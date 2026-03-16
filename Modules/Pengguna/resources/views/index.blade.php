@extends('layouts.main')

@section('content')
  

<div class="row blocking">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex">
          <h4 class="card-title">User Pengguna</h4>
           <a href="#" class="btn btn-primary btn-round ms-auto" style="background-color: rgb(114, 79, 255)!important; color:azure;!important" onclick="add()"><i class="fa fa-plus"></i> Tambah User</a>&nbsp; 
        </div>
        <div class="blocking"></div>
        <div class="card-body ">
      
            <table id="table" class="display table table-stripe table-bordered">
              <thead class="">
                <tr>
                  <th width="20%">Nama</th>
                  <th width="20%">Role</th>
                  <th width="5%">Username / Filter</th>
                  <th width="10%">Email</th>
                  <th width="15%">Status</th>
                  <th width="15%">Aksi</th>
              </tr>
                </tr>
              </thead>
              <tbody>
                <tr>      
                  
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>



<!-- Bootstrap modal -->
<div class="modal " id="modal_form" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <div class="modal-header">
          
              <h3 class="modal-title">header</h3>
          </div>
          <div class="modal-body form">
              <form action="#" id="form" class="form-horizontal">
                
                @csrf

                  <div class="form-body">

                    <div class="form-group row">

                      <div class="col-lg-3">
                   
                        <div class="mb-3">
                          <label for="alamat" class="form-label">Nama</label>
                          <input type="text" class="form-control"  id="nama" name="nama">
                          <span class="help-block text-danger nama_err"></span>
                        </div>
                        
                      </div>

                    <div class="col-lg-3">
                        <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Role</label>
                      <select class="form-select" id="role" name="role" >
                        <option value="" disabled selected hidden>Pilih</option>                        
                        <option value="Dokter">Dokter</option>    
                        <option value="Admin Perusahaan">Admin Perusahaan</option>  
                        <option value="Admin Klinik">Admin Klinik / Petugas</option>  
                     </select>
                      <span class="help-block text-danger role_err"></span>
                  </div>

                   </div>


                   <div class="col-lg-3 d-none" id="rl2">    
                    <div class="mb-3">
                      <label for="alamat" class="form-label ">Filter</label>
                      <select class="form-select" name="role2" id="role2">   
                                
                             @foreach ($penjab as $p)                             
                              <option value="{{ $p->kd_pj }}">{{$p->png_jawab }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger role2_err"></span>
                    </div>
                  </div>

   
                   <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Username</label>
                      <input type="text" class="form-control"  id="username" name="username">
                      <span class="help-block text-danger username_err"></span>
                    </div>
                    
                  </div>

                  <div class="col-lg-3">
                   
                    <div class="mb-3"></label>
                        <label for="alamat" class="form-label">Password</label>
                      <input type="password" class="form-control"  id="password" name="password" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  
                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Email</label>
                      <input type="text" class="form-control"  id="email" name="email" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  
                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Status</label>
                      <select class="form-select" name="status" id="status">
                        <option value="AKTIF">AKTIF</option> 
                        <option value="TIDAK AKTIF">TIDAK AKTIF</option> 
                        
                      </select>
                      <span class="help-block text-danger status_err"></span>
                    </div>
                    
                  </div>

               



                </div>

                </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
              
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
     <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

<@include('pengguna::script')  
@endsection