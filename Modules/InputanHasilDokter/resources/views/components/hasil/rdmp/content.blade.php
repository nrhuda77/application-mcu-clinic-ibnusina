
           
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                  <!-- About User -->
                  <div class="card mb-6">
                    <div class="card-body row">
                     <p class="card-text text-uppercase text-body-secondary small mb-0">Hasil Inputan Dokter RDMP</p>
                          

                  <div class="row justify-content-center">

                            <input type="hidden" class="form-control no_rkm_medis" name="no_rkm_medis" value="{{ $reg->no_rkm_medis }}">                        
                               
                            <input type="hidden" class="form-control no_reg" name="no_reg" value="{{ $reg->no_reg }}">
      
                            <input type="hidden" class="form-control no_rawat" name="no_rawat" value="{{ $norawat }}" >
      
                     <div class="col-lg-6">

                       <div class="row">

                        <div class="col-lg-6">
                   
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Hasil Kategori</label>
                      @php
    $selectedKategori = old('jenis', $data->jenis ?? '');
@endphp

<select class="form-select" name="jenis" id="jenis">
    <option value="" disabled {{ $selectedKategori == '' ? 'selected' : '' }}>-- Pilih --</option>
    <option value="p1" {{ $selectedKategori == 'p1' ? 'selected' : '' }}>P1</option>
    <option value="p2" {{ $selectedKategori == 'p2' ? 'selected' : '' }}>P2</option>
    <option value="p3" {{ $selectedKategori == 'p3' ? 'selected' : '' }}>P3</option>
    <option value="p4" {{ $selectedKategori == 'p4' ? 'selected' : '' }}>P4</option>
    <option value="p5" {{ $selectedKategori == 'p5' ? 'selected' : '' }}>P5</option>
    <option value="p6" {{ $selectedKategori == 'p6' ? 'selected' : '' }}>P6</option>
    <option value="p7" {{ $selectedKategori == 'p7' ? 'selected' : '' }}>P7</option>
</select>

                      <span class="help-block text-danger jenis_err"></span>
                    </div>
                        
                  </div>



                  
            <div class="col-lg-6">
                   
              <div class="mb-3">
                <label for="alamat" class="form-label">Hasil Akhir</label>
               @php
    // Ambil nilai default dari database
    $selectedKesimpulan = old('kesimpulan', $data->kesimpulan ?? '');
@endphp

<select class="form-select" name="kesimpulan" id="kesimpulan">
    <option value="" disabled {{ $selectedKesimpulan == '' ? 'selected' : '' }}>-- Pilih --</option>
    <option value="Laik kerja" {{ $selectedKesimpulan == 'Laik kerja' ? 'selected' : '' }}>Laik kerja</option>
    <option value="Laik kerja dengan catatan" {{ $selectedKesimpulan == 'Laik kerja dengan catatan' ? 'selected' : '' }}>Laik kerja dengan catatan</option>
    <option value="Laik kerja dengan penyesuaian dan/atau pembatasan pekerjaan" {{ $selectedKesimpulan == 'Laik kerja dengan penyesuaian dan/atau pembatasan pekerjaan' ? 'selected' : '' }}>
        Laik kerja dengan penyesuaian dan/atau pembatasan pekerjaan
    </option>
    <option value="Tidak laik kerja sementara" {{ $selectedKesimpulan == 'Tidak laik kerja sementara' ? 'selected' : '' }}>Tidak laik kerja sementara</option>
    <option value="Tidak laik kerja" {{ $selectedKesimpulan == 'Tidak laik kerja' ? 'selected' : '' }}>Tidak laik kerja</option>
</select>

                <span class="help-block text-danger kesimpulan_err"></span>
              </div>
                  
            </div>
             </div>

                           <div class="col-lg-12">
                        <div class="mb-3">
                          <label for="alamat" class="form-label">Temuan</label>
                          <textarea class="form-control " name="temuan" id="summernote" cols="50" rows="10" placeholder="Tuliskan Temuan di sini..."> {{ old('temuan', $data?->temuan) }}</textarea>
                          <span class="help-block text-danger no_reg_err"></span>
                        </div>
                        
                      </div>

                         <div class="col-lg-12">
                        <div class="mb-3">
                          <label for="alamat" class="form-label">Saran</label>
                          <textarea class="form-control " name="saran" id="summernote2" cols="50" rows="10" placeholder="Tuliskan Saran di sini...">{{ old('saran', $data?->saran) }}</textarea>
                          <span class="help-block text-danger no_reg_err"></span>
                        </div>
                        
                      </div>


                     </div>

                     <div class="col-lg-6">  
                      
                      @if ($data != null)
                         <div class="col-lg-12">  <iframe id="pdfFrame" src="/pdf-preview-temuan-rdmp/{{ $norawat }}"  width="100%" height="570px"></iframe></div>
                     <div class="col-lg-12">  <iframe id="pdfFrame2" src="/pdf-preview-saran-rdmp/{{ $norawat }}"  width="100%" height="600px"></iframe>  </div>
                  
                      @else
                        
                      @endif
                     </div>

                  </div>
                    </div>
                    
              





                  </div>
                  <!--/ About User -->
                 
                </div>
              
              </div>