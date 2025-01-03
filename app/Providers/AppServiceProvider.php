<?php

namespace App\Providers;

use App\Models\ConversationsModel;
use App\Models\MessageModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Socialite\Facades\Socialite;
use App\Services\CustomIdentityServerProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        // $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**\
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
            $message = MessageModel::with(['conversation.participants'])
    ->whereDoesntHave('conversationMessagesSeen', function ($query) {
        $query->whereColumn('messages.m_id', 'conversation_messages_seen.cms_message_id')->latest()->limit(1);
    })
    ->latest() // Fetch the latest messages
    ->take(4)
    ->get();
            $view->with('message', $message );
        } else {
            // Handle the case where the user is not authenticated (optional)
        }
    });

    // Socialite::extend('identity_server', function ($app) {
    //     $config = $app['config']['services.identity_server'];
    //     return new CustomIdentityServerProvider(
    //         $app['request'],
    //         $config['client_id'],
    //         $config['client_secret'],
    //         $config['redirect']
    //     );
    // });
    Paginator::useBootstrapFive();
}
}
