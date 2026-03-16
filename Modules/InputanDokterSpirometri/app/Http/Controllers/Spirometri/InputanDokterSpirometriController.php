<?php

namespace Modules\InputanDokterSpirometri\Http\Controllers\Spirometri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class InputanDokterSpirometriController extends Controller
{
    public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('hasil_inputan_dokter_mcu')->where('no_rawat', $no_rwt)->where('jenis', 'spirometri')->first();
      
        return view('inputandokterspirometri::components.index',[
            'reg' => $reg, 
            'pasien' => $pasien, 
            'data' => $data,
            'no_rawat' => $no_rawat,
        ]);
    } 


        public function ajax_data($no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $hasil = DB::table('hasil_inputan_dokter_mcu')->where('no_rawat', $no_rwt)->where('jenis', 'spirometri')->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['hasil' => $hasil, 'reg' => $reg, 'pasien' => $pasien]);
    }



    public function store(Request $request) {
        return CrudInputanDokterSpirometriController::store($request);
    }

    public function update(Request $request, $id) {}


    public function destroy($no_rawat) {
        return CrudInputanDokterSpirometriController::destroy($no_rawat);
    }


    public function auto_save_spirometri(Request $request) {
        return CrudInputanDokterSpirometriController::auto_save_spirometri($request);
    }


    public function pdf_preview_spirometri($no_rawat) {
        return CrudInputanDokterSpirometriController::pdf_preview_spirometri($no_rawat);
    }


}