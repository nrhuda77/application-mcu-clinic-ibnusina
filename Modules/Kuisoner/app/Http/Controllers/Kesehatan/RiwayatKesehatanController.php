<?php

namespace Modules\Kuisoner\Http\Controllers\Kesehatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


class RiwayatKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('riwayat_kesehatan_mcu')->where('no_rawat', $no_rwt)->first();
        $path = $request->segment(1); 

        $riwayatPenyakit = [
          'hepatitis' => 'Hepatitis',
          'hipertensi' => 'Hipertensi',
          'tbc' => 'TBC',
          'jantung' => 'Jantung',
          'alergi' => 'Alergi',
          
      ];

      $riwayatPenyakit2 = [
          
          'asma' => 'Asma',
          'diabet' => 'Diabetes',
          'wasir' => 'Wasir',
        //   'typhoid' => 'Typhoid',
        //   'hernia' => 'Hernia',
        //   'penyakit_kelamin' => 'Penyakit Kelamin',
          'operasi_pembedahan' => 'Operasi Pembedahan',
        //   'rawat_inap' => 'Rawat Inap',
        'konsumsi_obat' => 'Konsumsi Obat',
      ];

        $riwayatPenyakit3 = [
          
          'penyakit_saat_ini' => 'Penyakit Saat Ini',
        //   'penyakit_lainya' => 'Penyakit Lainnya',
          'hamil' => 'Hamil',
        //   'keguguran' => 'Keguguran',
          'haid' => 'Haid',
        //   'haid_tidak_normal' => 'Haid Tidak Normal',
      ];

      
        return view('kuisoner::components.kesehatan.index',[
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
        $riwayat = DB::table('riwayat_kesehatan_mcu')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['riwayat' => $riwayat, 'reg' => $reg, 'pasien' => $pasien]);
    }

    public function store(Request $request) {
     return CrudRiwayatKesehatanController::store($request);
    }

    public function update(Request $request) {
        return CrudRiwayatKesehatanController::update($request);
    }

    public function destroy($no_rawat) {
        return CrudRiwayatKesehatanController::destroy($no_rawat);
    }
}