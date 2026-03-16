<?php

namespace Modules\Kuisoner\Http\Controllers\Paparan;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RiwayatPaparanController extends Controller
{
       public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('riwayat_paparan_mcu')->where('no_rawat', $no_rwt)->first();
        $path = $request->segment(1); 

        $riwayatPenyakit = [
          'terpapar_bising' => 'Terpapar Bising',
          'terpapar_suhu_ekstrim_dingin' => 'Terpapar Suhu Ekstrim Dingin',
          'terpapar_suhu_ekstrim_panas' => 'Terpapar Suhu Ekstrim Panas',
          'terpapar_getaran' => 'Terpapar Getaran',
          'terpapar_debu' => 'Terpapar Debu',
          'terpapar_zat_kimia' => 'Terpapar Zat Kimia',
          'terpapar_radiasi' => 'Terpapar Radiasi',
          
      ];

      $riwayatPenyakit2 = [
          'lama_terpapar_bising' => 'Lama Terpapar Bising',
          'lama_terpapar_suhu_ekstrim_dingin' => 'Lama Terpapar Suhu Ekstrim Dingin',
          'lama_terpapar_suhu_ekstrim_panas' => 'Lama Terpapar Suhu Ekstrim Panas',
          'lama_terpapar_getaran' => 'Lama Terpapar Getaran',
          'lama_terpapar_debu' => 'Lama Terpapar Debu',
          'lama_terpapar_zat_kimia' => 'Lama Terpapar Zat Kimia',
          'lama_terpapar_radiasi' => 'Lama Terpapar Radiasi',
      ];

      
      
      
        return view('kuisoner::components.paparan.index',[
            'reg' => $reg, 
            'pasien' => $pasien, 
            'data' => $data,
            'riwayat' => $riwayatPenyakit,
            'riwayat2' => $riwayatPenyakit2,
            'no_rawat' => $no_rawat,
            'url' => $path,
        ]);
    }

    
    public function ajax_data($no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $riwayat = DB::table('riwayat_paparan_mcu')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['riwayat' => $riwayat, 'reg' => $reg, 'pasien' => $pasien]);
    }

    public function store(Request $request) {
     return CrudRiwayatPaparanController::store($request);
    }

    public function update(Request $request) {
        return CrudRiwayatPaparanController::update($request);
    }

    public function destroy($no_rawat) {
        return CrudRiwayatPaparanController::destroy($no_rawat);
    }
}