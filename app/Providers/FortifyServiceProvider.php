<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::loginView(function () {
            return view('auth.login');
        });

//        ResetPassword::createUrlUsing(function ($notifiable, string $token) {
//            return 'https://example.com/auth/reset-password?token='.$token;
//        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = null;

            if(is_numeric($request->get('email'))){
                $user = User::where('phone', $request->email)->first();
            } else {
                $user = User::where('email', $request->email)->first();
            }

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

    }
}
