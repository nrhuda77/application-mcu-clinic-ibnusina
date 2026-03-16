<?php

namespace Modules\LaporanHasilPdfMcu\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use FPDF as GlobalFPDF;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class LaporanHasilPdfMcuController extends Controller
{
    public function index(){
        $dokter = DB::table('dokter')->get();
        $penjab = DB::table('penjab')->get();
        return view('laporanhasilpdfmcu::index',['dokter' => $dokter,'penjab' => $penjab]);

    }

    public function p_jawab($no_rawat){
        $nrwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $nrwt)->first();
        $dokter = DB::table('dokter')->where('kd_dokter', $reg->kd_dokter)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        return view('laporanhasilpdfmcu::components.qr.p_jawab',['dokter' => $dokter,'reg' => $reg,'pasien' => $pasien]);

    }

      public function dr_periksa($kode,$no_rawat){
        $nrwt = Crypt::decrypt($no_rawat);
        $dr_periksa = DB::table('dokter_periksa_mcu')->where('kode', $kode)->where('no_rawat', $nrwt)->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $nrwt)->first();
        $dokter = DB::table('dokter')->where('kd_dokter', $dr_periksa->kd_dokter)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $master = DB::table('master_berkas_digital')->where('kode', $dr_periksa->kode)->first();
        return view('laporanhasilpdfmcu::components.qr.dr_periksa',[
            'dokter' => $dokter,
            'reg' => $reg,
            'pasien' => $pasien,
            'master' => $master
        ]);

    }


  public function generatePDFUmum($no_rawat)
    {
        
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first(); 
        $booking = DB::table('booking_registrasi')->where('no_rkm_medis', $reg->no_rkm_medis)->orderByDesc('tanggal_periksa')->first();
        $hip = DB::table('hasil_inputan_dokter_mcu')->where('no_rawat', $no_rwt)->first();
        $kop = public_path('assets/img/kop.png');
        $watermark = public_path('assets/img/watermark.png');
        $footer = public_path('assets/img/footer.png');


        $pdf = Pdf::loadView('laporanhasilpdfmcu::components.html.umum', [
            'kop' => $kop,
            'watermark' => $watermark,
            'footer' => $footer,
            'reg' => $reg, 
            'pasien' => $pasien,
            'booking' => $booking,
            'hip' => $hip
        ])->set_option('isHtml5ParserEnabled', true)
          ->set_option('isRemoteEnabled', true)
          ->set_option('isPhpEnabled', true)


// Set margin jadi 0
->set_option('margin_top', 0)
->set_option('margin_left', 0)
->set_option('margin_right', 0)
->set_option('margin_bottom', 0);

        // return $pdf->download('laporan.pdf'); // untuk download
        return $pdf->stream(); // untuk tampil di browser
    }



  public function generatePDFRDMP($no_rawat)
    {
        
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first(); 
        $booking = DB::table('booking_registrasi')->where('no_rkm_medis', $reg->no_rkm_medis)->orderByDesc('tanggal_periksa')->first();
        $hip = DB::table('hasil_inputan_dokter_mcu2')->where('no_rawat', $no_rwt)->first();
        $kop = public_path('assets/img/kop.png');
        $watermark = public_path('assets/img/watermark.png');


        $pdf = Pdf::loadView('laporanhasilpdfmcu::components.html.umum', [
            'kop' => $kop,
            'watermark' => $watermark,
            'reg' => $reg, 
            'pasien' => $pasien,
            'booking' => $booking,
            'hip' => $hip
        ]);

        // return $pdf->download('laporan.pdf'); // untuk download
        return $pdf->stream(); // untuk tampil di browser
    }







      public function show(Request $request)
    {



    $draw   = intval(request('draw'));
    $start  = intval(request('start'));
    $length = intval(request('length'));
    $search = request('search.value');

    $output = [
        'draw' => $draw,
        'recordsTotal' => DB::table('reg_periksa')->count(),
        'recordsFiltered' => 0,
        'data' => [],
    ];

    // Base Query
    $baseQuery = DB::table('reg_periksa')
                ->join('pasien as p', 'p.no_rkm_medis', '=', 'reg_periksa.no_rkm_medis')
                ->join('dokter as d', 'd.kd_dokter', '=', 'reg_periksa.kd_dokter')
                ->join('penjab as pj', 'pj.kd_pj', '=', 'reg_periksa.kd_pj')
                ->join('poliklinik as pk', 'pk.kd_poli', '=', 'reg_periksa.kd_poli')
                ->where('pk.kd_poli', 'UMCU')
                ->whereBetween('reg_periksa.tgl_registrasi', [$request->t_awal, $request->t_akhir])
                ->select('reg_periksa.*', 'p.nm_pasien', 'p.no_ktp', 'p.tgl_lahir', 'p.alamat', 'd.kd_dokter', 'd.nm_dokter', 'pk.kd_poli', 'pk.nm_poli', 'pj.png_jawab', 'pj.kd_pj');
    // Search filter
    if (!empty($search)) {
        $baseQuery->where(function($filter) use ($search) {
            $filter->orWhere('p.no_rkm_medis', 'like', '%' . $search . '%');
            $filter->orWhere('p.nm_pasien', 'like', '%' . $search . '%');
            $filter->orWhere('d.nm_dokter', 'like', '%' . $search . '%');
            $filter->orWhere('pj.png_jawab', 'like', '%' . $search . '%');
        });
    }

    // Clone query for counting filtered records
    $filteredCount = (clone $baseQuery)->count();

    // Data fetching
    $data = $baseQuery
        ->orderByDesc('reg_periksa.tgl_registrasi')
        ->orderByDesc('reg_periksa.jam_reg')
        ->skip($start)
        ->take($length)
        ->get();

    // Build data array
    $no = $start + 1;
    foreach ($data as $val) {

        $no_rawat = Crypt::encrypt($val->no_rawat);



    $jns = DB::table('pemeriksaan_non_lab_mcu')->where('no_rawat', $val->no_rawat)->first();

    if ($jns != null) {
        $sts = '<span class="btn btn-info btn-xs">Sudah Diinput</span>';
    } else {
        $sts = '<span class="btn btn-danger btn-xs">Belum Diinput</span>';
    }


        
        $output['data'][] = [
          "<td>$no</td>",
          "<td>$val->no_rawat <br> <span class='btn btn-warning btn-sm'>$val->no_rkm_medis</span></td>",
          "<td>$val->nm_pasien </td>",
          "<td>$val->nm_dokter <br> <span class='btn btn-primary btn-sm'>$val->no_reg</span></td>",
          "<td>$val->stts</td>",
          "<td>$val->tgl_registrasi </td>",
          "<td>$val->png_jawab</td>", 
          "<td>{$val->status_bayar}</td>", 
          "<td>{$sts}</td>",    
           '<td>
               <div class="dropdown pe-4">
                  <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="dropdown"> Action
                      <i class="ms-1 icon-base ti tabler-brand-juejin icon-15px"></i></button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item text-primary" onclick="detail(\''. $no_rawat.'\')"><i class="icon-base ti tabler-list-details me-1"></i> Detail</a>
                            <a class="dropdown-item text-warning" href="/detail-laporan-pdf-mcu/umum/'.$no_rawat.'"><i class="icon-base ti tabler-app-window me-1"></i>Cetak Pdf Umum</a>
                             <a class="dropdown-item text-warning" href="/detail-laporan-pdf-mcu/RDMP/'.$no_rawat.'"><i class="icon-base ti tabler-app-window me-1"></i>Cetak Pdf RDMP</a>
                              <a class="dropdown-item text-warning" href="/detail-laporan-pdf-mcu/RU-V/'.$no_rawat.'"><i class="icon-base ti tabler-app-window me-1"></i>Cetak Pdf RU V</a>
                            </div>
                </div>
                   
          </td>'
        ];
        $no++;
    }

    $output['recordsFiltered'] = $filteredCount;
    return response()->json($output);
        
    }
  
}