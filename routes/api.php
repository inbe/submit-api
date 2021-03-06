<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');
        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');
    });

    $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
        $api->post('tags', 'App\Api\V1\Controllers\TagsController@store');
        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to this item is only for authenticated user. Provide a token in your request!'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);
    });
    // tags
    $api->get('tags', 'App\\Api\\V1\\Controllers\\TagsController@index');
    $api->post('tags', 'App\\Api\\V1\\Controllers\\TagsController@store');
    $api->get('tags/{id}', 'App\\Api\\V1\\Controllers\\TagsController@show')->where('id', '[0-9]+');
    $api->get('issues', 'App\\Api\\V1\\Controllers\\IssuesController@index');
    $api->post('issues', 'App\\Api\\V1\\Controllers\\IssuesController@store');
    $api->get('issues/{id}', 'App\\Api\\V1\\Controllers\\IssuesController@show')->where('id', '[0-9]+');
    $api->put('issues/{id}', 'App\\Api\\V1\\Controllers\\IssuesController@update')->where('id', '[0-9]+');
    $api->get('hello', function() {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
});
