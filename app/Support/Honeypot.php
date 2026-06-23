<?php

namespace App\Support;

use Illuminate\Http\Request;

class Honeypot
{
    public static function isBot(Request $request): bool
    {
        return $request->filled('website') || $request->filled('company_url');
    }
}
