<?php

namespace Modules\PemeriksaanLanjut\Http\Controllers\VitalKondisiUmum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class VitalKondisiUmumController extends Controller
{
    public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('vital_kondisi_umum_mcu')->where('no_rawat', $no_rwt)->first();

        $path = $request->segment(1);          

        $pemeriksaan = [
          'nadi' => 'Nadi',
          'tinggi_badan' => 'Tinggi Badan',
          'berat_badan' => 'Berat Badan',
          'lingkar_perut' => 'Lingkar Perut',
          'lingkar_panggul' => 'Lingkar Panggul',
          'pernafasan' => 'Pernafasan',
          'spo2' => 'SpO2',
          'bmi' => 'BMI',
          'rlpp' => 'RLPP',
          'suhu' => 'Suhu',
          'kondisi_umum' => 'Kondisi Umum',
          'tekanan_darah' => 'Tekanan Darah',
       
      ];
      
      
        return view('pemeriksaanlanjut::components.vital-kondisi-umum.index',[
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
        $pemeriksaan = DB::table('vital_kondisi_umum_mcu')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['pemeriksaan' => $pemeriksaan, 'reg' => $reg, 'pasien' => $pasien]);
    }

    public function store(Request $request) {
     return CrudVitalKondisiUmumController::store($request);
    }

    public function update(Request $request) {
        return CrudVitalKondisiUmumController::update($request);
    }

    public function destroy($no_rawat) {
        return CrudVitalKondisiUmumController::destroy($no_rawat);
    }
}