<?php

namespace Modules\BookingPeriksa\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class BookingPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bookingperiksa::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookingperiksa::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
  public function show(Request $request)
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
                ->join('penjab as pj', 'd.kd_pj', '=', 'booking_registrasi.kd_pj');
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
        ->orderByDesc('no_rkm_medis')
        ->skip($start)
        ->take($length)
        ->get();

    // Build data array
    $no = $start + 1;
    foreach ($data as $val) {

        $rkm_mds = Crypt::encrypt($val->no_rkm_medis);

        $output['data'][] = [
          "<td>$no</td>",
          "<td>$val->nm_pasien</td>",
          "<td>$val->no_ktp</td>",
          "<td>$val->no_ktp</td>",
          "<td>$val->no_ktp</td>",
            '<td>
           
                    <a class="btn btn-warning btn-sm text-white mt-1" onclick="edit(\''.$rkm_mds.'\')"> <i class=" text-white icon-base ti tabler-edit" style="width: 15px; height: 15px; !important"></i> Edit </a>
                    <a class="btn btn-danger btn-sm text-white mt-1" onclick="hapus(\''.$rkm_mds.'\')"> <i class=" text-white icon-base ti tabler-trash" style="width: 15px; height: 15px; !important"></i> Hapus </a>
    
          </td>'
        ];
        $no++;
    }

    $output['recordsFiltered'] = $filteredCount;
    return response()->json($output);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('bookingperiksa::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}