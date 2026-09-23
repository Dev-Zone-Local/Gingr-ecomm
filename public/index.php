<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$url = $_SERVER['REQUEST_URI'];
if (strpos($url, 'public') !== false) {
    $url = str_replace('public/','',$url);
    header('location: '.$url);
    exit();
}

$scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");

$actual_link =  $scheme."://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if(!file_exists(__DIR__.'/../storage/installed') || !file_exists(__DIR__.'/../.env')) {
	if (!preg_match('/install/i', $actual_link)) {
	    header('location: install');
	    exit();
	}
}


$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// PHP 8.1+ adds a "full_path" key to every $_FILES entry. The bundled
// Symfony FileBag only recognises the classic five keys, so without this
// every upload is silently dropped and $request->hasFile() returns false.
foreach ($_FILES as $field => $info) {
    if (is_array($info)) {
        unset($_FILES[$field]['full_path']);
    }
}

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
