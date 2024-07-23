<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('is_deleted', false)->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:member,student',
        ]);

        DB::table('users')->insert([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:member,student',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = $validated['password'];
        }

        DB::table('users')->where('id', $id)->update($updateData);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->update(['is_deleted' => true]);
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function promote($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if ($user->role !== 'student') {
            DB::table('users')->where('id', $id)->update([
                'role' => 'student',
                'updated_at' => now(),
            ]);
            return redirect()->route('users.index')->with('success', 'User promoted to student successfully.');
        }

        return redirect()->route('users.index')->with('info', 'User is already a student.');
    }
}