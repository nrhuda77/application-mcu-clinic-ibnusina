<?php

namespace Modules\PemeriksaanLanjut\Http\Controllers\ThorackAbdomen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ThorackAbdomenController extends Controller
{
    public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('pemeriksaan_thoraks_abdomen_mcu')->where('no_rawat', $no_rwt)->first();
        $path = $request->segment(1);   

        $pemeriksaan = [
            'pernapasan_inspeksi' => 'Pernapasan Inspeksi',
            'pernapasan_perkusi_kanan' => 'Pernapasan Perkusi Kanan',
            'pernapasan_aus_suara_nafas' => 'Pernapasan Aus Suara Nafas',
            'pernapasan_aus_wheezing' => 'Pernapasan Aus Wheezing',
            'pernapasan_palpasi_stem_frem' => 'Pernapasan Palpasi Stem Frem',
            'pernapasan_perkusi_kiri' => 'Pernapasan Perkusi Kiri',
            'pernapasan_aus_ronchi' => 'Pernapasan Aus Ronchi',
            // 'jantung_inspeksi_ictus_cordis' => 'Jantung Inspeksi Ictus Cordis',
            // 'jantung_palpasi_ictus_cordis' => 'Jantung Palpasi Ictus Cordis',
            // 'jantung_perkusi_batas_jantung' => 'Jantung Perkusi Batas Jantung',
            'jantung_auskultasi' => 'Jantung Auskultasi',
            // 'pemeriksaan_payudara' => 'Pemeriksaan Payudara',

            'inspeksi' => 'Inspeksi',
            'palpasi' => 'Palpasi',
            // 'lien' => 'Lien',
            // 'masa' => 'Masa',
            // 'nyeri_ketok_cva' => 'Nyeri Ketok CVA',
            'perkusi' => 'Perkusi',
            'auskultasi_bising_usus' => 'Auskultasi Bising Usus',
            // 'helpar' => 'Helpar',
            // 'hernia' => 'Hernia',
            // 'ginjal_balotemen' => 'Ginjal Balotemen',
      ];
      
      
        return view('pemeriksaanlanjut::components.thorack-abdomen.index',[
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
        $pemeriksaan = DB::table('pemeriksaan_thoraks_abdomen_mcu')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['pemeriksaan' => $pemeriksaan, 'reg' => $reg, 'pasien' => $pasien]);
    }

    public function store(Request $request) {
     return CrudThorackAbdomenController::store($request);
    }

    public function update(Request $request) {
        return CrudThorackAbdomenController::update($request);
    }

    public function destroy($no_rawat) {
        return CrudThorackAbdomenController::destroy($no_rawat);
    }
}