<?php

namespace Modules\Kuisoner\Http\Controllers\Penyakitkeluarga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RiwayatPenyakitKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('riwayat_penyakit_keluarga_mcu')->where('no_rawat', $no_rwt)->first();
        $path = $request->segment(1); 

        $riwayatPenyakit = [
          'bapak_darah_tinggi' => 'Riwayat Darah Tinggi (Bapak)',
          'bapak_jantung' => 'Riwayat Penyakit Jantung (Bapak)',
          'bapak_diabet' => 'Riwayat Penyakit Diabetes (Bapak)',
          'bapak_asma' => 'Riwayat Penyakit Asma (Bapak)',
          'ibu_darah_tinggi' => 'Riwayat Darah Tinggi (Ibu)',
          'ibu_jantung' => 'Riwayat Penyakit Jantung (Ibu)',
      ];

      $riwayatPenyakit2 = [
          
          'ibu_diabet' => 'Riwayat Penyakit Diabetes (Ibu)',
          'ibu_asma' => 'Riwayat Penyakit Asma (Ibu)',
          'kakek_darah_tinggi' => 'Riwayat Darah Tinggi (Kakek)',
          'kakek_jantung' => 'Riwayat Penyakit Jantung (Kakek)',
          'kakek_diabet' => 'Riwayat Penyakit Diabetes (Kakek)',
          'kakek_asma' => 'Riwayat Penyakit Asma (Kakek)',
      
      ];

        $riwayatPenyakit3 = [
          
          
          'nenek_diabet' => 'Riwayat Penyakit Diabetes (Nenek)',
          'nenek_jantung' => 'Riwayat Penyakit Jantung (Nenek)',
          'nenek_darah_tinggi' => 'Riwayat Darah Tinggi (Nenek)',
          'nenek_asma' => 'Riwayat Penyakit Asma (Nenek)',
    
      ];

      
        return view('kuisoner::components.penyakit-keluarga.index',[
            'reg' => $reg, 
            'pasien' => $pasien, 
            'data' => $data,
            'riwayat' => $riwayatPenyakit,
            'riwayat2' => $riwayatPenyakit2,
            'riwayat3' => $riwayatPenyakit3,
            'no_rawat' => $no_rawat,
            'url' => $path,
        ]);
    }

 public function ajax_data($no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $riwayat = DB::table('riwayat_penyakit_keluarga_mcu')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['riwayat' => $riwayat, 'reg' => $reg, 'pasien' => $pasien]);
    }

    public function store(Request $request) {
     return CrudRiwayatPenyakitKeluargaController::store($request);
    }

    public function update(Request $request) {
        return CrudRiwayatPenyakitKeluargaController::update($request);
    }

    public function destroy($no_rawat) {
        return CrudRiwayatPenyakitKeluargaController::destroy($no_rawat);
    }
}