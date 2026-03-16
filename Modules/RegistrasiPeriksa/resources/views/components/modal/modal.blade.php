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
                          <label class="form-label" for="no_rkm_medis">No Rawat</label>
                          <input type="text" id="no_rawat" name="no_rawat" class="form-control" />
                          <span class="help-block text-danger no_rawat_err"></span>
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
                          <label class="form-label" for="no_ktp">Nomor Telepon</label>
                          <input type="text" id="no_tlp" name="no_tlp" class="form-control" />
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
                          <label class="form-label" for="hubunganpj">Hubugan Pj</label>
                          <input type="text" id="hubunganpj" name="hubunganpj" class="form-control" />
                      </div>

                      <div class="col-2">
                          <label class="form-label" for="umurdaftar">Umur</label>
                          <input type="text" id="umurdaftar" name="umurdaftar" class="form-control" />
                          <span class="help-block text-danger umurdaftar_err"></span>
                      </div>

                      <div class="col-lg-3">
                          <label class="form-label" for="umur">Status Umur</label>
                         <select name="sttsumur" id="sttsumur" class="form-control">
                          <option value="" disabled selected hidden>Pilih</option>                        
                          <option value="Th">Tahun</option>    
                          <option value="Bl">Bulan</option>  
                          <option value="Hr">Hari</option>
                         </select>
                         <span class="help-block text-danger sttsumur_err"></span>
                      </div>

                       <div class="col-lg-3">
                          <label class="form-label" for="p_jawab">Penanggung Jawab</label>
                          <input type="text" id="p_jawab" name="p_jawab" class="form-control" />
                          <span class="help-block text-danger p_jawab_err"></span>
                      </div>

                      <div class="col-lg-3">
                          <label class="form-label" for="p_jawab">Biaya Registrasi</label>
                          <input type="text" value="0" id="biaya_reg" name="biaya_reg" class="form-control" />
                          <span class="help-block text-danger biaya_reg_err"></span>
                      </div>


                        <div class="col-lg-3">
                          <label class="form-label" for="stts">Status</label>
                          <select name="stts" id="stts" class="form-control">
                              <option value="Belum"  selected >Belum</option>   
                          <option value="Sudah">Sudah</option>     
                          <option value="Pulang Paksa">Pulang Paksa</option>  
                          <option value="Dirawat">Dirawat</option>  
                          <option value="Berkas Diterima">Berkas Diterima</option> 
                          <option value="Dirujuk">Dirujuk</option>  
                          <option value="Meninggal">Meninggal</option>    
                          <option value="Batal">Batal</option>
                          </select>
                          <span class="help-block text-danger stts_err"></span>
                      </div>

                      <div class="col-lg-3">
                          <label class="form-label" for="stts_daftar">Status Daftar</label>
                          <select name="stts_daftar" id="stts_daftar" class="form-control">
                           <option value="" disabled selected hidden>Pilih</option>                      
                          <option value="-">-</option>   
                          <option value="Lama">Lama</option>    
                          <option value="Baru">Baru</option>  
                          </select>
                          <span class="help-block text-danger stts_daftar_err"></span>
                      </div>

                      <div class="col-lg-3">
                          <label class="form-label" for="status_bayar">Status Bayar</label>
                          <select name="status_bayar" id="status_bayar" class="form-control">                     
                          <option value="Sudah Bayar">Sudah Bayar</option>    
                          <option value="Belum Bayar" selected >Belum Bayar</option>  
                          </select>
                          <span class="help-block text-danger status_bayar_err"></span>
                      </div>

                        <div class="col-lg-3">
                          <label class="form-label" for="stts_daftar">Status Poli</label>
                          <select name="status_poli" id="status_poli" class="form-control">                      
                          <option value="Lama">Lama</option>    
                          <option value="Baru">Baru</option>
                          </select>
                          <span class="help-block text-danger status_bayar_err"></span>
                      </div>

                      <div class="row blocking2"></div>
                        
                        <div class="col-lg-12 text-end">
                          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary me-3">Submit</button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->