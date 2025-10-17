<?php
namespace EfficientDev\AppsUtilsModule\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidUsername implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-zA-Z0-9_.-]+$/', $value);
    }

    public function message()
    {
        return 'Usernames may only contain letters, numbers, dashes, underscores, and dots.';
    }
}
