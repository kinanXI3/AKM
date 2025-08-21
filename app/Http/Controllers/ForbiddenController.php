<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForbiddenController extends Controller
{
    public function showForbiddenPage()
    {
        abort(403, 'Forbidden');
    }
}
