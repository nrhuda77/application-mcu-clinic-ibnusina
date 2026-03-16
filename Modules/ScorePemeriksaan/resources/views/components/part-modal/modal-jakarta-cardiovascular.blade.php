
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
                            <input readonly  type="text" class="form-control no_reg" >
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


                      

                      <div class="col-lg-3 mb-3" style="border: 2px solid rgb(117, 112, 112); padding-bottom: 20px; border-radius: 20px ">
                        <label for="alamat" class="form-label">Sex</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
             
                          </select>
                          <span class="help-block text-danger gender_err"></span>

                          <label for="alamat" class="form-label">Score</label>
                          <input value="1" type="text" name="score_gender" readonly class="form-control"  id="score_gender">
                          <span class="help-block text-danger score_gender_err"></span>
                      </div>


                      
                      <div class="col-lg-3 mb-3" style="border: 2px solid rgb(117, 112, 112); padding-bottom: 20px; border-radius: 20px ">
                        <label for="alamat" class="form-label">Age</label>
                        <select name="age" id="age" class="form-control">
                            <option value="25-34">25-34</option>
                            <option value="35-39">35-39</option>
                            <option value="40-44">40-44</option>
                            <option value="45-49">45-49</option>
                            <option value="50-54">50-54</option>
                            <option value="55-59">55-59</option>
                            <option value="60-64">60-64</option>
             
                          </select>
                          <span class="help-block text-danger age_err"></span>

                          <label for="alamat" class="form-label">Score</label>
                          <input value="-4" type="text" name="score_age" readonly class="form-control"  id="score_age">
                          <span class="help-block text-danger score_age_err"></span>
                      </div>
                     


                      
                      <div class="col-lg-3 mb-3" style="border: 2px solid rgb(117, 112, 112); padding-bottom: 20px; border-radius: 20px ">
                        <label for="alamat" class="form-label">Age</label>
                        <select name="blood_presure" id="blood_presure" class="form-control">
                            <option value="Normal (<130/<85)">Normal (&lt;130/&lt;85)</option>
                            <option value="High Normal (130-139/85-89)">High Normal(130-139/85-89)</option>
                            <option value="Grade 1 HT (140-159/90-99)">Grade 1 HT (140-159/90-99)</option>
                            <option value="Grade 2 HT (160-179/100-109)">Grade 2 HT (160-179/100-109)</option>
                            <option value="Grade 3 HT (>180/>110)">Grade 3 HT (&gt;180/&gt;110)</option>

             
                          </select>
                          <span class="help-block text-danger blood_presure_err"></span>

                          <label for="alamat" class="form-label">Score</label>
                          <input value="0" type="text" name="score_blood_presure" readonly class="form-control"  id="score_blood_presure">
                          <span class="help-block text-danger score_blood_presure_err"></span>
                      </div>
                     

                      <div class="col-lg-3 mb-3" style="border: 2px solid rgb(117, 112, 112); padding-bottom: 20px; border-radius: 20px ">
                        <label for="alamat" class="form-label">BMI</label>
                        <select name="bmi" id="bmi" class="form-control">
                            <option value="13.79-25.99">13.79-25.99</option>
                            <option value="26.00-29.99">26.00-29.99</option>
                            <option value="30.00-35.58">30.00-35.58</option>
                          </select>
                          <span class="help-block text-danger bmi_err"></span>

                          <label for="alamat" class="form-label">Score</label>
                          <input value="0" type="text" name="score_bmi" readonly class="form-control"  id="score_bmi">
                          <span class="help-block text-danger score_bmi_err"></span>
                      </div>


                      
                      <div class="col-lg-3 mb-3" style="border: 2px solid rgb(117, 112, 112); padding-bottom: 20px; border-radius: 20px ">
                        <label for="alamat" class="form-label">Smoking</label>
                        <select name="smoking" id="smoking" class="form-control">
                            <option value="Never">Never</option>
                            <option value="Ex-Smoker">Ex-Smoker</option>
                            <option value="Smoker">Smoker</option>
                          </select>
                          <span class="help-block text-danger smoking_err"></span>

                          <label for="alamat" class="form-label">Score</label>
                          <input value="0" type="text" name="score_smoking" readonly class="form-control"  id="score_smoking">
                          <span class="help-block text-danger score_smoking_err"></span>
                      </div>
                     

                      
                      <div class="col-lg-3 mb-3" style="border: 2px solid rgb(117, 112, 112); padding-bottom: 20px; border-radius: 20px ">
                        <label for="alamat" class="form-label">Diabetes Melitus</label>
                        <select name="diabetes" id="diabetes" class="form-control">
                    
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                          </select>
                          <span class="help-block text-danger diabetes_err"></span>

                          <label for="alamat" class="form-label">Score</label>
                          <input value="0" type="text" name="score_diabetes" readonly class="form-control"  id="score_diabetes">
                          <span class="help-block text-danger score_diabetes_err"></span>
                      </div>
                     

                      
                      <div class="col-lg-3 mb-3" style="border: 2px solid rgb(117, 112, 112); padding-bottom: 20px; border-radius: 20px ">
                        <label for="alamat" class="form-label">Physical Exercise/Activity</label>
                        <select name="activity" id="activity" class="form-control">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                            <option value="No">No</option>
                          </select>
                          <span class="help-block text-danger activity_err"></span>

                          <label for="alamat" class="form-label">Score</label>
                          <input value="-3" type="text" name="score_activity" readonly class="form-control"  id="score_activity">
                          <span class="help-block text-danger score_activity_err"></span>
                      </div>
                        
                    
                     
                      <div class="col-lg-8 mb-3">
                        <label for="alamat" class="form-label">Score All</label>
                      <input type="text" name="score_all" id="score_all" class="form-control score_all" >
                    </div>

                    
                      <div id="total" class="btn btn-primary text-center" >
                       
                      </div>

                  
                    </div> 