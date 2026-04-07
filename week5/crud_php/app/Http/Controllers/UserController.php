<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function index() {
        $data = User::all();
        return view('read', compact('data'));
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        // Custom validation messages
        $messages = [
            'username.required' => 'Please fill out this field.',
            'email.required' => 'Please fill out this field.',
            'email.email' => 'Invalid email address.',
            'email.unique' => 'This email is already registered. Please try another',
            'username.unique' => 'This username is already registered. Please try another'
        ];

        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users'
        ], $messages);

        User::create($request->all());
        return redirect('/create')->with('success', 'User has been successfully inserted.');
    }

    public function edit($id) {
        $data = User::find($id);
        return view('update', compact('data'));
    }

    public function update(Request $request, $id) {
        $data = User::find($id);
        
        // Custom validation messages
        $messages = [
            'username.required' => 'Please fill out this field.',
            'email.required' => 'Please fill out this field.',
            'email.email' => 'Invalid email address.',
            'email.unique' => 'This email is already registered. Please try another',
            'username.unique' => 'This username is already registered. Please try another'
        ];

        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id
        ], $messages);
        
        $data->update($request->all());
        return redirect('/')->with('success', 'User has been successfully updated.');
    }

    public function delete($id) {
        User::destroy($id);
        return redirect('/');
    }
}
