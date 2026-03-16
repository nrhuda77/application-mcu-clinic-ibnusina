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

class RegistrasiPeriksaController extends Controller
{
    
    public function index()
    {
        $dokter = DB::table('dokter')->get();
        $penjab = DB::table('penjab')->get();
        return view('registrasiperiksa::index',[
            'dokter' => $dokter,
            'penjab' => $penjab
        ]);
    }


    
    
       public function store(Request $request) {
      return CrudController::store($request);
    }

     public function kuisoner_store(Request $request) {
      return CrudKuisonerController::kuisoner($request);
    }

     public function kategori_store(Request $request) {
      return CrudKuisonerController::store_kategori($request);
    }

     public function kategori_update(Request $request) {
      return CrudKuisonerController::update_kategori($request);
    }

    public function ajax_kategori(Request $request, $no_rawat) {
        
        $no_rwt = Crypt::decrypt($no_rawat);
        $reg = DB::table('reg_periksa')
                ->where('no_rawat', $no_rwt)
                ->first();

        $kategori = DB::table('menu_kategori_mcu')
                ->where('no_rawat', $no_rwt)
                ->first();
        $pasien = DB::table('pasien')
                ->where('no_rkm_medis', $reg->no_rkm_medis)
                ->first();
        
                
        return response()->json(['reg' => $reg, 'pasien' => $pasien, 'kategori' => $kategori]);

    }


     public function ajax_data(Request $request,$no_rawat) {


        $no_rwt = Crypt::decrypt($no_rawat); 

        $reg = DB::table('reg_periksa')
                ->where('no_rawat', $no_rwt)
                ->first();

        $pasien = DB::table('pasien')
                ->where('no_rkm_medis', $reg->no_rkm_medis)
                ->first();
                
        return response()->json(['reg' => $reg, 'pasien' => $pasien]);
    }


    public function ajax_data_kuisoner(Request $request,$no_rawat) {


        $no_rwt = Crypt::decrypt($no_rawat); 

        $reg = DB::table('reg_periksa')
                ->where('no_rawat', $no_rwt)
                ->first();

        $pasien = DB::table('pasien')
                ->where('no_rkm_medis', $reg->no_rkm_medis)
                ->first();
                
        return response()->json(['reg' => $reg, 'pasien' => $pasien]);
    }



    public function ajax_select(Request $request)
{
    $query = DB::table('pasien')
        ->select('nm_pasien', 'no_rkm_medis')
        ->where(function ($q) use ($request) {
            $q->where('no_rkm_medis', 'LIKE', '%'.$request->q.'%')
              ->orWhere('nm_pasien', 'LIKE', '%'.$request->q.'%');
        });

    if (Auth::user()?->role === 'Admin Perusahaan') {
        $query->where('kd_pj', Auth::user()->role2);
    }

    $pasien = $query->groupBy('no_rkm_medis')->limit(100)->get();

    $data = $pasien->map(fn($item) => [
        'id' => $item->no_rkm_medis,
        'nm_pasien' => $item->nm_pasien,
        'text' => $item->nm_pasien . ' # ' . $item->no_rkm_medis
    ]);

    return response()->json($data);
}

public function get_select($no_rkm_medis){

    $pasien = DB::table('pasien')->where('no_rkm_medis', $no_rkm_medis)->first();
    $booking = DB::table('booking_registrasi')->where('no_rkm_medis', $no_rkm_medis)
               ->where('kd_poli', 'UMCU')
               ->orderBy('tanggal_booking', 'desc')
               ->orderBy('tanggal_periksa', 'desc')
               ->first();
              
        $sekarang = Carbon::now();
        $tanggalLahir = Carbon::parse($pasien->tgl_lahir);
        $umurTahun = $tanggalLahir->age;

            if ($umurTahun >= 1) {
                $usia = $umurTahun;
                $stt_umur = "Th";
            } else {
                $bulan = $tanggalLahir->diffInMonths($sekarang);
                $hariSisa = $tanggalLahir->copy()->addMonths($bulan)->diffInDays($sekarang);
                $bulanDesimal = $bulan + ($hariSisa / $sekarang->daysInMonth);

            if ($bulanDesimal >= 1) {
                $usia = number_format($bulanDesimal, 1);
                $stt_umur = "Bl";
             } else {
                $usia = $tanggalLahir->diffInDays($sekarang);
                $stt_umur = "Hr";
            }
        }

    return response()->json([
         'pasien' => $pasien,
         'booking' => $booking,
         'usia' => $usia,
         'stt_umur' => $stt_umur
    ]);
}


    public function ajax_noreg($kd_dokter)
{
    date_default_timezone_set('Asia/Makassar');
    $current_date = Carbon::now()->format('Y-m-d');

    $last_booking = DB::table('reg_periksa')->where('kd_dokter', $kd_dokter)
                    ->whereDate('tgl_registrasi', $current_date)
                    ->max('no_reg');

    $nobooking =DB::table('booking_registrasi')->where('kd_poli', 'UMCU')
                    ->where('kd_dokter', $kd_dokter)
                    ->whereDate('tanggal_booking', $current_date)
                    ->max('no_reg');

    $max_no = max($last_booking ?? 0, $nobooking ?? 0);
    $no_rg = str_pad((int)$max_no + 1, 3, '0', STR_PAD_LEFT);
    

    return response()->json($no_rg);
}

public function ajax_norawat()
{
    $now = Carbon::now('Asia/Makassar');
    $tanggal = $now->format('Y/m/d'); // Format: YYYY/MM/DD

    // Ambil nomor rawat tertinggi di tanggal hari ini
    $maxNomor = DB::table(DB::raw("
        (
            SELECT
                no_rawat,
                SUBSTRING(no_rawat, 1, 10) AS tanggal,
                CONCAT(
                    SUBSTRING(no_rawat, 12, 2), -- HH
                    SUBSTRING(no_rawat, 14, 2), -- MM
                    SUBSTRING(no_rawat, 16, 2)  -- SS
                ) AS nomor
            FROM reg_periksa
            WHERE SUBSTRING(no_rawat, 1, 10) = '{$tanggal}'
        ) AS subquery
    "))->max('nomor');

    // Tambahkan +1 dari nomor terakhir
    $nextNomor = $maxNomor + 1;

    // Pad dengan nol agar jadi 6 digit (contoh: 000001)
    $nomorFormatted = str_pad($nextNomor, 6, '0', STR_PAD_LEFT);

    // Gabungkan dengan tanggal
    $noRawatBaru = $tanggal . '/' . $nomorFormatted;

    return response()->json($noRawatBaru);
}



 
    public function show(Request $request)
    {
       return CrudController::show($request);   
    }


    public function update(Request $request, $id) {}

   
    public function destroy($id) {}
}