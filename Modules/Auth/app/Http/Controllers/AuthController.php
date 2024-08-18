<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth::sign-in');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth::sign-up');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required|same:password|min:8'
        ], [
            'required' => ':attribute wajib di isi!',
            'min' => ':attribute minimal :min karakter!',
            'email' => '::attribute harus valid :email',
            'unique' => ':attribute sudah digunakan oleh user lain, Silahkan gunakan :unique lain',
            'same' => ':attribute tidak sama dengan :other'
        ]);

        try {
            User::create([
                'id' => Uuid::uuid4()->toString(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user'
            ]);

            return to_route('auth.create')->with('success', 'Berhasil melakukan pendaftaran!');
        } catch (\Exception $th) {
            return to_route('auth.create')->with('error', 'Gagal melakukan pendaftaran!');
        }
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'required' => ':attribute wajib di isi!',
            'email' => '::attribute harus valid :email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('auth.index')->withErrors(['error' => 'Email tidak terdaftar'])->withInput();
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('auth.index')->witherrors(['error' => 'Password salah'])->withInput();
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('auth.index')->witherrors(['error' => 'Email atau Password salah'])->withInput();
        }
        $request->session()->regenerate();
        return match ($user->role) {
            'admin' => redirect()->route('admin.index'),
            // 'creator' => redirect('/artikel'),
            // 'akuntan' => redirect('/transaksi'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('auth.index');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('auth::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('auth::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
