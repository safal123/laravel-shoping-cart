<?php

namespace App\Http\Controllers\Api;

use App\UserList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersListController extends Controller
{
    public function index() 
    {
        //$users = UserList::orderBy('id', 'desc')->get();
        $users = UserList::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validate = $request->validate([
          'name' => 'required',
          'email' => 'required|email|unique:user_lists',
          'message' => 'required'
      ]);

        $user =  UserList::create($data);

        return response()->json([
            'user' => $user,
            'message' => 'User saved successfully',
        ]);
    }

    public function destroy($id)
    {
        $user = UserList::find($id);

        if($user) {
            $user->delete();
            return response()->json(['success' => 'Deleted successfully']);
        }
        return response()->json(['error' => 'Information cannot be found.']);
    }
}
