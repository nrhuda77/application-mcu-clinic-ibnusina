<?php

namespace Modules\BookingRegistrasi\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BookingRegistrasi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{

      public static function store(Request $request) {
        $validatedData = $request->validate([
            'nm_pasien' => 'required',
            'no_rkm_medis' => 'required',
            'kd_dokter' => 'required',
            'kd_pj' => 'required',
            'tanggal_periksa' => 'required',
            'no_reg'=>'required',
            'waktu_booking' => 'required',
            'status' => 'required',
            'waktu_kunjungan' => 'required'

        ], [
            'nm_pasien.required' => 'Nama Pasien wajib diisi.',
            'no_rkm_medis.required' => 'No Rekam Medis wajib diisi.',
            'kd_dokter.required' => 'Dokter wajib diisi.',
            'kd_pj.required' => 'Penjab wajib diisi.',
            'tanggal_periksa.required' => 'Tanggal Periksa wajib diisi.',
            'no_reg.required' => 'No Reg wajib diisi.',
            'waktu_booking.required' => 'Waktu Booking wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            'waktu_kunjungan.required' => 'Waktu Kunjungan wajib diisi.'
        ]);

        try {

            $dateTimeString = $request->waktu_booking;
            $carbonDateTime = Carbon::parse($dateTimeString);
    
            $date = $carbonDateTime->toDateString(); // '2024-09-11'
            $time = $carbonDateTime->toTimeString(); // '22:21:00'

            DB::table('booking_registrasi')->insert([
                'tanggal_booking' => $date,
                'jam_booking' => $time,
                'no_rkm_medis' => $request->no_rkm_medis,
                'tanggal_periksa' => $request->tanggal_periksa,
                'kd_dokter' => $request->kd_dokter,
                'kd_poli' => 'UMCU',
                'no_reg' => $request->no_reg,
                'kd_pj' => $request->kd_pj,
                'limit_reg' => 1,
                'waktu_kunjungan' => $request->waktu_kunjungan,
                'status' => $request->status,

            ]);
 
            return response()->json([ 'status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'data' => $e->getMessage()]);
        }
    }


      public static function update(Request $request) {
        $validatedData = $request->validate([
            'no_rkm_medis' => 'required',
            'kd_dokter' => 'required',
            'kd_pj' => 'required',
            'tanggal_periksa_edit' => 'required',
            'no_reg'=>'required',
            'waktu_booking_edit' => 'required',
            'status' => 'required',
            'waktu_kunjungan' => 'required'

        ], [
            'no_rkm_medis.required' => 'No Rekam Medis wajib diisi.',
            'kd_dokter.required' => 'Dokter wajib diisi.',
            'kd_pj.required' => 'Penjab wajib diisi.',
            'tanggal_periksa_edit.required' => 'Tanggal Periksa wajib diisi.',
            'no_reg.required' => 'No Reg wajib diisi.',
            'waktu_booking_edit.required' => 'Waktu Booking wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            'waktu_kunjungan.required' => 'Waktu Kunjungan wajib diisi.'
        ]);

        try {

            $dateTimeString = $request->waktu_booking_edit;
            $carbonDateTime = Carbon::parse($dateTimeString);
    
            $date = $carbonDateTime->toDateString(); // '2024-09-11'
            $time = $carbonDateTime->toTimeString(); // '22:21:00'
            
            DB::table('booking_registrasi')
               ->where('no_rkm_medis', $request->no_rkm_medis)
               ->where('no_reg', $request->no_reg)
               ->where('kd_poli', 'UMCU')
               ->where('tanggal_periksa', $request->tanggal_periksa)
               ->update([
                'tanggal_booking' => $date,
                'jam_booking' => $time,
                'no_rkm_medis' => $request->no_rkm_medis,
                'tanggal_periksa' => $request->tanggal_periksa_edit,
                'kd_dokter' => $request->kd_dokter,
                'kd_poli' => 'UMCU',
                'no_reg' => $request->no_reg,
                'kd_pj' => $request->kd_pj,
                'limit_reg' => 1,
                'waktu_kunjungan' => $request->waktu_kunjungan,
                'status' => $request->status,

            ]);
            return response()->json([ 'status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'data' => $e->getMessage()]);
        }
    }



    public static function show(Request $request)
    {

    $draw   = intval(request('draw'));
    $start  = intval(request('start'));
    $length = intval(request('length'));
    $search = request('search.value');

    $output = [
        'draw' => $draw,
        'recordsTotal' => DB::table('booking_registrasi')->count(),
        'recordsFiltered' => 0,
        'data' => [],
    ];

    // Base Query
    $baseQuery = DB::table('booking_registrasi')
                ->join('pasien as p', 'p.no_rkm_medis', '=', 'booking_registrasi.no_rkm_medis')
                ->join('dokter as d', 'd.kd_dokter', '=', 'booking_registrasi.kd_dokter')
                ->join('penjab as pj', 'pj.kd_pj', '=', 'booking_registrasi.kd_pj')
                ->join('poliklinik as pk', 'pk.kd_poli', '=', 'booking_registrasi.kd_poli')
                ->where('pk.kd_poli', 'UMCU')
                ->whereBetween('booking_registrasi.tanggal_booking', [$request->t_awal, $request->t_akhir]);
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
        ->orderByDesc('booking_registrasi.waktu_kunjungan')
        ->orderByDesc('booking_registrasi.tanggal_periksa')
        ->skip($start)
        ->take($length)
        ->get();

    // Build data array
    $no = $start + 1;
    foreach ($data as $val) {

        $rkm_mds = Crypt::encrypt($val->no_rkm_medis);
        $tgl_periksa = Crypt::encrypt($val->tanggal_periksa);
        $lmt_reg = $val->limit_reg == 1 ? 'TERDAFTAR' : 'BELUM TERDAFTAR';

        $output['data'][] = [
          "<td>$no</td>",
          "<td>$val->nm_pasien <br> <span class='btn btn-primary btn-sm'>$val->no_rkm_medis</span></td>",
          "<td>$val->no_ktp</td>",
          "<td>$val->tanggal_booking</td>",
          "<td>$val->jam_booking</td>",
          "<td>$val->nm_dokter <br> <span class='btn btn-warning btn-sm'>$val->no_reg</span></td>",
          "<td>$lmt_reg</td>",      
           '<td>
               <div class="dropdown pe-4">
                  <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="dropdown"> Action
                      <i class="ms-1 icon-base ti tabler-brand-juejin icon-15px"></i></button>
                          <div class="dropdown-menu">
                             <a class="dropdown-item text-warning" onclick="edit(\''.$rkm_mds.'\', \''.$tgl_periksa.'\')"><i class="icon-base ti tabler-edit me-1"></i> Edit</a>
                             <a class="dropdown-item text-primary" onclick="detail(\''.$rkm_mds.'\', \''.$tgl_periksa.'\')"><i class="icon-base ti tabler-list-details me-1"></i> Detail</a>
                             <a class="dropdown-item text-danger" onclick="hapus(\''.$rkm_mds.'\', \''.$tgl_periksa.'\')"><i class="icon-base ti tabler-trash me-1"></i> Delete</a>
                           </div>
                </div>
                   
          </td>'
        ];
        $no++;
    }

    $output['recordsFiltered'] = $filteredCount;
    return response()->json($output);
        
    }


    public static function destroy($no_rkm_medis, $tanggal_periksa) {
        $num_rkm_medis = Crypt::decrypt($no_rkm_medis);
        $num_tanggal_periksa = Crypt::decrypt($tanggal_periksa);
        DB::table('booking_registrasi')->where('no_rkm_medis', $num_rkm_medis)->where('tanggal_periksa', $num_tanggal_periksa)->delete();
        return response()->json(['status' => 'success', 'message' => 'Data Berhasil Dihapus']);
    }

}