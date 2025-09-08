<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['username', 'password']);
        
        $user = \App\Models\Entities\Admin\User::where('username', $credentials['username'])->first();
        
        if ($user && Hash::check($credentials['password'], $user->password))  {

            $request->session()->regenerate();
                
            Auth::guard('web')->login($user);

            return redirect()->route('home')->with('success', 'Ingreso exitoso');
        }else {
            throw ValidationException::withMessages([
                'username' => ['El usuario o la contraseña son incorrectos.'], 
            ]);
        }
        
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); 

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect('/login'); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
