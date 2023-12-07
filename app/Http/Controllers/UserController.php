<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginpage()
    {
        return view('login.loginpage');
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        /*
                if (Auth::attempt($credential)) {
                    return redirect()->route('dashboard');
                }
        */
        if(Auth::attempt($credential)){
            dd('coba masuk');
                $user = role::where('Email', $request->email)->first();
                if($user){
                    $userRole = $user->Nama_Role;
                    switch ($userRole) {
                        case 'Kepala Sekolah':
                            return redirect('superadmin/dashboardsuperadmin');
                        case 'Siswa':
                            return redirect('/siswa/dashboardsiswa');
                        case 'Guru':
                            return redirect('/guru/dashboardguru');
                        default:
                            return redirect('/admin/dashboardadmin');
                }
            } else {
                dd('gagal');
                return back()->withErrors(['email' => 'Login gagal. Periksa email dan password Anda.']);
            }
        }        
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}