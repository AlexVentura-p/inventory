<?php

namespace App\Api\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show()
    {
        if (request()->user()->exists) {
            return response(request()->user(),201);
        }

        return response('User Not found', 401);

    }
}
