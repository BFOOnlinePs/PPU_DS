<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\mailing;

use App\Http\Controllers\Controller;
use App\Models\CompanyBranch;
use App\Models\ConversationsModel;
use App\Models\MessageModel;
use App\Models\Registration;
use App\Models\StudentCompany;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\UsersConversationsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MailingController extends Controller
{
    public function addNewMessage(Request $request)
    // replay
    {
        $validator = Validator::make($request->all(), [
            'conversations_id' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user_id = Auth::user()->u_id;

        $message = new MessageModel();

        $message->m_conversation_id = $request->input('conversations_id');
        $message->m_sender_id = $user_id;
        $message->m_message_text = $request->input('message');
        $message->m_status = 1;

        if ($message->save()) {
            return response()->json([
                'status' => true,
                'message' => 'تم الارسال بنجاح'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'هناك خلل ما حدث أثناء إرسال الرسالة'
            ]);
        }
    }
    public function getUserMailing()
    {
        $current_user = Auth::user();
        $conversation_id_list = UsersConversationsModel::where('uc_user_id', $current_user->u_id)
            ->pluck('uc_conversation_id');

        $mails = UsersConversationsModel::whereIn('uc_conversation_id', $conversation_id_list)
            ->where('uc_user_id', '!=', $current_user->u_id)
            ->with('conversation')
            ->with('user:u_id,name')
            ->with('lastMessage')
            ->orderBy('created_at', 'desc')
            ->get();


        return response()->json([
            'status' => true,
            'mails' => $mails
        ]);
    }
    // when send first message
    public function createNewMailWithMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required',
            'message' => 'required',
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
            $user_conversation1 = new UsersConversationsModel();
            $user_conversation1->uc_conversation_id = $conversation->c_id;
            $user_conversation1->uc_user_id = Auth::user()->u_id;
            $user_conversation1->save();

            $user_conversation2 = new UsersConversationsModel();
            $user_conversation2->uc_conversation_id = $conversation->c_id;
            $user_conversation2->uc_user_id = $request->input('receiver_id');
            $user_conversation2->save();

            $message = new MessageModel();
            $message->m_conversation_id = $conversation->c_id;
            $message->m_sender_id = Auth::user()->u_id;
            $message->m_message_text = $request->input('message');
            $message->m_status = 1;

            if ($message->save()) {
                return response()->json([
                    'status' => true,
                    'message' => 'تم الإرسال بنجاح'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'هناك خلل ما حدث أثناء إنشاء المحادثة'
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'message' => 'هناك خلل ما'
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
            // ->orderBy('created_at', 'desc')
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


        // (depend of year and semester)
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

        return response()->json([
            'status' => true,
            'chatable_users' => $chatable_users
        ]);
    }
}
