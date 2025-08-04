<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */



    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'full_name' => 'required|string|max:255',
            'dob' => 'required|date|before:today',
        ]);

        $fullName = $validated['full_name'];
        $parts = explode(' ', $fullName);
        $initials = '';

        foreach ($parts as $part) {
            $initials .= strtoupper(substr($part, 0, 1)) . '.';
        }

        User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'full_name' => $fullName,
            'initial_name' => $initials,
            'dob' => $validated['dob'],
        ]);

        return response()->json(['message' => 'User created successfully!']);

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
