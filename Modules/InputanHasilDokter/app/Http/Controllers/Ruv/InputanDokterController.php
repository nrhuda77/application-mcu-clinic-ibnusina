<?php

namespace Modules\InputanHasilDokter\Http\Controllers\Ruv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class InputanDokterController extends Controller
{
     public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('hasil_inputan_dokter_mcu3')->where('no_rawat', $no_rwt)->first();
      
        return view('inputanhasildokter::components.hasil.ru-v.index',[
            'reg' => $reg, 
            'pasien' => $pasien, 
            'data' => $data,
            'no_rawat' => $no_rawat,
        ]);
    } 


        public function ajax_data($no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $hasil = DB::table('hasil_inputan_dokter_mcu3')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['hasil' => $hasil, 'reg' => $reg, 'pasien' => $pasien]);
    }



    public function store(Request $request) {
        return CrudInputanDokterController::store($request);
    }

    public function update(Request $request, $id) {}


    public function destroy($no_rawat) {
        return CrudInputanDokterController::destroy($no_rawat);
    }


    public function auto_save_temuan(Request $request) {
        return CrudInputanDokterController::auto_save_temuan($request);
    }

       public function auto_save_saran(Request $request) {
        return CrudInputanDokterController::auto_save_saran($request);
    }

    public function auto_save_select(Request $request) {
        return CrudInputanDokterController::auto_save_select($request);
    }

    public function pdf_preview_temuan($no_rawat) {
        return CrudInputanDokterController::pdf_preview_temuan($no_rawat);
    }

     

    public function pdf_preview_saran($no_rawat) {
        return CrudInputanDokterController::pdf_preview_saran($no_rawat);
    }
}