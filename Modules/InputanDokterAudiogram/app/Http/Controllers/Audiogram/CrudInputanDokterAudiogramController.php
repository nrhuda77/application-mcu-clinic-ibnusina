<?php

namespace Modules\InputanDokterAudiogram\Http\Controllers\Audiogram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CrudInputanDokterAudiogramController extends Controller
{
     public static function store(Request $request) {
        try {
            $data = request()->all();
            $data = request()->except(['_token']);
            DB::table('hasil_inputan_dokter_mcu')->insert([
                'no_rawat' => $request->no_rawat,
                'no_rkm_medis' => $request->no_rkm_medis,
                'no_reg' => $request->no_reg,
                'hasil' => $request->temuan,
                'jenis' => 'audiogram'
            ]);
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
            DB::table('hasil_inputan_dokter_mcu')->where('no_rawat',$no_rwt)->where('jenis', 'audiogram')->update($data);
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
        DB::table('hasil_inputan_dokter_mcu')->where('no_rawat', $no_rwt)->where('jenis', 'audiogram')->delete();
        return response()->json(['status' => 'success']);
    }


    public static function auto_save_audiogram(Request $request)
  
    {
          $no_rawat = Crypt::decrypt($request->no_rawat);
        // Cek apakah sudah ada data user ini, update atau insert
        $exists = DB::table('hasil_inputan_dokter_mcu')->where('no_rawat', $no_rawat)->where('jenis', 'audiogram')->exists();

        if ($exists) {
            DB::table('hasil_inputan_dokter_mcu')
                ->where('no_rawat', $no_rawat)
                ->where('jenis', 'audiogram')
                ->update([
                    'hasil' => $request->temuan,             
                ]);
        } else {
            DB::table('hasil_inputan_dokter_mcu')->insert([
                'no_rkm_medis' => $request->no_rkm_medis,
                'no_reg' => $request->no_reg,
                'no_rawat' => $no_rawat,
                'hasil' => $request->temuan,
                'jenis' => 'audiogram'
            ]);
        }

        return response()->json(['status' => 'ok']);
    }




    public static function pdf_Preview_audiogram($no_rawat)
    {
        $norawat = Crypt::decrypt($no_rawat);
        $data = DB::table('hasil_inputan_dokter_mcu')->where('no_rawat', $norawat)->where('jenis', 'audiogram')->first();

        $content = $data?? '';
         $kop = public_path('assets/img/kop.png');
        $watermark = public_path('assets/img/watermark.png');

        $pdf = Pdf::loadView('inputandokteraudiogram::components.pdf', 
        [
            'content' => $content,
            'kop' => $kop,
            'watermark' => $watermark
    ]);
        return $pdf->stream();
    }
}