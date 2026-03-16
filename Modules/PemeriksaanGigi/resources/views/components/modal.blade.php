           <div class="modal fade" id="modal-pop" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Data Upload Gambar</h4>
                      </div>

                        <form action="#" id="form" class="row">
                
                @csrf

      

                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label"> Nama Pasien </label>     
                        <input readonly type="text" class="form-control nama_pasien" >   
                    </div>
                   </div>

                   <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label"> No Rekam Medis</label>     
                      <input readonly type="text" class="form-control"  id="no_rkm_medis" name="no_rkm_medis" >   
                      <span class="help-block text-danger no_rkm_medis_err"></span>
                  </div>
                 </div>

                 <div class="col-lg-3">
                  <div class="mb-3">
                    <label for="alamat" class="form-label"> No Rawat</label>     
                    <input readonly type="text" class="form-control"  id="no_rawat" name="no_rawat" >   
                    <span class="help-block text-danger no_rkm_medis_err"></span>
                </div>
               </div>


                   <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">No Reg</label>
                      <input readonly type="text" class="form-control"  id="no_reg" name="no_reg"  >
                      <span class="help-block text-danger no_reg_err"></span>
                    </div>
                    
                  </div>
   
                   <div class="col-lg-3">
                    <label for="alamat"  class="form-label">Urutan Gigi</label>
                      <input type="text" class="form-control" placeholder="Urutan no"  id="urutan" name="urutan[]" >
                    <div class="mb-3" id="urutan_gg">
                     
                      <span class="help-block text-danger urutan_err"></span>
                    </div>
                    
                  </div>

                  <div class="col-lg-3">
                    <label for="alamat" class="form-label">Posisi Gigi</label>
                      <select class="form-select" name="posisi[]" id="">
                        <option value="">Pilih...</option>
                        <option value="Kanan Atas">Kanan Atas</option> 
                        <option value="Kiri Atas">Kiri Atas</option> 
                        <option value="Kanan Bawah">Kanan Bawah</option> 
                        <option value="Kiri Bawah">Kiri Bawah</option> 
                        
                      </select>
                    <div class="mb-3" id="urutan_posisi">
                     
                      <span class="help-block text-danger _err"></span>
                    </div>

                    
                  </div>


                  <div class="col-lg-3">
                    <label for="alamat" class="form-label">Jenis Kerusakan</label>
                      <select class="form-select" name="jenis[]" id="jenis">
                        <option value="">Pilih...</option>
                        <option value="Caries">Caries</option> 
                        <option value="Impaksi">Impaksi</option> 
                        <option value="Karang">Karang</option> 
                        <option value="Missing">Missing</option> 
                        <option value="Palsu">Palsu</option> 
                        <option value="Plaque">Plaque</option> 
                        <option value="Pulpa">Pulpa</option> 
                        <option value="Radix">Radix</option> 
                        
                      </select>
                    <div class="mb-3" id="urutan_jenis">
                     
                      <span class="help-block text-danger _err"></span>
                    </div>

                    
                  </div>


              
                      <div class="row blocking2"></div>
                        
                        <div class="col-lg-12 text-end">
                          <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary me-3">Submit</button>
                          <button type="button" class="btn btn-warning me-1" id="add-input">Tambah Kolom</button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>





                <div class="modal fade" id="modal-pop-edit" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Data Booking Pasien</h4>
                      </div>

                        <form action="#" id="form_edit" class="row">
                
                @csrf
                                <input type="hidden" name="id" class="form-control">
      

                    <div class="col-lg-3">
                      <div class="mb-3">
                        <label for="alamat" class="form-label"> Nama Pasien </label>     
                        <input readonly type="text" class="form-control nama_pasien" >   
                    </div>
                   </div>

                   <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label"> No Rekam Medis</label>     
                      <input readonly type="text" class="form-control"  name="no_rkm_medis" >   
                      <span class="help-block text-danger no_rkm_medis_err"></span>
                  </div>
                 </div>

                 <div class="col-lg-3">
                  <div class="mb-3">
                    <label for="alamat" class="form-label"> No Rawat</label>     
                    <input readonly type="text" class="form-control" name="no_rawat" >   
                    <span class="help-block text-danger no_rkm_medis_err"></span>
                </div>
               </div>


                   <div class="col-lg-3">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">No Reg</label>
                      <input readonly type="text" class="form-control" name="no_reg"  >
                      <span class="help-block text-danger no_reg_err"></span>
                    </div>
                    
                  </div>
   
                   <div class="col-lg-3">
                    <label for="alamat"  class="form-label">Urutan Gigi</label>
                      <input type="text" class="form-control" placeholder="Urutan no" name="urutan" >
                     
                      <span class="help-block text-danger urutan_err"></span>

                    
                  </div>

                  <div class="col-lg-3">
                    <label for="alamat" class="form-label">Posisi Gigi</label>
                      <select class="form-select" name="posisi" >
                        <option value="">Pilih...</option>
                        <option value="Kanan Atas">Kanan Atas</option> 
                        <option value="Kiri Atas">Kiri Atas</option> 
                        <option value="Kanan Bawah">Kanan Bawah</option> 
                        <option value="Kiri Bawah">Kiri Bawah</option> 
                        
                      </select>
                     
                      <span class="help-block text-danger _err"></span>

                    
                  </div>


                  <div class="col-lg-3">
                    <label for="alamat" class="form-label">Jenis Kerusakan</label>
                      <select class="form-select" name="jenis">
                        <option value="">Pilih...</option>
                        <option value="Caries">Caries</option> 
                        <option value="Impaksi">Impaksi</option> 
                        <option value="Karang">Karang</option> 
                        <option value="Missing">Missing</option> 
                        <option value="Palsu">Palsu</option> 
                        <option value="Plaque">Plaque</option> 
                        <option value="Pulpa">Pulpa</option> 
                        <option value="Radix">Radix</option> 
                      </select>

                      <span class="help-block text-danger _err"></span>
                    
                  </div>


              
                      <div class="row blocking2"></div>
                        
                        <div class="col-12 text-end">
                          <button type="submit" id="btnSave2" onclick="save()" class="btn btn-primary me-3">Submit</button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>