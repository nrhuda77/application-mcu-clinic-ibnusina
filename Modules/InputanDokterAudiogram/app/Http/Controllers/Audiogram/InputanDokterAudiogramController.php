<?php

namespace Modules\InputanDokterAudiogram\Http\Controllers\Audiogram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class InputanDokterAudiogramController extends Controller
{
      public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('hasil_inputan_dokter_mcu')->where('no_rawat', $no_rwt)->where('jenis', 'audiogram')->first();
      
        return view('inputandokteraudiogram::components.index',[
            'reg' => $reg, 
            'pasien' => $pasien, 
            'data' => $data,
            'no_rawat' => $no_rawat,
        ]);
    } 


        public function ajax_data($no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $hasil = DB::table('hasil_inputan_dokter_mcu')->where('no_rawat', $no_rwt)->where('jenis', 'audiogram')->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['hasil' => $hasil, 'reg' => $reg, 'pasien' => $pasien]);
    }



    public function store(Request $request) {
        return CrudInputanDokterAudiogramController::store($request);
    }

    public function update(Request $request, $id) {}


    public function destroy($no_rawat) {
        return CrudInputanDokterAudiogramController::destroy($no_rawat);
    }


    public function auto_save_audiogram(Request $request) {
        return CrudInputanDokterAudiogramController::auto_save_audiogram($request);
    }


    public function pdf_preview_audiogram($no_rawat) {
        return CrudInputanDokterAudiogramController::pdf_preview_audiogram($no_rawat);
    }

}