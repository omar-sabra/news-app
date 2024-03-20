<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('admin.users.index', compact('users'));
    }

    public function trashedUsers() {
            $users = User::onlyTrashed()->paginate(5);
            return view('admin.users.trashed-users', compact('users'));
        }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|same:confirm_password',
//            'confirm_password' => 'same:password',
            'username' => 'required|string|max:255',
        ]);

        if (!$request->has('role')) {
            $request->request->add(['role' => 1]);
        } else {
            $request->request->add(['role' => 0]);
        }

        if (!$request->has('status')) {
            $request->request->add(['status' => 1]);
        } else {
            $request->request->add(['status' => 0]);
        }

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
//            'confirm_password' => Hash::check($request->confirm_password, Hash::make($request->password)),
            'username' => $request->username,
            'role' => $request->role,
            'status' => $request->status,
        ]);
        return redirect()->route('users')->with('success', 'User Created Successfully');
    }

     public function editStatusUser(Request $request) {
        $user = User::where('id', $request->id)->first();
        if ($user['status'] == 1) {
            $user->update([
                'status' => 0
            ]);
        } else {
            $user->update([
                'status' => 1
            ]);
        }
         return response()->json(['status' => $user->status]);
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:4|same:confirm_password',
//            'confirm_password' => 'same:password',
            'username' => 'required|string|max:255',
        ]);

        if ($request->has('role')) {
            $request->request->add(['role' => 0]);
        } else {
            $request->request->add(['role' => 1]);
        }

        if ($request->has('status')) {
            $request->request->add(['status' => 0]);
        } else {
            $request->request->add(['status' => 1]);
        }

        User::where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
//            'confirm_password' => Hash::check($request->confirm_password, Hash::make($request->password)),
            'username' => $request->username,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('users')->with('success', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy($id)
//    {
//
//    }

    public function softDelete($id) {
        $user_id = User::find($id);
        $user_id->delete();
        return redirect()->route('users')->with('success', 'User Deleted Successfully');
    }
}
