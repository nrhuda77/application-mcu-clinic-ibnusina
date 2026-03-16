<?php

namespace Modules\InputanHasilDokter\Http\Controllers\Ruv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use FPDF as GlobalFPDF;


class CrudInputanDokterController extends Controller
{
     public static function store(Request $request) {
        try {
            $data = request()->all();
            $data = request()->except(['_token']);
            DB::table('hasil_inputan_dokter_mcu3')->insert([
                'no_rawat' => $request->no_rawat,
                'no_rkm_medis' => $request->no_rkm_medis,
                'no_reg' => $request->no_reg,
                'kesimpulan' => $request->kesimpulan,
                'saran' => $request->saran,
                'temuan' => $request->temuan,
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
            DB::table('hasil_inputan_dokter_mcu3')->where('no_rawat',$no_rwt)->update($data);
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
        DB::table('hasil_inputan_dokter_mcu3')->where('no_rawat', $no_rwt)->delete();
        return response()->json(['status' => 'success']);
    }


    public static function auto_save_temuan(Request $request)
  
    {
          $no_rawat = Crypt::decrypt($request->no_rawat);
        // Cek apakah sudah ada data user ini, update atau insert
        $exists = DB::table('hasil_inputan_dokter_mcu3')->where('no_rawat', $no_rawat)->exists();

        if ($exists) {
            DB::table('hasil_inputan_dokter_mcu3')
                ->where('no_rawat', $no_rawat)
                
                ->update([
                    'temuan' => $request->temuan,
                    'kesimpulan' => $request->kesimpulan,
                
                ]);
        } else {
            DB::table('hasil_inputan_dokter_mcu3')->insert([
                'no_rkm_medis' => $request->no_rkm_medis,
                'no_reg' => $request->no_reg,
                'no_rawat' => $no_rawat,
                'temuan' => $request->temuan,
                'kesimpulan' => $request->kesimpulan,
            ]);
        }

        return response()->json(['status' => 'ok']);
    }



     public static  function auto_save_saran(Request $request)
    {
        $no_rawat = Crypt::decrypt($request->no_rawat);
        // Cek apakah sudah ada data user ini, update atau insert
        $exists = DB::table('hasil_inputan_dokter_mcu3')->where('no_rawat', $no_rawat)->exists();

        if ($exists) {
            DB::table('hasil_inputan_dokter_mcu3')
                ->where('no_rawat', $no_rawat)
                
                ->update([
                    'saran' => $request->saran, 
                    'kesimpulan' => $request->kesimpulan,
                    
                ]);
        } else {
            DB::table('hasil_inputan_dokter_mcu3')->insert([
                'no_rkm_medis' => $request->no_rkm_medis,
                'no_reg' => $request->no_reg,
                'no_rawat' => $no_rawat,
                'saran' => $request->saran,
                'kesimpulan' => $request->kesimpulan,
                
                
            ]);
        }

        return response()->json(['status' => 'ok']);
    }



     public static  function auto_save_select(Request $request)
    {
        $no_rawat = Crypt::decrypt($request->no_rawat);

        // Cek apakah sudah ada data user ini, update atau insert
        $exists = DB::table('hasil_inputan_dokter_mcu3')->where('no_rawat', $no_rawat)->exists();

        if ($exists) {
            DB::table('hasil_inputan_dokter_mcu3')
                ->where('no_rawat', $no_rawat)
                ->update([
                    'saran' => $request->saran, 
                    'kesimpulan' => $request->kesimpulan,
                    'jenis' => $request->jenis,
                    'temuan' => $request->temuan,
                    
                ]);
        } else {
            DB::table('hasil_inputan_dokter_mcu3')->insert([
                'no_rkm_medis' => $request->no_rkm_medis,
                'no_reg' => $request->no_reg,
                'no_rawat' => $no_rawat,
               'saran' => $request->saran, 
                    'kesimpulan' => $request->kesimpulan,
                    'jenis' => $request->jenis,
                    'temuan' => $request->temuan,
                
                
            ]);
        }

        return response()->json(['status' => 'ok']);
    }



         public static function header($pdf){
        $pdf->Image(public_path('assets/img/kop.png'),26, 0, 170);
        $pdf->SetDrawColor(0, 0, 0); // Set color to black
        $pdf->SetLineWidth(0.3); // Set line width
        $pdf->Line(25, 26.5, 195.5, 26.5); // Horizontal line
        $pdf->Line(25, 27, 195.5, 27); // Horizontal line
    }

     public static function footer($pdf){
        $pdf->Image(public_path('assets/img/footer.png'),0, 289, 210);
    }
     
    public static function pdf_Preview_temuan($no_rawat)
    {

         $norwt = Crypt::decrypt($no_rawat);
         $reg = DB::table('reg_periksa')->where('no_rawat', $norwt)->first();
         $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
         $inputan = DB::table('hasil_inputan_dokter_mcu3')->where('no_rawat', $norwt)->first();


         $pdf = new GlobalFPDF;
         $pdf->AddPage();

        // Header
        $pdf->SetFont('Arial', 'B', 14);
        self::header($pdf);

             $pdf->SetFont('Times', 'B', 15.5);

         $pdf->SetXY(26, 31.5); // posisi awal kiri
        $pdf->Cell(80, 10, "SERTIFIKAT HASIL PEMERIKSAAN KESEHATAN ", 0, 0); // label
        $pdf->Line(27, 39, 157, 39);
         $pdf->SetFont('Times', '', 11.5);

        $pdf->SetXY(26, $pdf->GetY()+10);
        $pdf->Cell(80, 10, "Berikut ini adalah hasil pemeriksaan kesehatan yang dilakukan pada tanggal : ".$reg->tgl_registrasi, 0, 0); // label
        
        $pdf->SetXY(26, $pdf->GetY()+7);
        $pdf->Cell(80, 10, "Nama ", 0, 0); // label
        $pdf->SetXY(50, $pdf->GetY());
        $pdf->MultiCell(80, 10, ": " . $pasien->nm_pasien, 0, 0); // label

        $pdf->SetXY(26, $pdf->GetY()-5);
        $pdf->Cell(80, 10, "Jabatan ", 0, 0); // label
        $pdf->SetXY(50, $pdf->GetY());
        $pdf->MultiCell(80, 10, ": " . $pasien->pekerjaan, 0, 0); // label

        
        $pdf->SetXY(26, $pdf->GetY());
        $pdf->SetFont('Times', 'B', 12.5);
        $pdf->Cell(26, 15, "TEMUAN :", 0, 0); // label
        $pdf->SetFont('Times', '', 11.5);

        $pdf->SetXY(50, $pdf->GetY()+5.5);
        $pdf->SetFont('Times', '', 11.5);
        $pdf->MultiCell(100, 4, $inputan?->temuan, 0, 0); // label



       self::footer($pdf);


         // Ambil isi PDF sebagai string
    $pdfContent = $pdf->Output('S'); // 'S' = return string, bukan langsung kirim ke browser

    // Kembalikan sebagai response Laravel
    return response($pdfContent)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="laporan_mcu.pdf"');
    }


       
    public static function pdf_Preview_saran($no_rawat)
    {
        
         $norwt = Crypt::decrypt($no_rawat);
         $reg = DB::table('reg_periksa')->where('no_rawat', $norwt)->first();
         $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
         $inputan = DB::table('hasil_inputan_dokter_mcu3')->where('no_rawat', $norwt)->first();


         $pdf = new GlobalFPDF;
         $pdf->AddPage();

        // Header
        $pdf->SetFont('Arial', 'B', 14);
        self::header($pdf);

             $pdf->SetFont('Times', 'B', 15.5);

         $pdf->SetXY(26, 31.5); // posisi awal kiri
       

        
        $pdf->SetXY(30, $pdf->GetY());
        $pdf->SetFont('Times', 'B', 12.5);
        $pdf->Cell(26, 15, "SARAN :", 0, 0); // label
        $pdf->SetFont('Times', '', 11.5);

        $pdf->SetXY(50, $pdf->GetY()+5.5);
        $pdf->SetFont('Times', '', 11.5);
        $pdf->MultiCell(100, 4, $inputan?->saran, 0, 0); // label



       self::footer($pdf);


         // Ambil isi PDF sebagai string
    $pdfContent = $pdf->Output('S'); // 'S' = return string, bukan langsung kirim ke browser

    // Kembalikan sebagai response Laravel
    return response($pdfContent)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="laporan_mcu.pdf"');
    }

}