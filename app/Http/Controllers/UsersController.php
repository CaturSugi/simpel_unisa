<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Termwind\Components\Dd;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return view('layouts.pages.users.index',compact('users'));
    }

    public function create()
    {
        return view('layouts.pages.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required',       
        ]);
        // @Dd($request->all());
        User::create($request->all());

        return redirect('/users');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $users = User::find($id);
        $users->update($request->all());

        return redirect('/users');
    }

    public function edit($id)
    {
        $users = User::find($id);
        return view('layouts.pages.users.edit', compact('users'));
    }

    public function delete($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect()->to('/users');
    }

    public function show($id)
    {
        $users = User::find($id);
        return view('layouts.pages.users.show', compact('users'));
    }

    public function softdelete()
    {
        $users = User::onlyTrashed()->paginate(5);
        return view('layouts.pages.users.softdelete', compact('users'));
    }

    public function restore($id)
    {
        $users = User::withTrashed()->find($id);
        $users->restore();
        return redirect()->to('/users');
    }

    public function forceDelete($id)
    {
        $users = User::onlyTrashed()->find($id);
        $users->forceDelete();
        return redirect()->to('/users');
    }

    // public function profile()
    // {
    //     // $user = User::find($id);
    //     return view('layouts.pages.users.profile.user');
    // }

    // public function editProfile(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users,email,' . $id,
    //         'password' => 'nullable|min:6',
    //     ]);

    //     $user = User::find($id);
    //     $data = $request->only(['name', 'email']);
    //     if ($request->filled('password')) {
    //         $data['password'] = bcrypt($request->password);
    //     }
    //     $user->update($data);

    //     return redirect()->route('users.profile', ['id' => $id]);
    // }
}
