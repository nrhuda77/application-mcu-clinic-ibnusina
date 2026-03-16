<?php

namespace Modules\ScorePemeriksaan\Http\Controllers\JakartaCardiovascular;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class JakartaCardiovascularController extends Controller
{
     public function index(Request $request,$no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data = DB::table('score_jakarta_cardiovascular')->where('no_rawat', $no_rwt)->first();

        $path = $request->segment(1);          
      
        return view('scorepemeriksaan::components.jakarta-cardiovascular.index',[
            'reg' => $reg, 
            'pasien' => $pasien, 
            'data' => $data,
            'no_rawat' => $no_rawat,
            'url' => $path,
        ]);
    }
  
    
    public function ajax_data($no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $score = DB::table('score_jakarta_cardiovascular')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['score' => $score, 'reg' => $reg, 'pasien' => $pasien]);
    }

    public function store(Request $request) {
     return CrudJakartaCardiovascularController::store($request);
    }

    public function update(Request $request) {
        return CrudJakartaCardiovascularController::update($request);
    }

    public function destroy($no_rawat) {
        return CrudJakartaCardiovascularController::destroy($no_rawat);
    }
}