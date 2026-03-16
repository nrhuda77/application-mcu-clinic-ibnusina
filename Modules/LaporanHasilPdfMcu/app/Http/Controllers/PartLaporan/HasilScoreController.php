<?php

namespace Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use FPDF as GlobalFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


class HasilScoreController extends Controller
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

    public static function watermark($pdf){
        
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

     public static function footer($pdf){
     // Posisi 1.5 cm dari bawah
       $pdf->SetY(289);
       $pdf->Image(public_path('assets/img/footer.png'), 0, $pdf->GetY(), 210);

    }

    public static function head_periksa($pdf,$pasien,$reg,$dokter,$word){
        
    
      $pdf->SetFont('Times', 'B', 12.5);
     $text = empty($word) ? "FORMULIR MEDICAL CHECKUP" : $word;

      $pageWidth = $pdf->GetPageWidth();
      $pdf->SetX(0); // Start from the left edge
      $textWidth = $pdf->GetStringWidth($text);
      $x = ($pageWidth - $textWidth) / 2;
      $pdf->SetX($x); // Move to calculated X position
      $pdf->Cell($textWidth, 43, $text, 0, 0, 'C'); // Cell with centered text

        $pdf->SetXY(25, 39);

        $pdf->SetFont('Times', '', 10.5);
        $pdf->Cell(26, 4, "Nama", 0, 0, 'L');  
        $pdf->SetXY(60, 39);
        $pdf->MultiCell(60, 4, ":".$pasien->nm_pasien);

        $pdf->SetXY(25, $pdf->GetY()+1);
        $pdf->Cell(26, 4, "Tanggal Lahir", 0, 0, 'L');  
        $pdf->SetXY(60, $pdf->GetY());
        $pdf->MultiCell(60, 4, ":".$pasien->tgl_lahir); 

        $pdf->SetXY(25, $pdf->GetY()+1);
        $pdf->Cell(26, 4, "NIK", 0, 0, 'L');  
        $pdf->SetXY(60, $pdf->GetY());
        $pdf->MultiCell(60, 4, ":".$pasien->no_ktp);

        $pdf->SetXY(25, $pdf->GetY()+1);
        $pdf->Cell(26, 4, "Jenis Kelamin", 0, 0, 'L');  
        $pdf->SetXY(60, $pdf->GetY());
        $pdf->MultiCell(60, 4, ":     ".$pasien->jk ? 'Laki-laki' : 'Perempuan');

        $pdf->SetXY(25, $pdf->GetY()+1);
        $pdf->Cell(26, 4, "No Telepon", 0, 0, 'L');  
        $pdf->SetXY(60, $pdf->GetY());
        $pdf->MultiCell(60, 4, ":".$pasien->no_tlp);

        $pdf->SetXY(125, $pdf->GetY()-24);
        $pdf->Cell(26, 4, "Tanggal Pemeriksaan", 0, 0, 'L');  
        $pdf->SetXY(160, $pdf->GetY());
        $pdf->MultiCell(40, 4, ":".$reg->tgl_registrasi); 

         $pdf->SetXY(125, $pdf->GetY()+1);
        $pdf->Cell(26, 4, "Waktu Pemeriksaan", 0, 0, 'L');  
        $pdf->SetXY(160, $pdf->GetY());
        $pdf->MultiCell(40, 4, ":".$reg->jam_reg); 

            $pdf->SetXY(125, $pdf->GetY()+1);
        $pdf->Cell(26, 4, "Instansi", 0, 0, 'L');  
        $pdf->SetXY(160, $pdf->GetY());
        $pdf->MultiCell(40, 4, ":".$pasien->perusahaan_pasien); 

          $pdf->SetXY(125, $pdf->GetY()+1);
        $pdf->Cell(26, 4, "Dokter Pengirim", 0, 0, 'L');  
        $pdf->SetXY(160, $pdf->GetY());
        $pdf->MultiCell(40, 4, ":".$dokter->nm_dokter); 

         $pdf->SetXY(125, $pdf->GetY()+1);
        $pdf->Cell(26, 4, "No Rekam Medis", 0, 0, 'L');  
        $pdf->SetXY(160, $pdf->GetY());
        $pdf->MultiCell(40, 4, ":".$pasien->no_rkm_medis); 


        $pdf->SetDrawColor(0, 0, 0); // Set color to black
        $pdf->SetLineWidth(0.3); // Set line width
        $pdf->Line(25, $pdf->GetY()+3, 195.5, $pdf->GetY()+3); // Horizontal line
        $pdf->Line(25, $pdf->GetY()+2, 195.6, $pdf->GetY()+2); // Horizontal line
    }

    public static function index($pdf,$norwt)
    {

           $reg = DB::table('reg_periksa')->where('no_rawat', $norwt)->first();
         $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
         $no_mcu = DB::table('nomor_surat_mcu')->where('no_rawat', $norwt)->first();
         $berkas_foto = DB::table('berkas_digital_perawatan')->where('kode', '013')->where('no_rawat', $norwt)->first();
         $lokasi = $berkas_foto?->lokasi_file ?? '';
         $inputan = DB::table('hasil_inputan_dokter_mcu')->where('no_rawat', $norwt)->first();
         $dokter = DB::table('dokter')->where('kd_dokter', $reg->kd_dokter)->first();
        $skr_jkrt_crdvs = DB::table('score_jakarta_cardiovascular')->where('no_rawat',$norwt)->latest()->first();
    $skr_napfa = DB::table('score_pemeriksaan_napfa')->where('no_rawat',$norwt)->latest()->first();
       if( $skr_jkrt_crdvs != null){
 $pdf->AddPage();
 $pdf->SetFont('Arial', 'B', 16);
 // Add text


        self::header($pdf);
        $word = "HASIL SCORE JAKARTA CARDIOVASCULAR";
        self::head_periksa($pdf,$pasien,$reg,$dokter,$word);

  $pdf->SetFont('Times', 'B', 12.5);


   
  $pdf->SetFillColor(0,176,80); 
   
   // Menggambar kotak dengan warna latar belakang
  $pdf->Rect(26, 83, 170, 4.5, 'DF'); 

  $pdf->SetFont('Times', 'B', 9);
  $pdf->SetTextColor(255, 255, 255); 
  $pdf->SetXY(60, 85.5); // Atur posisi Y sedikit lebih tinggi dari 83
  $pdf->Cell(0, 0, "Risk Faktor", 0, 1);  
  $pdf->SetXY(123, 85.5);
  $pdf->Cell(0, 0, "", 0, 1);  
  $pdf->SetXY(162, 85.5);
  $pdf->Cell(0, 0, "Keterangan", 0, 1);    

  $pdf->SetTextColor(0, 0, 0); 



  $pdf->SetDrawColor(217, 217, 217); // Set color to black
  $pdf->SetLineWidth(0.3); // Set line width
  $pdf->Line(26, 83, 26, 144); // Vertical line 
  $pdf->Line(113, 83, 113, 144);
  $pdf->Line(160, 83, 160, 144);
  $pdf->Line(196, 83, 196, 144);


   for ($i=95; $i <= 140 ; $i+=7) { 
   $pdf->Line(26, $i, 196, $i);
  }
  $pdf->SetFont('Times', '', 9.5);

  $pdf->Text(27, 93.5, "Sit & Reach Forward");  
  $pdf->Text(115, 93.5, $skr_jkrt_crdvs->gender ?? '-');
  $pdf->Text(162, 93.5, $skr_jkrt_crdvs->score_gender ?? '-');  
  
  $pdf->Text(27, 100.5, "Age"); 
  $pdf->Text(115, 100.5, $skr_jkrt_crdvs->age ?? '-');
  $pdf->Text(162, 100.5, $skr_jkrt_crdvs->score_age ?? '-');  

   
  $pdf->Text(27, 107.5, "Blood Preasure"); 
  $pdf->Text(115, 107.5, $skr_jkrt_crdvs->blood_presure?? '-');
  $pdf->Text(162, 107.5, $skr_jkrt_crdvs->score_blood_presure?? '-'); 
   
  $pdf->Text(27, 114.5, "BMI"); 
  $pdf->Text(115, 114.5, $skr_jkrt_crdvs->bmi ?? '-');
  $pdf->Text(162, 114.5, $skr_jkrt_crdvs->score_bmi ?? '-'); 
   
  $pdf->Text(27, 121.5, "Smoking"); 
  $pdf->Text(115, 121.5, $skr_jkrt_crdvs->smoking ?? '-');
  $pdf->Text(162, 121.5, $skr_jkrt_crdvs->score_smoking ?? '-'); 
   
  $pdf->Text(27, 128.5, "Diabetes Melitus"); 
  $pdf->Text(115, 128.5, $skr_jkrt_crdvs->diabetes ?? '-');
  $pdf->Text(162, 128.5, $skr_jkrt_crdvs->score_diabetes ?? '-'); 
  
  $pdf->Text(27, 135.5, "Physical Exercise/Activity"); 
  $pdf->Text(115, 135.5, $skr_jkrt_crdvs->activity ?? '-');
  $pdf->Text(162, 135.5, $skr_jkrt_crdvs->score_activity ?? '-'); 
 
  $pdf->Line(26, 144, 196, 144);
  $pdf->Text(27,142.5, "Score All"); 
  $pdf->Text(162,142.5, $skr_jkrt_crdvs->score_all?? '-'); 

   if ($skr_jkrt_crdvs?->score_all <= 18 && $skr_jkrt_crdvs?->score_all  >= 5) {
    $status = "High Risk (CV10 > 20%)";
    $color = $pdf->SetFillColor(255,0,0); 
} else if ($skr_jkrt_crdvs?->score_all <= 4 && $skr_jkrt_crdvs?->score_all >= 2) {
    $status = "Moderate Risk (CV10 = 10-20%)";
    $color =$pdf->SetFillColor(255,255,0); 
} else if ($skr_jkrt_crdvs?->score_all <= 1 ) {
    $status = "Low Risk (CV10 < 10%)";
    $color = $pdf->SetFillColor(0,176,80); 
}else {
    $status = "----";
    $color = $pdf->SetFillColor(255,0,0); 
}

   
      $color;
   
   // Menggambar kotak dengan warna latar belakang
  $pdf->Rect(26, 155, 170, 6.5, 'DF'); 

  $pdf->SetFont('Times', 'B', 9);
     $pdf->SetTextColor(0, 0, 0); 
  $pdf->SetXY(90, 157.5); // Atur posisi Y sedikit lebih tinggi dari 83
  $pdf->Cell(0, 0, $status, 0, 1);  
  $pdf->SetXY(123, 157.5);
  $pdf->Cell(0, 0, "", 0, 1);  
  $pdf->SetXY(162, 157.5);

//   $pdf->SetTextColor(0, 0, 0); 
//   $pdf->Text(130, 230, "Balikpapan, ".$be);
//  $pdf->Text(138, 234.5, "Dokter Pemeriksa");
// $pdf->Image(public_path('stampel_dr/qrcode_dokter_pasien_no_rawat.'.$no_rawat.'.png'), 142, 236, 18);
         


//         $pdf->SetFont('Times', 'B', 10.5);
//          // $pdf->Text(138, 59.5, " ".$dokter->nm_dokter);
//          // $pdf->SetDrawColor(0, 0, 0); // Set color to black
//          // $pdf->SetLineWidth(0.3);
//          // $pdf->Line(138, 60.5, 169, 60.5);
//          $nm_dokter = " " . $dokter->nm_dokter;
//         $pdf->Text(133, 256, $nm_dokter);
         
//          // Menghitung lebar teks
//          $width =$pdf->GetStringWidth($nm_dokter);
         
//          // Menggambar garis di bawah nama
//         $pdf->SetDrawColor(0, 0, 0); // Hitam
//         $pdf->SetLineWidth(0.3);
//         $pdf->Line(133, 257, 133 + $width, 257);
    self::footer($pdf);

}else{}



if($skr_napfa != null){
  
    $np1 =  $skr_napfa->score_sit_reach_forward;
    $np2 = $skr_napfa->score_sit_up;
    $np3 = $skr_napfa->score_push_up;
    $np4 = $skr_napfa->score_standing_board_jump;
    $np5 = $skr_napfa->score_shuttle_run;
    $np6 = $skr_napfa->score_rockport;
    $scorez = [$np1, $np2, $np3, $np4, $np5, $np6];

 $pdf->AddPage();
 $pdf->SetFont('Arial', 'B', 16);
          self::header($pdf);
          $word = "HASIL SCORE NAPFA";
        self::head_periksa($pdf,$pasien,$reg,$dokter,$word);

  $pdf->SetFont('Times', 'B', 12.5);


   
  $pdf->SetFillColor(0,176,80); 
   
   // Menggambar kotak dengan warna latar belakang
  $pdf->Rect(26, 83, 170, 4.5, 'DF'); 

  $pdf->SetFont('Times', 'B', 9);
  $pdf->SetTextColor(255, 255, 255); 
  $pdf->SetXY(60, 85.5); // Atur posisi Y sedikit lebih tinggi dari 83
  $pdf->Cell(0, 0, "Nama Test", 0, 1);  
  $pdf->SetXY(123, 85.5);
  $pdf->Cell(0, 0, "", 0, 1);  
  $pdf->SetXY(162, 85.5);
  $pdf->Cell(0, 0, "Keterangan", 0, 1);    

  $pdf->SetTextColor(0, 0, 0); 



  $pdf->SetDrawColor(217, 217, 217); // Set color to black
  $pdf->SetLineWidth(0.3); // Set line width
  $pdf->Line(26, 83, 26, 144); // Vertical line 
  $pdf->Line(113, 83, 113, 144);
  $pdf->Line(160, 83, 160, 144);
  $pdf->Line(196, 83, 196, 144);


   for ($i=95; $i <= 140 ; $i+=7) { 
   $pdf->Line(26, $i, 196, $i);
  }
  $pdf->SetFont('Times', '', 9.5);

  $pdf->Text(27, 93.5, "Sit Reach Forward");  
  $pdf->Text(115, 93.5, $skr_napfa->sit_reach_forward .' cm'?? '-');
  $pdf->Text(162, 93.5, $skr_napfa->score_sit_reach_forward ?? '-');  
  
  $pdf->Text(27, 100.5, "Sit Up"); 
  $pdf->Text(115, 100.5, $skr_napfa->sit_up .' x/menit' ?? '-');
  $pdf->Text(162, 100.5, $skr_napfa->score_sit_up ?? '-');  

   
  $pdf->Text(27, 107.5, "Push Up"); 
  $pdf->Text(115, 107.5, $skr_napfa->push_up .' x/menit' ?? '-');
  $pdf->Text(162, 107.5, $skr_napfa->score_push_up?? '-'); 
   
  $pdf->Text(27, 114.5, "Standing Board Jump"); 
  $pdf->Text(115, 114.5, $skr_napfa->standing_board_jump .' cm' ?? '-');
  $pdf->Text(162, 114.5, $skr_napfa->score_standing_board_jump ?? '-'); 
   
  $pdf->Text(27, 121.5, "Shuttle Run"); 
  $pdf->Text(115, 121.5, $skr_napfa->shuttle_run .' detik' ?? '-');
  $pdf->Text(162, 121.5, $skr_napfa->score_shuttle_run ?? '-'); 
   
  $pdf->Text(27, 128.5, "RockPort"); 
  $pdf->Text(115, 128.5, $skr_napfa->rockport .' menit' ?? '-');
  $pdf->Text(162, 128.5, $skr_napfa->score_rockport  ?? '-'); 
  
  $pdf->Text(27, 135.5, ""); 
  $pdf->Text(115, 135.5, $skr_napfa->rockport2 .' km' ?? '-');
  $pdf->Text(162, 135.5, '-'); 
 
  $pdf->Line(26, 144, 196, 144);
  $pdf->Text(27,142.5, "Score All"); 
  $pdf->Text(162,142.5, $skr_napfa->score_all?? '-'); 

   if ($skr_napfa?->score_all >= 27) {
     
     if (in_array(2, $scorez) || in_array(3, $scorez)) {
     $status = "Baik";
    $color =  $pdf->SetFillColor(0,176,80);
	}else{
    $status = "Sangat Baik";
    $color =  $pdf->SetFillColor(0,176,80);
     }
     
}else if ($skr_napfa?->score_all >= 21) {
     
      if (in_array(1, $scorez) || in_array(2, $scorez)) {
     $status = "Rata Rata";
    $color =  $pdf->SetFillColor(255,255,0);
	}else{
      $status = "Baik";
  $color =$pdf->SetFillColor(0,176,80); 
     }
 
} else if ($skr_napfa?->score_all >= 15) {
     
     	if (in_array(1, $scorez) ) {
     $status = "Kurang";
    $color =  $pdf->SetFillColor(255,0,0);
	}else{
	$status = "Rata Rata";
    $color =$pdf->SetFillColor(255,255,0); 
     }
     
    
} else if ($skr_napfa?->score_all >= 9) {
    $status = "Kurang";
    $color = $pdf->SetFillColor(255,0,0);
} else if ($skr_napfa?->score_all > 5) {
  $status = "Sangat Kurang";
  $color = $pdf->SetFillColor(255,0,0);
}else {
    $status = "-----";
    $color =$pdf->SetFillColor(255,0,0);
}

   
      $color;
   
   // Menggambar kotak dengan warna latar belakang
  $pdf->Rect(26, 155, 170, 6.5, 'DF'); 

  $pdf->SetFont('Times', 'B', 9);
  $pdf->SetTextColor(0, 0, 0); ; 
  $pdf->SetXY(105, 157.5); // Atur posisi Y sedikit lebih tinggi dari 83
  $pdf->Cell(0, 0, $status, 0, 1);  
  $pdf->SetXY(123, 157.5);
  $pdf->Cell(0, 0, "", 0, 1);  
  $pdf->SetXY(162, 157.5);

//   $pdf->SetTextColor(0, 0, 0); 
//    $pdf->Text(130, 230, "Balikpapan, ".$be);
//  $pdf->Text(138, 234.5, "Dokter Pemeriksa");
// $pdf->Image(public_path('stampel_dr/qrcode_dokter_pasien_no_rawat.'.$no_rawat.'.png'), 142, 236, 18);
         


//         $pdf->SetFont('Times', 'B', 10.5);
//          // $pdf->Text(138, 59.5, " ".$dokter->nm_dokter);
//          // $pdf->SetDrawColor(0, 0, 0); // Set color to black
//          // $pdf->SetLineWidth(0.3);
//          // $pdf->Line(138, 60.5, 169, 60.5);
//          $nm_dokter = " " . $dokter->nm_dokter;
//         $pdf->Text(133, 256, $nm_dokter);
         
//          // Menghitung lebar teks
//          $width =$pdf->GetStringWidth($nm_dokter);
         
//          // Menggambar garis di bawah nama
//         $pdf->SetDrawColor(0, 0, 0); // Hitam
//         $pdf->SetLineWidth(0.3);
//         $pdf->Line(133, 257, 133 + $width, 257);
self::footer($pdf);

}else{}

    }

    
}