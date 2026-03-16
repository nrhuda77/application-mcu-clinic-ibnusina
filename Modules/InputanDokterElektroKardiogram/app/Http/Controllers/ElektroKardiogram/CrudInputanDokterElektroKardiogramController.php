<?php

namespace Modules\InputanDokterElektroKardiogram\Http\Controllers\ElektroKardiogram;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CrudInputanDokterElektroKardiogramController extends Controller
{
     public static function store(Request $request) {
        try {
            $data = request()->all();
            $data = request()->except(['_token']);
            DB::table('hasil_elektrokardiogram')->insert([
                'no_rawat' => $request->no_rawat,
                'hasil' => $request->temuan,
                'tgl_periksa' => Carbon::now()->toDateString(),
                'jam' => Carbon::now()->toTimeString(),
                
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
            DB::table('hasil_elektrokardiogram')->where('no_rawat',$no_rwt)->update($data);
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
        DB::table('hasil_elektrokardiogram')->where('no_rawat', $no_rwt)->delete();
        return response()->json(['status' => 'success']);
    }


    public static function auto_save_elektrokardiogram(Request $request)
  
    {
          $no_rawat = Crypt::decrypt($request->no_rawat);
        // Cek apakah sudah ada data user ini, update atau insert
        $exists = DB::table('hasil_elektrokardiogram')->where('no_rawat', $no_rawat)->exists();

        if ($exists) {
            DB::table('hasil_elektrokardiogram')
                ->where('no_rawat', $no_rawat) 
                ->update([
                    'hasil' => $request->temuan,             
                ]);
        } else {
            DB::table('hasil_elektrokardiogram')->insert([
                'no_rawat' => $no_rawat,
                'tgl_periksa' => Carbon::now()->toDateString(),
                'jam' => Carbon::now()->toTimeString(),
                'hasil' => $request->temuan,
                
            ]);
        }

        return response()->json(['status' => 'ok']);
    }




    public static function pdf_Preview_elektrokardiogram($no_rawat)
    {
        $norawat = Crypt::decrypt($no_rawat);
        $data = DB::table('hasil_elektrokardiogram')->where('no_rawat', $norawat)->first();

        $content = $data?? '';
         $kop = public_path('assets/img/kop.png');
        $watermark = public_path('assets/img/watermark.png');
        

        $pdf = Pdf::loadView('inputandokterelektrokardiogram::components.pdf', 
        [
            'content' => $content,
            'kop' => $kop,
            'watermark' => $watermark
    ]);
        return $pdf->stream();
    }
}