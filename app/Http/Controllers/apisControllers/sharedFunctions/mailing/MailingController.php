<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\mailing;

use App\Helpers\ConversationMessageHelper;
use App\Http\Controllers\Controller;
use App\Mail\UserNotification;
use App\Models\ConversationMessagesSeenModel;
use App\Models\ConversationsModel;
use App\Models\MessageModel;
use App\Models\Registration;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\UsersConversationsModel;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailingController extends Controller
{
    protected $messageService;


    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    // when send first message (to create the conversation)
    public function createNewMailWithMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_ids' => 'required', // json
            'message' => 'required',
            'message_file' => 'nullable',
            'conversation_name' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $conversation = new ConversationsModel();
        $conversation->c_name = $request->input('conversation_name');

        if ($conversation->save()) {

            // $user_ids = [(string) Auth::user()->u_id, (string) $request->input('user_ids')];
            // $user_ids_json = json_encode($user_ids);

            $user_conversation1 = new UsersConversationsModel();
            $user_conversation1->uc_conversation_id = $conversation->c_id;
            $user_conversation1->uc_user_id = $request->input('user_ids');
            $user_conversation1->save();

            $conversation_id =  $conversation->c_id;
            $message_text =  $request->input('message');
            $file = $request->hasFile('message_file') ? $request->file('message_file') : null;

            $message = $this->messageService->createMessage($conversation_id, $message_text, $file);

            if ($message != null) {
                $current_user = Auth::user();

                $this->messageService->markMessageAsSeen(
                    $conversation_id,
                    $message->m_id,
                    $current_user->u_id
                );

                // return this data with (same as getUserMailing)
                $mail = UsersConversationsModel::where('uc_conversation_id', $conversation->c_id)
                    ->where('uc_user_id', '!=', $current_user->u_id)
                    ->with('conversation')
                    ->with('lastMessage')
                    ->orderBy('created_at', 'desc')
                    ->first();

                if ($mail) {
                    $user_ids = json_decode($mail->uc_user_id, true);
                    if (is_array($user_ids)) {
                        $user_ids = array_filter($user_ids, fn($id) => $id != $current_user->u_id);
                    }
                    $users = User::whereIn('u_id', $user_ids)
                        ->select('u_id', 'name')
                        ->get();
                    $mail->users = $users;

                    // for seen
                    $last_message = ConversationMessageHelper::lastMessage($mail->uc_conversation_id);
                    $is_seen = false;
                    if ($last_message) {
                        $is_seen = ConversationMessageHelper::isMessageSeen($last_message->m_id, $current_user->u_id);
                    }
                    $mail->is_seen = $is_seen;
                }

                return response()->json([
                    'status' => true,
                    'mail' => $mail,
                    'message' => trans('messages.message_sent'),
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => trans('messages.message_not_sent'),
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'message' => trans('messages.message_error'),
        ]);
    }

    public function addNewMessage(Request $request)
    // replay
    {
        $validator = Validator::make($request->all(), [
            'conversations_id' => 'required',
            'message' => 'required',
            'message_file' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }



        $conversation_id =  $request->input('conversations_id');
        $message_text =  $request->input('message');
        $file = $request->hasFile('message_file') ? $request->file('message_file') : null;

        $message = $this->messageService->createMessage($conversation_id, $message_text, $file);

        if ($message != null) {
            $current_user_id = auth()->user()->u_id;

            $is_message_marked_as_seen = $this->messageService->markMessageAsSeen(
                $conversation_id,
                $message->m_id,
                $current_user_id
            );
            if ($is_message_marked_as_seen) {
                return response()->json([
                    'status' => true,
                    'message' => trans('messages.message_sent_successfully'),
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'message' => trans('messages.message_not_sent_error'),
        ]);
    }

    public function sendNotification()
    {
        $user = User::where('u_id', Auth::user()->u_id)->first();

        Mail::to($user->email)->send(new UserNotification($user));

        return 'Email sent successfully!';
    }

    public function getUserMailing()
    {
        $current_user = Auth::user();
        $conversation_ids_list = UsersConversationsModel::whereJsonContains('uc_user_id', (string) Auth::user()->u_id)
            ->pluck('uc_conversation_id');

        $mails = UsersConversationsModel::whereIn('uc_conversation_id', $conversation_ids_list)
            ->where('uc_user_id', '!=', $current_user->u_id)
            ->with('conversation')
            ->with('lastMessage')
            ->orderBy(
                MessageModel::select('created_at')
                    ->whereColumn('m_conversation_id', 'users_conversations.uc_conversation_id')
                    ->latest()
                    ->take(1),
                'desc'
            )
            ->paginate(14);


        // to get users and isSeen
        $mails->each(function ($mail) use ($current_user) {
            $user_ids = json_decode($mail->uc_user_id, true);
            // remove current user id
            if (is_array($user_ids)) {
                $user_ids = array_filter($user_ids, fn($id) => $id != $current_user->u_id);
            }
            $users = User::whereIn('u_id', $user_ids)
                ->select('u_id', 'name')
                ->get();
            $mail->users = $users;

            // for seen
            $last_message = ConversationMessageHelper::lastMessage($mail->uc_conversation_id);
            $is_seen = false;
            if ($last_message) {
                $is_seen = ConversationMessageHelper::isMessageSeen($last_message->m_id, $current_user->u_id);
            }
            $mail->is_seen = $is_seen;
        });

        return response()->json([
            'status' => true,
            'pagination' => [
                'current_page' => $mails->currentPage(),
                'last_page' => $mails->lastPage(),
                'per_page' => $mails->perPage(),
                'total_items' => $mails->total(),
            ],
            'mails' => $mails->items()
        ]);
    }

    public function getConversationMessages(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'conversation_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $messages = MessageModel::where('m_conversation_id', $request->input('conversation_id'))
            ->with('sender:u_id,name,u_image')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'messages' => $messages
        ]);
    }

    public function getChatableUsers()
    {
        $user = Auth::user();
        $chatable_users = [];

        $current_semester = SystemSetting::first();

        // (depend on year and semester)
        if ($user->u_role_id == 2) { // for student (he can chat his supervisor and managers)
            $managers = User::select('users.u_id', 'users.name')
                ->join('company_branches', 'users.u_id', '=', 'company_branches.b_manager_id')
                ->join('students_companies', 'company_branches.b_id', '=', 'students_companies.sc_branch_id')
                ->join('registration', 'students_companies.sc_registration_id', '=', 'registration.r_id')
                ->where('registration.r_student_id', $user->u_id)
                ->where('registration.r_year', $current_semester->ss_year)
                ->where('registration.r_semester', $current_semester->ss_semester_type)
                ->distinct()
                ->get();

            $supervisors = Registration::join('users', 'registration.supervisor_id', '=', 'users.u_id')
                ->where('registration.r_student_id', $user->u_id)
                ->where('registration.r_year', $current_semester->ss_year)
                ->where('registration.r_semester', $current_semester->ss_semester_type)
                ->select('users.u_id', 'users.name')
                ->distinct()
                ->get();

            // return $supervisors;
            $chatable_users = $managers->merge($supervisors)->unique('u_id');

            // return $chatableUsers;
        } else if ($user->u_role_id == 10) { // trainings supervisor (he can chat his students from registration table)
            $students = Registration::join('users', 'registration.r_student_id', '=', 'users.u_id')
                ->where('registration.supervisor_id', $user->u_id)
                ->where('registration.r_year', $current_semester->ss_year)
                ->where('registration.r_semester', $current_semester->ss_semester_type)
                ->select('users.u_id', 'users.name')
                ->distinct()
                ->get();

            // return $students;
            $chatable_users = $students->unique('u_id');
            // return $chatableUsers;
        } else if ($user->u_role_id == 6) { // manager (he can chat his trainees)
            $trainees = Registration::join('users', 'registration.r_student_id', '=', 'users.u_id')
                ->join('students_companies', 'registration.r_id', '=', 'students_companies.sc_registration_id')
                ->join('company_branches', 'students_companies.sc_branch_id', '=', 'company_branches.b_id')
                ->where('company_branches.b_manager_id', $user->u_id)
                ->where('registration.r_year', $current_semester->ss_year)
                ->where('registration.r_semester', $current_semester->ss_semester_type)
                ->select('users.u_id', 'users.name')
                ->distinct()
                ->get();

            $chatable_users = $trainees->unique('u_id');
            // return $chatableUsers;
        };

        // add all users that has role id = 8 to the chatable users
        $chatable_users = $chatable_users->merge(User::where('u_role_id', 8)->select('u_id', 'name')->get());

        return response()->json([
            'status' => true,
            'chatable_users' => $chatable_users
        ]);
    }

    public function markMessageAsSeen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conversation_id' => 'required|exists:conversations,c_id',
            'message_id' => 'required|exists:messages,m_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $current_user_id = auth()->user()->u_id;

        $success = $this->messageService->markMessageAsSeen(
            $request->input('conversation_id'),
            $request->input('message_id'),
            $current_user_id
        );

        if (!$success) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to mark message as seen'
            ], 422);
        }

        return response()->json([
            'status' => true,
            'message' => 'Message marked as seen successfully'
        ]);
    }


    public function unseenConversationsCount()
    {
        $current_user_id = auth()->user()->u_id;
        $unseen_conversations_count = $this->messageService->unseenConversationsCount($current_user_id);
        return response()->json([
            'status' => true,
            'unseen_conversations_count' => $unseen_conversations_count
        ]);
    }
}
