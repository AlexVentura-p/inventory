<?php

namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function show()
    {
        if (request()->user()->exists) {
            return response(
                UserResource::make(request()->user()),
                201
            );
        }

        return   http_response_code(401);
    }
}
