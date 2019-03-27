<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);

        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray(),
            ], 200);
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);

        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray(),
            ], 200);
    }

    public function getDownline()
    {
        $members = User::where('parent_id', auth()->user()->id)->get();
        return response()->json(
            [
                'status' => 'success',
                'user' => $members->toArray(),
            ], 200);

    }

}