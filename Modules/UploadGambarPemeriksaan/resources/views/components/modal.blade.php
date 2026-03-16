
              <div class="modal fade" id="modal-pop" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Upload Gambar</h4>
                      </div>
                      <form id="form" class="row " >
                        @csrf


                       <div class="row g-0 ">
                            <div class="row">


                                   <div class="col-lg-3">
                              <div class="mb-3">
                                <label for="alamat" class="form-label">No Rekam Medis</label>
                                 <input readonly type="text" class="form-control no_rkm_medis" name="no_rkm_medis">                        
                                <span class="help-block text-danger no_rkm_medis_err"></span>
                            </div>
                           </div>
      
                          <div class="col-lg-3">
                            <div class="mb-3">
                              <label for="alamat" class="form-label"> Nama Pasien </label>
                                    <input readonly  type="text" class="form-control nama_pasien">
                              <span class="help-block text-danger no_rkm_meds_err"></span>
                          </div>
                         </div>
         
                         <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="alamat" class="form-label">No Reg</label>
                            <input readonly  type="text" class="form-control" name="no_reg">
                            <span class="help-block text-danger no_reg_err"></span>
                          </div>
                        </div>
      
      
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="alamat" class="form-label">No Rawat</label>
                            <input readonly  type="text" class="form-control no_rawat" name="no_rawat" >
                            <span class="help-block text-danger no_rawat_err"></span>
                          </div>
                        </div>


                         <div class="row " >
                                
                     <div class="col-lg-12">
                          <label for="alamat" class="form-label"> jenis </label>
                              <select class="form-select" name="jenis[]" >
                                <option value="" disabled selected hidden>Pilih</option> 
                                  @foreach ($master as $b )                                            
                                  <option value="{{ $b->kode }}">{{ $b->nama  }}</option>                           
                                  @endforeach
                              </select>                        
                          <span class="help-block text-danger jenis_err"></span>
                     </div>

                          <div class="col-lg-12">
                          <label class="form-label" for="kd_dokter">Dokter</label>
                          <select name="kd_dokter" id="kd_dokter" class="form-control">
                            <option value="">Pilih Dokter Pemeriksa</option>
                            @foreach ($dokter as $d)
                            <option value="{{$d->kd_dokter}}">{{$d->nm_dokter}}</option>
                            @endforeach
                          </select>
                          <span class="help-block text-danger kd_dokter_err"></span>
                      </div>

                        <div class="col-12">
                  <div class="card">
                    <h5 class="card-header">Upload Gambar</h5>
                    <div class="card-body">
                      <div class="dropzone needsclick dropzone-basic" id="dropzone-basic">
                        <div class="dz-message needsclick">
                          Drop files here or click to upload
                        </div>
                        <div class="fallback">
                          <input name="foto[]" type="file" />
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
            </div>
                     <div class="row" id="result-container"></div>

                            </div>                          
          
                      <div class="row blocking2"></div>
                        
                        <div class="col-12 text-end mt-5">
                          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary me-3">Submit </button>
                           <button type="button" class="btn btn-warning me-2" id="add-input">Tambah Kolom</button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                        
                         </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->
              






              
              <div class="modal fade" id="modal-pop-edit" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Upload Gambar</h4>
                      </div>
                      <form id="form_edit" class="row " >
                        @csrf


                       <div class="row g-0 ">
                            <div class="row">

                              <input type="hidden" name="lokasi_file">


                                   <div class="col-lg-3">
                              <div class="mb-3">
                                <label for="alamat" class="form-label">No Rekam Medis</label>
                                 <input readonly type="text" class="form-control no_rkm_medis" name="no_rkm_medis">                        
                                <span class="help-block text-danger no_rkm_medis_err"></span>
                            </div>
                           </div>
      
                          <div class="col-lg-3">
                            <div class="mb-3">
                              <label for="alamat" class="form-label"> Nama Pasien </label>
                                    <input readonly  type="text" class="form-control nama_pasien">
                              <span class="help-block text-danger no_rkm_meds_err"></span>
                          </div>
                         </div>
         
                         <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="alamat" class="form-label">No Reg</label>
                            <input readonly  type="text" class="form-control" name="no_reg">
                            <span class="help-block text-danger no_reg_err"></span>
                          </div>
                        </div>
      
      
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <label for="alamat" class="form-label">No Rawat</label>
                            <input readonly  type="text" class="form-control no_rawat" name="no_rawat" >
                            <span class="help-block text-danger no_rawat_err"></span>
                          </div>
                        </div>


                         <div class="row " >

                              <div class="col-lg-12">
                          <label class="form-label" for="kd_dokter">Dokter</label>
                          <select name="kd_dokter" id="kd_dokter" class="form-control">
                            <option value="">Pilih Dokter Pemeriksa</option>
                            @foreach ($dokter as $d)
                            <option value="{{$d->kd_dokter}}">{{$d->nm_dokter}}</option>
                            @endforeach
                          </select>
                          <span class="help-block text-danger kd_dokter_err"></span>
                      </div>
                                
                     <div class="col-lg-12">
                          <label for="alamat" class="form-label"> jenis </label>
                              <select class="form-select" name="jenis" >
                                <option value="" disabled selected hidden>Pilih</option> 
                                  @foreach ($master as $b )                                            
                                  <option value="{{ $b->kode }}">{{ $b->nama  }}</option>                           
                                  @endforeach
                              </select>                        
                          <span class="help-block text-danger jenis_err"></span>
                     </div>

                            <div class="col-12">
                  <div class="card">
                    <h5 class="card-header">Upload Gambar</h5>
                    <div class="card-body">
                      <div class="dropzone needsclick dropzone-basic" id="dropzone-dynamic-0">
                        <div class="dz-message needsclick">
                          Drop files here or click to upload
                        </div>
                        <div class="fallback">
                          <input name="foto" type="file" />
                        </div>
                    </div>
                    </div>
                    <span class="help-block text-danger foto_err"></span>
                  </div>
                </div>

                    
            </div>

                            </div>                          
          
                      <div class="row blocking2"></div>
                        
                        <div class="col-12 text-end mt-5">
                          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary me-3">Submit </button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                        
                         </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->

                
                