<?php

namespace App\Listeners\Users;

use App\LoginHistory;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateLastLoggedInAt
{
    /**
     * Store DateTime whenever user logs in the app
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $login = new LoginHistory();
        $login->user_id = \Auth::User()->id;
        $login->login = Carbon::now();
        $login->save();
    }
}
