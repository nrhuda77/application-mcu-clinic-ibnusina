<?php

namespace Modules\PemeriksaanGigi\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PemeriksaanGigiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokter = DB::table('dokter')->get();
        $penjab = DB::table('penjab')->get();
        return view('pemeriksaangigi::index',[
            'dokter' => $dokter,
            'penjab' => $penjab
        ]);
    }

     
    public function detail($no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $no_rwt)->first();
        $gigi = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $no_rwt)->get();
        return view('pemeriksaangigi::detail',[
            'no_rawat' => $no_rawat,
            'reg' => $reg,
            'pasien' => $pasien,
            'data' => $data,
            'gigi' => $gigi
        ]);
    }


     public function ajax_data(Request $request, $id) {
        $id_data = Crypt::decrypt($id);
        $gigi = DB::table('kesehatan_gigi_mcu')->where('id', $id_data)->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $gigi->no_rawat)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        return response()->json(['reg' => $reg, 'gigi' => $gigi, 'pasien' => $pasien]);
    }
    
    public function store(Request $request) {
        return CrudPemeriksaanGigiController::store($request);
    }

    
    public function show(Request $request)
    {
       return CrudPemeriksaanGigiController::show($request);
    }


    public function update(Request $request) {
        return CrudPemeriksaanGigiController::update($request);
    }

   
    public function destroy($id) {
        return CrudPemeriksaanGigiController::destroy($id);
    }

     public function destroy_all($no_rawat) {
        return CrudPemeriksaanGigiController::destroy_all($no_rawat);
    }
}