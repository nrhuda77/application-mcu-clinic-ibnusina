@extends('layouts.main')

@section('content')
  

<h1 class="h3 mb-3"> Pasien Registrasi</h1>
<div class="row blocking">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex">
          <h4 class="card-title"></h4>
          <a class="btn btn-danger text-white btn-round ms-auto" onclick="add()"><i class="fa fa-plus"></i> Tambah Booking</a>&nbsp;
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <form action="#" id="filterForm" class="form-horizontal">
                <div class="form-body">   
                  <div class="form-group row mb-5">
                <div class="col-md-4 mt-3">
                     <label class="control-label text-dark" style="font-weight:bolder;">Tanggal Awal</label>
                     <input name="t_awal" id="t_awal"  class="form-control" type="date" value="{{ date('Y-m-d') }}">
                       <span class="help-block"></span>
                </div>
  
                 <div class="col-md-4 mt-3">
                      <label class="control-label text-dark" style="font-weight:bolder;">Tanggal Akhir</label>
                      <input name="t_akhir" id="t_akhir" class="form-control" type="date" value="{{ date('Y-m-d') }}">
                      <span class="help-block"></span>
                </div>
                </div>
                </div>
            </form>
            <table id="table" class="datatables-ajax table table-bordered dataTable" width="100%">
              <thead class="">
                  <tr>
                    <th width="15%">Nama Pasien</th>
                    <th width="5%">No KTP</th>
                    {{-- <th width="20%">Alamat</th> --}}
                    <th width="15%">Tanggal Lahir</th>
                    <th width="10%">Tanggal Daftar</th>
                    <th width="20%">Status </th>
                    <th width="15%">Aksi</th>
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


  
  @include('pasien::components.modal')


    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
     <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

@include('pasien::components.script')
    
@endsection