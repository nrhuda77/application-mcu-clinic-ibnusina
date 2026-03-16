@extends('layouts.main')

@section('content')
  

<h1 class="h3 mb-3"> Booking Registrasi</h1>
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
                    <th width="5%">No</th>
                    <th width="20%">Nama Pasien</th>
                    <th width="15%">No Ktp</th>
                    <th width="10%">Tanggal Booking</th>
                    <th width="10%">Tanggal Periksa</th>
                    <th width="15%">Dokter</th>
                    <th width="15%">Status</th>
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


  
  <!-- Edit User Modal -->
              <div class="modal fade" id="modal-pop" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Data Booking Pasien</h4>
                      </div>
                      <form id="form" class="row g-6" >
                        @csrf
                        <input type="hidden" id="id" name="id" class="form-control">

                      <div class="col-lg-3 psn">
                          <label class="form-label" for="nm_pasien">Nama Pasien</label>
                          <select class="form-control" id="nm_pasien" name="nm_pasien"></select>
                          <span class="help-block text-danger nm_pasien_err"></span>
                      </div>

                      <div class="col-lg-3 psn2">
                          <label class="form-label" for="nm_pasien">Nama Pasien</label>
                          <input class="form-control nm_pasien">
                      </div>

                        <div class="col-lg-3">
                          <label class="form-label" for="no_rkm_medis">No Rekam Medis</label>
                          <input type="text" id="no_rkm_medis" name="no_rkm_medis" class="form-control" />
                          <span class="help-block text-danger no_rkm_medis_err"></span>
                      </div>

                       <div class="col-lg-3">
                          <label class="form-label" for="no_ktp">Nomor KTP</label>
                          <input type="text" id="no_ktp" name="no_ktp" class="form-control" />
                      </div>

                      <div class="col-lg-3">
                          <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                          <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" />
                      </div>

                       <div class="col-lg-3">
                          <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                          <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control" />
                      </div>

                      <div class="col-lg-3">
                          <label class="form-label" for="tgl_lahir">Tanggal Lahir</label>
                          <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" />
                      </div>

                       <div class="col-lg-3">
                          <label class="form-label" for="alamat">Alamat</label>
                          <input type="text" id="alamat" name="alamat" class="form-control" />
                      </div>

                      <div class="col-lg-3 wbk">
                          <label class="form-label" for="waktu_booking">Waktu Booking</label>
                          <input type="datetime-local" id="waktu_booking" name="waktu_booking" class="form-control" />
                          <span class="help-block text-danger waktu_booking_err"></span>
                      </div>

                      <div class="col-lg-3 wbk2">
                          <label class="form-label" for="waktu_booking">Waktu Booking</label>
                          <input type="datetime-local" id="waktu_booking_edit" name="waktu_booking_edit" class="form-control" />
                          <span class="help-block text-danger waktu_booking_edit_err"></span>
                      </div>

                       <div class="col-lg-3" style="display: none;">
                          <label class="form-label" for="tanggal_periksa">Tanggal Periksa</label>
                          <input type="date" id="tanggal_periksa" name="tanggal_periksa" class="form-control" />
                          <span class="help-block text-danger tanggal_periksa_err"></span>
                      </div>

                      <div class="col-lg-3">
                          <label class="form-label" for="tanggal_periksa">Tanggal Periksa e</label>
                          <input type="date" id="tanggal_periksa_edit" name="tanggal_periksa_edit" class="form-control" />
                          <span class="help-block text-danger tanggal_periksa_edit_err"></span>
                      </div>

                       <div class="col-lg-3">
                          <label class="form-label" for="kd_dokter">Dokter</label>
                          <select name="kd_dokter" id="kd_dokter" class="form-control">
                            <option value="">Pilih Dokter</option>
                            @foreach ($dokter as $d)
                            <option value="{{$d->kd_dokter}}">{{$d->nm_dokter}}</option>
                            @endforeach
                          </select>
                          <span class="help-block text-danger kd_dokter_err"></span>
                      </div>

                       <div class="col-lg-3">
                          <label class="form-label" for="no_reg">No Reg</label>
                          <input type="text" id="no_reg" name="no_reg" class="form-control" />
                          <span class="help-block text-danger no_reg_err"></span>
                      </div>

                      <div class="col-lg-3">
                          <label class="form-label" for="kd_pj">Penjab</label>
                          <select name="kd_pj" id="kd_pj" class="form-control">
                            <option value="">Pilih Penjab</option>
                            @foreach ($penjab as $p)
                            <option value="{{$p->kd_pj}}">{{$p->png_jawab}}</option>
                            @endforeach
                          </select>
                          <span class="help-block text-danger kd_pj_err"></span>
                      </div>


                        <div class="col-lg-3">
                          <label class="form-label" for="status">Status</label>
                          <select name="status" id="status" class="form-control">
                            <option value="">Pilih Status</option>
                            <option  value="Terdaftar">Terdaftar</option>     
                            <option value="Dokter Berhalangan">Dokter Berhalangan</option>  
                            <option value="Batal">Batal</option>  
                          </select>
                          <span class="help-block text-danger status_err"></span>
                      </div>

                        <div class="col-lg-3">
                          <label class="form-label" for="waktu_kunjungan">Waktu Kunjungan</label>
                          <input type="datetime-local" id="waktu_kunjungan" name="waktu_kunjungan" class="form-control" />
                          <span class="help-block text-danger waktu_kunjungan_err"></span>
                      </div>

                      <div class="row blocking2"></div>
                        
                        <div class="col-lg-12 text-end">
                          <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary me-3">Submit</button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
     <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

<x-bookingregistrasi::script></x-bookingregistrasi::script>
    
@endsection