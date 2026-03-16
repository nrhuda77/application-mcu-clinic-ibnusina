
              <div class="modal fade" id="modal-pop" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Pemeriksaan Non Lab</h4>
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
                            <input readonly  type="text" class="form-control" id="no_reg">
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


                                
                      <div class="col-lg-3">
                        <label for="alamat" class="form-label">Pemeriksaan USG</label>
                        <input type="text" class="form-control" name="usg" id="usg" value="Tidak Dilakukan">   
                          <span class="help-block text-danger usg_err"></span>
                        
                      </div>


                      
                      <div class="col-lg-3">
                        <label for="alamat" class="form-label">Pemeriksaan Radiologi</label>
                        <input type="text" class="form-control" name="radiologi" id="radiologi" value="Tidak Dilakukan">   
                          <span class="help-block text-danger radiologi_err"></span>
                        
                      </div>
                     


                      
                      <div class="col-lg-3">
                        <label for="alamat" class="form-label">Pemeriksaan EKG</label>
                        <input type="text" class="form-control" name="ekg" id="ekg" value="Tidak Dilakukan"> 
                          <span class="help-block text-danger ekg_err"></span>
                        
                      </div>
                     


                      
                      <div class="col-lg-3">
                        <label for="alamat" class="form-label">Pemeriksaan Treadmil</label>
                        <input type="text" class="form-control" name="treadmil" id="treadmil" value="Tidak Dilakukan"> 
          
                          <span class="help-block text-danger treadmil_err"></span>
                        
                      </div>
                     

                      
                      <div class="col-lg-3">
                        <label for="alamat" class="form-label">Pemeriksaan Audiometri</label>
                        <input type="text" class="form-control" name="audiometri" id="audiometri" value="Tidak Dilakukan"> 
                          <span class="help-block text-danger audiometri_err"></span>
                        
                      </div>
                     

                      
                      <div class="col-lg-3">
                        <label for="alamat" class="form-label">Pemeriksaan Spirometri</label>
                        <input type="text" class="form-control" name="spirometri" id="spirometri" value="Tidak Dilakukan"> 
                          {{-- <select class="form-select" name="spirometri" id="spirometri">
                            <option value="Tidak Dilakukan">Tidak Dilakukan</option> 
                            <option value="Dilakukan">Dilakukan</option> 
                          </select> --}}
          
                          <span class="help-block text-danger spirometri_err"></span>
                        
                      </div>
                     
                     
       
   
             
                      <div class="col-lg-3">
                        <label for="alamat" class="form-label">Pemeriksaan napfa</label>
                        <input type="text" class="form-control" name="napfa" id="napfa" value="Tidak Dilakukan"> 
                          <span class="help-block text-danger napfa_err"></span>
                        
                      </div>









                            </div>

                      

                
                                  
          
                      <div class="row blocking2"></div>
                        
                        <div class="col-lg-12 text-end">
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

                