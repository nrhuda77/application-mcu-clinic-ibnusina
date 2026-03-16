@extends('layouts.main')

@section('content')
  
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
  

     <div class="content-wrapper blocking">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Header -->
              <div class="row">
                <div class="col-12">
                  <div class="card mb-6">
                    <div class="user-profile-header-banner">
                      {{-- <img src="../../assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" /> --}}
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-5">
                      <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img
                          src="https://i.pinimg.com/564x/57/00/c0/5700c04197ee9a4372a35ef16eb78f4e.jpg"
                          alt="user image"
                          width="100"
                          style=" border-style: solid; border-color:rgb(2, 163, 142); padding: 5px;"
                          class="d-block h-auto ms-0 ms-sm-6 rounded user-profile-img" />
                      </div>
                      <div class="flex-grow-1 mt-3 mt-lg-5">
                        <div
                          class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                          <div class="user-profile-info">
                            <h4 class="mb-2 mt-lg-6">{{$pasien->nm_pasien}}</h4>
                            <ul
                              class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 my-2">
                              <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class="icon-base ti tabler-ticket icon-lg"></i>
                                <span class="fw-medium">No Rekam Medis : {{$reg->no_rkm_medis}}</span>
                              </li>
                              <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class="icon-base ti tabler-article icon-lg"></i
                                ><span class="fw-medium">No Rawat : {{$reg->no_rawat}}</span>
                              </li>
                              <li class="list-inline-item d-flex gap-2 align-items-center">
                                <i class="icon-base ti tabler-square-asterisk icon-lg"></i
                                ><span class="fw-medium"> No Reg : {{$reg->no_reg}}</span>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Header -->

               <div class="row">
                <div class="col-md-12">
                  <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-sm-row mb-6 gap-sm-0 gap-2">

                         @if($data == null)
                          

                         <li class="nav-item">
                        <a class="nav-link active bg-danger" onclick="alerts2()"
                          ><i class="icon-base ti tabler-trash icon-sm me-1_5"></i> Hapus Data</a>
                      </li>
                      @else

                    
                         <li class="nav-item">
                        <a class="nav-link active bg-danger" onclick="hapus('{{ $no_rawat }}')"
                          ><i class="icon-base ti tabler-trash icon-sm me-1_5"></i> Hapus Data</a>
                      </li>

                        @endif
                     
                      
                   

                       <li class="nav-item">
                        <a class="nav-link active" href="/hasil-inputan-dokter-spirometri"
                          ><i class="icon-base ti tabler-arrow-left icon-sm me-1_5"></i> Kembali</a
                        >
                      </li>
      
                    </ul>
                  </div>
                </div>
              </div>
              
             <x-inputandokterspirometri::content :data="$data" :norawat="$no_rawat" :reg="$reg"></x-inputandokterspirometri::content>
         
            </div>
            <!-- / Content -->

      

          </div>


     <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
     <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
     <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
     <x-inputandokterspirometri::script :temuan="$data?->hasil" :saran="$data?->catatan_hasil" :norawat="$no_rawat" :reg="$reg"></x-inputandokterspirometri::script>


    
@endsection