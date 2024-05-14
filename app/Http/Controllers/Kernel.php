<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...
        \Edwink\FilamentUserActivity\Http\Middleware\RecordUserActivity::class,
    ];

}