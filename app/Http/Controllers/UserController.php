<?php

namespace App\Http\Controllers;

use App\Events\UserUpdated;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function update(User $user, UpdateUserRequest $request)
    {
        $this->authorize('update', $user);

        $user->update($request->all());

        UserUpdated::dispatch($user);
    }
}
