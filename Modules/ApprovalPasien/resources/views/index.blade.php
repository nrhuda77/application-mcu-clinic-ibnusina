@extends('layouts.main')

@section('content')
  
@php

  $nmpj = DB::table('penjab')->where('kd_pj', auth()->user()->role2 )->first();
@endphp

<div id="role2" style="display: none">{{ auth()->user()->role2 }}</div>
<div id="nmrole2" style="display: none">{{$nmpj->png_jawab}}</div>


<h1 class="h3 mb-3">Approval Pasien</h1>
<div class="row blocking">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex">
          <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
                   <form action="#" id="filterForm" class="form-horizontal">
                <div class="form-body">   
                  <div class="form-group row mb-5">
                <div class="col-md-4 mt-3">
                     <label class="control-label text-dark" style="font-weight:bolder;">Filter Kode Pj</label>
                     <select class="form-select"  id="filter_pj">   
                      <option selected value="">Pilih</option>                              
                      @foreach ($penjab as $p)                             
                       <option value="{{ $p->kd_pj }}">{{$p->png_jawab }}</option>                              
                       @endforeach
                   </select>
                       <span class="help-block"></span>
                </div>
  
               
                </div>
                </div>
            </form>
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


          <form action="#" id="form" method="POST">
            @csrf
            <div class="col-7 mb-3">
              <a href="#" class="btn btn-sm" style="background-color: rgb(218, 15, 140)!important; color:azure;!important" onclick="save()"><i class="fa fa-plus"></i> Approve </a>&nbsp;
            </div>
          <div class="table-responsive">
            <table id="table" class="display table table-striped table-hover  table-bordered">
              <thead class="">
                <tr>
                    <th width="5%"><input type="checkbox" name="checkall" onclick="toggle(this);" id="checkall" ></th>
                    <th width="15%">Nama Pasien</th>
                    <th width="20%">Alamat</th>
                    <th width="15%">Tanggal Lahir</th>
                    <th width="10%">Tanggal Daftar </th>
                    <th width="15%">Status</th>
                    <th width="5%">Status Approve</th>
                    <th width="25%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>      
                  
                </tr>
              </tbody>
            </table>
          </div>

        </form>
      
          </div>
        </div>
      </div>
    </div>
  </div>



<x-approvalpasien::modal  :penjab="$penjab" :cacatfisik="$cacatfisik" :suku="$suku" :bahasa="$bahasa" :propinsi="$propinsi" :perusahaan="$perusahaan" :kab="$kab" :kec="$kec" :kel="$kel"></x-approvalpasien::modal>

     <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
     <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
     <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>



@include('approvalpasien::components.script')

    
@endsection