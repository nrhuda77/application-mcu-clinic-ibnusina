

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
                        <input type="hidden" name="id" id="id">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control"  id="nm_pasien" name="nm_pasien" >
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
                        <input type="text" class="form-control"  id="no_ktp" name="no_ktp" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
                    
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control"  id="tmp_lahir" name="tmp_lahir" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
  
                    
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jk" id="jk">
                          <option value="L">Laki-Laki</option> 
                          <option value="P">Perempuan</option> 
                          
                        </select>
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control"  id="tgl_lahir" name="tgl_lahir" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Nama Ibu</label>
                        <input type="text" class="form-control"  id="nm_ibu" name="nm_ibu" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control"  id="alamat" name="alamat" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Golongan Darah</label>
                        <select class="form-select" name="gol_darah" id="gol_darah">
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
                        <input type="text" class="form-control"  id="pekerjaan" name="pekerjaan" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Status Nikah</label>
                        <select class="form-select" name="stts_nikah" id="stts_nikah">
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
                        <input type="text" class="form-control"  id="agama" name="agama" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Tanggal Daftar</label>
                        <input type="date" class="form-control"  id="tgl_daftar" name="tgl_daftar" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
  
                   
  
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">No Telpon</label>
                        <input type="text" class="form-control"  id="no_tlp" name="no_tlp" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Umur</label>
                        <input type="text" class="form-control"  id="umur" name="umur" >
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
                        <select class="form-select" name="keluarga" id="keluarga">
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
                        <input type="text" class="form-control"  id="namakeluarga" name="namakeluarga" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
                
                    
                        <div class="col-lg-3">    
                          <div class="mb-3">
                            <label for="alamat" class="form-label">Kode PJ</label>
                           <input type="hidden" class="form-control"  name="kd_pj" id="kd_pj">
                           <input readonly type="text" class="form-control"  name="kd_pjf" id="kd_pjf">
                            <span class="help-block text-danger kd_pj_err"></span>
                          </div>
                        
                       </div>
  
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">No Peserta</label>
                        <input type="text" class="form-control"  id="no_peserta" name="no_peserta" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
               
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Kecamatan</label>
                        <select class="form-select" id="kd_kec">   
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
                        <select class="form-select" id="kd_kab">   
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
                        <select class="form-select"  id="kd_kel">   
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
                        <input type="text" class="form-control"  id="pekerjaanpj" name="pekerjaanpj" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat PJ</label>
                        <input type="text" class="form-control"  id="alamatpj" name="alamatpj" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Kelurahan PJ</label>
                        <input type="text" class="form-control"  id="kelurahanpj" name="kelurahanpj" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Kecamatan PJ</label>
                        <input type="text" class="form-control"  id="kecamatanpj" name="kecamatanpj" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Kabupaten PJ</label>
                        <input type="text" class="form-control"  id="kabupatenpj" name="kabupatenpj" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Perusahaan Pasien</label>
                        <select class="form-select" id="perusahaan_pasien" name="perusahaan_pasien">   
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
                        <select class="form-select" name="suku_bangsa" id="suku_bangsa">   
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
                        <select class="form-select" name="bahasa_pasien" id="bahasa_pasien">   
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
                        <select class="form-select" name="cacat_fisik" id="cacat_fisik">   
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
                        <select class="form-select" name="kd_prop" id="kd_prop">   
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
                        <input type="text" class="form-control"  id="email" name="email" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Nip</label>
                        <input type="text" class="form-control"  id="nip" name="nip" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Propinsi PJ</label>
                        <input type="text" class="form-control"  id="propinsipj" name="propinsipj" >
                        <span class="help-block text-danger kode_kota_err"></span>
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
  
  
  
  <!-- Bootstrap modal -->
<div class="modal " id="modal_form2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            
                <h3 class="modal-title">header</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form2" class="form-horizontal">
                  
                  @csrf
  
                    <div class="form-body">
  
                      <div class="form-group row">
  
                      <div class="col-lg-3">
                        <input type="hidden" name="id" id="id">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control"  id="nm_pasien2" name="nm_pasien" >
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
                        <input type="text" class="form-control"  id="no_ktp2" name="no_ktp" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
                    
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control"  id="tmp_lahir2" name="tmp_lahir" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
  
                    
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jk" id="jk2">
                          <option value="L">Laki-Laki</option> 
                          <option value="P">Perempuan</option> 
                          
                        </select>
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control"  id="tgl_lahir2" name="tgl_lahir" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Nama Ibu</label>
                        <input type="text" class="form-control"  id="nm_ibu2" name="nm_ibu" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control"  id="alamat2" name="alamat" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Golongan Darah</label>
                        <select class="form-select" name="gol_darah" id="gol_darah2">
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
                        <input type="text" class="form-control"  id="pekerjaan" name="pekerjaan2" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>
                      
                    </div>
  
  
                    <div class="col-lg-3">
                     
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Status Nikah</label>
                        <select class="form-select" name="stts_nikah" id="stts_nikah2">
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
                        <input type="text" class="form-control"  id="agama2" name="agama" >
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
                           <input type="hidden" class="form-control"  name="kd_pj" id="kd_pj2">
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
                      <input type="text" class="form-control" name="kd_kec" id="kd_kec2">
                     <span class="help-block text-danger kd_kec_err"></span>
                    </div>
  
                     </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Kabupaten</label>
                        <input type="text" class="form-control" name="kd_kab" id="kd_kab2">
                     <span class="help-block text-danger kd_kap_err"></span>
                    </div>
  
                     </div>
  
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" name="kd_kel" id="kd_kel2">
                     <span class="help-block text-danger kd_kel_err"></span>
                    </div>
  
                     </div>
                    
                    
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Pekerjaan PJ</label>
                        <input type="text" class="form-control"  id="pekerjaanpj" name="pekerjaanpj" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat PJ</label>
                        <input type="text" class="form-control"  id="alamatpj" name="alamatpj" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Kelurahan PJ</label>
                        <input type="text" class="form-control"  id="kelurahanpj" name="kelurahanpj" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Kecamatan PJ</label>
                        <input type="text" class="form-control"  id="kecamatanpj" name="kecamatanpj" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Kabupaten PJ</label>
                        <input type="text" class="form-control"  id="kabupatenpj" name="kabupatenpj" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Perusahaan Pasien</label>
                        <select class="form-select" id="perusahaan_pasien" name="perusahaan_pasien">   
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
                        <select class="form-select" name="suku_bangsa" id="suku_bangsa">   
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
                        <select class="form-select" name="bahasa_pasien" id="bahasa_pasien">   
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
                        <select class="form-select" name="cacat_fisik" id="cacat_fisik">   
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
                        <select class="form-select" name="kd_prop" id="kd_prop">   
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
                        <input type="text" class="form-control"  id="email" name="email" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Nip</label>
                        <input type="text" class="form-control"  id="nip" name="nip" >
                        <span class="help-block text-danger kode_kota_err"></span>
                      </div>  
                    </div>
  
  
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Propinsi PJ</label>
                        <input type="text" class="form-control"  id="propinsipj" name="propinsipj" >
                        <span class="help-block text-danger kode_kota_err"></span>
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