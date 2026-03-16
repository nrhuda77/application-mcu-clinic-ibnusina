
           
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                  <!-- About User -->
                  <div class="card mb-6">
                    <div class="card-body row">
                     <p class="card-text text-uppercase text-body-secondary small mb-0">Hasil Inputan Elektro Kardiogram</p>
                          

                  <div class="row justify-content-center">

                            <input type="hidden" class="form-control no_rkm_medis" name="no_rkm_medis" value="{{ $reg->no_rkm_medis }}">                        
                               
                            <input type="hidden" class="form-control no_reg" name="no_reg" value="{{ $reg->no_reg }}">
      
                            <input type="hidden" class="form-control no_rawat" name="no_rawat" value="{{ $norawat }}" >
      
                     <div class="col-lg-6">





                           <div class="col-lg-12">
                        <div class="mb-3">
                          <label for="alamat" class="form-label">Temuan</label>
                          <textarea class="form-control " name="temuan" id="summernote" cols="50" rows="10" placeholder="Tuliskan Temuan di sini..."> {{ old('hasil', $data?->hasil) }}</textarea>
                          <span class="help-block text-danger no_reg_err"></span>
                        </div>
                        
                      </div>



                     </div>

                     <div class="col-lg-6">  
                      
                      @if ($data != null)
                    
                     <div class="col-lg-12"> <iframe id="pdfFrame" src="/pdf-preview-temuan-elektrokardiogram/{{ $norawat }}"  width="100%" height="600px"></iframe>  </div>
                  
                      @else
                        
                      @endif
                     </div>

                  </div>
                    </div>
                    
              





                  </div>
                  <!--/ About User -->
                 
                </div>
              
              </div>