<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function index(Request $request ,$perPage=2)
    {
        // $perPage = 2; // Number of items per page
        $users = User::paginate($perPage);
        return response()->json($users);
    }

    public function show($id){
        $user = User::find($id);
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
