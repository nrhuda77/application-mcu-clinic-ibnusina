<?php

namespace Modules\LoginPasien\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loginpasien::index');
    }

     public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'no_ktp' => 'required',
            'tgl_lahir' => 'required'
        ]);

        $credentials = [
            'no_ktp' => $validated['no_ktp'],
            'tgl_lahir' => $validated['tgl_lahir'],
        ];

        // Cari pasien berdasarkan no_ktp dan tgl_lahir (tanggal lahir)
        $pasien = Pasien::select('no_rkm_medis','no_ktp','tgl_lahir')->where('no_ktp', $request->no_ktp)
            ->where('tgl_lahir', $request->tgl_lahir)->latest('tgl_daftar') 
            ->first();
    
        if ($pasien == null) {
            return back()->with('loginFailed', 'Login Gagal No Ktp atau Tanggal Lahir Salah!');
        }

        // Ambil registrasi terbaru dari booking
        $reg_periksa = DB::table('reg_periksa')->select('tgl_registrasi','kd_poli', 'no_reg')->where('no_rkm_medis', $pasien->no_rkm_medis )->where('kd_poli','UMCU')->latest('tgl_registrasi')->first();
        $rgp = $reg_periksa->no_reg ?? '';
     
        if ( $rgp != null || $rgp != '' ) {
          
            
                Auth::guard('pasien')->login( $pasien) ;
                $request->session()->regenerate();

                
                return redirect()->intended('/dashboard-pasien');
           
        } else {
            return back()->with('loginFailed', 'Login Gagal No Ktp atau Tanggal Lahir Salaah!');
        }
    }


    public function logout(Request $request){
        Auth::guard('pasien')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}