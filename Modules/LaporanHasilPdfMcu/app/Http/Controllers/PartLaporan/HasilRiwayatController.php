<?php

namespace Modules\LaporanHasilPdfMcu\Http\Controllers\PartLaporan;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use FPDF as GlobalFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HasilRiwayatController extends Controller
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


          $pdf->AddPage();

    self::header($pdf);

        self::head_periksa($pdf,$pasien,$reg, $dokter, '');

        
        $pdf->SetDrawColor(0, 0, 0); // Set color to black
        $pdf->SetLineWidth(0.3); // Set line width
        $pdf->Line(25, 69, 195.5, 69); // Horizontal line
        $pdf->Line(25, 70, 195.6, 70); // Horizontal line

        $pdf->SetFont('Times', 'B', 12.5);
        $pdf->Text(26, 78, "I. RIWAYAT KESEHATAN");
        
        
          $pdf->SetFillColor(0,176,80); 
        
        // Menggambar kotak dengan warna latar belakang
        $pdf->Rect(26, 83, 170, 4.5, 'DF'); 

        $pdf->SetFont('Times', 'B', 9);
        $pdf->SetTextColor(255, 255, 255); 
        $pdf->SetXY(60, 85.5); // Atur posisi Y sedikit lebih tinggi dari 83
        $pdf->Cell(0, 0, "Riwayat Kesehatan", 0, 1);  
        $pdf->SetXY(123, 85.5);
        $pdf->Cell(0, 0, "Jawaban", 0, 1);  
        $pdf->SetXY(162, 85.5);
        $pdf->Cell(0, 0, "Keterangan", 0, 1);    
 
        $pdf->SetTextColor(0, 0, 0); 


        // $pdf->SetDrawColor(217, 217, 217); // Set color to black
        // $pdf->SetLineWidth(0.3); // Set line width
        // $pdf->Line(26, 83, 26, 188); // Vertical line 
        // $pdf->Line(113, 83, 113, 188);
        // $pdf->Line(145, 83, 145, 188);
        // $pdf->Line(196, 83, 196, 188);


        // for ($i=93; $i <= 188 ; $i+=5) { 
        //   $pdf->Line(26, $i, 196, $i);
        // }

        $pdf->SetDrawColor(217, 217, 217); // Set color to black
        $pdf->SetLineWidth(0.3); // Set line width
        $pdf->Line(26, 83, 26, 153); // Vertical line 
        $pdf->Line(113, 83, 113, 153);
        $pdf->Line(145, 83, 145, 153);
        $pdf->Line(196, 83, 196, 153);


        for ($i=93; $i <= 153 ; $i+=5) { 
          $pdf->Line(26, $i, 196, $i);
        }

        $pdf->SetFont('Times', '', 9.5);

        $pdf->Text(27, 91.5, "Hepatitis");  
        $pdf->Text(125, 91.5, $rkm?->hepatitis ?? '-');
        $pdf->Text(146, 91.5, $rkm?->keterangan_hepatitis ?? '-');  
       
        $pdf->Text(27, 96.5, "Hipertensi"); 
        $pdf->Text(125, 96.5, $rkm?->hipertensi ?? '-');
        $pdf->Text(146, 96.5, $rkm?->keterangan_hipertensi ?? '-');  

        
        $pdf->Text(27, 101.5, "Pengobatan TBC"); 
        $pdf->Text(125, 101.5, $rkm?->tbc ?? '-');
        $pdf->Text(146, 101.5, $rkm?->keterangan_tbc ?? '-'); 
        
        $pdf->Text(27, 106.5, "Penyakit Jantung"); 
        $pdf->Text(125, 106.5, $rkm?->jantung ?? '-');
        $pdf->Text(146, 106.5, $rkm?->keterangan_jantung ?? '-'); 
        
        $pdf->Text(27, 111.5, "Riwayat Alergi"); 
        $pdf->Text(125, 111.5, $rkm?->alergi ?? '-');
        $pdf->Text(146, 111.5, $rkm?->keterangan_alergi ?? '-'); 
        
        $pdf->Text(27, 116.5, "Riwayat Asma"); 
        $pdf->Text(125, 116.5, $rkm?->asma ?? '-');
        $pdf->Text(146, 116.5, $rkm?->keterangan_asma ?? '-'); 
       
        $pdf->Text(27, 121.5, "Diabetes Melitus/Kencing Manis"); 
        $pdf->Text(125, 121.5, $rkm?->diabet ?? '-');
        $pdf->Text(146, 121.5, $rkm?->keterangan_diabet ?? '-'); 
      
        $pdf->Text(27, 126.5, "Haemorroid (Wasir)"); 
        $pdf->Text(125, 126.5, $rkm?->wasir ?? '-');
        $pdf->Text(146, 126.5, $rkm?->keterangan_wasir ?? '-'); 
       
        // $pdf->Text(27, 131.5, "Typhoid"); 
        // $pdf->Text(125, 131.5, $rkm?->typhoid ?? '-');
        // $pdf->Text(146, 131.5, $rkm?->keterangan_typhoid ?? '-'); 
       
        // $pdf->Text(27, 136.5, "Hernia"); 
        // $pdf->Text(125, 136.5, $rkm?->hernia ?? '-');
        // $pdf->Text(146, 136.5, $rkm?->keterangan_hernia ?? '-'); 
       
        // $pdf->Text(27, 141.5, "Penyakit Kelamin"); 
        // $pdf->Text(125, 141.5, $rkm?->penyakit_kelamin ?? '-');
        // $pdf->Text(146, 141.5, $rkm?->keterangan_penyakit_kelamin ?? '-'); 
   
        $pdf->Text(27, 131.5, "Riwayat Operasi/Pembedahan"); 
        $pdf->Text(125, 131.5, $rkm?->operasi_pembedahan ?? '-');
        $pdf->Text(146, 131.5, $rkm?->keterangan_operasi_pembedahan ?? '-'); 
        
        // $pdf->Text(27, 151.5, "Riwayat Rawat Inap"); 
        // $pdf->Text(125, 151.5, $rkm?->rawat_inap ?? '-');
        // $pdf->Text(146, 151.5, $rkm?->keterangan_rawat_inap ?? '-'); 
     
        $pdf->Text(27, 136.5, "Riwayat Konsumsi Obat"); 
        $pdf->Text(125, 136.5, $rkm?->konsumsi_obat ?? '-');
        $pdf->Text(146, 136.5, $rkm?->keterangan_konsumsi_obat ?? '-'); 
        
        $pdf->Text(27, 141.5, "Penyakit Yang di Derita Saat ini"); 
        $pdf->Text(125, 141.5, $rkm?->penyakit_saat_ini ?? '-');
        $pdf->Text(146, 141.5, $rkm?->keterangan_penyakit_saat_ini ?? '-'); 
       
        // $pdf->Text(27, 166.5, "Penyakit Lainnya"); 
        // $pdf->Text(125, 166.5, $rkm?->penyakit_lainya ?? '-');
        // $pdf->Text(146, 166.5, $rkm?->keterangan_penyakit_lainya ?? '-'); 
   
        $pdf->Text(27, 146.5, "Riwayat Hamil"); 
        $pdf->Text(125, 146.5, $rkm?->hamil ?? '-');
        $pdf->Text(146, 146.5, $rkm?->keterangan_hamil ?? '-'); 
    
        // $pdf->Text(27, 176.5, "Riwayat keguguran"); 
        // $pdf->Text(125, 176.5, $rkm?->keguguran ?? '-');
        // $pdf->Text(146, 176.5, $rkm?->keterangan_keguguran ?? '-'); 

        $pdf->Text(27, 151.5, "Gangguan Haid"); 
        $pdf->Text(125, 151.5, $rkm?->haid ?? '-');
        $pdf->Text(146, 151.5, $rkm?->keterangan_haid ?? '-'); 
   
        // $pdf->Text(27, 186.5, "Siklus Haid Tidak Normal"); 
        // $pdf->Text(125, 186.5, $rkm?->haid_tidak_normal ?? '-');
        // $pdf->Text(146, 186.5, $rkm?->keterangan_haid_tidak_normal ?? '-'); 



       $pdf->SetFont('Times', 'B', 12.5);
        $pdf->Text(26, 166, "II. RIWAYAT PENYAKIT KELUARGA"); 

        $pdf->Rect(26, 171, 170, 4.5, 'DF'); 

        $pdf->SetFont('Times', 'B', 9);
        $pdf->SetTextColor(255, 255, 255); 
        $pdf->SetXY(47, 173.5); // Atur posisi Y sedikit lebih tinggi dari 83
        $pdf->Cell(0, 0, "Jenis Penyakit", 0, 1); 
        $pdf->SetXY(99, 173.5);
        $pdf->Cell(0, 0, "Bapak", 0, 1);  
        $pdf->SetXY(127, 173.5);
        $pdf->Cell(0, 0, "Ibu", 0, 1);  
        $pdf->SetXY(149, 173.5);
        $pdf->Cell(0, 0, "Kakek", 0, 1);    
        $pdf->SetXY(177, 173.5);
        $pdf->Cell(0, 0, "Nenek", 0, 1);  
 
        $pdf->SetTextColor(0, 0, 0); 

        // $pdf->Line(26, 201, 26, 250); // Vertical line 
        // $pdf->Line(88, 201, 88, 250);
        // $pdf->Line(120, 201, 120, 250);
        // $pdf->Line(140, 201, 140, 250);
        // $pdf->Line(168, 201, 168, 250);
        // $pdf->Line(196, 201, 196, 250);

        // for ($i=210; $i <= 250 ; $i+=5) { 
        //     $pdf->Line(26, $i, 196, $i);
        //   }

        $pdf->Line(26, 171, 26, 195); // Vertical line 
        $pdf->Line(88, 171, 88, 195);
        $pdf->Line(120, 171, 120, 195);
        $pdf->Line(140, 171, 140, 195);
        $pdf->Line(168, 171, 168, 195);
        $pdf->Line(196, 171, 196, 195);

        for ($i=180; $i <= 195 ; $i+=5) { 
            $pdf->Line(26, $i, 196, $i);
          }

          $pdf->SetFont('Times', '', 9.5);

          $pdf->Text(27, 178.8, "Darah Tinggi ");
          $pdf->Text(100, 178.8, $rpk?->bapak_darah_tinggi ?? '-');  
          $pdf->Text(126, 178.8, $rpk?->ibu_darah_tinggi ?? '-');
          $pdf->Text(150.5, 178.8, $rpk?->kakek_darah_tinggi ?? '-');  
          $pdf->Text(178, 178.8, $rpk?->nenek_darah_tinggi ?? '-');  

          $pdf->Text(27, 183.8, "Diabetes Melitus");  
          $pdf->Text(100, 183.8, $rpk?->bapak_diabet ?? '-');
          $pdf->Text(126, 183.8, $rpk?->ibu_diabet ?? '-');
          $pdf->Text(150.5, 183.8, $rpk?->kakek_diabet ?? '-'); 
          $pdf->Text(178, 183.8, $rpk?->nenek_diabet ?? '-');  
          
          $pdf->Text(27, 188.8, "Sakit Jantung");  
          $pdf->Text(100, 188.8, $rpk?->bapak_jantung ?? '-');
          $pdf->Text(126, 188.8, $rpk?->ibu_jantung ?? '-');
          $pdf->Text(150.5, 188.8, $rpk?->kakek_jantung ?? '-');  
          $pdf->Text(178, 188.8, $rpk?->nenek_jantung ?? '-');  

          // $pdf->Text(27, 223.8, "Sakit Ginjal");  
          // $pdf->Text(100, 223.8, $rpk?->bapak_ginjal ?? '-');
          // $pdf->Text(126, 223.8, $rpk?->ibu_ginjal ?? '-');
          // $pdf->Text(150.5, 223.8, $rpk?->kakek_ginjal ?? '-');  
          // $pdf->Text(178, 223.8, $rpk?->nenek_ginjal ?? '-');  

          // $pdf->Text(27, 228.8, "Sakit Hati/Liver");  
          // $pdf->Text(100, 228.8, $rpk?->bapak_liver ?? '-');
          // $pdf->Text(126, 228.8, $rpk?->ibu_liver ?? '-');
          // $pdf->Text(150.5, 228.8, $rpk?->kakek_liver ?? '-');  
          // $pdf->Text(178, 228.8, $rpk?->nenek_liver ?? '-');  

          $pdf->Text(27, 193.8, "Asma");  
          $pdf->Text(100, 193.8, $rpk?->bapak_asma ?? '-');
          $pdf->Text(126, 193.8, $rpk?->ibu_asma ?? '-');
          $pdf->Text(150.5, 193.8, $rpk?->kakek_asma ?? '-'); 
          $pdf->Text(178, 193.8, $rpk?->nenek_asma ?? '-');   

          // $pdf->Text(27, 238.8, "Alergi");  
          // $pdf->Text(100, 238.8, $rpk?->bapak_alergi ?? '-');
          // $pdf->Text(126, 238.8, $rpk?->ibu_alergi ?? '-');
          // $pdf->Text(150.5, 238.8, $rpk?->kakek_alergi ?? '-'); 
          // $pdf->Text(178, 238.8, $rpk?->nenek_alergi ?? '-');  

          // $pdf->Text(27, 243.8, "Gangguan Mental");  
          // $pdf->Text(100, 243.8, $rpk?->bapak_gangguan_mental ?? '-');
          // $pdf->Text(126, 243.8, $rpk?->ibu_gangguan_mental ?? '-');  
          // $pdf->Text(150.5, 243.8, $rpk?->kakek_gangguan_mental ?? '-'); 
          // $pdf->Text(178, 243.8, $rpk?->nenek_gangguan_mental ?? '-'); 

          // $pdf->Text(27, 248.8, "Lainnya");  
          // $pdf->Text(100, 248.8, $rpk?->bapak_lainya ?? '-');
          // $pdf->Text(126, 248.8, $rpk?->ibu_lainya ?? '-'); 
          // $pdf->Text(150.5, 248.8, $rpk?->kakek_lainya ?? '-');  
          // $pdf->Text(178, 248.8, $rpk?->nenek_lainya ?? '-'); 


         self::footer($pdf);


           $pdf->AddPage();

    self::header($pdf);

    $pdf->SetFont('Times', 'B', 12.5);
    $pdf->Text(26, 35, "III. KEBIASAAN"); 

     
    $pdf->SetFillColor(0,176,80); 
     
     // Menggambar kotak dengan warna latar belakang
    $pdf->Rect(26, 37, 170, 4.5, 'DF'); 

    $pdf->SetFont('Times', 'B', 9);
       $pdf->SetTextColor(255, 255, 255); 
       $pdf->SetXY(60, 39.5); // Atur posisi Y sedikit lebih tinggi dari 83
       $pdf->Cell(0, 0, "Kebiasaan", 0, 1);  
       $pdf->SetXY(123, 39.5);
       $pdf->Cell(0, 0, "Ya/Tidak", 0, 1);  
       $pdf->SetXY(162, 39.5);
       $pdf->Cell(0, 0, "Keterangan", 0, 1);    
 
       $pdf->SetTextColor(0, 0, 0); 
     

    // $pdf->SetDrawColor(217, 217, 217); // Set color to black
    // $pdf->SetLineWidth(0.3); // Set line width
    // $pdf->Line(26, 37, 26, 67); // Vertical line 
    // $pdf->Line(113, 37, 113, 67);
    // $pdf->Line(145, 37, 145, 67);
    // $pdf->Line(196, 37, 196, 67);

    //  for ($i=47; $i <= 67 ; $i+=5) { 
    //    $pdf->Line(26, $i, 196, $i);
    //   }


   $pdf->SetDrawColor(217, 217, 217); // Set color to black
   $pdf->SetLineWidth(0.3); // Set line width
   $pdf->Line(26, 37, 26,62); // Vertical line 
   $pdf->Line(113, 37, 113,62);
   $pdf->Line(145, 37, 145,62);
   $pdf->Line(196, 37, 196,62);

    for ($i=47; $i <=62 ; $i+=5) { 
      $pdf->Line(26, $i, 196, $i);
     }

     $pdf->SetFont('Times', '', 9.5);

     $pdf->Text(27, 45.8, "Merokok");  
     $pdf->Text(126, 45.8, $rkb?->merokok ?? '-');
     $pdf->Text(146, 45.8, $rkb?->keterangan_merokok ?? '-');

     $pdf->Text(27, 50.8, "Kopi");  
     $pdf->Text(126, 50.8, $rkb?->kopi ?? '-');
     $pdf->Text(146, 50.8, $rkb?->keterangan_kopi ?? '-');

     $pdf->Text(27, 55.8, "Alkohol");  
     $pdf->Text(126, 55.8, $rkb?->alkohol ?? '-');
     $pdf->Text(146, 55.8, $rkb?->keterangan_alkohol ?? '-');

     $pdf->Text(27, 60.8, "Olah Raga");  
     $pdf->Text(126, 60.8, $rkb?->olahraga ?? '-');
     $pdf->Text(146, 60.8, $rkb?->keterangan_olahraga ?? '-');

      //$pdf->Text(27, 65.8, "Istirahat Tidur Malam");  
      //$pdf->Text(126, 65.8, $rkb?->tidur ?? '-');
      //$pdf->Text(146, 65.8, $rkb?->keterangan_tidur ?? '-');


     $pdf->SetFont('Times', 'B', 12.5);
    $pdf->Text(26, 76, "IV. RIWAYAT IMUNISASI"); 

    $pdf->Rect(26, 80, 170, 4.5, 'DF');
     
    $pdf->SetFont('Times', 'B', 9);
       $pdf->SetTextColor(255, 255, 255); 
       $pdf->SetXY(100, 82.4); // Atur posisi Y sedikit lebih tinggi dari 83
       $pdf->Cell(0, 0, "Jenis Imunisasi", 0, 1);  
       $pdf->SetXY(174, 82.4);
       $pdf->Cell(0, 0, "Keterangan", 0, 1);

 
       $pdf->SetTextColor(0, 0, 0); 

    // $pdf->Line(26, 80, 26, 135); // Vertical line 
    // $pdf->Line(170, 80, 170, 135);
    // $pdf->Line(196, 80, 196, 135);
     
    //  for ($i=90; $i <= 135 ; $i+=5) { 
    //    $pdf->Line(26, $i, 196, $i);
    //   }

   $pdf->Line(26, 80, 26, 100); // Vertical line 
   $pdf->Line(170, 80, 170, 100);
   $pdf->Line(196, 80, 196, 100);
    
    for ($i=90; $i <= 100 ; $i+=5) { 
      $pdf->Line(26, $i, 196, $i);
     }

     $pdf->SetFont('Times', '', 9.5);

     $pdf->Text(27, 88.8, "Hep A");  
     $pdf->Text(180, 88.8, $rim?->hep_a ?? '-');

     $pdf->Text(27, 93.8, "Hep B");  
     $pdf->Text(180, 93.8, $rim?->hep_b ?? '-');

      //$pdf->Text(27, 98.8, "BCG");  
      //$pdf->Text(180, 98.8, $rim?->bcg ?? '-');

      //$pdf->Text(27, 103.8, "Polio");  
      //$pdf->Text(180, 103.8, $rim?->polio ?? '-');

      //$pdf->Text(27, 108.8, "DPT");  
      //$pdf->Text(180, 108.8, $rim?->dpt ?? '-');

      //$pdf->Text(27, 113.8, "Tetanus");  
      //$pdf->Text(180, 113.8, $rim?->tetanus ?? '-');

      //$pdf->Text(27, 118.8, "Campak");  
      //$pdf->Text(180, 118.8, $rim?->campak ?? '-');

      //$pdf->Text(27, 123.8, "Typhoid");  
      //$pdf->Text(180, 123.8, $rim?->typhoid ?? '-');

      //$pdf->Text(27, 128.8, "Rubbela");  
      //$pdf->Text(180, 128.8, $rim?->rubela ?? '-');

     $pdf->Text(27, 98.8, "Covid-19");  
     $pdf->Text(180, 98.8, $rim?->covid19 ?? '-');


  $pdf->SetFont('Times', 'B', 12.5);
    $pdf->Text(26, 116, "V. RIWAYAT PAPARAN KERJA"); 

    $pdf->Rect(26, 120, 170, 4.5, 'DF'); 

    $pdf->SetFont('Times', 'B', 9);
    $pdf->SetTextColor(255, 255, 255); 
    $pdf->SetXY(60, 122.5); // Atur posisi Y sedikit lebih tinggi dari 83
    $pdf->Cell(0, 0, "Jenis Paparan", 0, 1);  
    $pdf->SetXY(123, 122.5);
    $pdf->Cell(0, 0, "Terpapar", 0, 1);  
    $pdf->SetXY(160, 122.5);
    $pdf->Cell(0, 0, "Lama Paparan", 0, 1);    

    $pdf->SetTextColor(0, 0, 0); 

    // $pdf->Line(26, 150, 26, 215); // Vertical line 
    // $pdf->Line(113, 150, 113, 215);
    // $pdf->Line(145, 150, 145, 215);
    // $pdf->Line(196, 150, 196, 215);

    //  for ($i=160; $i <= 215 ; $i+=5) { 
    //    $pdf->Line(26, $i, 196, $i);
    //   }


   $pdf->Line(26, 120, 26, 160); // Vertical line 
    $pdf->Line(113, 120, 113, 160);
    $pdf->Line(145, 120, 145, 160);
    $pdf->Line(196, 120, 196, 160);

     for ($i=130; $i <= 160 ; $i+=5) { 
       $pdf->Line(26, $i, 196, $i);
      }

   
     $pdf->SetFont('Times', '', 9.5);

     $pdf->Text(27, 128.8, "Terpapar Bising");  
     $pdf->Text(126, 128.8, $rpm?->terpapar_bising ?? '-');
     $pdf->Text(146, 128.8, $rpm?->lama_terpapar_bising ?? '-');

     $pdf->Text(27, 133.8, "Suhu Ekstrim Dingin");  
     $pdf->Text(126, 133.8, $rpm?->terpapar_suhu_ekstrim_dingin ?? '-');
     $pdf->Text(146, 133.8, $rpm?->lama_terpapar_suhu_ekstrim_dingin ?? '-');

     $pdf->Text(27, 138.8, "Suhu Ekstrim Panas");  
     $pdf->Text(126, 138.8, $rpm?->terpapar_suhu_ekstrim_panas ?? '-');
     $pdf->Text(146, 138.8, $rpm?->lama_terpapar_suhu_ekstrim_panas ?? '-');

     $pdf->Text(27, 143.8, "Terpapar Getaran");  
     $pdf->Text(126, 143.8, $rpm?->terpapar_getaran ?? '-');
     $pdf->Text(146, 143.8, $rpm?->lama_terpapar_getaran ?? '-'); 

     $pdf->Text(27, 148.8, "Terpapar Debu");  
     $pdf->Text(126, 148.8, $rpm?->terpapar_debu ?? '-');
     $pdf->Text(146, 148.8, $rpm?->lama_terpapar_debu ?? '-');

     $pdf->Text(27, 153.8, "Terpapar Zat Kimia");  
     $pdf->Text(126, 153.8, $rpm?->terpapar_zat_kimia ?? '-');
     $pdf->Text(146, 153.8, $rpm?->lama_terpapar_zat_kimia ?? '-');

     $pdf->Text(27, 158.8, "Terpapar Radiasi");  
     $pdf->Text(126, 158.8, $rpm?->terpapar_radiasi ?? '-');
     $pdf->Text(146, 158.8, $rpm?->lama_terpapar_radiasi ?? '-');

      //$pdf->Text(27, 193.8, "Monitor Komputer");  
      //$pdf->Text(126, 193.8, $rpm?->terpapar_komputer ?? '-');
      //$pdf->Text(146, 193.8, $rpm?->lama_terpapar_komputer ?? '-');

      //$pdf->Text(27, 198.8, "Gerakan Berulang-ulang");  
      //$pdf->Text(126, 198.8, $rpm?->terpapar_gerakan_berulang ?? '-');
      //$pdf->Text(146, 198.8, $rpm?->lama_terpapar_gerakan_berulang ?? '-');

      //$pdf->Text(27, 203.8, "Mendorong/Menarik");  
      //$pdf->Text(126, 203.8, $rpm?->terpapar_mendorong_menarik ?? '-');
      //$pdf->Text(146, 203.8, $rpm?->lama_terpapar_mendorong_menarik ?? '-');

      //$pdf->Text(27, 208.8, "Angkat Beban Tanpa Alat Seberat 25KG");  
      //$pdf->Text(126, 208.8, $rpm?->terpapar_angkat_beban_25 ?? '-');
      //$pdf->Text(146, 208.8, $rpm?->lama_terpapar_angkat_beban_25 ?? '-');

      //$pdf->Text(27, 213.8, "Lain Lain");  
      //$pdf->Text(126, 213.8, $rpm?->terpapar_lainnya ?? '-');
      //$pdf->Text(146, 213.8, $rpm?->lama_terpapar_lainnya ?? '-');

             self::footer($pdf);
             
             $pdf->AddPage();
             self::header($pdf);

         $pdf->SetFont('Times', '', 10);




     $pdf->SetFont('Times', 'B', 11.5);
     $pdf->Text(26, 33, "VI. TANDA VITAL DAN KONDISI UMUM"); 

     $pdf->SetFont('Times', '', 10.5);
     $pdf->Text(26, 39, "Tekanan Darah");  
     $pdf->Text(73, 39, ": ".$vku?->tekanan_darah." mmHg"); 
     $pdf->Text(113, 39, "Tinggi Badan");  
     $pdf->Text(155, 39, ": ".$vku?->tinggi_badan." cm"); 

     $pdf->Text(26, 44, "Nadi");  
     $pdf->Text(73, 44, ": ".$vku?->nadi." x/m"); 
     $pdf->Text(113, 44, "Berat Badan");  
     $pdf->Text(155, 44, ": ". $vku?->bb." Kg"); 

     $pdf->Text(26, 49, "Pernafasan");  
     $pdf->Text(73, 49, ": ".$vku?->prnf." x/m"); 
     $pdf->Text(113, 49, "Lingkar Perut");  
     $pdf->Text(155, 49, ": ".$vku?->lingkar_perut." cm"); 

     $pdf->Text(26, 54, "Suhu");  
     $pdf->Text(73, 54, ":  ".$vku?->suhu." C"); 
    //  $pdf->Text(113, 54, "Lingkar Panggul");  
    //  $pdf->Text(155, 54, ": ".$vku?->lingkar_panggul." cm"); 


     $pdf->Text(26, 59, "SpO2");  
     $pdf->Text(73, 59, ": ".$vku?->spo2." %"); 
    //  $pdf->Text(113, 59, "RLPP");  
    //  $pdf->Text(155, 59, ": ".$vku?->rlpp); 


     $pdf->Text(26, 64, "Kondisi Umum");  
     $pdf->Text(73, 64, ": ".$vku?->kondisi_umum); 
    //  $pdf->Text(113, 64, "BMI");  
    //  $pdf->Text(155, 64, ": ".$vku?->bmi." Kg/m2"); 
         $pdf->Text(113, 54, "BMI");  
     $pdf->Text(155, 54, ": ".$vku?->bmi." Kg/m2"); 

  
    
     $pdf->SetFont('Times', 'B', 11.5);
     $pdf->Text(26, 71, "VII. PEMERIKSAAN FISIK"); 

     $pdf->SetFont('Times', 'B', 10.5);
     $pdf->Text(26, 78, "KULIT");

     $pdf->SetFont('Times', '', 10.5);
     $pdf->Text(26, 83, "Kulit");  
     $pdf->Text(73, 83, ": ".$fkm?->kulit); 

    
     $pdf->SetFont('Times', 'B', 10.5);
     $pdf->Text(26, 93, "MATA");

 $pdf->SetFont('Times', '', 10.5);
     $pdf->Text(26, 97, "Buta Warna");  
     $pdf->Text(73, 97, ": ".$fkm?->buta_warna); 

     $pdf->Text(26, 102, "Sklera");  
     $pdf->Text(73, 102, ": ".$fkm?->seklera); 
     $pdf->Text(113, 97, "Conjungtiva");  
     $pdf->Text(155, 97, ": ".$fkm?->conjungtiva); 

     $pdf->Text(26, 107, "Bola Mata");  
     $pdf->Text(73, 107, ": ".$fkm?->bola_mata); 
     $pdf->Text(113, 102, "Pupil");  
     $pdf->Text(155, 102, ": ".$fkm?->pupil); 

  
     $pdf->Text(113, 107, "Refleks Pupil");  
     $pdf->Text(155, 107, ": ".$fkm?->refleks_pupil); 
    
     $pdf->Text(26, 112, "Kaca Mata");  
     $pdf->Text(73, 112, ": ".$fkm?->kaca_mata); 
     $pdf->Text(113, 112, "Jaeger Test");  
     $pdf->Text(155, 112, ": ".$fkm?->jaeger_test); 
    
     $pdf->Text(26, 117, "Visus Kanan");  
     $pdf->Text(73, 117, ": ".$fkm?->visus_kanan); 
     $pdf->Text(113, 117, "Visus Kiri");  
     $pdf->Text(155, 117, ": ".$fkm?->visus_kiri); 

    //  $pdf->Text(26, 117, "Kedalaman Bilik Mata");  
    //  $pdf->Text(73, 117, ": ".$fkm?->kedalaman_bilik_mata); 
    //  $pdf->Text(113, 117, "Pemulihan Silau");  
    //  $pdf->Text(155, 117, ": ".$fkm?->pemulihan_silau); 



     $pdf->SetFont('Times', 'B', 10.5);
     $pdf->Text(26, 126, "THT");

     $pdf->SetFont('Times', '', 10.5);
     $pdf->Text(26, 130, "Daun Telinga Kanan");  
     $pdf->Text(73, 130, ": ".$fkm?->daun_telinga_kanan);
     $pdf->Text(113, 130, "Daun Telinga Kiri");  
     $pdf->Text(155, 130, ": ".$fkm?->daun_telinga_kiri);  

     $pdf->Text(26, 135, "Liang Telinga Kanan");  
     $pdf->Text(73, 135, ": ".$fkm?->liang_telinga_kanan);
     $pdf->Text(113, 135, "Liang Telinga Kiri");  
     $pdf->Text(155, 135, ": ".$fkm?->liang_telinga_kiri);  

     $pdf->Text(26, 140, "Serumen Telinga Kanan");  
     $pdf->Text(73, 140, ": ". $fkm?->serumen_telinga_kanan);
     $pdf->Text(113, 140, "Serumen Telinga Kiri");  
     $pdf->Text(155, 140, ": ". $fkm?->serumen_telinga_kiri);  

     $pdf->Text(26, 145, "Membrana Timpani Kanan");  
     $pdf->Text(73, 145, ": ".$fkm?->membran_timpani_kanan);
     $pdf->Text(113, 145, "Membrana Timpani Kiri");  
     $pdf->Text(155, 145, ": ".$fkm?->membran_timpani_kiri);  

     $pdf->Text(26, 150, "Hidung");  
     $pdf->Text(73, 150, ": ".$fkm?->hidung);
     $pdf->Text(113, 150, "Lidah");  
     $pdf->Text(155, 150, ": ".$fkm?->lidah);  

     $pdf->Text(26, 155, "Faring");  
     $pdf->Text(73, 155, ": ".$fkm?->faring);
     $pdf->Text(113, 155, "Tonsil");  
     $pdf->Text(155, 155, ": ".$fkm?->tonsil);  

             self::footer($pdf);
// ggg
    }

}