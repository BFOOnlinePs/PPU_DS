<?php

namespace App\Http\Controllers\project\training_supervisor;

use App\Http\Controllers\Controller;
use App\Models\ConversationsModel;
use App\Models\MessageModel;
use App\Models\User;
use App\Models\UsersConversationsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    public function index()
    {
        $data = ConversationsModel::whereIn('c_id',function ($query){
            $query->select('m_conversation_id')->from('messages')->where('m_sender_id',auth()->user()->u_id)->orWhereIn('m_id',function ($query2){
                $query2->select('uc_conversation_id')->from('users_conversations')->where('uc_user_id',auth()->user()->u_id);
            });
        })->get();
        return view('project.training_supervisor.conversation.index',['data'=>$data]);
    }

    public function details($id)
    {
        $data = MessageModel::where('m_conversation_id',$id)->with(['sender'])->get();
        $receive = UsersConversationsModel::where('uc_conversation_id',$id)->with('receive')->first();
        return view('project.training_supervisor.conversation.details',['data'=>$data , 'id'=>$id , 'receive'=>$receive]);
    }

    public function add()
    {
        $users = User::query();
        if (auth()->user()->u_role_id == 2){
            $users->where(function($query) {
                $query->whereIn('u_id', function($query) {
                    $query->select('supervisor_id')
                          ->from('registration')
                          ->where('r_student_id', auth()->user()->u_id);
                })
                ->orWhereIn('u_id', function($query) {
                    $query->select('c_manager_id')
                          ->from('companies')
                          ->whereIn('c_id', function($query2) {
                              $query2->select('sc_company_id')
                                     ->from('students_companies')
                                     ->where('sc_student_id', auth()->user()->u_id);
                          });
                });
            })->orWhere('u_role_id', 8);
            // $users->wherein('u_id',function($query){
            //     $query->select('supervisor_id')->from('registration')->where('r_student_id',auth()->user()->u_id);
            // });
            // $users->whereIn('u_id',function($query){
            //     $query->select('c_manager_id')->from('companies')->whereIn('c_id' , function($query2){
            //         $query2->select('sc_company_id')->from('students_companies')->where('sc_student_id',auth()->user()->u_id);
            //     });
            // });

            // $users->where('u_role_id',8);
        }
        if (auth()->user()->u_role_id == 10){
            // $users->whereIn('u_id', function ($query) {
            //     $query->select('c_manager_id')
            //         ->from('companies')
            //         ->whereIn('c_id', function ($query) {
            //             $query->select('sc_company_id')
            //                 ->from('students_companies')
            //                 ->whereIn('sc_registration_id', function ($query) {
            //                     $query->select('r_id')
            //                         ->from('registration')
            //                         ->where('supervisor_id', 510);
            //                 });
            //         });
            // });
            $users->whereIn('u_id',function($query){
                $query->select('r_student_id')->from('registration')->where('supervisor_id',auth()->user()->u_id);
            })
            ->orWhere('u_role_id', 8);
        }
        if (auth()->user()->u_role_id == 6){
            $users->whereIn('u_id',function($query){
                $query->select('sc_student_id')->from('students_companies')->whereIn('sc_company_id',function($query2){
                    $query2->select('c_id')->from('companies')->where('c_manager_id',auth()->user()->u_id);
                });
            })
            ->orWhere('u_role_id',8);
        }
        $users = $users->get();
        return view('project.training_supervisor.conversation.add',['users'=>$users]);
    }

    public function create(Request $request)
    {
        $conversations = new ConversationsModel();
        $conversations->c_name = $request->c_name;
        if ($conversations->save()){
            $data = new UsersConversationsModel();
            $data->uc_conversation_id = $conversations->c_id;
            $data->uc_user_id = $request->uc_user_id;
            if ($data->save()){
                $messages = new MessageModel();
                $messages->m_conversation_id = $conversations->c_id;
                $messages->m_sender_id = auth()->user()->u_id;
                $messages->m_message_text = $request->m_message_text;
                $messages->m_status = 1;
                $messages->save();
                return redirect()->route('training_supervisor.conversation.details',['id'=>$conversations->c_id])->with(['success' => 'تمت الاضافة بنجاح']);
            }
        }
    }

    public function create_message(Request $request)
    {
        $data = new MessageModel();
        $data->m_conversation_id = $request->m_conversation_id;
        $data->m_sender_id = auth()->user()->u_id;
        $data->m_message_text = $request->m_message_text;
        $data->m_status = 1;
        if($data->save()){
            return redirect()->route('training_supervisor.conversation.details',['id'=>$request->m_conversation_id])->with(['success' => 'تم اضافة الرسالة بنجاح']);
        }
    }
}
