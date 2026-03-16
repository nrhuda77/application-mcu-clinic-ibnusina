<?php

namespace Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use FPDF as GlobalFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class HasilGigiController extends Controller
{

      public static function header($pdf){
        $pdf->Image(public_path('assets/img/kop.png'),26, 0, 160);
        $pdf->SetDrawColor(0, 0, 0); // Set color to black
        $pdf->SetLineWidth(0.3); // Set line width
        $pdf->Line(25, 26.5, 195.5, 26.5); // Horizontal line
        $pdf->Line(25, 27, 195.5, 27); // Horizontal line

    $source = imagecreatefrompng('assets/img/watermark2.png');
$white = imagecolorallocatealpha($source, 255, 255, 255, 75); // transparansi

// Tambah teks ke gambar
imagestring($source, 5, 10, 10, "Watermark", $white);

// Simpan hasil ke file sementara
$tempFile = 'temp_watermark.png';
imagepng($source, $tempFile);
imagedestroy($source);

// Masukkan ke PDF
$pdf->Image($tempFile, 30, 75, 140);
    }

    public static function index($pdf, $norwt)
    {

         $reg = DB::table('reg_periksa')->where('no_rawat', $norwt)->first();
         $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
         $no_mcu = DB::table('nomor_surat_mcu')->where('no_rawat', $norwt)->first();
         $berkas_foto = DB::table('berkas_digital_perawatan')->where('kode', '013')->where('no_rawat', $norwt)->first();
         $lokasi = $berkas_foto?->lokasi_file ?? '';


        $pdf->SetFont('Times', 'B', 10.5);
    $pdf->Text(26, 162, "GIGI");
    $pdf->SetDrawColor(217, 217, 217);

    $pdf->SetFont('Times', '', 10.5);
    $pdf->Text(26, 167, "Caries");
    $pdf->Line(26, 170, 191, 170);
    $pdf->Line(26, 175, 191, 175);
    $pdf->Line(26, 180, 191, 180);

    for ($i=26; $i <= 200 ; $i+=10.33) { 
        $pdf->Line($i, 180, $i, 170);
      }


      $caries_atas_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_caries_kiri_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'caries')->where('posisi', 'Kiri Atas')->where('urutan', $caries_atas_kiri)->latest()->first();

        if( $gigi_caries_kiri_atas == null){
          $pdf->SetTextColor(0, 0, 0);
          $pdf->Text($i, 174, $caries_atas_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
          $pdf->Text($i, 174, $caries_atas_kiri);
        }
       
        $caries_atas_kiri--;
      }
      
      $pdf->SetTextColor(0, 0, 0);

      $caries_atas_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_caries_kanan_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'caries')->where('posisi', 'Kanan Atas')->where('urutan', $caries_atas_kanan)->latest()->first();

        if( $gigi_caries_kanan_atas == null){
          $pdf->SetTextColor(0, 0, 0);
          $pdf->Text($i, 174, $caries_atas_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
          $pdf->Text($i, 174, $caries_atas_kanan);
        }

        $caries_atas_kanan++;
      }

      $pdf->SetTextColor(0, 0, 0);

      $caries_bawah_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_caries_kiri_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'caries')->where('posisi', 'Kiri Bawah')->where('urutan', $caries_bawah_kiri)->latest()->first();

        if( $gigi_caries_kiri_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
          $pdf->Text($i, 179, $caries_bawah_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
          $pdf->Text($i, 179, $caries_bawah_kiri);
        }


        $caries_bawah_kiri--;
      }

      $pdf->SetTextColor(0, 0, 0);

      $caries_bawah_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_caries_kanan_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'caries')->where('posisi', 'Kanan Bawah')->where('urutan', $caries_bawah_kanan)->latest()->first();

        if( $gigi_caries_kanan_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
           $pdf->Text($i, 179, $caries_bawah_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
           $pdf->Text($i, 179, $caries_bawah_kanan);
        }
      
        $caries_bawah_kanan++;
      }

      $pdf->SetTextColor(0, 0, 0);


    $pdf->Text(26, 183.5, "Missing");
    $pdf->Line(26, 187, 191, 187);
    $pdf->Line(26, 192, 191, 192);
    $pdf->Line(26, 197, 191, 197);


    for ($i=26; $i <= 196 ; $i+=10.33) { 
        $pdf->Line($i, 197, $i, 187);
      }

      $missing_atas_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_missing_kiri_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'missing')->where('posisi', 'Kiri Atas')->where('urutan', $missing_atas_kiri)->latest()->first();

        if( $gigi_missing_kiri_atas == null){
          $pdf->SetTextColor(0, 0, 0);
         $pdf->Text($i, 191, $missing_atas_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
         $pdf->Text($i, 191, $missing_atas_kiri);
        }
        
        $missing_atas_kiri--;
      }

      $pdf->SetTextColor(0, 0, 0);

      $missing_atas_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_missing_kanan_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'missing')->where('posisi', 'Kanan Atas')->where('urutan', $missing_atas_kanan)->latest()->first();

        if( $gigi_missing_kanan_atas == null){
          $pdf->SetTextColor(0, 0, 0);
            $pdf->Text($i, 191, $missing_atas_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
            $pdf->Text($i, 191, $missing_atas_kanan);
        }

     
        $missing_atas_kanan++;
      }

      $pdf->SetTextColor(0, 0, 0);

      $missing_bawah_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_missing_kiri_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'missing')->where('posisi', 'Kiri Bawah')->where('urutan', $missing_bawah_kiri)->latest()->first();

        if( $gigi_missing_kiri_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
           $pdf->Text($i, 196, $missing_bawah_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
           $pdf->Text($i, 196, $missing_bawah_kiri);
        }
        $pdf->Text($i, 196, $missing_bawah_kiri);
        $missing_bawah_kiri--;
      }

      $pdf->SetTextColor(0, 0, 0);

      $missing_bawah_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_missing_kanan_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'missing')->where('posisi', 'Kanan Bawah')->where('urutan', $missing_bawah_kanan)->latest()->first();

        if( $gigi_missing_kanan_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
           $pdf->Text($i, 196, $missing_bawah_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
           $pdf->Text($i, 196, $missing_bawah_kanan);
        }
       
        $missing_bawah_kanan++;
      }

      $pdf->SetTextColor(0, 0, 0);


    $pdf->Text(26, 201, "Plaque");
    $pdf->Line(26, 205, 191, 205);
    $pdf->Line(26, 210, 191, 210);
    $pdf->Line(26, 215, 191, 215);

    for ($i=26; $i <= 196 ; $i+=10.33) { 
        $pdf->Line($i, 215, $i, 205);
      }

      $plaque_atas_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_plaque_kiri_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'plaque')->where('posisi', 'Kiri Atas')->where('urutan', $plaque_atas_kiri)->latest()->first();

        if( $gigi_plaque_kiri_atas == null){
          $pdf->SetTextColor(0, 0, 0);
         $pdf->Text($i, 209, $plaque_atas_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
         $pdf->Text($i, 209, $plaque_atas_kiri);
        }
        
        $plaque_atas_kiri--;
      }

      $pdf->SetTextColor(0, 0, 0);


      $plaque_atas_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_plaque_kanan_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'plaque')->where('posisi', 'Kanan Atas')->where('urutan', $plaque_atas_kanan)->latest()->first();

        if( $gigi_plaque_kanan_atas == null){
          $pdf->SetTextColor(0, 0, 0);
            $pdf->Text($i, 209, $plaque_atas_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
            $pdf->Text($i, 209, $plaque_atas_kanan);
        }
        
        $plaque_atas_kanan++;
      }

      $pdf->SetTextColor(0, 0, 0);

      $plaque_bawah_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_plaque_kiri_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'plaque')->where('posisi', 'Kiri Bawah')->where('urutan', $plaque_bawah_kiri)->latest()->first();

        if( $gigi_plaque_kiri_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
           $pdf->Text($i, 214, $plaque_bawah_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
           $pdf->Text($i, 214, $plaque_bawah_kiri);
        }
        
        $plaque_bawah_kiri--;
      }

      $pdf->SetTextColor(0, 0, 0);

      $plaque_bawah_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_plaque_kanan_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'plaque')->where('posisi', 'Kanan Bawah')->where('urutan', $plaque_bawah_kanan)->latest()->first();

        if( $gigi_plaque_kanan_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
          $pdf->Text($i, 214, $plaque_bawah_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
          $pdf->Text($i, 214, $plaque_bawah_kanan);
        }
        
        $plaque_bawah_kanan++;
      }

      $pdf->SetTextColor(0, 0, 0);


    $pdf->Text(26, 219, "Impaksi Gigi");
    $pdf->Line(26, 223, 191, 223);
    $pdf->Line(26, 228, 191, 228);
    $pdf->Line(26, 233, 191, 233);

    for ($i=26; $i <= 196 ; $i+=10.33) { 
        $pdf->Line($i, 233, $i, 223);
      }

      $impaksi_atas_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_impaksi_kiri_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'impaksi')->where('posisi', 'Kiri Atas')->where('urutan', $impaksi_atas_kiri)->latest()->first();

        if( $gigi_impaksi_kiri_atas == null){
          $pdf->SetTextColor(0, 0, 0);
         $pdf->Text($i, 227, $impaksi_atas_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
         $pdf->Text($i, 227, $impaksi_atas_kiri);
        }
       
        $impaksi_atas_kiri--;
      }

      $pdf->SetTextColor(0, 0, 0);

      $impaksi_atas_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_impaksi_kanan_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'impaksi')->where('posisi', 'Kanan Atas')->where('urutan', $impaksi_atas_kanan)->latest()->first();

        if( $gigi_impaksi_kanan_atas == null){
          $pdf->SetTextColor(0, 0, 0);
             $pdf->Text($i, 227, $impaksi_atas_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
             $pdf->Text($i, 227, $impaksi_atas_kanan);
        }
       
        $impaksi_atas_kanan++;
      }


      $pdf->SetTextColor(0, 0, 0);

      $impaksi_bawah_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_impaksi_kiri_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'impaksi')->where('posisi', 'Kiri Bawah')->where('urutan', $impaksi_bawah_kiri)->latest()->first();

        if( $gigi_impaksi_kiri_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
           $pdf->Text($i, 232, $impaksi_bawah_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
           $pdf->Text($i, 232, $impaksi_bawah_kiri);
        }
        
       
        $impaksi_bawah_kiri--;
      }

      $pdf->SetTextColor(0, 0, 0);

      $impaksi_bawah_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_impaksi_kanan_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'impaksi')->where('posisi', 'Kanan Bawah')->where('urutan', $impaksi_bawah_kanan)->latest()->first();

        if( $gigi_impaksi_kanan_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
           $pdf->Text($i, 232, $impaksi_bawah_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
           $pdf->Text($i, 232, $impaksi_bawah_kanan);
        }
       
        $impaksi_bawah_kanan++;
      }

      
      $pdf->SetTextColor(0, 0, 0);

    
    $pdf->Text(26, 237, "Gangren Pulpa");
    $pdf->Line(26, 241, 191, 241);
    $pdf->Line(26, 246, 191, 246);
    $pdf->Line(26, 251, 191, 251);

    for ($i=26; $i <= 196 ; $i+=10.33) { 
        $pdf->Line($i, 251, $i, 241);
      }

      $pulpa_atas_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_pulpa_kiri_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'pulpa')->where('posisi', 'Kiri Atas')->where('urutan', $pulpa_atas_kiri)->latest()->first();

        if( $gigi_pulpa_kiri_atas == null){
          $pdf->SetTextColor(0, 0, 0);
         $pdf->Text($i, 245, $pulpa_atas_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
         $pdf->Text($i, 245, $pulpa_atas_kiri);
        }
       
        $pulpa_atas_kiri--;
      }

      $pdf->SetTextColor(0, 0, 0);

      $pulpa_atas_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_pulpa_kanan_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'pulpa')->where('posisi', 'Kanan Atas')->where('urutan', $pulpa_atas_kanan)->latest()->first();

        if( $gigi_pulpa_kanan_atas == null){
          $pdf->SetTextColor(0, 0, 0);
           $pdf->Text($i, 245, $pulpa_atas_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
           $pdf->Text($i, 245, $pulpa_atas_kanan);
        }
        
        $pulpa_atas_kanan++;
      }

      $pdf->SetTextColor(0, 0, 0);

      $pulpa_bawah_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_pulpa_kiri_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'pulpa')->where('posisi', 'Kiri Bawah')->where('urutan', $pulpa_bawah_kiri)->latest()->first();

        if( $gigi_pulpa_kiri_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
           $pdf->Text($i, 250, $pulpa_bawah_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
           $pdf->Text($i, 250, $pulpa_bawah_kiri);
        }
      
        $pulpa_bawah_kiri--;
      }

      $pdf->SetTextColor(0, 0, 0);

      $pulpa_bawah_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_pulpa_kanan_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'pulpa')->where('posisi', 'Kanan Bawah')->where('urutan', $pulpa_bawah_kanan)->latest()->first();

        if( $gigi_pulpa_kanan_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
        $pdf->Text($i, 250, $pulpa_bawah_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
        $pdf->Text($i, 250, $pulpa_bawah_kanan);
        }
       
        $pulpa_bawah_kanan++;
      }

      $pdf->SetTextColor(0, 0, 0);


    $pdf->Text(26, 255, "Karang Gigi");
    $pdf->Line(26, 259, 191, 259);
    $pdf->Line(26, 264, 191, 264);
    $pdf->Line(26, 269, 191, 269);

    for ($i=26; $i <= 196 ; $i+=10.33) { 
        $pdf->Line($i, 269, $i, 259);
      }

      $karang_atas_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_karang_kiri_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'karang')->where('posisi', 'Kiri Atas')->where('urutan', $karang_atas_kiri)->latest()->first();

        if( $gigi_karang_kiri_atas == null){
          $pdf->SetTextColor(0, 0, 0);
         $pdf->Text($i, 263, $karang_atas_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
         $pdf->Text($i, 263, $karang_atas_kiri);
        }
       
        $karang_atas_kiri--;
      }


      $pdf->SetTextColor(0, 0, 0);

      $karang_atas_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_karang_kanan_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'karang')->where('posisi', 'Kanan Atas')->where('urutan', $karang_atas_kanan)->latest()->first();

        if( $gigi_karang_kanan_atas == null){
          $pdf->SetTextColor(0, 0, 0);
           $pdf->Text($i, 263, $karang_atas_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
           $pdf->Text($i, 263, $karang_atas_kanan);
        }
       
        $karang_atas_kanan++;
      }


      $pdf->SetTextColor(0, 0, 0);

      $karang_bawah_kiri = 8;
      for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
        $gigi_karang_kiri_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'karang')->where('posisi', 'Kiri Bawah')->where('urutan', $karang_bawah_kiri)->latest()->first();

        if( $gigi_karang_kiri_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
           $pdf->Text($i, 268, $karang_bawah_kiri);
        }else{
          $pdf->SetTextColor(255, 0, 0);
           $pdf->Text($i, 268, $karang_bawah_kiri);
        }
       
        $karang_bawah_kiri--;
      }


      $pdf->SetTextColor(0, 0, 0);

      $karang_bawah_kanan = 1;
      for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
        $gigi_karang_kanan_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'karang')->where('posisi', 'Kanan Bawah')->where('urutan', $karang_bawah_kanan)->latest()->first();

        if( $gigi_karang_kanan_bawah == null){
          $pdf->SetTextColor(0, 0, 0);
         $pdf->Text($i, 268, $karang_bawah_kanan);
        }else{
          $pdf->SetTextColor(255, 0, 0);
         $pdf->Text($i, 268, $karang_bawah_kanan);
        }
      
        $karang_bawah_kanan++;
      }
 $pdf->AddPage();

    self::header($pdf);

       
   $pdf->SetFont('Times', '', 10);
  


   $pdf->SetDrawColor(217, 217, 217);

   $pdf->SetFont('Times', '', 10.5);
   $pdf->Text(26, 30, "Gangren Radix");
   $pdf->Line(26, 33, 191, 33);
   $pdf->Line(26, 38, 191, 38);
   $pdf->Line(26, 43, 191, 43);

   for ($i=26; $i <= 196 ; $i+=10.33) { 
       $pdf->Line($i, 43, $i, 33);
     }

     $radix_atas_kiri = 8;
     for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
      $gigi_radix_kiri_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'radix')->where('posisi', 'Kiri Atas')->where('urutan', $radix_atas_kiri)->latest()->first();

      if( $gigi_radix_kiri_atas == null){
        $pdf->SetTextColor(0, 0, 0);
         $pdf->Text($i, 37, $radix_atas_kiri);
      }else{
        $pdf->SetTextColor(255, 0, 0);
         $pdf->Text($i, 37, $radix_atas_kiri);
      }
    
       $radix_atas_kiri--;
     }

     $radix_atas_kanan = 1;
     for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
      $gigi_radix_kanan_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'radix')->where('posisi', 'Kanan Atas')->where('urutan', $radix_atas_kanan)->latest()->first();

      if( $gigi_radix_kanan_atas == null){
        $pdf->SetTextColor(0, 0, 0);
       $pdf->Text($i, 37, $radix_atas_kanan);
      }else{
        $pdf->SetTextColor(255, 0, 0);
       $pdf->Text($i, 37, $radix_atas_kanan);
      }
     
       $radix_atas_kanan++;
     }

     $radix_bawah_kiri = 8;
     for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
      $gigi_radix_kiri_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'radix')->where('posisi', 'Kiri Bawah')->where('urutan', $radix_bawah_kiri)->latest()->first();

      if( $gigi_radix_kiri_bawah == null){
        $pdf->SetTextColor(0, 0, 0);
          $pdf->Text($i, 42, $radix_bawah_kiri);
      }else{
        $pdf->SetTextColor(255, 0, 0);
          $pdf->Text($i, 42, $radix_bawah_kiri);
      }
      
       $radix_bawah_kiri--;
     }

     $radix_bawah_kanan = 1;
     for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
      $gigi_radix_kanan_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'radix')->where('posisi', 'Kanan Bawah')->where('urutan', $radix_bawah_kanan)->latest()->first();

      if( $gigi_radix_kanan_bawah == null){
        $pdf->SetTextColor(0, 0, 0);
         $pdf->Text($i, 42, $radix_bawah_kanan);
      }else{
        $pdf->SetTextColor(255, 0, 0);
         $pdf->Text($i, 42, $radix_bawah_kanan);
      }
     
       $radix_bawah_kanan++;
     }
   


   $pdf->Text(26, 48, "Gigi Palsu");
   $pdf->Line(26, 51, 191, 51);
   $pdf->Line(26, 56, 191, 56);
   $pdf->Line(26, 61, 191, 61);


   for ($i=26; $i <= 196 ; $i+=10.33) { 
       $pdf->Line($i, 61, $i, 51);
     }

     $palsu_atas_kiri = 8;
     for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
      $gigi_palsu_kiri_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'palsu')->where('posisi', 'Kiri Atas')->where('urutan', $palsu_atas_kiri)->latest()->first();

      if( $gigi_palsu_kiri_atas == null){
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Text($i, 55, $palsu_atas_kiri);
      }else{
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Text($i, 55, $palsu_atas_kiri);
      }
      
       $palsu_atas_kiri--;
     }

     $palsu_atas_kanan = 1;
     for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
      $gigi_palsu_kanan_atas = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'palsu')->where('posisi', 'Kanan Atas')->where('urutan', $palsu_atas_kanan)->latest()->first();

      if( $gigi_palsu_kanan_atas == null){
        $pdf->SetTextColor(0, 0, 0);
            $pdf->Text($i, 55, $palsu_atas_kanan);
      }else{
        $pdf->SetTextColor(255, 0, 0);
            $pdf->Text($i, 55, $palsu_atas_kanan);
      }
 
       $palsu_atas_kanan++;
     }

     $palsu_bawah_kiri = 8;
     for ($i=30; $i <= 107.5 ; $i+= 10.5) { 
      $gigi_palsu_kiri_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'palsu')->where('posisi', 'Kiri Bawah')->where('urutan', $palsu_bawah_kiri)->latest()->first();

      if( $gigi_palsu_kiri_bawah == null){
        $pdf->SetTextColor(0, 0, 0);
         $pdf->Text($i, 60, $palsu_bawah_kiri);
      }else{
        $pdf->SetTextColor(255, 0, 0);
         $pdf->Text($i, 60, $palsu_bawah_kiri);
      }
      
       $palsu_bawah_kiri--;
     }

     $palsu_bawah_kanan = 1;
     for ($i=112.5; $i <= 190.5 ; $i+= 10.5) { 
      $gigi_palsu_kanan_bawah = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $norwt)->where('jenis', 'palsu')->where('posisi', 'Kanan Bawah')->where('urutan', $palsu_bawah_kanan)->latest()->first();

      if( $gigi_palsu_kanan_bawah == null){
        $pdf->SetTextColor(0, 0, 0);
         $pdf->Text($i, 60, $palsu_bawah_kanan);
      }else{
        $pdf->SetTextColor(255, 0, 0);
         $pdf->Text($i, 60, $palsu_bawah_kanan);
      }
      
       $palsu_bawah_kanan++;
     }
      
    }

    

}