<?php
namespace EfficientDev\AppsUtilsModule\Traits;

use EfficientDev\AppsUtilsModule\Rules\ValidUsername;

trait ValidatesUsername
{
    /**
     * Get validation rules for a username field.
     *
     * @param  int|null  $ignoreUserId  If updating a user, ignore this ID for unique check
     * @return array
     */
    public function usernameRules0(?int $ignoreUserId = null): array
    {
        $uniqueRule = 'unique:users,username';

        if ($ignoreUserId) {
            $uniqueRule .= ",{$ignoreUserId}";
        }

        return [
            'required',
            'string',
            'max:255',
            $uniqueRule,
            'regex:/^[a-zA-Z0-9_.-]+$/', // optional: restrict allowed characters
        ];
    }
    public function usernameRules(?int $ignoreUserId = null): array
    {
    	$username = strtolower(request()->username ?? '');
		/*$uniqueRule = 'unique:users,username';

		if ($ignoreUserId) {
		    $uniqueRule .= ",{$ignoreUserId}";
		}*/


        $uniqueRule = 'unique:users,username';

        if ($ignoreUserId) {
            $uniqueRule .= ",{$ignoreUserId}";
        }

        return [
            'required',
            'string',
            'max:255',
            new ValidUsername,
            $uniqueRule,
        ];
    }
}
