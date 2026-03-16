<?php

namespace Modules\Pasien\Http\Controllers;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
        public function index()
    {
        return view("pasien::index",[
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

    /**
     * Show the form for creating a new resource.
     */
    public function kelurahan(Request $request){
        $kel = DB::table('kelurahan')->select('nm_kel', 'kd_kel')
        ->where(function ($query) use ($request) {
            $query->where('kd_kel', 'LIKE', '%'.$request->q.'%')
                  ->orWhere('nm_kel', 'LIKE', '%'.$request->q.'%');
        })
        ->limit(100)->get();
    $data = $kel->map(function ($item) {
        return [
            'id' => $item->kd_kel,
            'nm_kel' => $item->nm_kel,
            'text' => $item->nm_kel 
        ];
    });
    return response()->json($data);
       }
  
  
       public function kabupaten(Request $request){
        $kel = DB::table('kabupaten')->select('nm_kab', 'kd_kab')
        ->where(function ($query) use ($request) {
            $query->where('kd_kab', 'LIKE', '%'.$request->q.'%')
                  ->orWhere('nm_kab', 'LIKE', '%'.$request->q.'%');
        })
        ->limit(100)->get();
    $data = $kel->map(function ($item) {
  
        return [
            'id' => $item->kd_kab,
            'nm_kab' => $item->nm_kab,
            'text' => $item->nm_kab 
        ];
    });
    return response()->json($data);
       }
  
  
       public function kecamatan(Request $request){
        $kel = DB::table('kecamatan')->select('nm_kec', 'kd_kec')
        ->where(function ($query) use ($request) {
            $query->where('kd_kec', 'LIKE', '%'.$request->q.'%')
                  ->orWhere('nm_kec', 'LIKE', '%'.$request->q.'%');
        })
        ->limit(100)->get();
    $data = $kel->map(function ($item) {
  
        return [
            'id' => $item->kd_kec,
            'nm_kec' => $item->nm_kec,
            'text' => $item->nm_kec 
        ];
    });
    return response()->json($data);
       }
  

  
      public function ajax_norkm(){
        $pasien = DB::table('pasien')->max('no_rkm_medis');
        $b = $pasien + 1;
        
        if ($b < 10) {
            $increment = "00000".$b ; // Increment puluhan
        } elseif ($b >= 10 && $b < 100) {
            $increment = "0000".$b ; // Increment ratusan
        } elseif ($b >= 100 && $b < 1000) {
            $increment = "000".$b; // Increment ribuan
        } elseif ($b >= 1000 && $b < 10000) {
            $increment = "00".$b; // Increment ribuan
        } elseif ($b >= 10000 && $b < 100000) {
          $increment = "00".$b; // Increment ribuan
        } elseif ($b >= 100000 && $b < 1000000) {
        $increment = $b; // Increment ribuan
        }else {
            $increment = $b; // Increment sepuluhan ribu, dan seterusnya
        }
           return json_encode( $increment );
   
       }
  
      public function ajax_detail($no_rkm_medis){
        $r_no_rkm_medis = Crypt::decrypt($no_rkm_medis);
        $psn = DB::table('pasien')->where('no_rkm_medis', $r_no_rkm_medis)->first();
     
           return json_encode($psn);
   
       }


       public static function show(Request $request)
    {



    $draw   = intval(request('draw'));
    $start  = intval(request('start'));
    $length = intval(request('length'));
    $search = request('search.value');

    $output = [
        'draw' => $draw,
        'recordsTotal' => DB::table('pasien')->count(),
        'recordsFiltered' => 0,
        'data' => [],
    ];

    // Base Query
    $baseQuery = DB::table('pasien')
                ->whereBetween('tgl_daftar', [$request->t_awal, $request->t_akhir]);

                 if ($request->role == "Admin Perusahaan") {
                    $baseQuery->where('kd_pj', $request->role2);
                 }
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
        ->orderByDesc('tgl_daftar')
        ->skip($start)
        ->take($length)
        ->get();

    // Build data array
    $no = $start + 1;
    foreach ($data as $val) {

     

        $no_rkm_medis= Crypt::encrypt($val->no_rkm_medis);


                       
                $link_detail = '<a class="dropdown-item"  href="javascript:void(0)" title="Detail" onclick="detail(\''. $no_rkm_medis.'\')">   <i class="fas fa-id-badge text-success"> </i> Detail</a>';      
                $link_edit = '  <a class="dropdown-item"  href="javascript:void(0)" title="Edit" onclick="edit(\''. $no_rkm_medis.'\')">   <i class="fas fa-edit text-warning"> </i> Edit</a>';  
                $output['data'][] =
                      
                    array(
  
                        "<td>$val->nm_pasien <br> <p class='btn btn-danger btn-sm mb-0'>$val->no_rkm_medis</p> </td>",
                        "<td>$val->no_ktp</td>",
                        // "<td>+$val->alamat</td>",
                        "<td>$val->tgl_lahir</td>",
                        "<td>$val->tgl_daftar <br> </td>",
                        "<td>$val->stts_nikah </td>",
                        '<td>
                        <div class="btn-group dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"> Aksi </button>
                         <ul class="dropdown-menu" role="menu">
                            <li>
                             '.$link_detail.''.$link_edit.'
                             
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

       public function ajax_number(){
  
        $data = DB::table('pasien')->leftJoin('pasien as p', 'pasien.no_ktp', '=', 'p.no_ktp')
        ->whereNull('p.no_ktp') 
        ->where('pasien.status', 0) // Memastikan tidak ada kecocokan di tabel pasien
        ->count();
    return json_encode($data);
    
      }


       public function update(Request $request)
      {
        $validator =FacadesValidator::make($request->all(), [
          'nm_pasien' => 'required',
          'no_ktp' => 'required',
      
    
          'no_rkm_medis' => 'required',
      
          
      ]);
  
  
      
  
      if ($validator->passes()) {
  
          $data = [
            'nm_pasien' => $request->nm_pasien,
            'no_rkm_medis' => $request->no_rkm_medis,
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
            // 'propinsi' => $request->propinsi,
            'email' => $request->email,
            'nip' => $request->nip,
            'kd_prop' => $request->kd_prop,
  
            'propinsipj' => $request->propinsipj,
          
          ];
        
          $token = request()->except(['_token']);
  
         DB::table('pasien')->where('no_rkm_medis',$request->no_rkm_medis)->update($data);
          return response()->json($request);
    
      } else{
          return response()->json(['error'=>$validator->errors()]);
      } 
      }
  
}