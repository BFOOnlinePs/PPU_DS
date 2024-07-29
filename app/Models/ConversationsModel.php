<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationsModel extends Model
{
    use HasFactory;
    protected $table = 'conversations';
    protected $primaryKey = 'c_id';

    public function participants()
    {
        return $this->hasMany(UsersConversationsModel::class);
    }
    public function messages()
    {
        // return $this->hasMany(Message::class);
    }
}
