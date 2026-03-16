<?php

namespace Modules\InputanDokterElektroKardiogram\Http\Controllers\ElektroKardiogram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class InputanDokterElektroKardiogramController extends Controller
{
     public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('hasil_elektrokardiogram')->where('no_rawat', $no_rwt)->first();
      
        return view('inputandokterelektrokardiogram::components.index',[
            'reg' => $reg, 
            'pasien' => $pasien, 
            'data' => $data,
            'no_rawat' => $no_rawat,
        ]);
    } 


        public function ajax_data($no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $hasil = DB::table('hasil_elektrokardiogram')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['hasil' => $hasil, 'reg' => $reg, 'pasien' => $pasien]);
    }



    public function store(Request $request) {
        return CrudInputanDokterElektroKardiogramController::store($request);
    }

    public function update(Request $request, $id) {}


    public function destroy($no_rawat) {
        return CrudInputanDokterElektroKardiogramController::destroy($no_rawat);
    }


    public function auto_save_elektrokardiogram(Request $request) {
        return CrudInputanDokterElektroKardiogramController::auto_save_elektrokardiogram($request);
    }


    public function pdf_preview_elektrokardiogram($no_rawat) {
        return CrudInputanDokterElektroKardiogramController::pdf_preview_elektrokardiogram($no_rawat);
    }

}