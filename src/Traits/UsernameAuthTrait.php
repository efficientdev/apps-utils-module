<?php
namespace EfficientDev\AppsUtilsModule\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Models\User;

trait UsernameAuthTrait
{
    protected function usernameLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = strtolower($request->username);

        if (Auth::attempt([
            'username' => $username??$request->username,
            'password' => $request->password
        ], $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(config('app.url')); // or RouteServiceProvider::HOME
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    protected function sendUsernameBasedResetLink(Request $request)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
        ]);

        $user = User::where('username', $request->username)->first();

        // Optionally prevent reset if email is shared
        // if (User::where('email', $user->email)->count() > 1) {
        //     return back()->withErrors(['username' => 'Password reset unavailable for shared emails.']);
        // }

        $status = Password::sendResetLink([
            'email' => $user->email,
        ]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['username' => __($status)]);
    }
}
