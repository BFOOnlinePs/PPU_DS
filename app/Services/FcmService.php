<?php

namespace App\Services;

use App\Models\FCMRegistrationTokens;
use App\Models\NotificationModel;
use App\Models\NotificationUserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\Messaging\NotFound;
use Kreait\Firebase\Exception\Messaging\InvalidArgument;


class FcmService
{
    protected $messaging;

    public function __construct()
    {
        $firebase = (new Factory)->withServiceAccount(config('firebase.projects.app.credentials'));
        $this->messaging = $firebase->createMessaging();
    }


    /// save the notification in database even no tokens are available
    /// handle the payload
    public function sendNotification(String $title, String $body, array $userIds, $type = null, $type_id = null)
    {
        // // remove the current user from the list
        // $userIds = array_filter($userIds, fn($id) => $id != Auth::user()->u_id);

        Log::info('aseel in sendNotification');
        Log::info('aseel userIds', $userIds);
        $tokensByUser = FCMRegistrationTokens::whereIn('frt_user_id', $userIds)
            ->pluck('frt_registration_token')
            ->toArray();

        Log::info('aseel tokensByUser', $tokensByUser);

        $notification = NotificationModel::create([
            'title' => $title,
            'body' => $body,
        ]);

        foreach ($userIds as $userId) {
            NotificationUserModel::create([
                'notification_id' => $notification->id,
                'user_id' => $userId,
            ]);
        }

        Log::info("aseel 2 models created");

        $this->sendToTokens($title, $body, $tokensByUser, $type, $type_id);
    }

    private function sendToTokens($title, $body, $tokens, $type, $type_id)
    {
        $notification = Notification::create($title, $body);

        $message = CloudMessage::new()
            ->withNotification($notification);

        if (!empty($tokens)) {
            try {
                // Send the message via FCM
                $report = $this->messaging->sendMulticast($message, $tokens);

                Log::info('Message sent successfully to tokens:', ['tokens' => $tokens]);
                Log::info('Success count:', ['count' => $report->successes()->count()]);
                Log::info('Failure count:', ['count' => $report->failures()->count()]);
                Log::info('unknownTokens', ['tokens' => $report->unknownTokens()]);
                Log::info('invalidTokens', ['tokens' => $report->invalidTokens()]);

                // Handle unknown tokens
                foreach ($report->unknownTokens() as $token) {
                    FCMRegistrationTokens::where('frt_registration_token', $token)->delete();
                    Log::info('Deleted unknown FCM token:', ['token' => $token]);
                }

                // Handle invalid tokens
                foreach ($report->invalidTokens() as $token) {
                    FCMRegistrationTokens::where('frt_registration_token', $token)->delete();
                    Log::info('Deleted invalid FCM token:', ['token' => $token]);
                }
            } catch (NotFound $e) {
                Log::info('Token not found: ' . $e->getMessage());
            } catch (InvalidArgument $e) {
                Log::info('Invalid argument: ' . $e->getMessage());
            } catch (\Exception $e) {
                Log::info('Error sending message: ' . $e->getMessage());
            }
        } else {
            Log::info('No tokens found');
        }
    }


    // not used anymore
    private function sendToToken($title, $body, $userId, $token, $type, $type_id)
    {
        $notification = Notification::create($title, $body);

        // Create a message targeting a specific token
        // i edited it since toTarget is deprecated
        $message = CloudMessage::new()
            ->toToken($token)
            ->withNotification($notification);

        $data = [];

        if ($type !== null) {
            $data[config('constants.notification.type')] = $type;
        }

        if ($type_id !== null) {
            $data[config('constants.notification.type_id')] = $type_id;
        }

        // Attach data payload if it exists
        if (!empty($data)) {
            $message = $message->withData($data);
        }

        try {
            // Send the message via FCM
            $this->messaging->send($message);
            Log::info('Message sent successfully to token: ' . $token);
        } catch (NotFound $e) {
            Log::info('Token not found: ' . $e->getMessage());
            $fcmUserToken = FCMRegistrationTokens::where('frt_user_id', $userId)
                ->where('frt_registration_token', $token)->get();

            // if by accident saved the same token more than one time
            foreach ($fcmUserToken as $token) {
                Log::info('delete token: ' . $token);

                $token->delete();
            }
        } catch (InvalidArgument $e) {
            Log::info('Invalid argument: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::info('Error sending message: ' . $e->getMessage());
        }
    }
}
