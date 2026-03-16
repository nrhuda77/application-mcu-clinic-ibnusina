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
                      <label for="alamat" class="form-label">Nama Pasien</label>
                      <input type="text" class="form-control"  id="nm_pasien2" >
                      <span class="help-block text-danger kode_kota_err"></span>
                  </div>

                   </div>
   
                   {{-- <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">No Rekam Medis</label>
                      <input type="text" class="form-control"  id="no_rkm_medis" name="no_rkm_medis" oninput="calculateBMI()" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div> --}}

                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">No KTP</label>
                      <input type="text" class="form-control"  id="no_ktp2"  >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  
                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Tempat Lahir</label>
                      <input type="text" class="form-control"  id="tmp_lahir2" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  
                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Jenis Kelamin</label>
                      <select class="form-select" id="jk2">
                        <option value="L">Laki-Laki</option> 
                        <option value="P">Perempuan</option> 
                        
                      </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Tanggal Lahir</label>
                      <input type="date" class="form-control"  id="tgl_lahir2"  >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Nama Ibu</label>
                      <input type="text" class="form-control"  id="nm_ibu2"  >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Alamat</label>
                      <input type="text" class="form-control"  id="alamat2" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Golongan Darah</label>
                      <select class="form-select" id="gol_darah2">
                        <option value="A">A</option> 
                        <option value="B">B</option> 
                        <option value="O">O</option> 
                        <option value="AB">AB</option> 
                      </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">pekerjaan</label>
                      <input type="text" class="form-control"  id="pekerjaan2"  >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Status Nikah</label>
                      <select class="form-select"  id="stts_nikah2">
                        <option value="BELUM MENIKAH">BELUM MENIKAH</option> 
                        <option value="MENIKAH">MENIKAH</option> 
                        <option value="JANDA">JANDA</option> 
                        <option value="DUDHA">DUDHA</option>
                        <option value="JOMBLO">JOMBLO</option>  
                        
                      </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Agama</label>
                      <input type="text" class="form-control"  id="agama2" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Tanggal Daftar</label>
                      <input type="date" class="form-control"  id="tgl_daftar2" name="tgl_daftar" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                 


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">No Telpon</label>
                      <input type="text" class="form-control"  id="no_tlp2" name="no_tlp" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Umur</label>
                      <input type="text" class="form-control"  id="umur2" name="umur" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Pendidikan</label>
                      <select class="form-select" name="pnd" id="pnd2">
                        <option value="TS">TS</option> 
                        <option value="TK">TK</option> 
                        <option value="SD">SD</option> 
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>  
                        <option value="SLTA/SEDERAJAT">SLTA/SEDERAJAT</option>  
                        <option value="D1">D1</option>  
                        <option value="D2">D2</option>  
                        <option value="D3">D3</option>  
                        <option value="D4">D4</option>  
                        <option value="S1">S1</option>  
                        <option value="S2">S2</option>  
                        <option value="S3">S3</option>  
                        
                      </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Keluarga</label>
                      <select class="form-select" name="keluarga" id="keluarga2">
                        <option value="AYAH">AYAH</option> 
                        <option value="IBU">IBU</option> 
                        <option value="ISTRI">ISTRI</option> 
                        <option value="SENDIRI">SENDIRI</option>
                        <option value="LAIN-LAIN">LAIN-LAIN</option>  
                        <option value="SLTA/SEDERAJAT">SLTA/SEDERAJAT</option>  
      
                        
                      </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Nama Keluarga</label>
                      <input type="text" class="form-control"  id="namakeluarga2" name="namakeluarga" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  <div class="col-lg-3">    
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kode PJ</label>
                      <select disabled class="form-select" name="kd_pj" id="kd_pj2">   
                                
                             @foreach ($penjab as $p)                             
                              <option value="{{ $p->kd_pj }}">{{$p->png_jawab }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger kd_pj_err"></span>
                    </div>
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">No Peserta</label>
                      <input type="text" class="form-control"  id="no_peserta2" name="no_peserta" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

             

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control" readonly  id="kd_kec2">

                   <span class="help-block text-danger kd_kec_err"></span>
                  </div>

                   </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kabupaten</label>
                    <input type="text" id="kd_kab2" class="form-control" readonly>

                   <span class="help-block text-danger kd_kap_err"></span>
                  </div>

                   </div>


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kelurahan</label>
                    <input type="text" id="kd_kel2" class="form-control" readonly>

                   <span class="help-block text-danger kd_kel_err"></span>
                  </div>

                   </div>
                  
                  

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Pekerjaan PJ</label>
                      <input type="text" class="form-control"  id="pekerjaanpj2" name="pekerjaanpj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Alamat PJ</label>
                      <input type="text" class="form-control"  id="alamatpj2" name="alamatpj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kelurahan PJ</label>
                      <input type="text" class="form-control"  id="kelurahanpj2" name="kelurahanpj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kecamatan PJ</label>
                      <input type="text" class="form-control"  id="kecamatanpj2" name="kecamatanpj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kabupaten PJ</label>
                      <input type="text" class="form-control"  id="kabupatenpj2" name="kabupatenpj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Perusahaan Pasien</label>
                      <select disabled class="form-select" id="perusahaan_pasien2" name="perusahaan_pasien">   
                        <option value="" disabled selected hidden>Pilih</option>                      
                             @foreach ($perusahaan as $p)                             
                              <option value="{{ $p->kode_perusahaan }}">{{ $p->nama_perusahaan  }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>


                  <div class="col-lg-3">    
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Suku Bangsa</label>
                      <select disabled class="form-select" name="suku_bangsa2" id="suku_bangsa2">   
                        <option value="" disabled selected hidden>Pilih</option>                      
                             @foreach ($suku as $p)                             
                              <option value="{{ $p->id }}">{{ $p->nama_suku_bangsa  }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger kd_pj_err"></span>
                    </div>
                  </div>


                  <div class="col-lg-3">    
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Bahasa Pasien</label>
                      <select  disabled class="form-select" name="bahasa_pasien" id="bahasa_pasien2">   
                        <option value="" disabled selected hidden>Pilih</option>                      
                             @foreach ($bahasa as $p)                             
                              <option value="{{ $p->id }}">{{ $p->nama_bahasa  }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger kd_pj_err"></span>
                    </div>
                  </div>


                  <div class="col-lg-3">    
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Cacat Fisik</label>
                      <select disabled class="form-select" name="cacat_fisik" id="cacat_fisik2">   
                        <option value="" disabled selected hidden>Pilih</option>                      
                             @foreach ($cacatfisik as $p)                             
                              <option value="{{ $p->id }}">{{ $p->nama_cacat  }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger kd_pj_err"></span>
                    </div>
                  </div>


                  <div class="col-lg-3">    
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Provinsi</label>
                      <select disabled class="form-select" name="kd_prop" id="kd_prop2">   
                        <option value="" disabled selected hidden>Pilih</option>                      
                             @foreach ($propinsi as $p)                             
                              <option value="{{ $p->kd_prop }}">{{ $p->nm_prop }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger kd_pj_err"></span>
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Email</label>
                      <input type="text" class="form-control"  id="email2" name="email" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Nip</label>
                      <input type="text" class="form-control"  id="nip2" name="nip" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Propinsi PJ</label>
                      <input type="text" class="form-control"  id="propinsipj2" name="propinsipj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>


                </div>

                </div>
              </form>
          </div>
          <div class="modal-footer">
       
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<!-- Bootstrap modal -->
<div class="modal " id="modal_form3" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <div class="modal-header">
          
              <h3 class="modal-title3">header</h3>
          </div>
          <div class="modal-body form">
              <form action="#" id="form3" class="form-horizontal">
                
                @csrf

                  <div class="form-body">

                    <div class="form-group row">

                    <div class="col-lg-3">
                      <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Nama Pasiens</label>
                      <input type="text" class="form-control"  id="nm_pasien3" name="nm_pasien" >
                      <span class="help-block text-danger kode_kota_err"></span>
                  </div>

                   </div>
   
                   {{-- <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">No Rekam Medis</label>
                      <input type="text" class="form-control"  id="no_rkm_medis" name="no_rkm_medis" oninput="calculateBMI()" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div> --}}

                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">No KTP</label>
                      <input type="text" class="form-control"  id="no_ktp3" name="no_ktp" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  
                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Tempat Lahir</label>
                      <input type="text" class="form-control"  id="tmp_lahir3" name="tmp_lahir" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  
                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Jenis Kelamin</label>
                      <select class="form-select" name="jk" id="jk3">
                        <option value="L">Laki-Laki</option> 
                        <option value="P">Perempuan</option> 
                        
                      </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Tanggal Lahir</label>
                      <input type="date" class="form-control"  id="tgl_lahir3" name="tgl_lahir" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Nama Ibu</label>
                      <input type="text" class="form-control"  id="nm_ibu3" name="nm_ibu" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Alamat</label>
                      <input type="text" class="form-control"  id="alamat3" name="alamat" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Golongan Darah</label>
                      <select class="form-select" name="gol_darah" id="gol_darah3">
                        <option value="A">A</option> 
                        <option value="B">B</option> 
                        <option value="O">O</option> 
                        <option value="AB">AB</option> 
                      </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">pekerjaan</label>
                      <input type="text" class="form-control"  id="pekerjaan3" name="pekerjaan" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Status Nikah</label>
                      <select class="form-select" name="stts_nikah" id="stts_nikah3">
                        <option value="BELUM MENIKAH">BELUM MENIKAH</option> 
                        <option value="MENIKAH">MENIKAH</option> 
                        <option value="JANDA">JANDA</option> 
                        <option value="DUDHA">DUDHA</option>
                        <option value="JOMBLO">JOMBLO</option>  
                        
                      </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Agama</label>
                      <input type="text" class="form-control"  id="agama3" name="agama" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Tanggal Daftar</label>
                      <input type="date" class="form-control"  id="tgl_daftar3" name="tgl_daftar" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                 


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">No Telpon</label>
                      <input type="text" class="form-control"  id="no_tlp3" name="no_tlp" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Umur</label>
                      <input type="text" class="form-control"  id="umur3" name="umur" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Pendidikan</label>
                      <select class="form-select" name="pnd" id="pnd">
                        <option value="TS">TS</option> 
                        <option value="TK">TK</option> 
                        <option value="SD">SD</option> 
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>  
                        <option value="SLTA/SEDERAJAT">SLTA/SEDERAJAT</option>  
                        <option value="D1">D1</option>  
                        <option value="D2">D2</option>  
                        <option value="D3">D3</option>  
                        <option value="D4">D4</option>  
                        <option value="S1">S1</option>  
                        <option value="S2">S2</option>  
                        <option value="S3">S3</option>  
                        
                      </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Keluarga</label>
                      <select class="form-select" name="keluarga" id="keluarga3">
                        <option value="AYAH">AYAH</option> 
                        <option value="IBU">IBU</option> 
                        <option value="ISTRI">ISTRI</option> 
                        <option value="SENDIRI">SENDIRI</option>
                        <option value="LAIN-LAIN">LAIN-LAIN</option>  
                        <option value="SLTA/SEDERAJAT">SLTA/SEDERAJAT</option>  
      
                        
                      </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Nama Keluarga</label>
                      <input type="text" class="form-control"  id="namakeluarga3" name="namakeluarga" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

              
                  
                      <div class="col-lg-3">    
                        <div class="mb-3">
                          <label for="alamat" class="form-label">Kode PJ</label>
                        <select  name="kd_pj" id="kd_pj3" class="form-select">
                         <option value="" disabled selected hidden>Pilih</option>                      
                         @foreach ($penjab as $p)                             
                          <option value="{{ $p->kd_pj }}">{{ $p->png_jawab }}</option>                              
                          @endforeach
                        </select>
                          <span class="help-block text-danger kd_pj_err"></span>
                        </div>
                      
                     </div>


                  <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">No Peserta</label>
                      <input type="text" class="form-control"  id="no_peserta3" name="no_peserta" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                    
                  </div>

             

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kecamatan</label>
                      <select class="form-select"  id="kd_kec3">   
                      <option value="">Search Data Kecamatan.........</option>
                   </select>
                   <input type="hidden" name="kd_kec">
                   <input type="text" readonly class="form-control" id="nkd_kec">
                   <span class="help-block text-danger kd_kec_err"></span>
                  </div>

                   </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kabupaten</label>
                      <select class="form-select" id="kd_kab3">   
                      <option value="">Search Data Kabupaten.........</option>
                   </select>
                    <input type="hidden" name="kd_kab">
                    <input type="text" readonly class="form-control" id="nkd_kab">
                   <span class="help-block text-danger kd_kap_err"></span>
                  </div>

                   </div>


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kelurahan</label>
                      <select class="form-select"  id="kd_kel3">   
                      <option value="">Search Data Kelurahan.........</option>
                   </select>
                   <input type="hidden" name="kd_kel">
                   <input type="text" class="form-control" readonly id="nkd_kel">
                   <span class="help-block text-danger kd_kel_err"></span>
                  </div>

                   </div>
                  
                  

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Pekerjaan PJ</label>
                      <input type="text" class="form-control"  id="pekerjaanpj3" name="pekerjaanpj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Alamat PJ</label>
                      <input type="text" class="form-control"  id="alamatpj3" name="alamatpj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kelurahan PJ</label>
                      <input type="text" class="form-control"  id="kelurahanpj3" name="kelurahanpj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kecamatan PJ</label>
                      <input type="text" class="form-control"  id="kecamatanpj3" name="kecamatanpj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kabupaten PJ</label>
                      <input type="text" class="form-control"  id="kabupatenpj3" name="kabupatenpj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Perusahaan Pasien</label>
                      <select class="form-select" id="perusahaan_pasien3" name="perusahaan_pasien">   
                        <option value="" disabled selected hidden>Pilih</option>                      
                             @foreach ($perusahaan as $p)                             
                              <option value="{{ $p->kode_perusahaan }}">{{ $p->nama_perusahaan  }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>


                  <div class="col-lg-3">    
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Suku Bangsa</label>
                      <select class="form-select" name="suku_bangsa" id="suku_bangsa3">   
                        <option value="" disabled selected hidden>Pilih</option>                      
                             @foreach ($suku as $p)                             
                              <option value="{{ $p->id }}">{{ $p->nama_suku_bangsa  }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger kd_pj_err"></span>
                    </div>
                  </div>


                  <div class="col-lg-3">    
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Bahasa Pasien</label>
                      <select class="form-select" name="bahasa_pasien" id="bahasa_pasien3">   
                        <option value="" disabled selected hidden>Pilih</option>                      
                             @foreach ($bahasa as $p)                             
                              <option value="{{ $p->id }}">{{ $p->nama_bahasa  }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger kd_pj_err"></span>
                    </div>
                  </div>


                  <div class="col-lg-3">    
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Cacat Fisik</label>
                      <select class="form-select" name="cacat_fisik" id="cacat_fisik3">   
                        <option value="" disabled selected hidden>Pilih</option>                      
                             @foreach ($cacatfisik as $p)                             
                              <option value="{{ $p->id }}">{{ $p->nama_cacat  }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger kd_pj_err"></span>
                    </div>
                  </div>


                  <div class="col-lg-3">    
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Provinsi</label>
                      <select class="form-select" name="kd_prop" id="kd_prop3">   
                        <option value="" disabled selected hidden>Pilih</option>                      
                             @foreach ($propinsi as $p)                             
                              <option value="{{ $p->kd_prop }}">{{ $p->nm_prop }}</option>                              
                              @endforeach
                          </select>
                      <span class="help-block text-danger kd_pj_err"></span>
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Email</label>
                      <input type="text" class="form-control"  id="email3" name="email" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Nip</label>
                      <input type="text" class="form-control"  id="nip3" name="nip" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Propinsi PJ</label>
                      <input type="text" class="form-control"  id="propinsipj3" name="propinsipj" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>  
                  </div>


                </div>

                </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" id="btnSave" onclick="save2()" class="btn btn-primary">Simpan</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
              
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>