<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        $user = User::whereEmail($request->get('email'))->first();

        if (!$user->activated_at) {
            abort(401, 'You can not log in as your account has not been activated yet.');
        }

        if (!auth()->attempt($request->only(['email', 'password']))) {
            abort(401, 'Unauthenticated.');
        }
    }
}
