<?php

namespace Modules\PemeriksaanLanjut\Http\Controllers\FisikKulitMata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CrudFisikKulitMataController extends Controller
{
         public static function store(Request $request) {
        try {
            $data = request()->all();
            $data = request()->except(['_token']);
            DB::table('pemeriksaan_kulit_mata_tht_mcu')->insert($data);
            return response()->json([
                'status' => 'success',
            ]);
        }catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat input.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

     
    public static function update(Request $request) {
        try{
            $no_rwt = $request->no_rawat; 
            $data = request()->all();
            $data = request()->except(['_token']);
            DB::table('pemeriksaan_kulit_mata_tht_mcu')->where('no_rawat',$no_rwt)->update($data);
            return response()->json(['status' => 'success']);
        }catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat input.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

  
    public static function destroy($no_rawat) {
        $no_rwt = Crypt::decrypt($no_rawat);
        DB::table('pemeriksaan_kulit_mata_tht_mcu')->where('no_rawat', $no_rwt)->delete();
        return response()->json(['status' => 'success']);
    }
}