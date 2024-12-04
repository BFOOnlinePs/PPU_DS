<?php

namespace App\Providers;

use App\Models\ConversationsModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    // Check if the user is authenticated

    view()->composer('*', function ($view)
    {
        if (Auth::check()) {
            // Get the authenticated user
            $userId = auth()->user()->u_id;

            // Query to get the conversations
//             $message = ConversationsModel::query();
// $message->whereIn('c_id', function ($query) use ($userId) {
//     $query->select('uc_conversation_id')
//         ->from('users_conversations')
//         ->whereJsonContains('uc_user_id', $userId)
//         ->whereIn('uc_conversation_id', function ($query2) {
//             $query2->select('m_conversation_id')->from('messages')->latest()->take(1);
//         })->whereNotIn('m_conversation_id', function ($query3) use ($userId) {
//             $query3->select('conversation_id')
//                 ->from('conversation_messages_seen')
//                 ->where('user_id', $userId);
//         });
// });
//             $message = $message->with('user', 'participants')
//                 ->orderBy('c_id', 'desc')
//                 ->get();

//             $view->with('cart', $message );
        } else {
            // Handle the case where the user is not authenticated (optional)
        }
    });


    Paginator::useBootstrapFive();
}
}
