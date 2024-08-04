<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersConversationsModel extends Model
{
    use HasFactory;

    protected $table = 'users_conversations';
    protected $primaryKey = 'uc_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'uc_user_id', 'u_id');
    }
    public function conversation()
    {
        return $this->belongsTo(ConversationsModel::class,'uc_conversation_id' ,'c_id');
    }
    public function lastMessage()
    {
        return $this->hasOne(MessageModel::class, 'm_conversation_id', 'uc_conversation_id')
            ->orderBy('created_at', 'desc')
            ->orderBy('m_id', 'desc');
    }

    public function receive()
    {
        return $this->belongsTo(User::class , 'uc_user_id');
    }
}
