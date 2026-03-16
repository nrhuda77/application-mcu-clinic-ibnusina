
             

           
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                  <!-- About User -->
                  <div class="card mb-6">
                    <div class="card-body row">
                     <p class="card-text text-uppercase text-body-secondary small mb-0">Pemeriksaan Genital, Anus , Extremitas</p>

                 <div class="col-12">
                      <ul class="list-unstyled my-3 py-1">
                      @foreach($pemeriksaan as $key => $label)
                          <li class="d-flex align-items-center mb-4">
                               <i class="icon-base ti tabler-list-details icon-lg"></i>
                               <span class="fw-medium mx-2">{{ $label }}:</span>
                               <span clas="col-12">{{ $data?->$key }}</span>
                          </li>
                        @endforeach
                      </ul>
                 </div>           
                 
                    </div>
                    
              





                  </div>
                  <!--/ About User -->
                 
                </div>
              
              </div>