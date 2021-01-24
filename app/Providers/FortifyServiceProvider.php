<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->orWhere('phone', $request->email)->first();

            if ($user && $user->isActive &&
                Hash::check($request->password, $user->password)) {
                return $user;
            } else {
                $message = "Nažalost ovaj email ili telefon ne postoji";
                if ($user !== null) {
                    if(!$user->isActive && !$user->isBlocked) {
                        $message = "Nažalost ovaj račun još nije odobren od strane admina. Molim pričekajte.";
                    } else if ($user->isBlocked) {
                        $message = "<p>Nažalost ovaj račun je blokiran. Obratite se administatoru.</p><p><a href='/kontakt' target='_blank'>Kontaktirajte nas</a></p> ";
                    } else {
                        $message = "Nažalost ovaj email i password se ne podudaraju.";
                    }
                }
                throw ValidationException::withMessages([
                    Fortify::username() => $message,
                ]);
            }
        });
    }
}
