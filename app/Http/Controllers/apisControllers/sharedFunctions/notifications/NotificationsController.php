<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\notifications;

use App\Http\Controllers\Controller;
use App\Models\NotificationUserModel;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function getUserNotifications()
    {
        $user_id = auth()->user()->u_id;
        $user = User::where('u_id', $user_id)->first();
        $notifications = $user->notifications()
            ->orderBy('notifications.created_at', 'desc')
            ->paginate(10);

        $notifications->getCollection()->transform(function ($notification) {
            $notification->notification_user = $notification->pivot;
            unset($notification->pivot);
            return $notification;
        });

        return response()->json([
            'status' => true,
            'pagination' => [
                'current_page' => $notifications->currentPage(),
                'last_page' => $notifications->lastPage(),
                'per_page' => $notifications->perPage(),
                'total_items' => $notifications->total(),
            ],
            'notifications' => $notifications->items()
        ]);
    }


    public function markNotificationsAsRead(Request $request)
    {
        $notification_id = $request->input('notification_id');
        $user_id = auth()->user()->u_id;
        $notification = NotificationUserModel::where('notification_id', $notification_id)
            ->where('user_id', $user_id)
            ->first();

        if ($notification) {
            $notification->is_read = 1;
            $notification->save();
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
