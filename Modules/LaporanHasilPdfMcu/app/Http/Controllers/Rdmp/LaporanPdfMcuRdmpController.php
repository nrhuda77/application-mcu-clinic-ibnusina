<?php

namespace Modules\LaporanHasilPdfMcu\Http\Controllers\Rdmp;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use FPDF as GlobalFPDF;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan\HasilAudiogramController;
use Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan\HasilElektroKardiogramController;
use Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan\HasilGambarController;
use Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan\HasilGigiController;
use Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan\HasilRiwayatController;
use Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan\HasilRongentDadaController;
use Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan\HasilScoreController;
use Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan\SertifikatHasilController;

class LaporanPdfMcuRdmpController extends Controller
{
 
     public function header($pdf){
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

    public function watermark($pdf){
        
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

     public function footer($pdf){
     // Posisi 1.5 cm dari bawah
       $pdf->SetY(289);
       $pdf->Image(public_path('assets/img/footer.png'), 0, $pdf->GetY(), 210);

    }

    public function head_periksa($pdf,$pasien,$reg,$dokter,$word){
        
    
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

        // $pdf->Text(26, 51, "Tanggal Lahir");  
        // $pdf->Text(60, 51, ": ". $pasien->tgl_lahir); 
        // $pdf->Text(110, 51, "Waktu Pemeriksaan");  
        // $pdf->Text(145, 51, ": ".$reg->jam_reg); 

        // $pdf->Text(26, 56, "NIK");  
        // $pdf->Text(60, 56, ": ".$pasien->no_ktp); 
        // $pdf->Text(110, 56, "Instansi"); 

        // // $pdf->Text(145, 57.5, " ");  
        // $pdf->Text(145, 56, ": ".$pasien->perusahaan_pasien); 
        // // $pdf->Text(145, 66.5, " "); 


        // $pdf->Text(26, 61, "Jenis Kelamin");  
        // $pdf->Text(60, 61, ": ".$pasien->jk ? 'Laki-laki' : 'Perempuan'); 
        // $pdf->Text(110, 61, "Dokter Pengirim");  
        // $pdf->Text(145, 61, ": ".$reg->kd_dokter); 

        // $pdf->Text(26, 66, "No. Telepon");  
        // $pdf->Text(60, 66, ": ".$pasien->no_tlp); 
        // $pdf->Text(110, 66, "No. Rekam Medis");  
        // $pdf->Text(145, 66, ": ".$reg->no_rkm_medis); 



        $pdf->SetDrawColor(0, 0, 0); // Set color to black
        $pdf->SetLineWidth(0.3); // Set line width
        $pdf->Line(25, $pdf->GetY()+3, 195.5, $pdf->GetY()+3); // Horizontal line
        $pdf->Line(25, $pdf->GetY()+2, 195.6, $pdf->GetY()+2); // Horizontal line
    }
     
    public function index($no_rawat)
    {

         $norwt = Crypt::decrypt($no_rawat);
         $reg = DB::table('reg_periksa')->where('no_rawat', $norwt)->first();
         $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
         $no_mcu = DB::table('nomor_surat_mcu')->where('no_rawat', $norwt)->first();
         $berkas_foto = DB::table('berkas_digital_perawatan')->where('kode', '013')->where('no_rawat', $norwt)->first();
         $lokasi = $berkas_foto?->lokasi_file ?? '';
         $inputan = DB::table('hasil_inputan_dokter_mcu')->where('no_rawat', $norwt)->first();
         $dokter = DB::table('dokter')->where('kd_dokter', $reg->kd_dokter)->first();
         $rkm = DB::table('riwayat_kesehatan_mcu')->where('no_rawat', $norwt)->first();
         $rpk = DB::table('riwayat_penyakit_keluarga_mcu')->where('no_rawat', $norwt)->first();
         $rkb = DB::table('riwayat_kebiasan_mcu')->where('no_rawat', $norwt)->first();
         $rim = DB::table('riwayat_imunisasi_mcu')->where('no_rawat', $norwt)->first();
         $rpm = DB::table('riwayat_paparan_mcu')->where('no_rawat', $norwt)->first();
         $vku = DB::table('vital_kondisi_umum_mcu')->where('no_rawat', $norwt)->first();
         $fkm = DB::table('pemeriksaan_kulit_mata_tht_mcu')->where('no_rawat', $norwt)->first();
         $tad = DB::table('pemeriksaan_thoraks_abdomen_mcu')->where('no_rawat', $norwt)->first();
         $gex = DB::table('pemeriksaan_genital_vertebra_mcu')->where('no_rawat', $norwt)->first();
         $ceknonlab = DB::table('pemeriksaan_non_lab_mcu')->where('no_rawat', $norwt)->first();

         $c_norwt = str_replace('/', '-', $norwt);

            $link_stamp_dokter = url('qrcode/dokter-penanggungjawab/'.$no_rawat);

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

    $filename = 'dokter-penanggungjawab.png';
    $filepath = $folder . DIRECTORY_SEPARATOR . $filename;

    $result->saveToFile($filepath);

     $link = url('detail-laporan-pdf-pasien-mcu/RDMP/'.$no_rawat);

    $qrCode = new QrCode(
    data: $link,
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

    $filename = 'RDMP.png';
    $filepath = $folder . DIRECTORY_SEPARATOR . $filename;

    $result->saveToFile($filepath);


         $pdf = new GlobalFPDF;

     

         $pdf->AddPage();

        // Header
        $this->header($pdf);

        
        $pdf->SetFont('Times', 'B', 15);
        $text = "PEMERIKSAAN KESEHATAN";
        $pageWidth = $pdf->GetPageWidth();
        $pdf->SetX(0); // Start from the left edge
        $textWidth = $pdf->GetStringWidth($text);
        $x = ($pageWidth - $textWidth) / 2;
        $pdf->SetX($x); // Move to calculated X position
        $pdf->Cell($textWidth, 53.5, $text, 0, 0, 'C'); // Cell with centered text

        $text2 = "(MEDICAL CHECKUP)";
        $pageWidth2 = $pdf->GetPageWidth();
        $pdf->SetX(0); // Start from the left edge
        $textWidth2 = $pdf->GetStringWidth($text2);
        $x2 = ($pageWidth2 - $textWidth2) / 2;
        $pdf->SetX($x2); // Move to calculated X position
        $pdf->Cell($textWidth2, 70, $text2, 0, 0, 'C'); // Cell with centered text

        $pdf->SetFont('Times', '', 13);
        
        $pdf->SetXY(26, 55); // posisi awal kiri
        $pdf->Cell(80, 10, "Nama / Name", 0, 0); // label
        
        $pdf->SetXY(108, 57); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": " . $pasien->nm_pasien, 0, 'L', 0); // isi + auto-wrap $pdf->MultiCell(80, 5, ":     " . $pasien->nm_pasien.'asdsadasdsadsadasc asdsadasadsdsad', 0, 'L', 0); // isi + auto-wrap
        
        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "Tanggal Lahir (Umur)", 0, 0); // label
        $pdf->SetXY(68, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, "/ Date Of Birth (Age)", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->Cell(100, 5, ": " . Carbon::parse($pasien->tgl_lahir)->locale('id')->translatedFormat('d F Y') . " / " . Carbon::parse($pasien->tgl_lahir)->age . " tahun", 0, 1, 'L');
        
        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "NIK ", 0, 0); // label
        $pdf->SetXY(35, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, "/ ID Number", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->Cell(100, 5, ": " . $pasien->no_ktp, 0, 1, 'L');

        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "Jenis Kelamin ", 0, 0); // label
        $pdf->SetXY(53, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, "/ Sex", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": " . ($pasien->jk == 'L' ? 'Laki-laki' : 'Perempuan'), 0, 'L', 0);

        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "No. Telepon  ", 0, 0); // label
        $pdf->SetXY(50, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, "/ Phone", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": " . $pasien->no_tlp, 0, 1);

        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "Jabatan   ", 0, 0); // label
        $pdf->SetXY(40, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, " / Job Title ", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": " . $pasien->pekerjaan, 0, 1);

        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "Alamat   ", 0, 0); // label
        $pdf->SetXY(40, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, " / Address", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": " . $pasien->alamat, 0, 1);


        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "Tanggal Pemeriksaan   ", 0, 0); // label
        $pdf->SetXY(66, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, "/ Date Of", 0, 0); // label

        $pdf->SetXY(26, $pdf->GetY()+5);
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, "Examination", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()-2); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": " . Carbon::parse($reg->tgl_registrasi)->locale('id')->translatedFormat('d F Y'), 0, 1);

        $pdf->SetXY(26, $pdf->GetY()+3); // posisi awal kiri
        $pdf->Cell(80, 10, "Massa Berlaku  ", 0, 0); // label
        $pdf->SetXY(53, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, " / Expired Date", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": " . Carbon::parse($reg->tgl_registrasi)  ->addYear()->locale('id')->translatedFormat('d F Y'), 0, 1);
        
        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "Instansi   ", 0, 0); // label
        $pdf->SetXY(40, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, " / Company", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": " . $pasien->perusahaan_pasien, 0, 1);

        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "Proyek    ", 0, 0); // label
        $pdf->SetXY(40, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, " / Project", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": " . $pasien->perusahaan_pasien, 0, 1);
        

        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "Jenis Pemeriksaan  ", 0, 0); // label
        $pdf->SetXY(60, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, " / Type Of Examination ", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": Berkala", 0, 1);
        

        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "No Rekam Medis    ", 0, 0); // label
        $pdf->SetXY(58, $pdf->GetY());
        $pdf->SetFont('Times', 'I', 13);
        $pdf->Cell(80, 10, " / Medical Record Number", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": " . $pasien->no_rkm_medis, 0, 1);
        

        $pdf->SetXY(26, $pdf->GetY()-1); // posisi awal kiri
        $pdf->Cell(80, 10, "No Mcu   ", 0, 0); // label

        $pdf->SetFont('Times', '', 13);
        $pdf->SetXY(108, $pdf->GetY()+2); // posisi awal kanan
        $pdf->MultiCell(100, 5, ": " . $no_mcu?->no_surat, 0, 1);

        $pdf->SetXY(26, $pdf->GetY()); // posisi awal kiri

         if($lokasi != null){
          $image_berkas_foto = base_path($lokasi);
           $pdf->Image($image_berkas_foto ?? '',80, 160, 50);
         }else{
         }
       
        
        $this->footer($pdf);
    



     SertifikatHasilController::index2($pdf, $norwt);

     HasilRiwayatController::index($pdf, $norwt);
             

     HasilGigiController::index($pdf, $norwt);






     


     $pdf->Text(26, 66, "Authorize:");

   $pdf->SetFont('Times', 'B', 10.5);
   $pdf->Text(26, 73, "THORAKS");

   $pdf->SetFont('Times', 'B', 10);
   $pdf->Text(26, 80, "Pernapasan");

   $pdf->SetFont('Times', '', 10.5);
   $pdf->Text(26, 85, "Pernapasan Inspeksi");  
   $pdf->Text(71, 85, ": ".$tad?->pernapasan_inspeksi); 
   $pdf->Text(110, 85, "Pernapasan Palpasi Stem Frem");  
   $pdf->Text(159, 85, ": ".$tad?->pernapasan_palpasi_stem_frem);

   $pdf->Text(26, 90, "Pernapasan Perkusi kanan");  
   $pdf->Text(71, 90, ": ".$tad?->pernapasan_perkusi_kanan); 
   $pdf->Text(110, 90, "Pernapasan Perkusi kiri");  
   $pdf->Text(159, 90, ": ".$tad?->pernapasan_perkusi_kiri);

   $pdf->Text(26, 95, "Pernapasan Aus suara nafas");  
   $pdf->Text(71, 95, ": ".$tad?->pernapasan_aus_suara_nafas); 
   $pdf->Text(110, 95, "Pernapasan Aus Ronchi");  
   $pdf->Text(159, 95, ": ".$tad?->pernapasan_aus_ronchi);


   $pdf->Text(26, 100, "Pernapasan Aus wheezing");  
   $pdf->Text(71, 100, ": ".$tad?->pernapasan_aus_wheezing); 




   $pdf->SetFont('Times', 'B', 10);
   $pdf->Text(26, 105, "Jantung");

   $pdf->SetFont('Times', '', 10.5);
      $pdf->Text(26, 110, "Jantung Auskultasi");  
   $pdf->Text(71, 110, ": ".$tad?->jantung_auskultasi);

  //  $pdf->Text(26, 110, "Jantung Inspeksi ictus cordis");  
  //  $pdf->Text(71, 110, ": ".$tad?->jantung_inspeksi_ictus_cordis); 
  //  $pdf->Text(110, 110, "Jantung Perkusi batas jantung");  
  //  $pdf->Text(159, 110, ": ".$tad?->jantung_perkusi_batas_jantung);

  //  $pdf->Text(26, 115, "Jantung Palpasi ictus cordis");  
  //  $pdf->Text(71, 115, ": ".$tad?->jantung_palpasi_ictus_cordis); 
  //  $pdf->Text(110, 115, "Jantung Auskultasi");  
  //  $pdf->Text(159, 115, ": ".$tad?->jantung_auskultasi);

  //  $pdf->Text(26, 120, "Pemeriksaan Payudara");  
  //  $pdf->Text(71, 120, ": ".$tad?->pemeriksaan_payudara); 


     $pdf->SetFont('Times', 'B', 10.5);
   $pdf->Text(26, 118, "ABDOMEN");

   $pdf->SetFont('Times', '', 10.5);
   $pdf->Text(26, 125, "Inspeksi");  
   $pdf->Text(71, 125, ": ".$tad?->inspeksi); 
   $pdf->Text(110, 125, "Perkusi");  
   $pdf->Text(159, 125, ": ".$tad?->perkusi);

   $pdf->Text(26, 130, "Palpasi");  
   $pdf->Text(71, 130, ": ".$tad?->palpasi); 
   $pdf->Text(110, 130, "Auskultasi bising usus");  
   $pdf->Text(159, 130, ": ".$tad?->auskultasi_bising_usus);

  //  $pdf->Text(26, 145, "Lien");  
  //  $pdf->Text(71, 145, ": ".$lien); 
  //  $pdf->Text(110, 145, "Helpar");  
  //  $pdf->Text(159, 145, ": ".$helpar);

  //  $pdf->Text(26, 150, "Masa");  
  //  $pdf->Text(71, 150, ": ".$masa); 
  //  $pdf->Text(110, 150, "Hernia");  
  //  $pdf->Text(159, 150, ": ".$hernia);

  //  $pdf->Text(26, 155, "Nyeri Ketok CVA");  
  //  $pdf->Text(71, 155, ": ".$nyeri_ketok_cva); 
  //  $pdf->Text(110, 155, "Ginjal Balotemen");  
  //  $pdf->Text(159, 155, ": ".$ginjal_balotemen);


   $pdf->SetFont('Times', 'B', 10.5);
   $pdf->Text(26, 138, "GENITAL DAN ANUS");

   $pdf->SetFont('Times', '', 10.5);
   $pdf->Text(26, 145, "Genitalia Externa");  
   $pdf->Text(71, 145, ": ".$gex?->genitalia_externa); 
  //  $pdf->Text(110, 170, "Anus/Rectum/Perianal");  
  //  $pdf->Text(159, 170, ": ".$gex?->perianal);

  //  $pdf->Text(26, 175, "Rectal Toucher");  
  //  $pdf->Text(71, 175, ": ".$gex?->rectal_toucher); 
  //  $pdf->Text(110, 175, "Prostat (khusus laki-laki)");  
  //  $pdf->Text(159, 175, ": ".$gex?->prostat);



   $pdf->SetFont('Times', 'B', 10.5);
   $pdf->Text(26, 153, "VERTEBRA DAN EKSTREMITAS");  

   $pdf->SetFont('Times', '', 10.5);
   $pdf->Text(26, 160, "Vertebra");  
   $pdf->Text(71, 160, ": ". $gex?->vertebra); 
  //  $pdf->Text(110, 190, "Tinel Test");  
  //  $pdf->Text(159, 190, ": ".$gex?->tinel_test);

   $pdf->SetFont('Times', 'B', 10);
   $pdf->Text(26, 165, "Ekstremitas");

   $pdf->SetFont('Times', '', 10.5);
   $pdf->Text(26, 170, "Ekestremitas Reflek fisiologis");  
   $pdf->Text(71, 170, ": ".$gex?->ekestremitas_reflek_fisiologis); 
   $pdf->Text(110, 170, "Ekestremitas Reflek patologis");  
   $pdf->Text(159, 170, ": ".$gex?->ekestremitas_reflek_patologis);

   $pdf->Text(26, 175, "Fungsi motorik ekstrem atas");  
   $pdf->Text(71, 175, ": ".$gex?->fungsi_motorik_ekstrem_atas); 
   $pdf->Text(110, 175, "Fungsi motorik ekstrem bawah");  
   $pdf->Text(159, 175, ": ".$gex?->fungsi_motorik_ekstrem_bawah);

   $pdf->Text(26, 180, "Ekestremitas Tonus otot");  
   $pdf->Text(71, 180, ": ".$gex?->ekestremitas_tonus_otot); 
  //  $pdf->Text(110, 210, "Romberg Test");  
  //  $pdf->Text(159, 210, ": ".$gex?->romberg_test);

  //  $pdf->Text(26, 215, "Laseque Sign");  
  //  $pdf->Text(71, 215, ": ".$gex?->laseque_sign); 
  //  $pdf->Text(110, 215, "Kernig's Sign");  
  //  $pdf->Text(159, 215, ": ".$gex?->kernig_sign);
    
      $this->footer($pdf);

      $pdf->AddPage();

      $this->header($pdf);

        $pdf->SetFont('Times', 'B', 11.5);
 
$pdf->SetFont('Times', 'B', 13.5);
 $text = "HASIL PEMERIKSAAN NON LABORATORIUM";
 $pageWidth =$pdf->GetPageWidth();
$pdf->SetX(0); // Start from the left edge
 $textWidth =$pdf->GetStringWidth($text);
 $x = ($pageWidth - $textWidth) / 2;
$pdf->SetX($x); // Move to calculated X position
$pdf->Cell($textWidth, 40, $text, 0, 0, 'C'); // Cell with centered text
  
  $pdf->SetFont('Times', 'B', 11.5);
 $pdf->Text(26, 40, "Pemeriksaan Non Laboratorium");  
  // Tentukan isi teks untuk setiap pemeriksaan
  $ceknonlab1 = $ceknonlab->usg ?? 'Tidak Dilakukan';
  $ceknonlab2 = $ceknonlab->radiologi ?? 'Tidak Dilakukan';
  $ceknonlab3 = $ceknonlab->ekg ?? 'Tidak Dilakukan';
  $ceknonlab4 = $ceknonlab->treadmil ?? 'Tidak Dilakukan';
  $ceknonlab5 = $ceknonlab->audiometri ?? 'Tidak Dilakukan';
  $ceknonlab6 = $ceknonlab->spirometri ?? 'Tidak Dilakukan';
  $ceknonlab7 = $ceknonlab->napfa ?? 'Tidak Dilakukan';
  // Set font normal untuk bagian header
  $pdf->SetFont('Times', '', 10.5);
  $pdf->Text(26, 50, "Pemeriksaan USG : ");
  $pdf->Text(26, 60, "Pemeriksaan Radiologi : ");
  $pdf->Text(26, 70, "Pemeriksaan EKG : ");
  $pdf->Text(26, 80, "Pemeriksaan Treadmil : ");
  $pdf->Text(26, 90, "Pemeriksaan Audiometri : ");
  $pdf->Text(26, 100, "Pemeriksaan Spirometri : ");
  $pdf->Text(26, 110, "Pemeriksaan Napfa : ");
  
  // Set font bold jika teks bukan 'Tidak Dilakukan'
  if ($ceknonlab1 != 'Tidak Dilakukan') {
      $pdf->SetFont('Times', 'B', 10.5);
  } else {
      $pdf->SetFont('Times', '', 10.5);
  }
  $pdf->Text(75, 50, $ceknonlab1);
  
  // Ulangi untuk pemeriksaan lainnya
  if ($ceknonlab2 != 'Tidak Dilakukan') {
      $pdf->SetFont('Times', 'B', 10.5);
  } else {
      $pdf->SetFont('Times', '', 10.5);
  }
  $pdf->Text(75, 60, $ceknonlab2);
  
  if ($ceknonlab3 != 'Tidak Dilakukan') {
      $pdf->SetFont('Times', 'B', 10.5);
  } else {
      $pdf->SetFont('Times', '', 10.5);
  }
  $pdf->Text(75, 70, $ceknonlab3);
  
  if ($ceknonlab4 != 'Tidak Dilakukan') {
      $pdf->SetFont('Times', 'B', 10.5);
  } else {
      $pdf->SetFont('Times', '', 10.5);
  }
  $pdf->Text(75, 80, $ceknonlab4);
  
  if ($ceknonlab5 != 'Tidak Dilakukan') {
      $pdf->SetFont('Times', 'B', 10.5);
  } else {
      $pdf->SetFont('Times', '', 10.5);
  }
  $pdf->Text(75, 90, $ceknonlab5);
  
  if ($ceknonlab6 != 'Tidak Dilakukan') {
      $pdf->SetFont('Times', 'B', 10.5);
  } else {
      $pdf->SetFont('Times', '', 10.5);
  }
  $pdf->Text(75, 100, $ceknonlab6);

  if ($ceknonlab7 != 'Tidak Dilakukan') {
    $pdf->SetFont('Times', 'B', 10.5);
} else {
    $pdf->SetFont('Times', '', 10.5);
}
$pdf->Text(75, 110, $ceknonlab7);

      $this->footer($pdf);


      HasilScoreController::index($pdf,$norwt);
      HasilRongentDadaController::index($pdf,$norwt);
      HasilElektroKardiogramController::index($pdf,$norwt);
      HasilAudiogramController::index($pdf,$norwt);



     $upg = DB::table('berkas_digital_perawatan')->where('no_rawat',$norwt)->where('kode','006')->get();
      $txt = "HASIL PEMERIKSAAN RADIOLOGI";
      

      if($upg == null){
      }else{
        HasilGambarController::index($pdf,$norwt,$upg,$txt);
      }

      $upg = DB::table('berkas_digital_perawatan')->where('no_rawat',$norwt)->where('kode','009')->get();
      $txt = "HASIL PEMERIKSAAN ELEKTROKARDIOGRAM";

      if($upg == null){
      
      }else{
        HasilGambarController::index($pdf,$norwt,$upg,$txt);
      }

       $upg = DB::table('berkas_digital_perawatan')->where('no_rawat',$norwt)->where('kode','010')->get();
      $txt = "HASIL PEMERIKSAAN AUDIOMETRI";

      if($upg == null){
     
      }else{
        HasilGambarController::index($pdf,$norwt,$upg,$txt);
      }


       $upg = DB::table('berkas_digital_perawatan')->where('no_rawat',$norwt)->where('kode','011')->get();
      $txt = "HASIL PEMERIKSAAN SPIROMETRI";

      if($upg == null){
       
      }else{
        HasilGambarController::index($pdf,$norwt,$upg,$txt);
      }

       $upg = DB::table('berkas_digital_perawatan')->where('no_rawat',$norwt)->where('kode','012')->get();
      $txt = "HASIL PEMERIKSAAN VISION TESTER";

      if($upg == null){
       
      }else{
        HasilGambarController::index($pdf,$norwt,$upg,$txt);
      }

        $upg = DB::table('berkas_digital_perawatan')->where('no_rawat',$norwt)->where('kode','014')->get();
      $txt = "HASIL PEMERIKSAAN NAPFA";

      if($upg == null){
       
      }else{
        HasilGambarController::index($pdf,$norwt,$upg,$txt);
      }

        $upg = DB::table('berkas_digital_perawatan')->where('no_rawat',$norwt)->where('kode','015')->get();
      $txt = "HASIL PEMERIKSAAN VISION TREADMIL";

      if($upg == null){
       
      }else{
        HasilGambarController::index($pdf,$norwt,$upg,$txt);
      }

        $upg = DB::table('berkas_digital_perawatan')->where('no_rawat',$norwt)->where('kode','016')->get();
      $txt = "HASIL KUESIONER ACROPHOBHIA";

      if($upg == null){
       
      }else{
        HasilGambarController::index($pdf,$norwt,$upg,$txt);
      }

        $upg = DB::table('berkas_digital_perawatan')->where('no_rawat',$norwt)->where('kode','017')->get();
      $txt = "HASIL KUESIONER CLAUSTROPOBHIA";

      if($upg == null){
      
      }else{
      HasilGambarController::index($pdf,$norwt,$upg,$txt);
      }

      $upg = DB::table('berkas_digital_perawatan')->where('no_rawat',$norwt)->where('kode','018')->get();
      $txt = "HASIL PEMERIKSAAN LABORATORIUM";
      if($upg  == null || $upg ->isEmpty()){
      }else{  
        HasilGambarController::index($pdf,$norwt,$upg,$txt);
      }

         // Ambil isi PDF sebagai string
    $pdfContent = $pdf->Output('S'); // 'S' = return string, bukan langsung kirim ke browser

    // Kembalikan sebagai response Laravel
    return response($pdfContent)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="laporan_mcu.pdf"');
    }
}