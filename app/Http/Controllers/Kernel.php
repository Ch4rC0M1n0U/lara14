<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Edwink\FilamentUserActivity\Http\Middleware\RecordUserActivity;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...
        RecordUserActivity::class,
    ];

}