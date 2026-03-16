

              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                  <!-- About User -->
                  <div class="card mb-6">
                    <div class="card-body row">
                     <p class="card-text text-uppercase text-body-secondary small mb-0">Riwayat Paparan</p>

                 <div class="col-lg-6">
                      <ul class="list-unstyled my-3 py-1">
                      @foreach($riwayat as $key => $label)
                          <li class="d-flex align-items-center mb-4">
                               <i class="icon-base ti tabler-list-details icon-lg"></i>
                               <span class="fw-medium mx-2">{{ $label }}:</span>
                               <span clas="col-lg-12">{{ $data?->$key }}</span>
                          </li>
                        @endforeach
                      </ul>
                 </div>

                   <div class="col-lg-6">
                      <ul class="list-unstyled my-3 py-1">
                      @foreach($riwayat2 as $key => $label)
                          <li class="d-flex align-items-center mb-4">
                               <i class="icon-base ti tabler-list-details icon-lg"></i>
                               <span class="fw-medium mx-2">{{ $label }}:</span>
                               <span clas="col-lg-12">{{ $data?->$key }}</span>
                          </li>
                        @endforeach
                      </ul>
                 </div>

                 
                 
                    </div>
                    






             
                  </div>
                  <!--/ About User -->
                 
                </div>
              
              </div>