
                     <div class=" row">
                     
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
                            <input readonly  type="text" class="form-control no_reg" name="no_reg">
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

                        <div class="form-label text-primary mt-5 mb-2">GENITAL DAN ANUS</div>


                  <div class="col-lg-3">               
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Genitalia Externa</label>
                      <input type="text" class="form-control" value="Keadaan Normal" id="genitalia_externa" name="genitalia_externa" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                  </div>

                  
                  {{-- <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">R ectal Toucher</label>
                      <input type="text" class="form-control" value="Keadaan Normal"  id="rectal_toucher" name="rectal_toucher" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>                  
                  </div>


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Perianal</label>
                      <input type="text" class="form-control" value="Keadaan Normal"  id="perianal" name="perianal" >
                      <span class="help-block text-danger perianal_err"></span>
                    </div>                  
                  </div>      
                  
                  
                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Prosta (Laki Laki)</label>
                      <input type="text" class="form-control" value="Keadaan Normal"  id="prostat" name="prostat" >
                      <span class="help-block text-danger prostat_err"></span>
                    </div>                  
                  </div>     --}}
               
                  <div class="form-label text-primary mt-5 mb-2">VERTEBRA DAN EKSTREMITAS</div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Vertebra</label>
                      <input type="text" class="form-control" value="Keadaan Normal"  id="vertebra" name="vertebra" >
                      <span class="help-block text-danger vertebra_err"></span>
                    </div>                  
                  </div>      


                  {{-- <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Tinel Test</label>
                      <input type="text" class="form-control" value="Keadaan Normal" id="tinel_test" name="tinel_test" >
                      <span class="help-block text-danger tinel_test_err"></span>
                    </div>                  
                  </div>       --}}


                  <div class="form-label text-primary mt-5 mb-2">Ekstremitas</div>

                  
                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">ekestremitas Reflek Fisiologis</label>
                      <input type="text" class="form-control" value="Keadaan Normal" id="ekestremitas_reflek_fisiologis" name="ekestremitas_reflek_fisiologis" >
                      <span class="help-block text-danger ekestremitas_reflek_fisiologis_err"></span>
                    </div>                  
                  </div>    


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Ekestremitas Reflek Patologis</label>
                      <input type="text" class="form-control" value="Keadaan Normal" id="ekestremitas_reflek_patologis" name="ekestremitas_reflek_patologis" >
                      <span class="help-block text-danger ekestremitas_reflek_patologis_err"></span>
                    </div>                  
                  </div>    


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Fungsi Motorik Ekstrem Atas</label>
                      <input type="text" class="form-control" value="Keadaan Normal" id="fungsi_motorik_ekstrem_atas" name="fungsi_motorik_ekstrem_atas" >
                      <span class="help-block text-danger fungsi_motorik_ekstrem_atas_err"></span>
                    </div>                  
                  </div>  


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Fungsi Motorik Ekstrem Bawah</label>
                      <input type="text" class="form-control" value="Keadaan Normal" id="fungsi_motorik_ekstrem_bawah" name="fungsi_motorik_ekstrem_bawah" >
                      <span class="help-block text-danger fungsi_motorik_ekstrem_bawah_err"></span>
                    </div>                  
                  </div> 


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Ekestremitas Tonus Otot</label>
                      <input type="text" class="form-control" value="Keadaan Normal" id="ekestremitas_tonus_otot" name="ekestremitas_tonus_otot" >
                      <span class="help-block text-danger ekestremitas_tonus_otot_err"></span>
                    </div>                  
                  </div> 


                  {{-- <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Romberg Test</label>
                      <input type="text" class="form-control" value="Keadaan Normal" id="romberg_test" name="romberg_test" >
                      <span class="help-block text-danger romberg_test_err"></span>
                    </div>                  
                  </div> 


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Laseque Sign</label>
                      <input type="text" class="form-control" value="Keadaan Normal" id="laseque_sign" name="laseque_sign" >
                      <span class="help-block text-danger laseque_sign_err"></span>
                    </div>                  
                  </div>

                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kernig Sign</label>
                      <input type="text" class="form-control" value="Keadaan Normal" id="kernig_sign" name="kernig_sign" >
                      <span class="help-block text-danger kernig_sign_err"></span>
                    </div>                  
                  </div>  --}}

                  
                    </div> 