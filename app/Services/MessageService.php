<?php

namespace App\Services;

use App\Models\ConversationMessagesSeenModel;
use App\Models\MessageModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageService
{
    public function createMessage($conversation_id, $message_text, $file = null): MessageModel
    {
        Log::info('aseel createMessage');
        $message = new MessageModel();

        $message->m_conversation_id = $conversation_id;
        $message->m_sender_id = Auth::user()->u_id;
        $message->m_message_text = $message_text;
        Log::info('aseel messageModel');

        if ($file) {

            $extension = $file->getClientOriginalExtension();
            $file_name = time() . '_' . uniqid() . '.' . $extension;
            $folderPath = 'uploads/mails';
            $file->storeAs($folderPath, $file_name, 'public');

            $message->m_message_file = $file_name;
            Log::info('aseel message file');
        }

        // // mark as reed
        // $this->markMessageAsSeen($message->m_id);
        $message->save();
        return $message->save() ? $message : null;
    }


    public function markMessageAsSeen(int $conversation_id, int $message_id, int $user_id): bool
    {
        // if exists in seen table, update it, else create it
        $last_message_seen = ConversationMessagesSeenModel::where('cms_conversation_id', $conversation_id)
            ->where('cms_receiver_id', $user_id)
            ->first();

        if ($last_message_seen) {
            $last_message_seen->cms_message_id = $message_id;
            return $last_message_seen->save();
        } else {
            $last_message_seen = new ConversationMessagesSeenModel();
            $last_message_seen->cms_conversation_id = $conversation_id;
            $last_message_seen->cms_message_id = $message_id;
            $last_message_seen->cms_receiver_id = $user_id;
            return $last_message_seen->save();
        }
    }
}
