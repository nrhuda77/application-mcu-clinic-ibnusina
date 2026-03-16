
             

           
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                  <!-- About User -->
                  <div class="card mb-6">
                    <div class="card-body row">
                     <p class="card-text text-uppercase text-body-secondary small mb-0">Riwayat Registrasi</p>

                 <div class="col-12">
                     <div class="table-responsive text-nowrap mt-5">
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>No Rawat</th>
                        <th>No Registrasi</th>
                        <th>Dokter</th>
                        <th>Waktu Registrasi</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($reg as $r )
                        @php
                            $dr = DB::table('dokter')->where('kd_dokter', $r->kd_dokter)->first();
                            $rks = DB::table('riwayat_kesehatan_mcu')->where('no_rawat', $r->no_rawat)->first();
                            $no_rawat = Crypt::encrypt($r->no_rawat);
                        @endphp
                        <tr>
                        <td>{{ $r->no_rawat }}</td>
                        <td>{{ $r->no_reg }}</td>
                        <td>{{ $dr->nm_dokter }}</td>
                        <td>{{ $r->tgl_registrasi }} <br> {{ $r->jam_reg }}</td>
                        @if($rks == null)
                           <td> <span class="badge bg-label-danger me-1">Kuisoner Kosong</span></td>
                           <td> <a class="btn btn-primary btn-sm text-white" onclick="kuisoner('{{ $no_rawat }}')">Isi Kuisoner</a> </td>
                           @else
                           <td> <span class="badge bg-label-success me-1">Kuisoner Sudah Di Isi</span></td> 
                           <td> <a class="btn btn-warning btn-sm text-white" onclick="kuisoner('{{ $no_rawat }}')">Cek Kuisoner</a> </td>
                        @endif

                        
                        
             
                      </tr>
                        @endforeach
                   
                      
                      


              
                    </tbody>
                  </table>
                </div>
                 </div>           
                 
                    </div>
           



                  </div>
                  <!--/ About User -->
                 
                </div>
              
              </div>