<?php

namespace Modules\Pengguna\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengguna::index',[
          'penjab' => DB::table('penjab')->select('kd_pj', 'png_jawab')->get()
        ]);
    }

public function store(Request $request)
    {

      // dd($request->kd_pj);
      $validator =FacadesValidator::make($request->all(), [
        'nama' => 'required',
        'role' => 'required',
        'role2' => 'required',
        'username' => 'required',
         'email' => 'required',
        'status' => 'required',
        'password' => 'required',
        
    ]);

  if ($validator->passes()) {

        User::create([
          'nama' => $request->nama,
          'role' => $request->role,
          'role2' => $request->role2,
          'username' => $request->username,
          'password' => Hash::make($request->password), 
          'email' => $request->email,
          'status' => $request->status,
          

      ]);
        return response()->json($request);
  
    } else{
        return response()->json(['error'=>$validator->errors()]);
    } 
    }




    public function update(Request $request, User $user)
    {
      $validator =FacadesValidator::make($request->all(), [
        'nama' => 'required',
        'role2' => 'required',
        'role' => 'required',
        'username' => 'required',
         'email' => 'required',
        'status' => 'required',
        // 'password' => 'required',
    
        
    ]);



    if ($validator->passes()) {

      if($request->password == '' || $request->password == null){

        $u = User::where('id',$request->id)->first();
        $data = [
          'nama' => $request->nama,
          'role' => $request->role,
          'role2' => $request->role2,
          'username' => $request->username,
          'password' => $u->password, 
          'email' => $request->email,
          'status' => $request->status,
        
        ];
        
      }else{

        $data = [
          'nama' => $request->nama,
          'role' => $request->role,
          'role2' => $request->role2,
          'username' => $request->username,
          'password' => Hash::make($request->password), 
          'email' => $request->email,
          'status' => $request->status,
        
        ];
        
      }

       
      
        $token = request()->except(['_token']);

        User::where('id',$request->id)->update($data ,$token);
        return response()->json($request);
  
    } else{
        return response()->json(['error'=>$validator->errors()]);
    } 
    }

    public function ajax_detail($id){
         $r_id = Crypt::decrypt($id);
        $user = User::where('id', $r_id)->first();
           return json_encode($user);
   
       }

       public function destroy($id){
            $r_id = Crypt::decrypt($id);
        $user = User::where('id', $r_id)->delete();
           return json_encode($user);
   
       }


       public function show(Request $request)
    {



    $draw   = intval(request('draw'));
    $start  = intval(request('start'));
    $length = intval(request('length'));
    $search = request('search.value');

    $output = [
        'draw' => $draw,
        'recordsTotal' => DB::table('users')->count(),
        'recordsFiltered' => 0,
        'data' => [],
    ];

    // Base Query
    $baseQuery = DB::table('users');
        
                // Search filter
    if (!empty($search)) {
        $baseQuery->where(function($filter) use ($search) {
              $filter->orWhere('role', 'like', '%' . $search . '%');
              $filter->orWhere('role2', 'like', '%' . $search . '%');
              $filter->orWhere('nama', 'like', '%' . $search . '%');
              $filter->orWhere('username', 'like', '%' . $search . '%');
              $filter->orWhere('email', 'like', '%' . $search . '%');
              $filter->orWhere('status', 'like', '%' . $search . '%');
        });
    }

    // Clone query for counting filtered records
    $filteredCount = (clone $baseQuery)->count();

    // Data fetching
    $data = $baseQuery
        ->skip($start)
        ->take($length)
        ->latest()
        ->get();

    // Build data array
    $no = $start + 1;
    foreach ($data as $val) {

        $id = Crypt::encrypt($val->id);
        $rol = $val->rol ?? '';

        $output['data'][] = [
           "<td>$val->nama </td>",
          "<td>{$rol}</td>",
           "<td>$val->username<br>  <span class='btn btn-warning btn-xs'>$val->role2 </span></td>",
           "<td>$val->email</td>",
           "<td>$val->status</td>",    
           '<td>
               <div class="dropdown pe-4">
                  <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="dropdown"> Action
                      <i class="ms-1 icon-base ti tabler-brand-juejin icon-15px"></i></button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item text-primary" onclick="detail(\''. $id.'\')"><i class="icon-base ti tabler-list-details me-1"></i> Detail</a>
                            <a class="dropdown-item text-warning" onclick="edit(\''. $id.'\')"><i class="icon-base ti tabler-edit me-1"></i>Edit</a>
                            <a class="dropdown-item text-danger" onclick="hapus(\''. $id.'\')"><i class="icon-base ti tabler-trash me-1"></i>Delete</a>
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