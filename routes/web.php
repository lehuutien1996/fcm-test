<?php

use Illuminate\Support\Facades\Route;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

Route::get('/', function () {
    return view('welcome');
});

Route::post('save-token', function () {
    $attributes = request()->only([
        'user',
        'token',
    ]);

    session()->put('user', $attributes['user']);
    session()->put('token', $attributes['token']);

    $tokens = cache()->pull('tokens', []);
    $tokens[] = $attributes['token'];
    $tokens = array_unique($tokens);
    cache()->put('tokens', $tokens);

    return response()->json(
        compact('attributes', 'tokens')
    );
});

Route::post('send-message', function () {
    $message = request()->message ?? '';

    $user   = session()->get('user');
    $token  = session()->get('token');
    $tokens = cache()->get('tokens', []);

    $notification = (new PayloadNotificationBuilder($user))
        ->setBody($message)
        ->setSound('sound')
        ->setBadge('badge')
        ->build();

    $data = (new PayloadDataBuilder())
        ->setData([
            'user'    => $user,
            'message' => $message,
        ])
        ->build();

    FCM::sendTo(
        $tokens,
        null,
        $notification,
        $data
    );
    return response()->json(
        compact('message', 'user', 'tokens')
    );
});
