<?php

namespace Modules\RegistrasiPeriksa\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class CrudController extends Controller
{


    public static function store(Request $request) {
        $validatedData = $request->validate([
            'nm_pasien' => 'required',
            'no_reg' => 'required',
            'no_rawat' => 'required',
            'kd_dokter' => 'required',
            'no_rkm_medis' => 'required',
            'kd_pj' => 'required',
            'biaya_reg' => 'required',
            'stts' => 'required',
            'stts_daftar' => 'required',
            'umurdaftar' => 'required',
            'sttsumur' => 'required',
            'status_bayar' => 'required',
            'status_poli' => 'required',

        ], [
            'nm_pasien.required' => 'Nama Pasien wajib diisi.',
            'no_reg.required' => 'No Registrasi wajib diisi.',
            'no_rawat.required' => 'No Rawat Medis wajib diisi.',
            'no_rkm_medis.required' => 'No Rekam Medis wajib diisi.',
            'kd_dokter.required' => 'Dokter wajib diisi.',
            'kd_pj.required' => 'Penjab wajib diisi.',
            'biaya_reg.required' => 'Biaya Registrasi wajib diisi.',
            'stts.required' => 'Status wajib diisi.',
            'stts_daftar.required' => 'Status Daftar wajib diisi.',
            'umurdaftar.required' => 'Umur wajib diisi.',
            'sttsumur.required' => 'Status Umur wajib diisi.',
            'status_bayar.required' => 'Status Bayar wajib diisi.',
            'status_poli.required' => 'Status Poli wajib diisi.'
        ]);

     try {
    $biaya = preg_replace("/[^0-9]/", "", $request->biaya_reg);
    $now = Carbon::now();

    $formattedDate = $now->toDateString();
    $formattedTime = $now->toTimeString();
    $umr =  $request->umurdaftar;

   

    // Insert ke reg_periksa
    DB::table('reg_periksa')->insert([
        'no_reg'         => $request->no_reg,
        'no_rawat'       => $request->no_rawat,
        'tgl_registrasi' => $formattedDate,
        'jam_reg'        => $formattedTime,
        'kd_dokter'      => $request->kd_dokter,
        'no_rkm_medis'   => $request->no_rkm_medis,
        'kd_poli'        => 'UMCU',
        'p_jawab'        => $request->p_jawab,
        'almt_pj'        => $request->almt_pj,
        'hubunganpj'     => $request->hubunganpj,
        'biaya_reg'      => $biaya,
        'stts'           => $request->stts,
        'stts_daftar'    => $request->stts_daftar,
        'status_lanjut'  => 'Ralan',
        'kd_pj'          => $request->kd_pj,
        'umurdaftar'     => self::ambilUmur($umr),
        'sttsumur'       => $request->sttsumur,
        'status_bayar'   => $request->status_bayar,
        'status_poli'    => $request->status_poli,
    ]);

    // Update status booking
    DB::table('booking_registrasi')
        ->where('no_rkm_medis', $request->no_rkm_medis)
        ->update(['status' => 'Terdaftar']);

    // Cek dan insert nomor surat jika belum ada
    $nomorPendaftaran = DB::table('nomor_surat_mcu')
        ->where('no_rawat', $request->no_rawat)
        ->first();

    if (empty($nomorPendaftaran?->no_surat)) {
        $noUrut = DB::table('nomor_surat_mcu')->max('urutan') ?? 0;
        $noUrut++;

        $noSurat = self::generateNomorPendaftaran($noUrut, $formattedDate);

        DB::table('nomor_surat_mcu')->insert([
            'no_surat' => $noSurat,
            'no_rawat' => $request->no_rawat,
            'urutan'   => $noUrut,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Pendaftaran berhasil.',
        'data'    => $request,
    ]);

} catch (Exception $e) {
    return response()->json([
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat mendaftar.',
        'error'   => $e->getMessage(),
    ], 500);
}
    }


     public static function generateNomorPendaftaran($noPendaftaranMcu, $tanggal)
    {
        $date = Carbon::parse($tanggal);
        $bulanRomawi = self::toRoman($date->format('m'));
        $tahun = $date->format('Y');
        $nomor = str_pad($noPendaftaranMcu, 5, '0', STR_PAD_LEFT);
        return "{$nomor}/MCU/P/I.S/{$bulanRomawi}/{$tahun}";
    }


    private static function toRoman($number)
    {
        $map = [
            '1' => 'I', '2' => 'II', '3' => 'III', '4' => 'IV', '5' => 'V',
            '6' => 'VI', '7' => 'VII', '8' => 'VIII', '9' => 'IX', '10' => 'X',
            '11' => 'XI', '12' => 'XII'
        ];
        return $map[intval($number)] ?? '';
    }

     private static function ambilUmur($umurString)
{
    if (preg_match('/(\d+)\s*Th/', $umurString, $matchTahun)) {
        return (int) $matchTahun[1];
    }

    if (preg_match('/(\d+)\s*Bl/', $umurString, $matchBulan)) {
        return (int) $matchBulan[1];
    }

    if (preg_match('/(\d+)\s*Hr/', $umurString, $matchHari)) {
        return (int) $matchHari[1];
    }

    return 0;
}
    


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

        $no_rawat = Crypt::encrypt($val->no_rawat);
        $menuKategori = DB::table('menu_kategori_mcu')->where('no_rawat', $val->no_rawat)->first();

        $kategori = $menuKategori->kategori ?? 'Belum Dipilih';
        $linkKategori = $menuKategori && $menuKategori->kategori === 'Follow Up'
            ? '<a class="dropdown-item text-info" href="/pdf-followup/' . $no_rawat . '" title="Detail">  <i class="icon-base ti tabler-clipboard-text me-1"> </i> Follow Up</a>'
            : '';

        $output['data'][] = [
          "<td>$no</td>",
          "<td>$val->no_rawat <br> <span class='btn btn-warning btn-sm'>$val->no_rkm_medis</span></td>",
          "<td>$val->nm_pasien </td>",
          "<td>$val->nm_dokter <br> <span class='btn btn-primary btn-sm'>$val->no_reg</span></td>",
          "<td>$val->stts</td>",
          "<td>$val->tgl_registrasi </td>",
          "<td>$val->png_jawab</td>", 
          "<td>{$val->status_bayar}</td>",
          "<td>{$kategori}</td>",     
           '<td>
               <div class="dropdown pe-4">
                  <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="dropdown"> Action
                      <i class="ms-1 icon-base ti tabler-brand-juejin icon-15px"></i></button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item text-primary" onclick="detail(\''. $no_rawat.'\')"><i class="icon-base ti tabler-list-details me-1"></i> Detail</a>
                            <a class="dropdown-item text-warning" onclick="kuisoner(\''. $no_rawat.'\')"><i class="icon-base ti tabler-checklist me-1"></i> Kuisoner</a>
                            <a class="dropdown-item text-success" ' . ($menuKategori ? 'onclick="update_kategori(\''. $no_rawat.'\')"' : 'onclick="kategori(\''. $no_rawat.'\')"') .' ><i class="icon-base ti tabler-address-book me-1"></i> ' 
                            . ($menuKategori ? 'Edit Kategori' : 'Kategori') .'</a>
                            '.$linkKategori.'
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