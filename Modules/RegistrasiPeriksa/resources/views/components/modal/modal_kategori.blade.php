
  <!-- Edit User Modal -->
              <div class="modal fade" id="modal-pop-kategori" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Kuisoner Pasien</h4>
                      </div>
                      <form id="form_kategori" class="row " >
          
                   @csrf
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="alamat" class="form-label"> No Rekam Medis </label>
                                <input readonly  type="text" class="form-control" name="no_rkm_medis"   >
                          <span class="help-block text-danger no_rkm_meds_err"></span>
                      </div>
                     </div>


                     <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="alamat" class="form-label"> No Rawat </label>
                              <input readonly  type="text" class="form-control" name="no_rawat"   >
                        <span class="help-block text-danger no_rkm_meds_err"></span>
                    </div>
                   </div>

                  <div class="col-lg-12">    
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kategori Mcu</label>
                      <select class="form-select" name="kategori" id="kategori">   
                        {{-- <option value="" disabled selected hidden>Pilih</option>                       --}}
                        <option value="Pre Employment"  selected >Pre Employment / calon karyawan</option>   
                        <option value="Pre-retirement">Pre-retirement / Pra Pensiun</option>     
                        <option value="Reguler">Reguler / Pemeriksaan Kesehatan</option>  
                        <option value="Follow Up">Follow Up</option>  
                        <option value="RDMP">RDMP</option> 
                        <option value="RU V">RU V</option>  
                        <option value="lain-lainnya">lain-lainnya</option>    
                     </select>
                      <span class="help-block text-danger stts_err"></span>
                    </div>
                  </div>


                      <div class="row blocking2"></div>
                        
                        <div class="col-lg-12 text-end">
                          <button type="button" id="btnSave3" onclick="save_kategori()" class="btn btn-primary me-3">Submit</button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->

                