<?php

namespace Modules\BookingRegistrasi\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class BookingRegistrasiController extends Controller
{
    

    public function index()
    {
        $dokter = DB::table('dokter')->get();
        $penjab = DB::table('penjab')->get();
        return view('bookingregistrasi::index',[
            'dokter' => $dokter,
            'penjab' => $penjab
        ]);
    }

   
    
    public function create()
    {
        return view('bookingregistrasi::create');
    }


    public function store(Request $request) {

        return CrudController::store($request);
  
    }

    public function ajax_data(Request $request,$no_rkm_medis, $tgl_periksa) {

        $tanggal_periksa = Crypt::decrypt($tgl_periksa);
        $no_rkm = Crypt::decrypt($no_rkm_medis); 

        $pasien = DB::table('pasien')
                ->where('no_rkm_medis', $no_rkm)
                ->first();

        $reg = DB::table('booking_registrasi')
                ->where('no_rkm_medis', $no_rkm)
                ->where('tanggal_periksa', $tanggal_periksa)
                ->first();
                
        return response()->json(['pasien' => $pasien , 'reg' => $reg]);
    }


    public function ajax_noreg($kd_dokter)
{
    date_default_timezone_set('Asia/Makassar');
    $current_date = Carbon::now()->format('Y-m-d');

    $last_booking = DB::table('reg_periksa')->where('kd_dokter', $kd_dokter)
                    ->whereDate('tgl_registrasi', $current_date)
                    ->max('no_reg');

    $nobooking =DB::table('booking_registrasi')->where('kd_poli', 'UMCU')
                    ->where('kd_dokter', $kd_dokter)
                    ->whereDate('tanggal_booking', $current_date)
                    ->max('no_reg');

    $max_no = max($last_booking ?? 0, $nobooking ?? 0);
    $no_rg = str_pad((int)$max_no + 1, 3, '0', STR_PAD_LEFT);

    return response()->json($no_rg);
}



     public function show(Request $request)
    {

       return CrudController::show($request);
        
    }


    public function update(Request $request) {

        return CrudController::update($request);
    }

   
    
    public function destroy($no_rkm_medis, $tanggal_periksa) {

        return CrudController::destroy($no_rkm_medis, $tanggal_periksa);
    }
}