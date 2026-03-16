<?php

namespace Modules\PengajuanPasien\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;
class PengajuanPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengajuanpasien::index',[
            'penjab' => DB::table('penjab')->get(),
            'cacatfisik' => DB::table('cacat_fisik')->get(),
            'suku' => DB::table('suku_bangsa')->get(),
            'bahasa' => DB::table('bahasa_pasien')->get(),
            'propinsi' => DB::table('propinsi')->get(),
            'perusahaan' => DB::table('perusahaan_pasien')->get(),
            'kab' => DB::table('kabupaten')->get(),
            'kec' => DB::table('kecamatan')->get(),
            'kel' => DB::table('kelurahan')->get()
          ]);
    }

    public function store(Request $request)
    {
      $validator =FacadesValidator::make($request->all(), [
        'nm_pasien' => 'required',
        'no_ktp' => 'required',
    ]);

    
  if ($validator->passes()) {

        DB::table('approval_pasien')->insert([
          'nm_pasien' => $request->nm_pasien,
          'no_ktp' => $request->no_ktp, 
          'tmp_lahir' => $request->tmp_lahir,
          'jk' => $request->jk,
          'tgl_lahir' => $request->tgl_lahir,
          'nm_ibu' => $request->nm_ibu,
          'alamat' => $request->alamat,
          'gol_darah' => $request->gol_darah,
          'pekerjaan' => $request->pekerjaan,
          'stts_nikah' => $request->stts_nikah,
          'agama' => $request->agama,
          'tgl_daftar' => $request->tgl_daftar,
          'no_tlp' => $request->no_tlp,
          'umur' => $request->umur,
          'pnd' => $request->pnd,
          'keluarga' => $request->keluarga,
          'namakeluarga' => $request->namakeluarga,
          'kd_pj' => $request->kd_pj,
          'no_peserta' => $request->no_peserta,
          'kd_kec' => $request->kd_kec,
          'kd_kab' => $request->kd_kab,
          'kd_kel' => $request->kd_kel,
          'pekerjaanpj' => $request->pekerjaanpj,
          'alamatpj' => $request->alamatpj,
          'kelurahanpj' => $request->kelurahanpj,
          'kabupatenpj' => $request->kabupatenpj,
          'kecamatanpj' => $request->kecamatanpj,
          'perusahaan_pasien' => $request->perusahaan_pasien,
          'suku_bangsa' => $request->suku_bangsa,
          'bahasa_pasien' => $request->bahasa_pasien,
          'cacat_fisik' => $request->cacat_fisik,
          'email' => $request->email,
          'nip' => $request->nip,
          'kd_prop' => $request->kd_prop,
          'propinsipj' => $request->propinsipj,

      ]);
        return response()->json($request);
  
    } else{
        return response()->json(['error'=>$validator->errors()]);
    } 
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
      $validator =FacadesValidator::make($request->all(), [
        'nm_pasien' => 'required',
        'no_ktp' => 'required',
    ]);


    if ($validator->passes()) {

        $data = [
          'nm_pasien' => $request->nm_pasien,
          'no_ktp' => $request->no_ktp, 
          'tmp_lahir' => $request->tmp_lahir,
          'jk' => $request->jk,
          'tgl_lahir' => $request->tgl_lahir,
          'nm_ibu' => $request->nm_ibu,
          'alamat' => $request->alamat,
          'gol_darah' => $request->gol_darah,
          'pekerjaan' => $request->pekerjaan,
          'stts_nikah' => $request->stts_nikah,
          'agama' => $request->agama,
          'tgl_daftar' => $request->tgl_daftar,
          'no_tlp' => $request->no_tlp,
          'umur' => $request->umur,
          'pnd' => $request->pnd,
          'keluarga' => $request->keluarga,
          'namakeluarga' => $request->namakeluarga,
          'kd_pj' => $request->kd_pj,
          'no_peserta' => $request->no_peserta,
          'kd_kec' => $request->kd_kec,
          'kd_kab' => $request->kd_kab,
          'kd_kel' => $request->kd_kel,
          'pekerjaanpj' => $request->pekerjaanpj,
          'alamatpj' => $request->alamatpj,
          'kelurahanpj' => $request->kelurahanpj,
          'kabupatenpj' => $request->kabupatenpj,
          'kecamatanpj' => $request->kecamatanpj,
          'perusahaan_pasien' => $request->perusahaan_pasien,
          'suku_bangsa' => $request->suku_bangsa,
          'bahasa_pasien' => $request->bahasa_pasien,
          'cacat_fisik' => $request->cacat_fisik,
          'email' => $request->email,
          'nip' => $request->nip,
          'kd_prop' => $request->kd_prop,
          'propinsipj' => $request->propinsipj,
        
        ];
      
        $token = request()->except(['_token']);

          DB::table('approval_pasien')->where('id',$request->id)->update($data);
        return response()->json($request);
  
    } else{
        return response()->json(['error'=>$validator->errors()]);
    } 
    }



      public function ajax_detail($id){
        $r_id = Crypt::decrypt($id);
        $approv = DB::table('approval_pasien')->where('id', $r_id)->first();
        $kel = DB::table('kelurahan')->where('kd_kel', $approv->kd_kel)->first();
        $kec = DB::table('kecamatan')->where('kd_kec', $approv->kd_kec)->first();
        $kab = DB::table('kabupaten')->where('kd_kab', $approv->kd_kab)->first();
           return json_encode([$approv, $kel, $kec, $kab]);
   
       }

        public static function show(Request $request)
    {



    $draw   = intval(request('draw'));
    $start  = intval(request('start'));
    $length = intval(request('length'));
    $search = request('search.value');

    $output = [
        'draw' => $draw,
        'recordsTotal' => DB::table('approval_pasien')->count(),
        'recordsFiltered' => 0,
        'data' => [],
    ];

    // Base Query
    $baseQuery = DB::table('approval_pasien')

                ->whereBetween('tgl_daftar', [$request->t_awal, $request->t_akhir]);
    // Search filter
    if (!empty($search)) {
        $baseQuery->where(function($filter) use ($search) {
           $filter->orWhere('nm_pasien', 'like', '%' . $search . '%');
  
            $filter->orWhere('no_ktp', 'like', '%' . $search . '%');
            $filter->orWhere('alamat', 'like', '%' . $search . '%');
            $filter->orWhere('agama', 'like', '%' . $search . '%');
  
            $filter->orWhere('stts_nikah', 'like', '%' . $search . '%');
            $filter->orWhere('umur', 'like', '%' . $search . '%');
            $filter->orWhere('tgl_daftar', 'like', '%' . $search . '%');
            $filter->orWhere('tgl_lahir', 'like', '%' . $search . '%');
        });
    }

    // Clone query for counting filtered records
    $filteredCount = (clone $baseQuery)->count();

    // Data fetching
    $data = $baseQuery
        ->orderBy('id', 'desc')
        ->skip($start)
        ->take($length)
        ->get();

    // Build data array
    $no = $start + 1;
    foreach ($data as $val) {

        $id = Crypt::encrypt($val->id);


                 $link_detail = '<a class="dropdown-item"  href="javascript:void(0)" title="Detail" onclick="detail(\''. $id.'\')">   <i class="fas fa-id-badge text-success"> </i> Detail</a>';      
               
             
                  $psn = DB::table('pasien')->where('no_ktp', $val->no_ktp)->first();
                  $ktp = $psn->no_ktp ?? null;

                  if($val->status == 0 && $ktp == null){
                    $stus = "<span class='btn btn-warning btn-xs'>Menunggu</span>";
                    $link_hps = '  <a class="dropdown-item"  href="javascript:void(0)" title="Edit" onclick="hapus(\''. $id.'\')">   <i class="fas fa-trash text-danger"> </i> Hapus</a>';  
                    $link_edit = '  <a class="dropdown-item"  href="javascript:void(0)" title="Edit" onclick="edit(\''. $id.'\')">   <i class="fas fa-edit text-warning"> </i> Edit</a>';  
                  }elseif($val->status == 0 && $ktp == !null){
                    $stus = "<p class='btn btn-success btn-sm'>Approved</p>";
                    $link_hps = '';  
                    $link_edit = ' ';  
                  }else{
                    $stus = "<p class='btn btn-danger btn-sm'>Ditolak</p>";
                    
                  }
             
                  $output['data'][] =
                    
              array(

                "<td>$val->nm_pasien <br> <p class='btn btn-secondary btn-xs'>$val->no_ktp</p></td>",
                "<td>$val->alamat</td>",
                "<td>$val->tgl_lahir</td>",
                "<td>$val->tgl_daftar</td>",
                "<td>$val->stts_nikah</td>", 
                "<td> $stus</td>",
                '<td>
                     <div class="btn-group dropdown">
                       <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-bs-toggle="dropdown"> Aksi </button>
                         <ul class="dropdown-menu" role="menu">
                            <li>
                              '.$link_detail.''.$link_edit.''.$link_hps.'         
                            </li>
                         </ul>
                     </div>
                 </td>',
              );
              $no++;

    
    }

    $output['recordsFiltered'] = $filteredCount;
    return response()->json($output);
        
    }
}