<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/check-username', function (Request $request) {
    $username = $request->query('username');

    $exists = User::where('username', $username)->exists();

    return response()->json([
        'available' => !$exists,
    ]);
});
