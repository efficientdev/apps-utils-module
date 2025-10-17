Readme.md


#components
<x-apps-utils::register-username />

#publish
php artisan vendor:publish --tag=apps-utils-components

#publish database migrations
php artisan vendor:publish --tag=apps-utils-migrations

#publish controllers, jobs
php artisan vendor:publish --tag=apps-utils



# in app\Models\User.php

use EfficientDev\AppsUtilsModule\Traits\HasUsername;

class User extends Authenticatable
{
    use HasUsername;

    // ...
}


# in app/Http/Controllers/Auth/AuthenticatedSessionController.php

use EfficientDev\AppsUtilsModule\Traits\UsernameAuthTrait;

class AuthenticatedSessionController extends Controller
{
    use UsernameAuthTrait;

    public function store(Request $request): RedirectResponse
    {
        return $this->usernameLogin($request);
    }

    // ...
}

#in app/Http/Controllers/Auth/PasswordResetLinkController.php

use EfficientDev\AppsUtilsModule\Traits\UsernameAuthTrait;

class PasswordResetLinkController extends Controller
{
    use UsernameAuthTrait;

    public function store(Request $request): RedirectResponse
    {
        return $this->sendUsernameBasedResetLink($request);
    }
}


#in app/Http/Controllers/Auth/RegisteredUserController.php

use EfficientDev\AppsUtilsModule\Traits\ValidatesUsername;

class RegisteredUserController extends Controller
{
    use ValidatesUsername;

    public function store(Request $request)
    {
        $request->validate([
            'username' => $this->usernameRules(),
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

