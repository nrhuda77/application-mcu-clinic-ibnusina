<?php

namespace Modules\Kuisoner\Http\Controllers\Imunisasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RiwayatImunisasiController extends Controller
{
     public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('riwayat_imunisasi_mcu')->where('no_rawat', $no_rwt)->first();
        $path = $request->segment(1); 

        $riwayatPenyakit = [
          'hep_a' => 'Hepatitis A',
          'hep_b' => 'Hepatitis B',
          'covid19' => 'Covid 19', 
      ];

 

      
        return view('kuisoner::components.imunisasi.index',[
            'reg' => $reg, 
            'pasien' => $pasien, 
            'data' => $data,
            'riwayat' => $riwayatPenyakit,
            'no_rawat' => $no_rawat,
            'url' => $path,
        ]);
    }
  
    
    public function ajax_data($no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $riwayat = DB::table('riwayat_imunisasi_mcu')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['riwayat' => $riwayat, 'reg' => $reg, 'pasien' => $pasien]);
    }

    public function store(Request $request) {
     return CrudRiwayatImunisasiController::store($request);
    }

    public function update(Request $request) {
        return CrudRiwayatImunisasiController::update($request);
    }

    public function destroy($no_rawat) {
        return CrudRiwayatImunisasiController::destroy($no_rawat);
    }
}