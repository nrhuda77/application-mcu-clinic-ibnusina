<?php

namespace Modules\PemeriksaanNonLab\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PemeriksaanNonLabController extends Controller
{
         public function index(){
        $dokter = DB::table('dokter')->get();
        $penjab = DB::table('penjab')->get();
        return view('pemeriksaannonlab::index',['dokter' => $dokter,'penjab' => $penjab]);

    }


      public function detail($no_rawat){
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();
        $data =  DB::table('pemeriksaan_non_lab_mcu')->where('no_rawat', $no_rwt)->first();
        $periksa = [
            'usg' => 'Usg',
            'radiologi' => 'Radiologi',
            'ekg' => 'Ekg',
            'treadmil' => 'Treadmil',
            'audiometri' => 'Audiometri',
            'spirometri' => 'Spirometri',
            'napfa' => 'Napfa',
        ];
        return view('pemeriksaannonlab::detail',[
            'data' => $data,
            'reg' => $reg,
            'pasien' => $pasien,
            'no_rawat' => $no_rawat,
            'periksa' => $periksa
        ]);

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
                            <a class="dropdown-item text-warning" href="/detail-pemeriksaan-nonlab/'.$no_rawat.'"><i class="icon-base ti tabler-app-window me-1"></i>Halaman Inputan</a>
                           </div>
                </div>
                   
          </td>'
        ];
        $no++;
    }

    $output['recordsFiltered'] = $filteredCount;
    return response()->json($output);
        
    }
  
    
    public function ajax_data($no_rawat)
    {
        $no_rwt = Crypt::decrypt($no_rawat);
        $pemeriksaan = DB::table('pemeriksaan_non_lab_mcu')->where('no_rawat', $no_rwt)->orderByDesc('id')->first();
        $reg = DB::table('reg_periksa')->where('no_rawat', $no_rwt)->first();
        $pasien = DB::table('pasien')->where('no_rkm_medis', $reg->no_rkm_medis)->first();

        return response()->json(['pemeriksaan' => $pemeriksaan, 'reg' => $reg, 'pasien' => $pasien]);
    }

    public function store(Request $request) {
     return CrudPemeriksaanNonLabController::store($request);
    }

    public function update(Request $request) {
        return CrudPemeriksaanNonLabController::update($request);
    }

    public function destroy($no_rawat) {
        return CrudPemeriksaanNonLabController::destroy($no_rawat);
    }
}