<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            return UserResource::collection(User::all());
        } else {
            abort(403, 'Unauthorized');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        if (auth()->user()->role_id == 1) {
            $create_user = User::create($request->validated());
            return new UserResource($create_user);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (auth()->user()->role_id == 1) {
            return new UserResource($user);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, User $user)
    {
        if (auth()->user()->role_id == 1) {
            $user->update($request->validated());
            return new UserResource($user);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->user()->role_id == 1) {
            $user->delete();
            return response(null, ResponseAlias::HTTP_NO_CONTENT);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
