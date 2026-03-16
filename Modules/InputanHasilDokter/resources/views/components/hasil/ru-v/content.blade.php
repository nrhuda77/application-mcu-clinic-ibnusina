
           
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                  <!-- About User -->
                  <div class="card mb-6">
                    <div class="card-body row">
                     <p class="card-text text-uppercase text-body-secondary small mb-0">Hasil Inputan Dokter Umum</p>
                          

                  <div class="row justify-content-center">

                            <input type="hidden" class="form-control no_rkm_medis" name="no_rkm_medis" value="{{ $reg->no_rkm_medis }}">                        
                               
                            <input type="hidden" class="form-control no_reg" name="no_reg" value="{{ $reg->no_reg }}">
      
                            <input type="hidden" class="form-control no_rawat" name="no_rawat" value="{{ $norawat }}" >
      
                     <div class="col-lg-6">

    <div class="row">

                  
            <div class="col-lg-6">
                   
              <div class="mb-3">
                <label for="alamat" class="form-label">Hasil Akhir</label>
               @php
    // Ambil nilai default dari database
    $selectedKesimpulan = old('kesimpulan', $data->kesimpulan ?? '');
    $selectedjenis = old('jenis', $data->jenis ?? '');
@endphp

<select class="form-select" name="jenis" id="jenis">
    <option value="" disabled {{ $selectedjenis == '' ? 'selected' : '' }}>-- Pilih --</option>
    <option value="p1" {{ $selectedjenis == 'p1' ? 'selected' : '' }}>P1</option>
    <option value="p2" {{ $selectedjenis == 'p2' ? 'selected' : '' }}>P2</option>
    <option value="p3" {{ $selectedjenis == 'p3' ? 'selected' : '' }}>P3</option>
    <option value="p4" {{ $selectedjenis == 'p4' ? 'selected' : '' }}>P4</option>
    <option value="p5" {{ $selectedjenis == 'p5' ? 'selected' : '' }}>P5</option>
    <option value="p6" {{ $selectedjenis == 'p6' ? 'selected' : '' }}>P6</option>
    <option value="p7" {{ $selectedjenis == 'p7' ? 'selected' : '' }}>P7</option>
</select>
   </div>
                  
            </div>
<div class="col-lg-6">
                   <label for="alamat" class="form-label">Kesimpulan</label>
              <div class="mb-3">
<select class="form-select" name="kesimpulan" id="kesimpulan">
    <option value="" disabled {{ $selectedKesimpulan == '' ? 'selected' : '' }}>-- Pilih --</option>
    <option value="Memenuhi Syarat" {{ $selectedKesimpulan == 'Memenuhi Syarat' ? 'selected' : '' }}>Memenuhi Syarat</option>
    <option value="Perlu Penyesuaian Pekerjaan" {{ $selectedKesimpulan == 'Perlu Penyesuaian Pekerjaan' ? 'selected' : '' }}>Perlu Penyesuaian Pekerjaan</option>
    <option value="Laik kerja dengan penyesuaian dan/atau pembatasan pekerjaan" {{ $selectedKesimpulan == 'Laik kerja dengan penyesuaian dan/atau pembatasan pekerjaan' ? 'selected' : '' }}>
        Laik kerja dengan penyesuaian dan/atau pembatasan pekerjaan
    </option>
    <option value="Tidak Memenuhi Syarat" {{ $selectedKesimpulan == 'Tidak Memenuhi Syarat' ? 'selected' : '' }}>Tidak Memenuhi Syarat</option>
   
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
                         <div class="col-lg-12">  <iframe id="pdfFrame" src="/pdf-preview-temuan-ruv/{{ $norawat }}"  width="100%" height="570px"></iframe></div>
                     <div class="col-lg-12">  <iframe id="pdfFrame2" src="/pdf-preview-saran-ruv/{{ $norawat }}"  width="100%" height="600px"></iframe>  </div>
                  
                      @else
                        
                      @endif
                     </div>

                  </div>
                    </div>
                    
              





                  </div>
                  <!--/ About User -->
                 
                </div>
              
              </div>