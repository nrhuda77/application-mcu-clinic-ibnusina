
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

                        <div class="col-lg-3">               
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Tekanan Darah</label>
                      <input  type="text" class="form-control" placeholder="mmHg"  id="tekanan_darah" name="tekanan_darah" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>
                  </div>

                  
                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Nadi</label>
                      <input type="text" class="form-control" placeholder="x/m"  id="nadi" name="nadi" >
                      <span class="help-block text-danger kode_kota_err"></span>
                    </div>                  
                  </div>


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Pernafasan</label>
                      <input type="text" class="form-control" placeholder="x/m" id="pernafasan" name="pernafasan" >
                      <span class="help-block text-danger pernafasan_err"></span>
                    </div>                  
                  </div>                   
               


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Suhu</label>
                      <input type="text" class="form-control" placeholder="°C" id="suhu" name="suhu" >
                      <span class="help-block text-danger suhu_err"></span>
                    </div>                  
                  </div>      


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">SP02</label>
                      <input type="text" class="form-control" placeholder="%" id="spo2" name="spo2" >
                      <span class="help-block text-danger spo2_err"></span>
                    </div>                  
                  </div>      



                  
                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Kondisi Umum</label>
                      <input type="text" class="form-control" id="kondisi_umum" name="kondisi_umum" >
                      <span class="help-block text-danger kondisi_umum_err"></span>
                    </div>                  
                  </div>    


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Tinggi Badan</label>
                      <input type="text" class="form-control" placeholder="cm" id="tinggi_badan" name="tinggi_badan" oninput="calculateBMI()" >
                      <span class="help-block text-danger tinggi_badan_err"></span>
                    </div>                  
                  </div>    


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Berat Badan</label>
                      <input type="text" class="form-control" placeholder="kg" id="berat_badan" name="berat_badan" oninput="calculateBMI()" >
                      <span class="help-block text-danger berat_badan_err"></span>
                    </div>                  
                  </div>  


                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Lingkar Perut</label>
                      <input type="text" class="form-control" placeholder="cm" id="lingkar_perut" name="lingkar_perut" >
                      <span class="help-block text-danger lingkar_perut_err"></span>
                    </div>                  
                  </div> 


                  <div class="col-lg-3" style="display:none;">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Lingkar Panggul</label>
                      <input type="text" class="form-control" placeholder="cm" value="0" id="lingkar_panggul" name="lingkar_panggul" >
                      <span class="help-block text-danger lingkar_panggul_err"></span>
                    </div>                  
                  </div> 


                  <div class="col-lg-3" style="display:none;">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">RLPP</label>
                      <input type="text" class="form-control" placeholder="cm" value="0"  id="rlpp" name="rlpp" >
                      <span class="help-block text-danger rlpp_err"></span>
                    </div>                  
                  </div> 



                  <div class="col-lg-3">
                    <div class="mb-3">
                      <label for="alamat" class="form-label">BMI</label>
                      <input type="text" class="form-control" placeholder="Kg/m2" id="bmi" name="bmi" >
                      <span class="help-block text-danger bmi_err"></span>
                    </div>                  
                  </div> 

                    </div> 