<?php

namespace App\Services;

use App\Models\NotificationUserModel;

class NotificationsService
{

    public function unseenNotificationsCount($user_id): int
    {
        return NotificationUserModel::where('user_id', $user_id)
            ->where('is_read', 0)
            ->count();
    }

    public function markNotificationsAsRead($notification_id, $user_id): void
    {
        NotificationUserModel::where('notification_id', $notification_id)
            ->where('user_id', $user_id)
            ->update(['is_read' => 1]);
    }
}
