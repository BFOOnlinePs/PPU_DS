<?php

namespace App\Http\Controllers\project\training_supervisor;

use App\Http\Controllers\Controller;
use App\Models\ConversationsModel;
use App\Models\User;
use App\Models\UsersConversationsModel;

class ConversationController extends Controller
{
    public function index()
    {
        $data = ConversationsModel::get();
        return view('project.training_supervisor.conversation.index',['data'=>$data]);
    }

    public function details($id)
    {
        $data = UsersConversationsModel::where('uc_conversation_id',$id)->get();
        return view('project.training_supervisor.conversation.details',['data'=>$data]);
    }

    public function add()
    {
        $users = User::get();
        return view('project.training_supervisor.conversation.add',['users'=>$users]);
    }
}
