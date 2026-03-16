<?php

namespace Modules\PemeriksaanLanjut\Http\Controllers\GenitalAnusVetebrata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class GenitalAnusController extends Controller
{
  
    public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('pemeriksaan_genital_vertebra_mcu')->where('no_rawat', $no_rwt)->first();
        $path = $request->segment(1);          



        $pemeriksaan = [
          'genitalia_externa' => 'Genitalia Externa',
        //   'rectal_toucher' => 'Rectal Toucher',
        //   'prostat' => 'Prostat',
        //   'perianal' => 'Perianal',
          'vertebra' => 'Vertebra',
        //   'tinel_test' => 'Tinel Test',
          'ekestremitas_reflek_fisiologis' => 'Ekestremitas Reflek Fisiologis',
          'ekestremitas_reflek_patologis' => 'Ekestremitas Reflek Patologis',
          'fungsi_motorik_ekstrem_atas' => 'Fungsi Motorik Ekstrem Atas',
          'fungsi_motorik_ekstrem_bawah' => 'Fungsi Motorik Ekstrem Bawah',
          'ekestremitas_tonus_otot' => 'Ekestremitas Tonus Otot',
        //   'romberg_test' => 'Romberg Test',
        //   'laseque_sign' => 'Laseque Sign',
        //   'kernig_sign' => 'Kernig Sign',

      ];
      
      
        return view('pemeriksaanlanjut::components.genital-extremitas.index',[
            'reg' => $reg, 
            'pasien' => $pasien, 
            'data' => $data,
            'pemeriksaan' => $pemeriksaan,
            'no_rawat' => $no_rawat,
            'url' => $path,
        ]);
    }
  
    
    public function ajax_data($no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $pemeriksaan = DB::table('pemeriksaan_genital_vertebra_mcu')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['pemeriksaan' => $pemeriksaan, 'reg' => $reg, 'pasien' => $pasien]);
    }

    public function store(Request $request) {
     return CrudGenitalAnusController::store($request);
    }

    public function update(Request $request) {
        return CrudGenitalAnusController::update($request);
    }

    public function destroy($no_rawat) {
        return CrudGenitalAnusController::destroy($no_rawat);
    }
}