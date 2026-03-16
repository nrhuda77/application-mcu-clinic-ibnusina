<div class="row row-cols-1 row-cols-md-3 g-6 mb-12">
               
               
               
                @foreach ($berkas as $b )
                    @php
                        $mstr = DB::table('master_berkas_digital')->where('kode', $b->kode)->first();
                    @endphp
                    
                   <div class="col">
                    <div class="card">
                    <div class="d-flex flex-md-row flex-column">
                      <div>
                        <img class="card-img card-img-left" src="/gambar-pemeriksaan/{{ Crypt::encrypt($b->lokasi_file) }}" alt="Card image">
                      </div>
                      <div>
                        <div class="card-body">
                          <h5 class="card-title">{{$mstr->nama}}</h5>
                           <p class="card-text d-flex justify-content-end gap-1">
                        <a class="btn btn-warning btn-sm text-white" onclick="edit('{{ Crypt::encrypt($b->lokasi_file) }}')">Edit</a>
                        <a class="btn btn-danger btn-sm text-white" onclick="hapus('{{ Crypt::encrypt($b->lokasi_file) }}')">Hapus</a>
                      </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- <div class="card h-80">
                    <img class="card-img-top" src="/gambar-pemeriksaan/{{ Crypt::encrypt($b->lokasi_file) }}" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">{{$mstr->nama}}</h5>
                      <p class="card-text d-flex justify-content-end gap-1">
                        <a class="btn btn-warning btn-sm text-white">Edit</a>
                        <a class="btn btn-danger btn-sm text-white">Hapus</a>
                      </p>
                    </div>
                  </div> --}}
                </div>
                @endforeach
               
                
           
              </div>