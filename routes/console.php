<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('email:send {user}', function(\App\DripEmailer $drip, $user){
    $drip->send(\App\User::find($user));
});

Artisan::command('load:oa_users', function( \App\Console\Commands\Load_oa_user_for_adsage_company $loadOaUser){
    $loadOaUser->handle();
});
