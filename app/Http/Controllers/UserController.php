<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(25);

        return view('users', ['users' => $users]);
    }

    public function searchUsers($search) {
        $users = User::where('name', 'LIKE', '%'.$search.'%')
            ->select('name', 'email')
            ->limit(5)
            ->get();

        return response()->json($users);
    }
}
