<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('rule')->paginate(5);
        return view('auth.users')->with('users', $users);
    }

    public function error403()
    {
        return view('error403');
    }

    public function edit_user_rule($id)
    {
        $user = User::with('rule')->find($id);
        // return $user;
        $rules = Rule::all();
        return view('auth.edit_user_rule', compact('user', 'rules'));
    }

    public function update_rule(Request $request, $id)
    {
        $user = User::find($id);
        $user->rule_id = $request->rule_id;
        $user->save();
        return redirect()->back()->with('done', "User Rule Updated Successfuly");
    }

    public function delete_user($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('done', "User Deleted Successfully");
        }

        return redirect()->back()->with('error', "User not found");
    }



}
