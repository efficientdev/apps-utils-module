
---

# Apps Utils Module

A Laravel package providing utility components and traits for handling usernames during registration, login, and password reset processes.

---

## 📦 Installation

```bash
composer require efficientdev/apps-utils-module
```

---

## 🧩 Components

Use the following Blade component in your registration view:

```blade
<x-apps-utils::register-username />
```

---

## 🚀 Publishing Assets

### Publish UI Components

```bash
php artisan vendor:publish --tag=apps-utils-components
```

### Publish Database Migrations

```bash
php artisan vendor:publish --tag=apps-utils-migrations
```

### Publish Controllers, Jobs, and More

```bash
php artisan vendor:publish --tag=apps-utils
```

---

## 🧠 Usage

### 1. Update Your `User` Model

```php
// app/Models/User.php

use EfficientDev\AppsUtilsModule\Traits\HasUsername;

class User extends Authenticatable
{
    use HasUsername;

    // ...
}
```

---

### 2. Update Auth Controllers

#### Login Controller

```php
// app/Http/Controllers/Auth/AuthenticatedSessionController.php

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
```

#### Password Reset Controller

```php
// app/Http/Controllers/Auth/PasswordResetLinkController.php

use EfficientDev\AppsUtilsModule\Traits\UsernameAuthTrait;

class PasswordResetLinkController extends Controller
{
    use UsernameAuthTrait;

    public function store(Request $request): RedirectResponse
    {
        return $this->sendUsernameBasedResetLink($request);
    }
}
```

#### Registration Controller

```php
// app/Http/Controllers/Auth/RegisteredUserController.php

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
```

---

## ✅ Summary

This module makes it easy to integrate username-based authentication into your Laravel app, including:

* Registration form field
* Login with username
* Username validation and database support
* Password reset via username

---
