<?php

namespace Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;
use FPDF as GlobalFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HasilGambarController extends Controller
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
 

     public static function index($pdf, $norwt, $upg, $txt)
    {
    
      if ($upg->isNotEmpty()) {

          $no_rwt = Crypt::encrypt($norwt);

           $c_norwt = str_replace('/', '-', $norwt);
      $link_stamp_dokter = url('qrcode/dokter-pemeriksa/'.$upg[0]->kode.'/'.$no_rwt);
      $qr = DB::table('dokter_periksa_mcu')
      ->where('kode', $upg[0]->kode)
      ->where('no_rawat', $norwt)
      ->first();
      $dr = DB::table('dokter') ->where('kd_dokter', $qr?->kd_dokter)->first();

    $qrCode = new QrCode(
    data: $link_stamp_dokter,
    encoding: new Encoding('UTF-8'),
    errorCorrectionLevel: ErrorCorrectionLevel::Low,
    size: 300,
    margin: 10,
    roundBlockSizeMode: RoundBlockSizeMode::Margin,
    foregroundColor: new Color(0, 0, 0),
    backgroundColor: new Color(255, 255, 255)
);

    $writer = new PngWriter();
    $result = $writer->write($qrCode);

      $folder = base_path('assets/qrcode/'.$c_norwt);
    if (!file_exists($folder)) {
        mkdir($folder, 0755, true);
    }

    $filename = $upg[0]->kode. '.png';
    $filepath = $folder . DIRECTORY_SEPARATOR . $filename;

    $result->saveToFile($filepath);
      }

    


         $reg = DB::table('reg_periksa')->where('no_rawat', $norwt)->first();
         $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
         $no_mcu = DB::table('nomor_surat_mcu')->where('no_rawat', $norwt)->first();
         $berkas_foto = DB::table('berkas_digital_perawatan')->where('kode', '013')->where('no_rawat', $norwt)->first();
         $lokasi = $berkas_foto?->lokasi_file ?? '';
         $dokter = DB::table('dokter')->where('kd_dokter', $reg->kd_dokter)->first();

       foreach($upg as $u){
      
   $pdf->AddPage();
   
   self::header($pdf);
  
  $pdf->SetFont('Times', 'B', 13.5);
  $text = $txt;

   $pdf->SetFont('Times', '', 10.5);
        self::head_periksa($pdf,$pasien,$reg,$dokter,$text);



        $pdf->SetDrawColor(0, 0, 0); // Set color to black
        $pdf->SetLineWidth(0.3); // Set line width
        $pdf->Line(25, 69, 195.5, 69); // Horizontal line
        $pdf->Line(25, 70, 195.6, 70); // Horizontal line

    
 
 

            $gambar_cek_lab = str_replace("assets/", "assets/", $u->lokasi_file);
      $imagePath = base_path($gambar_cek_lab);
      $pdf->Image( $imagePath, 0, 76, 210);

      $pdf->SetFont('Times', '', 11);
// $pdf->Text(26, 252, "Terima kasih atas kerjasamanya.");


if($qr){
  $pdf->Text(10, 256.5, "Dokter Pemeriksa");
  $pdf->Image(base_path('assets/qrcode/'.$c_norwt.'/'.$qr->kode.'.png'), 12, 257, 22);
  $pdf->SetFont('Times', 'B', 10.5);
$nm_dokter = " " . $dr->nm_dokter;
$pdf->Text(10, 280, $nm_dokter);

$width = $pdf->GetStringWidth($nm_dokter);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.3);
$pdf->Line(10, 281, 10 + $width, 281);
}
// $pdf->Image(public_path('qr_link/qrcode'.$no_rawat.'.png'), 145, 257, 18);

// Nama dokter

      
self::footer($pdf);
    }

}
}