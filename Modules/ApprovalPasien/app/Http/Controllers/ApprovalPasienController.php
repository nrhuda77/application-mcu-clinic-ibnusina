<?php

namespace Modules\ApprovalPasien\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ApprovalPasienController extends Controller
{
     public function index()
    {
        return view("approvalpasien::index",[
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
  
  
      public function approve(Request $request )
      {
  
 
  
    foreach(request()->no_ktp as $ktp){
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

      $apr = DB::table('approval_pasien')->where('no_ktp', $ktp)->first();
      $psn = DB::table('pasien')->where('no_ktp', $ktp)->first();
      $sts =  $apr->status ?? 0;
      $pasn = $psn->no_ktp ?? null;
  
      if ($sts == 0) {
        if ($pasn == null) {
  
          DB::table('pasien')->insert([
            'nm_pasien' => $apr->nm_pasien,
            'no_rkm_medis' =>  $increment,
            'no_ktp' => $apr->no_ktp, 
            'tmp_lahir' => $apr->tmp_lahir,
            'jk' => $apr->jk,
            'tgl_lahir' => $apr->tgl_lahir,
            'nm_ibu' => $apr->nm_ibu,
            'alamat' => $apr->alamat,
            'gol_darah' => $apr->gol_darah,
            'pekerjaan' => $apr->pekerjaan,
            'stts_nikah' => $apr->stts_nikah,
            'agama' => $apr->agama,
            'tgl_daftar' => $apr->tgl_daftar,
            'no_tlp' => $apr->no_tlp,
            'umur' => $apr->umur,
            'pnd' => $apr->pnd,
            'keluarga' => $apr->keluarga,
            'namakeluarga' => $apr->namakeluarga,
            'kd_pj' => $apr->kd_pj,
            'no_peserta' => $apr->no_peserta,
            'kd_kec' => $apr->kd_kec,
            'kd_kab' => $apr->kd_kab,
            'kd_kel' => $apr->kd_kel,
            'pekerjaanpj' => $apr->pekerjaanpj,
            'alamatpj' => $apr->alamatpj,
            'kelurahanpj' => $apr->kelurahanpj,
            'kabupatenpj' => $apr->kabupatenpj,
            'kecamatanpj' => $apr->kecamatanpj,
            'perusahaan_pasien' => $apr->perusahaan_pasien,
            'suku_bangsa' => $apr->suku_bangsa,
            'bahasa_pasien' => $apr->bahasa_pasien,
            'cacat_fisik' => $apr->cacat_fisik,
            // 'propinsi' => $apr->propinsi,
            'email' => $apr->email,
            'nip' => $apr->nip,
            'kd_prop' => $apr->kd_prop,
            'propinsipj' => $apr->propinsipj,
               
        ]);
    
        }else{
    
        }

      }else{
  
      }
  
    }

    return response()->json($request);
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
                // ->where('kd_pj' ,$request->filter_pj)
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

      $link_detail = '<a class="dropdown-item "   title="Detail" onclick="detail(\''. $id.'\')">   <i class="fas fa-eye text-info"></i> </i> Detail</a>';      
               
                    $psn = DB::table('pasien')->where('no_ktp', $val->no_ktp)->first();
                    $ktp = $psn->no_ktp ?? null;
  
                    if($val->status == 0 && $ktp == null){
                      $stus = "<p class='btn btn-warning btn-xs'>Menunggu</p>";
                      $link_hps = '  <a class="dropdown-item"   title="Edit" onclick="hapus(\''. $id.'\')">   <i class="fas fa-trash text-primary"></i> Hapus</a>';  
                      $link_tolak_approve = '  <a class="dropdown-item"   title="Edit" onclick="tolak(\''. $id.'\')">   <i class="fas fa-times-circle text-danger"> </i> Tolak</a>';  
                      $link_edit = '  <a class="dropdown-item"   title="Edit" onclick="edit(\''. $id.'\')">  <i class="fas fa-edit text-warning"></i> Edit</a>';  
                      $apprv = ' <input type="checkbox" name="no_ktp[]" id="" value="'.$val->no_ktp.'" > ';  
                    }elseif($val->status == 0 && $ktp == !null){
                      $stus = "<button class='btn btn-success btn-xs'>Telah di Approved</button>";
                      $link_hps = '  <a class="dropdown-item"   title="Edit" onclick="hapus(\''. $id.'\')">   <i class="fas fa-trash text-danger"></i> Hapus</a>';  
                      $link_edit = '  ';  
                      $apprv = '';
                      $link_tolak_approve = '  ';  
            
                    }else{
                      $stus = "<button class='btn btn-danger btn-xs'>Ditolak Approved</button>";
                      $link_hps = '  <a class="dropdown-item"   title="Edit" onclick="hapus(\''. $id.'\')">   <i class="fas fa-trash text-danger"></i> Hapus</a>';  
                      $link_edit = '  <a class="dropdown-item"   title="Edit" onclick="edit(\''. $id.'\')">  <i class="fas fa-edit text-warning"></i> Edit</a>';  
                      $apprv = ' ';
                      $link_tolak_approve = '';
                    }
               
   
      
                    $output['data'][] =
                      
                    array(
        
                   "<td>$apprv</td>",
                   "<td>$val->nm_pasien</td>",
                   "<td>$val->no_ktp</td>",
                   "<td>$val->tgl_lahir<td>",
                   "<td>$val->tgl_daftar</td>",
                   "<td> $val->stts_nikah</td>",
                   "<td>$stus</td>",
                   '<td>
                   <div class="btn-group dropdown">
                       <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-bs-toggle="dropdown"> Aksi </button>
                    <ul class="dropdown-menu" role="menu">
                       <li>
                        '.$link_edit.''.$link_detail.''.$link_hps.''.$link_tolak_approve.'
                        
                       </li>
                     </ul>
                   </div>
             </td>',
                   "<td><span class='text-secondary text-xs font-weight-bold'>  $link_detail. $link_edit. $link_tolak_approve. $link_hps</span></td>"
                );
                $no++;

    
    }

    $output['recordsFiltered'] = $filteredCount;
    return response()->json($output);
        
    }

       public function ajax_number(){
  
        $data = DB::table('approval_pasien')->leftJoin('pasien as p', 'approval_pasien.no_ktp', '=', 'p.no_ktp')
        ->whereNull('p.no_ktp') 
        ->where('approval_pasien.status', 0) // Memastikan tidak ada kecocokan di tabel pasien
        ->count();
    return json_encode($data);
    
      }
  
  
  
      /**
       * Show the form for editing the specified resource.
       */
      public function edit(Request $request, $id)
      {
          //
      }
  
      /**
       * Update the specified resource in storage.
       */
      public function tolak( Request $request, $id)
      {
       
         $r_id = Crypt::decrypt($id);
  
          $data = [
           'status' => 1,
          
          ];
        
          $token = request()->except(['_token']);
  
          DB::table('approval_pasien')->where('id',$request->id)->update($data);
          return response()->json($request);
    
      }
  
      /**
       * Remove the specified resource from storage.
       */
      public function destroy(Request $request, $id)
      {
         $r_id = Crypt::decrypt($id);
          $v = DB::table('approval_pasien')->where('id', $r_id)->delete();
         
          return json_encode($v);
      }

      
}