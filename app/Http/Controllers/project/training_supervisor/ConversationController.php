<?php

namespace App\Http\Controllers\project\training_supervisor;

use App\Http\Controllers\Controller;
use App\Models\ConversationsModel;
use App\Models\MessageModel;
use App\Models\User;
use App\Models\UsersConversationsModel;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $data = ConversationsModel::whereIn('c_id',function ($query){
            $query->select('uc_conversation_id')->from('users_conversations')->where('uc_user_id',auth()->user()->u_id);
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
        $users = User::get();
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
