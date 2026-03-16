@extends('layouts.main')

@section('content')
  

    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-email.css')}}" />



<h1 class="h3 mb-3"> Registrasi Periksa</h1>
<div class="row blocking">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex">
          <h4 class="card-title"></h4>
          <a class="btn btn-danger text-white btn-round ms-auto" onclick="add()"><i class="fa fa-plus"></i> Tambah Registrasi</a>&nbsp;
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
                    <th width="5%">No</th>
                    <th width="15%">No Rawat / No Rekam Medis</th>
                    <th width="15%">Nama Pasien</th>
                    <th width="15%">Dokter</th>
                    <th width="5%">Status</th>
                    <th width="2%">Tangal Registrasi</th>
                    <th width="15%">pembayaran</th>
                    <th width="10%">Status Bayar</th>
                    <th width="10%">Kategori</th>
                    <th width="5%">Action</th>

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


  <x-registrasiperiksa::modal :dokter="$dokter" :penjab="$penjab"></x-registrasiperiksa::modal>

  <x-registrasiperiksa::modal.modal_kuisoner :dokter="$dokter" :penjab="$penjab"></x-registrasiperiksa::modal.modal_kuisoner>

  <x-registrasiperiksa::modal.modal_kategori></x-registrasiperiksa::modal.modal_kategori>



    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
     <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
 <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
{{-- <script src="{{ asset('assets/js/app-email.js') }}"></script> --}}
    <script src="{{ asset('assets/js/app-ecommerce-settings.js') }}"></script>
<x-registrasiperiksa::script></x-registrasiperiksa::script>
<x-registrasiperiksa::script.script_kuisoner></x-registrasiperiksa::script.script_kuisoner>
<x-registrasiperiksa::script.script_kategori></x-registrasiperiksa::script.script_kategori>

    
@endsection