<?php
namespace EfficientDev\AppsUtilsModule\Traits;

trait HasUsername
{
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    // Optional: helpful accessor
    public function getRouteKeyName()
    {
        return 'username';
    }
    public function setUsernameAttribute($value)
	{
	    $this->attributes['username'] = strtolower($value);
	}

}
