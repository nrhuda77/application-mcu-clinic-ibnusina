<?php

namespace Modules\PemeriksaanGigi\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CrudPemeriksaanGigiController extends Controller
{
      public static function show(Request $request)
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

        $no_rawat= Crypt::encrypt($val->no_rawat);

        $cek_sts = DB::table('kesehatan_gigi_mcu')->where('no_rawat', $val->no_rawat)->first();
        if ($cek_sts != null) {
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
                            <a class="dropdown-item text-warning" href="/detail-pemeriksaan-gigi/'. $no_rawat.'"><i class="icon-base ti tabler-app-window me-1"></i>Halaman Inputan</a>
                           </div>
                </div>
                   
          </td>'
        ];
        $no++;
    }

    $output['recordsFiltered'] = $filteredCount;
    return response()->json($output);
        
    }


      public static function store(Request $request)
    {   
        
        try {

        $validatedData = $request->validate([
        'no_rkm_medis' => 'required',
        'no_reg' => 'required',
        'no_rawat' => 'required',
        'urutan' => 'required|array',
        'posisi' => 'required|array',
        'jenis' => 'required|array',
    ]);
    // Loop melalui data yang ada
    foreach ($validatedData['urutan'] as $index => $urutan) {
        DB::table('kesehatan_gigi_mcu')->insert([
            'no_rkm_medis' => $request->no_rkm_medis,
            'no_reg' => $request->no_reg,
            'no_rawat' => $request->no_rawat,
            'jenis' => $validatedData['jenis'][$index],
            'urutan' => $urutan,
            'posisi' => $validatedData['posisi'][$index],
        ]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Data berhasil disimpan.',
    ]);
    }catch(Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat input.',
            'error'   => $e->getMessage(),
        ], 500);
    }

    }

    public static function update(Request $request){
        try{
            DB::table('kesehatan_gigi_mcu')
            ->where('id',$request->id)
            ->update([
                'posisi' => $request->posisi,
                'urutan' => $request->urutan,
                'jenis' => $request->jenis
            ]);
            return response()->json(['status' => 'success', 'data' => $request->all()]);
        }catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat input.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

     public static function destroy($id) {
        $id_data = Crypt::decrypt($id);
        DB::table('kesehatan_gigi_mcu')->where('id', $id_data)->delete();
        return response()->json(['status' => 'success']);
    }

    public static function destroy_all($no_rawat) {
        $no_rawat_data = Crypt::decrypt($no_rawat);
        DB::table('kesehatan_gigi_mcu')->where('no_rawat', $no_rawat_data )->delete();
        return response()->json(['status' => 'success']);
    }

}