<?php

namespace Modules\PemeriksaanLanjut\Http\Controllers\FisikKulitMata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class FisikKulitMataController extends Controller
{
    public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('pemeriksaan_kulit_mata_tht_mcu')->where('no_rawat', $no_rwt)->first();
        $path = $request->segment(1);          

        $pemeriksaan = [
          'kulit' => 'Kulit',
          'buta_warna' => 'Buta Warna',
          'kaca_mata' => 'Kaca Mata', 
          'visus_kanan' => 'Visus Kanan',
          'visus_kiri' => 'Visus Kiri',
          'jaeger_test' => 'Jaeger Test',
          'bola_mata' => 'Bola Mata',
          'seklera' => 'Seklera',
          'conjungtiva' => 'Conjungtiva',
          'pupil' => 'Pupil',
          'refleks_pupil' => 'Refleks Pupil',
          'daun_telinga_kanan' => 'Daun Telinga Kanan',
          'liang_telinga_kanan' => 'Liang Telinga Kanan',
          'serumen_telinga_kanan' => 'Serumen Telinga Kanan',
          'membran_timpani_kanan' => 'Membran Timpani Kanan',
          'hidung' => 'Hidung',
          'faring' => 'Faring',
          'daun_telinga_kiri' => 'Daun Telinga Kiri',
          'liang_telinga_kiri' => 'Liang Telinga Kiri',
          'serumen_telinga_kiri' => 'Serumen Telinga Kiri',
          'membran_timpani_kiri' => 'Membran Timpani Kiri',
          'lidah' => 'Lidah',
          'tonsil' => 'Tonsil',
      ];
      
      
        return view('pemeriksaanlanjut::components.fisik-kulit-mata.index',[
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
        $pemeriksaan = DB::table('pemeriksaan_kulit_mata_tht_mcu')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['pemeriksaan' => $pemeriksaan, 'reg' => $reg, 'pasien' => $pasien]);
    }

    public function store(Request $request) {
     return CrudFisikKulitMataController::store($request);
    }

    public function update(Request $request) {
        return CrudFisikKulitMataController::update($request);
    }

    public function destroy($no_rawat) {
        return CrudFisikKulitMataController::destroy($no_rawat);
    }
}