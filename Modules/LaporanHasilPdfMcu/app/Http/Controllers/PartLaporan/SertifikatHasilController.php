<?php

namespace Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use FPDF as GlobalFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class SertifikatHasilController extends Controller
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
 
    public static function index($pdf, $norwt)
    {

         $reg = DB::table('reg_periksa')->where('no_rawat', $norwt)->first();
         $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
          $inputan = DB::table('hasil_inputan_dokter_mcu')->where('no_rawat', $norwt)->first();
            $dokter = DB::table('dokter')->where('kd_dokter', $reg->kd_dokter)->first();
             $c_norwt = str_replace('/', '-', $norwt);

              $inptn = $inputan?->hasil_kategori ?? '';
              $inptn2 = $inputan?->hasil_kesimpulan ?? '';
                $p1 = '';
  $p2 = '';
  $p3 = '';
  $p4 = '';
  $p5 = '';
  $p6 = '';
  $p7 = '';


         if( $inptn  == 'M1A'){
  $p1 = 'X' ?? '';
}elseif( $inptn  == 'M1B'){
  $p2 = 'X' ?? '';
}elseif( $inptn  == 'M2'){
  $p3 = 'X' ?? '';
}elseif( $inptn  == 'M3A'){
  $p4 = 'X' ?? '';
}elseif( $inptn  == 'M3B'){
  $p5 = 'X' ?? '';
}elseif( $inptn  == 'M4'){
  $p6 = 'X' ?? '';
}elseif( $inptn  == 'M5'){
  $p7 = 'X' ?? '';
}


         $pdf->AddPage();
  
       // Header
       $pdf->SetFont('Arial', 'B', 14);
       self::header($pdf);

       // Judul Sertifikat
       $pdf->SetFont('Times', 'B', 15.5);
       $pdf->SetXY(26, 31.5);
       $pdf->Cell(80, 10, "SERTIFIKAT HASIL PEMERIKSAAN KESEHATAN ", 0, 1);
       $pdf->Line(27, 39, 157, 39);

      $pdf->SetFont('Times', '', 11.5);
      $pdf->SetXY(26, 45);
$pdf->Cell(0, 10, "Berikut ini adalah hasil pemeriksaan kesehatan yang dilakukan pada tanggal : " . $reg->tgl_registrasi, 0, 1);

$pdf->SetXY(26, $pdf->GetY() + 2);
$pdf->Cell(24, 8, "Nama");
$pdf->SetXY(50, $pdf->GetY());
$pdf->MultiCell(100, 8, ": " . $pasien->nm_pasien);

$pdf->SetXY(26, $pdf->GetY() - 4);
$pdf->Cell(24, 8, "Jabatan");
$pdf->SetXY(50, $pdf->GetY());
$pdf->MultiCell(100, 8, ": " . $pasien->pekerjaan);
self::watermark($pdf);
// Bagian Temuan
$pdf->SetXY(26, $pdf->GetY() + 2);
$pdf->SetFont('Times', 'B', 12.5);
$pdf->Cell(26, 15, "TEMUAN :");
$pdf->SetFont('Times', '', 11.5);


$pdf->SetXY($pdf->GetX(), $pdf->GetY() + 3);
// Tuliskan hasil pemeriksaan dengan MultiCell agar otomatis wrap
$pdf->MultiCell(100, 5, $inputan->hasil);


// Gambar kotak dan tabel kategori
$pdf->SetFillColor(217, 217, 217);
$pdf->Rect(26, $pdf->GetY() + 5.5, 20, 7, 'DF');
$pdf->Rect(46.7, $pdf->GetY() + 5.5, 148, 7, 'DF');
$pdf->SetFillColor(255, 255, 255);

$fortbl = $pdf->GetY();
for ($i = 0; $i < 5; $i++) {
    $pdf->Rect(46.7, $fortbl + 13.5, 148, 7, 'DF');
    $pdf->Rect(26, $fortbl + 13.5, 9, 7, 'DF');
    $pdf->Rect(35.8, $fortbl + 13.5, 10.2, 7, 'DF');
    $fortbl += 7;
}

for ($i = 0; $i < 2; $i++) {
    $pdf->Rect(46.7, $fortbl + 13.5, 148, 11, 'DF');
    $pdf->Rect(26, $fortbl + 13.5, 9, 11, 'DF');
    $pdf->Rect(35.8, $fortbl + 13.5, 10.2, 11, 'DF');
    $fortbl += 10.5;
}

// Isi tabel kategori
$pdf->SetFont('Arial', '', 11);
$fortcontn = $pdf->GetY() + 18;

$pdf->Text(27, $pdf->GetY() + 10, 'Kategori');
$pdf->Text(48, $pdf->GetY() + 10, 'Catatan');

$pdf->Text(37, $fortcontn, 'M1A');
$pdf->Text(29.5, $fortcontn, $p1);
$pdf->Text(48, $fortcontn, 'Tidak ditemukan problem kesehatan');

$pdf->Text(37, $fortcontn + 8, 'M1B');
$pdf->Text(29.5, $fortcontn + 8, $p2);
$pdf->Text(48, $fortcontn + 8, 'Ditemukan problem kesehatan yang tidak serius');

$pdf->Text(37, $fortcontn + 15, 'M2');
$pdf->Text(29.5, $fortcontn + 15, $p3);
$pdf->Text(48, $fortcontn + 15, 'Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko rendah');

$pdf->Text(37, $fortcontn + 22, 'M3A');
$pdf->Text(29.5, $fortcontn + 22, $p4);
$pdf->Text(48, $fortcontn + 22, 'Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko sedang');

$pdf->Text(37, $fortcontn + 28, 'M3B');
$pdf->Text(29.5, $fortcontn + 28, $p5);
$pdf->Text(48, $fortcontn + 28, 'Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko tinggi');

$pdf->Text(37, $fortcontn + 36, 'M4');
$pdf->Text(29.5, $fortcontn + 36, $p6);
$pdf->SetXY(47, $pdf->GetY() + 50);
$pdf->Text(48, $fortcontn + 35, 'Ditemukan keterbatasan fisik untuk melakukan pekerjaan secara normal, hanya');
$pdf->Text(48, $fortcontn + 39, 'cocok untuk pekerjaan ringan');

$pdf->Text(37, $fortcontn + 46, 'M5');
$pdf->Text(29.5, $fortcontn + 46, $p7);
$pdf->SetXY(47, $pdf->GetY() + 2);
$pdf->Text(48, $fortcontn + 45, 'Dalam perawatan di rumah sakit atau dalam kondisi yang tidak memungkinkan untuk');
$pdf->Text(48, $fortcontn + 49, 'melakukan pekerjaan (status izin sakit)');

// Bagian Kesimpulan
$pdf->SetXY(26, $pdf->GetY() + 20);
$pdf->SetFont('Times', 'B', 12.5);
$pdf->Cell(26, 15, "KESIMPULAN :");

$pdf->SetXY(60, $pdf->GetY() + 5.5);
$pdf->SetFont('Times', 'B', 11.5);
$pdf->MultiCell(100, 5, strtoupper($inputan->kesimpulan));

// Bagian Saran-Saran
$pdf->SetXY(26, $pdf->GetY());
$pdf->SetFont('Times', 'B', 12.5);

$pdf->SetXY(63, $pdf->GetY() + 5.5);
$pdf->SetFont('Times', '', 11.5);

$currentY = $pdf->GetY();

$text = $inputan->catatan_hasil;
$width = 100;
$lineHeight = 5;

// Hitung jumlah baris teks kira-kira
$nbLines = $pdf->GetStringWidth($text) / $width;
$nbLines = ceil($nbLines); // pembulatan ke atas

$estimatedHeight = $nbLines * $lineHeight;
// dd( $currentY + $estimatedHeight );

if ($currentY + $estimatedHeight < 197.0) {
  $pdf->SetFont('Times', 'B', 12.5);
   $pdf->SetXY(26, $pdf->GetY() -10);
$pdf->Cell(26, 15, "SARAN -SARAN :");
$pdf->SetFont('Times', '', 11);
$pdf->SetXY(65, $pdf->GetY()+5);
  $pdf->MultiCell(100, 5, $inputan->catatan_hasil);

$pdf->SetFont('Times', '', 11);
$pdf->Text(26, 252, "Terima kasih atas kerjasamanya.");
$pdf->Text(26, 256.5, "Dokter Pemeriksa");

$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/dokter-penanggungjawab.png'), 28, 257, 22);
$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/umum.png'), 175, 257, 25);
// $pdf->Image(public_path('qr_link/qrcode'.$no_rawat.'.png'), 145, 257, 18);

// Nama dokter
$pdf->SetFont('Times', 'B', 10.5);
$nm_dokter = " " . $dokter->nm_dokter;
$pdf->Text(26, 280, $nm_dokter);

$width = $pdf->GetStringWidth($nm_dokter);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.3);
$pdf->Line(26, 281, 26 + $width, 281);

    self::footer($pdf);
   
}else{

 $pdf->AddPage();
 self::header($pdf); 
 $pdf->SetY(35); // Atur ke Y baru, misal 20

 $pdf->SetFont('Times', 'B', 12.5);
 $pdf->SetXY(26, $pdf->GetY());
$pdf->Cell(40, 5, "SARAN -SARAN :");
 $pdf->SetX(65); // Atur ke X baru, misal 10
$pdf->SetFont('Times', '', 11);
   $pdf->MultiCell(100, 5, $inputan->catatan_hasil);

$pdf->SetFont('Times', '', 11);
$pdf->Text(26, 252, "Terima kasih atas kerjasamanya.");
$pdf->Text(26, 256.5, "Dokter Pemeriksa");

$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/dokter-penanggungjawab.png'), 28, 257, 22);

$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/umum.png'), 175, 257, 25);
// $pdf->Image(public_path('qr_link/qrcode'.$no_rawat.'.png'), 145, 257, 18);

// Nama dokter
$pdf->SetFont('Times', 'B', 10.5);
$nm_dokter = " " . $dokter->nm_dokter;
$pdf->Text(26, 280, $nm_dokter);

$width = $pdf->GetStringWidth($nm_dokter);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.3);
$pdf->Line(26, 281, 26 + $width, 281);

    self::footer($pdf);
}




    }





     public static function index2($pdf, $norwt)
    {

         $reg = DB::table('reg_periksa')->where('no_rawat', $norwt)->first();
         $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
          $inputan = DB::table('hasil_inputan_dokter_mcu2')->where('no_rawat', $norwt)->first();
            $dokter = DB::table('dokter')->where('kd_dokter', $reg->kd_dokter)->first();
             $c_norwt = str_replace('/', '-', $norwt);

              $inptn = $inputan?->jenis?? '';
              $inptn2 = $inputan?->kesimpulan ?? '';
                $p1 = '';
  $p2 = '';
  $p3 = '';
  $p4 = '';
  $p5 = '';
  $p6 = '';
  $p7 = '';


         if( $inptn  == 'p1'){
  $p1 = 'X' ?? '';
}elseif( $inptn  == 'p2'){
  $p2 = 'X' ?? '';
}elseif( $inptn  == 'p3'){
  $p3 = 'X' ?? '';
}elseif( $inptn  == 'p4'){
  $p4 = 'X' ?? '';
}elseif( $inptn  == 'p5'){
  $p5 = 'X' ?? '';
}elseif( $inptn  == 'p6'){
  $p6 = 'X' ?? '';
}elseif( $inptn  == 'p7'){
  $p7 = 'X' ?? '';
}



$pp1 = '';
$pp2 = '';
$pp3 = '';
$pp4 = '';

if($inptn2 == 'lolos'){
  $pp = 'Normal' ?? '';
}elseif($inptn2 == 'gagal'){
  $pp = 'Tidak Normal' ?? '';
}elseif($inptn2 == 'bersyarat'){
  $pp = 'Bersyarat' ?? '';
}else{
  $pp = '';
}

         $pdf->AddPage();
  
       // Header
       $pdf->SetFont('Arial', 'B', 14);
       self::header($pdf);

       // Judul Sertifikat
       $pdf->SetFont('Times', 'B', 15.5);
       $pdf->SetXY(26, 31.5);
       $pdf->Cell(80, 10, "SERTIFIKAT HASIL PEMERIKSAAN KESEHATAN ", 0, 1);
       $pdf->Line(27, 39, 157, 39);

      $pdf->SetFont('Times', '', 11.5);
      $pdf->SetXY(26, 45);
$pdf->Cell(0, 10, "Berikut ini adalah hasil pemeriksaan kesehatan yang dilakukan pada tanggal : " . $reg->tgl_registrasi, 0, 1);

$pdf->SetXY(26, $pdf->GetY() + 2);
$pdf->Cell(24, 8, "Nama");
$pdf->SetXY(50, $pdf->GetY());
$pdf->MultiCell(100, 8, ": " . $pasien->nm_pasien);

$pdf->SetXY(26, $pdf->GetY() - 4);
$pdf->Cell(24, 8, "Jabatan");
$pdf->SetXY(50, $pdf->GetY());
$pdf->MultiCell(100, 8, ": " . $pasien->pekerjaan);
self::watermark($pdf);
// Bagian Temuan
$pdf->SetXY(26, $pdf->GetY() + 2);
$pdf->SetFont('Times', 'B', 12.5);
$pdf->Cell(26, 15, "TEMUAN :");
$pdf->SetFont('Times', '', 11.5);


$pdf->SetXY($pdf->GetX(), $pdf->GetY() + 3);
// Tuliskan hasil pemeriksaan dengan MultiCell agar otomatis wrap
$pdf->MultiCell(100, 5, $inputan->temuan);


// Gambar kotak dan tabel kategori
$pdf->SetFillColor(217, 217, 217);
$pdf->Rect(26, $pdf->GetY() + 5.5, 20, 7, 'DF');
$pdf->Rect(46.7, $pdf->GetY() + 5.5, 148, 7, 'DF');
$pdf->SetFillColor(255, 255, 255);

$fortbl = $pdf->GetY();
for ($i = 0; $i < 5; $i++) {
    $pdf->Rect(46.7, $fortbl + 13.5, 148, 7, 'DF');
    $pdf->Rect(26, $fortbl + 13.5, 9, 7, 'DF');
    $pdf->Rect(35.8, $fortbl + 13.5, 10.2, 7, 'DF');
    $fortbl += 7;
}

for ($i = 0; $i < 2; $i++) {
    $pdf->Rect(46.7, $fortbl + 13.5, 148, 11, 'DF');
    $pdf->Rect(26, $fortbl + 13.5, 9, 11, 'DF');
    $pdf->Rect(35.8, $fortbl + 13.5, 10.2, 11, 'DF');
    $fortbl += 10.5;
}

// Isi tabel kategori
$pdf->SetFont('Arial', '', 11);
$fortcontn = $pdf->GetY() + 18;

$pdf->Text(27, $pdf->GetY() + 10, 'Kategori');
$pdf->Text(48, $pdf->GetY() + 10, 'Catatan');

$pdf->Text(37, $fortcontn, 'P1');
$pdf->Text(29.5, $fortcontn, $p1);
$pdf->Text(48, $fortcontn, 'Tidak ditemukan problem kesehatan');

$pdf->Text(37, $fortcontn + 8, 'P2');
$pdf->Text(29.5, $fortcontn + 8, $p2);
$pdf->Text(48, $fortcontn + 8, 'Ditemukan problem kesehatan yang tidak serius');

$pdf->Text(37, $fortcontn + 15, 'P3');
$pdf->Text(29.5, $fortcontn + 15, $p3);
$pdf->Text(48, $fortcontn + 15, 'Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko rendah');

$pdf->Text(37, $fortcontn + 22, 'P4');
$pdf->Text(29.5, $fortcontn + 22, $p4);
$pdf->Text(48, $fortcontn + 22, 'Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko sedang');

$pdf->Text(37, $fortcontn + 28, 'P5');
$pdf->Text(29.5, $fortcontn + 28, $p5);
$pdf->Text(48, $fortcontn + 28, 'Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko tinggi');

$pdf->Text(37, $fortcontn + 36, 'P6');
$pdf->Text(29.5, $fortcontn + 36, $p6);
$pdf->SetXY(47, $pdf->GetY() + 50);
$pdf->Text(48, $fortcontn + 35, 'Ditemukan keterbatasan fisik untuk melakukan pekerjaan secara normal, hanya');
$pdf->Text(48, $fortcontn + 39, 'cocok untuk pekerjaan ringan');

$pdf->Text(37, $fortcontn + 46, 'P7');
$pdf->Text(29.5, $fortcontn + 46, $p7);
$pdf->SetXY(47, $pdf->GetY() + 2);
$pdf->Text(48, $fortcontn + 45, 'Dalam perawatan di rumah sakit atau dalam kondisi yang tidak memungkinkan untuk');
$pdf->Text(48, $fortcontn + 49, 'melakukan pekerjaan (status izin sakit)');

// Bagian Kesimpulan
$pdf->SetXY(26, $pdf->GetY() + 20);
$pdf->SetFont('Times', 'B', 12.5);
$pdf->Cell(26, 15, "KESIMPULAN :");

$pdf->SetXY(60, $pdf->GetY() + 5.5);
$pdf->SetFont('Times', 'B', 11.5);
$pdf->MultiCell(100, 5, strtoupper($inputan->kesimpulan));

// Bagian Saran-Saran
$pdf->SetXY(26, $pdf->GetY());
$currentY = $pdf->GetY();

$text = $inputan->saran;
$width = 100;
$lineHeight = 5;

// Hitung jumlah baris teks kira-kira
$nbLines = $pdf->GetStringWidth($text) / $width;
$nbLines = ceil($nbLines); // pembulatan ke atas

$estimatedHeight = $nbLines * $lineHeight;
// dd( $currentY + $estimatedHeight );

if ($currentY + $estimatedHeight < 171.0) {
  $pdf->SetFont('Times', 'B', 12.5);
   $pdf->SetXY(26, $pdf->GetY() );
$pdf->Cell(26, 15, "SARAN -SARAN :");
$pdf->SetFont('Times', '', 11);
$pdf->SetXY(65, $pdf->GetY()+5);
  $pdf->MultiCell(100, 5, $inputan->saran);

$pdf->SetFont('Times', '', 11);
$pdf->Text(26, 252, "Terima kasih atas kerjasamanya.");
$pdf->Text(26, 256.5, "Dokter Pemeriksa");

$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/dokter-penanggungjawab.png'), 28, 257, 22);
$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/RDMP.png'), 175, 257, 25);
// $pdf->Image(public_path('qr_link/qrcode'.$no_rawat.'.png'), 145, 257, 18);

// Nama dokter
$pdf->SetFont('Times', 'B', 10.5);
$nm_dokter = " " . $dokter->nm_dokter;
$pdf->Text(26, 280, $nm_dokter);

$width = $pdf->GetStringWidth($nm_dokter);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.3);
$pdf->Line(26, 281, 26 + $width, 281);

    self::footer($pdf);
   
}else{

 $pdf->AddPage();
 self::header($pdf); 
 $pdf->SetY(35); // Atur ke Y baru, misal 20

 $pdf->SetFont('Times', 'B', 12.5);
 $pdf->SetXY(26, $pdf->GetY());
$pdf->Cell(40, 5, "SARAN -SARAN :");
 $pdf->SetX(65); // Atur ke X baru, misal 10
$pdf->SetFont('Times', '', 11);
   $pdf->MultiCell(100, 5, $inputan->saran);

$pdf->SetFont('Times', '', 11);
$pdf->Text(26, 252, "Terima kasih atas kerjasamanya.");
$pdf->Text(26, 256.5, "Dokter Pemeriksa");

$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/dokter-penanggungjawab.png'), 28, 257, 22);

$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/RDMP.png'), 175, 257, 25);
// $pdf->Image(public_path('qr_link/qrcode'.$no_rawat.'.png'), 145, 257, 18);

// Nama dokter
$pdf->SetFont('Times', 'B', 10.5);
$nm_dokter = " " . $dokter->nm_dokter;
$pdf->Text(26, 280, $nm_dokter);

$width = $pdf->GetStringWidth($nm_dokter);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.3);
$pdf->Line(26, 281, 26 + $width, 281);

    self::footer($pdf);
}
    }

   

       public static function index3($pdf, $norwt)
    {

         $reg = DB::table('reg_periksa')->where('no_rawat', $norwt)->first();
         $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
          $inputan = DB::table('hasil_inputan_dokter_mcu3')->where('no_rawat', $norwt)->first();
            $dokter = DB::table('dokter')->where('kd_dokter', $reg->kd_dokter)->first();
              $c_norwt = str_replace('/', '-', $norwt);

              $inptn = $inputan?->jenis?? '';
              $inptn2 = $inputan?->kesimpulan ?? '';
                $p1 = '';
  $p2 = '';
  $p3 = '';
  $p4 = '';
  $p5 = '';
  $p6 = '';
  $p7 = '';


         if( $inptn  == 'p1'){
  $p1 = 'X' ?? '';
}elseif( $inptn  == 'p2'){
  $p2 = 'X' ?? '';
}elseif( $inptn  == 'p3'){
  $p3 = 'X' ?? '';
}elseif( $inptn  == 'p4'){
  $p4 = 'X' ?? '';
}elseif( $inptn  == 'p5'){
  $p5 = 'X' ?? '';
}elseif( $inptn  == 'p6'){
  $p6 = 'X' ?? '';
}elseif( $inptn  == 'p7'){
  $p7 = 'X' ?? '';
}


         $pdf->AddPage();
  
       // Header
       $pdf->SetFont('Arial', 'B', 14);
       self::header($pdf);

       // Judul Sertifikat
       $pdf->SetFont('Times', 'B', 15.5);
       $pdf->SetXY(26, 31.5);
       $pdf->Cell(80, 10, "SERTIFIKAT HASIL PEMERIKSAAN KESEHATAN ", 0, 1);
       $pdf->Line(27, 39, 157, 39);

      $pdf->SetFont('Times', '', 11.5);
      $pdf->SetXY(26, 45);
$pdf->Cell(0, 10, "Berikut ini adalah hasil pemeriksaan kesehatan yang dilakukan pada tanggal : " . $reg->tgl_registrasi, 0, 1);

$pdf->SetXY(26, $pdf->GetY() + 2);
$pdf->Cell(24, 8, "Nama");
$pdf->SetXY(50, $pdf->GetY());
$pdf->MultiCell(100, 8, ": " . $pasien->nm_pasien);

$pdf->SetXY(26, $pdf->GetY() - 4);
$pdf->Cell(24, 8, "Jabatan");
$pdf->SetXY(50, $pdf->GetY());
$pdf->MultiCell(100, 8, ": " . $pasien->pekerjaan);
self::watermark($pdf);
// Bagian Temuan
$pdf->SetXY(26, $pdf->GetY() + 2);
$pdf->SetFont('Times', 'B', 12.5);
$pdf->Cell(26, 15, "TEMUAN :");
$pdf->SetFont('Times', '', 11.5);


$pdf->SetXY($pdf->GetX(), $pdf->GetY() + 3);
// Tuliskan hasil pemeriksaan dengan MultiCell agar otomatis wrap
$pdf->MultiCell(100, 5, $inputan->temuan);




// Isi tabel kategori
$pdf->SetFont('Arial', '', 11);
$fortcontn = $pdf->GetY() + 18;

$pdf->SetFont('Arial', 'B', 12);
$pdf->Text(26, $fortcontn + 50, 'Derajat Kesehatan :');

// Kotak utama derajat kesehatan
$pdf->SetDrawColor(0);
$pdf->SetFillColor(255, 255, 255);
$pdf->Rect(26, $fortcontn + 55, 139, 5, 'DF');

// Tentukan posisi highlight sesuai jenis
$pdf->SetFillColor(255, 200, 200);
$positions = [
    'p1' => 25,
    'p2' => 45,
    'p3' => 65,
    'p4' => 85,
    'p5' => 105,
    'p6' => 125,
    'p7' => 145,
];

$col = $positions[$inptn] ?? 25; // default ke 25 kalau tidak ada
$pdf->Rect($col, $fortcontn + 55, 20, 5, 'F');

// Garis vertikal pembatas
$linesX = [45, 65, 85, 105, 125, 145, 165];
foreach ($linesX as $x) {
    $pdf->Line($x, $fortcontn + 55, $x, $fortcontn + 60);
}

// Label P1-P7
$pdf->SetTextColor(0);
$labels = ['P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'P7'];
$labelX = [33, 53, 73, 93, 113, 133, 153];

for ($i = 0; $i < count($labels); $i++) {
    $pdf->Text($labelX[$i], $fortcontn + 59, $labels[$i]);
}

// Bagian Kesimpulan
$pdf->SetXY(26, $pdf->GetY() + 20);
$pdf->SetFont('Times', 'B', 12.5);
$pdf->Cell(26, 15, "KESIMPULAN :");

$pdf->SetXY(60, $pdf->GetY() + 5.5);
$pdf->SetFont('Times', 'B', 11.5);
$pdf->MultiCell(100, 5, strtoupper($inputan->kesimpulan));

// Bagian Saran-Saran
$pdf->SetXY(26, $pdf->GetY());
$currentY = $pdf->GetY();

$text = $inputan->saran;
$width = 100;
$lineHeight = 5;

// Hitung jumlah baris teks kira-kira
$nbLines = $pdf->GetStringWidth($text) / $width;
$nbLines = ceil($nbLines); // pembulatan ke atas

$estimatedHeight = $nbLines * $lineHeight;
// dd( $currentY + $estimatedHeight );

if ($currentY + $estimatedHeight < 171.0) {
  $pdf->SetFont('Times', 'B', 12.5);
   $pdf->SetXY(26, $pdf->GetY());
$pdf->Cell(26, 15, "SARAN -SARAN :");
$pdf->SetFont('Times', '', 11);
$pdf->SetXY(65, $pdf->GetY()+5);
  $pdf->MultiCell(100, 5, $inputan->saran);

$pdf->SetFont('Times', '', 11);
$pdf->Text(26, 252, "Terima kasih atas kerjasamanya.");
$pdf->Text(26, 256.5, "Dokter Pemeriksa");

$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/dokter-penanggungjawab.png'), 28, 257, 22);
$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/RU-V.png'), 175, 257, 25);
// $pdf->Image(public_path('qr_link/qrcode'.$no_rawat.'.png'), 145, 257, 18);

// Nama dokter
$pdf->SetFont('Times', 'B', 10.5);
$nm_dokter = " " . $dokter->nm_dokter;
$pdf->Text(26, 280, $nm_dokter);

$width = $pdf->GetStringWidth($nm_dokter);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.3);
$pdf->Line(26, 281, 26 + $width, 281);

    self::footer($pdf);
   
}else{

 $pdf->AddPage();
 self::header($pdf); 
 $pdf->SetY(35); // Atur ke Y baru, misal 20

 $pdf->SetFont('Times', 'B', 12.5);
 $pdf->SetXY(26, $pdf->GetY());
$pdf->Cell(40, 5, "SARAN -SARAN :");
 $pdf->SetX(65); // Atur ke X baru, misal 10
$pdf->SetFont('Times', '', 11);
   $pdf->MultiCell(100, 5, $inputan->saran);

$pdf->SetFont('Times', '', 11);
$pdf->Text(26, 252, "Terima kasih atas kerjasamanya.");
$pdf->Text(26, 256.5, "Dokter Pemeriksa");

$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/dokter-penanggungjawab.png'), 28, 257, 22);

$pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/RU-V.png'), 175, 257, 25);
// $pdf->Image(public_path('qr_link/qrcode'.$no_rawat.'.png'), 145, 257, 18);

// Nama dokter
$pdf->SetFont('Times', 'B', 10.5);
$nm_dokter = " " . $dokter->nm_dokter;
$pdf->Text(26, 280, $nm_dokter);

$width = $pdf->GetStringWidth($nm_dokter);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.3);
$pdf->Line(26, 281, 26 + $width, 281);

    self::footer($pdf);
}
    }

    function NbLines($pdf, $w, $txt) {
    $cw = &$pdf->CurrentFont['cw'];
    if($w==0)
        $w = $pdf->w-$pdf->rMargin-$pdf->x;
    $wmax = ($w-2*$pdf->cMargin)*1000/$pdf->FontSize;
    $s = str_replace("\r",'',$txt);
    $nb = strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep = -1;
    $i = 0;
    $j = 0;
    $l = 0;
    $nl = 1;
    while($i<$nb) {
        $c = $s[$i];
        if($c=="\n") {
            $i++;
            $sep = -1;
            $j = $i;
            $l = 0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep = $i;
        $l += $cw[$c];
        if($l > $wmax) {
            if($sep==-1) {
                if($i==$j)
                    $i++;
            } else
                $i = $sep+1;
            $sep = -1;
            $j = $i;
            $l = 0;
            $nl++;
        } else
            $i++;
    }
    return $nl;
}


}