
           
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
                      <label for="alamat" class="form-label">Hasil Kategori</label>
                      @php
    $selectedKategori = old('hasil_kategori', $data->hasil_kategori ?? '');
@endphp

<select class="form-select" name="hasil_kategori" id="hasil_kategori">
    <option value="" disabled {{ $selectedKategori == '' ? 'selected' : '' }}>-- Pilih --</option>
    <option value="M1A" {{ $selectedKategori == 'M1A' ? 'selected' : '' }}>Tidak ditemukan problem kesehatan</option>
    <option value="M1B" {{ $selectedKategori == 'M1B' ? 'selected' : '' }}>Ditemukan problem kesehatan yang tidak serius</option>
    <option value="M2" {{ $selectedKategori == 'M2' ? 'selected' : '' }}>Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko rendah</option>
    <option value="M3A" {{ $selectedKategori == 'M3A' ? 'selected' : '' }}>Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko sedang</option>
    <option value="M3B" {{ $selectedKategori == 'M3B' ? 'selected' : '' }}>Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko tinggi</option>
    <option value="M4" {{ $selectedKategori == 'M4' ? 'selected' : '' }}>Ditemukan keterbatasan fisik untuk melakukan pekerjaan secara normal, hanya cocok untuk pekerjaan ringan</option>
    <option value="M5" {{ $selectedKategori == 'M5' ? 'selected' : '' }}>Dalam perawatan di rumah sakit atau dalam kondisi yang tidak memungkinkan untuk melakukan pekerjaan (status izin sakit)</option>
</select>

                      <span class="help-block text-danger hasil_kategori_err"></span>
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
    <option value="fit" {{ $selectedKesimpulan == 'fit' ? 'selected' : '' }}>FIT</option>
    <option value="unfit" {{ $selectedKesimpulan == 'unfit' ? 'selected' : '' }}>UNFIT</option>
    <option value="temporary unfit" {{ $selectedKesimpulan == 'temporary unfit' ? 'selected' : '' }}>TEMPORARY UNFIT </option>
 </select>

                <span class="help-block text-danger kesimpulan_err"></span>
              </div>
                  
            </div>
             </div>

                           <div class="col-lg-12">
                        <div class="mb-3">
                          <label for="alamat" class="form-label">Temuan</label>
                          <textarea class="form-control " name="temuan" id="summernote" cols="50" rows="10" placeholder="Tuliskan Temuan di sini..."> {{ old('hasil', $data?->hasil) }}</textarea>
                          <span class="help-block text-danger no_reg_err"></span>
                        </div>
                        
                      </div>

                         <div class="col-lg-12">
                        <div class="mb-3">
                          <label for="alamat" class="form-label">Saran</label>
                          <textarea class="form-control " name="saran" id="summernote2" cols="50" rows="10" placeholder="Tuliskan Saran di sini...">{{ old('catatan_hasil', $data?->catatan_hasil) }}</textarea>
                          <span class="help-block text-danger no_reg_err"></span>
                        </div>
                        
                      </div>


                     </div>

                     <div class="col-lg-6">  
                      
                      @if ($data != null)
                         <div class="col-lg-12">  <iframe id="pdfFrame" src="/pdf-preview-temuan-umum/{{ $norawat }}"  width="100%" height="570px"></iframe></div>
                     <div class="col-lg-12">  <iframe id="pdfFrame2" src="/pdf-preview-saran-umum/{{ $norawat }}"  width="100%" height="600px"></iframe>  </div>
                  
                      @else
                        
                      @endif
                     </div>

                  </div>
                    </div>
                    
              





                  </div>
                  <!--/ About User -->
                 
                </div>
              
              </div>