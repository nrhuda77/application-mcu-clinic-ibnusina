<style>
  .nav-link.active {
    background:  #2ac3b3 !important;
    color: white !important;
}

</style>
  <!-- Edit User Modal -->
              <div class="modal fade" id="modal-pop-kuisoner" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Kuisoner Pasien</h4>
                      </div>
                      <form id="form_kuisoner" class="row " >
                        @csrf


                <div class="row g-0 ">
                  <!-- Email Sidebar -->
                  <div class="col app-email-sidebar border-end flex-grow-0" id="app-email-sidebar">
  
                  <div class="d-flex justify-content-between flex-column mb-4 mb-md-0">
                    <ul class="nav nav-align-left nav-pills flex-column" id="pills-tab" role="tablist">

                      <li class="nav-item mb-1">
                        <a class="nav-link active" id="pills-kesehatan-tab" data-bs-toggle="pill" data-bs-target="#pills-kesehatan" type="button" role="tab" aria-controls="pills-kesehatan" aria-selected="true">
                          <i class="icon-base ti tabler-activity-heartbeat icon-sm me-1_5"></i>
                          <span class="align-middle">Riwayat Kesehatan</span>
                        </a>
                      </li>
                      <li class="nav-item mb-1">
                        <a class="nav-link" id="pills-penyakit-keluarga-tab" data-bs-toggle="pill" data-bs-target="#pills-penyakit-keluarga" type="button" role="tab" aria-controls="pills-penyakit-keluarga" aria-selected="false">
                          <i class="icon-base ti tabler-dna-2 icon-sm me-1_5"></i>
                          <span class="align-middle">Riwayat Penyakit Keluarga</span>
                        </a>
                      </li>
                      <li class="nav-item mb-1">
                        <a class="nav-link" id="pills-kebiasaan-tab" data-bs-toggle="pill" data-bs-target="#pills-kebiasaan" type="button" role="tab" aria-controls="pills-kebiasaan" aria-selected="false">
                          <i class="icon-base ti tabler-trekking icon-sm me-1_5"></i>
                          <span class="align-middle">Riwayat Kebiasaan</span>
                        </a>
                      </li>
                      <li class="nav-item mb-1">
                        <a class="nav-link" id="pills-imunisasi-tab" data-bs-toggle="pill" data-bs-target="#pills-imunisasi" type="button" role="tab" aria-controls="pills-imunisasi" aria-selected="false">
                          <i class="icon-base ti tabler-vaccine icon-sm me-1_5"></i>
                          <span class="align-middle">Riwayat Imunisasi</span>
                        </a>
                      </li>
                      <li class="nav-item mb-1">
                        <a class="nav-link"id="pills-paparan-tab" data-bs-toggle="pill" data-bs-target="#pills-paparan" type="button" role="tab" aria-controls="pills-paparan" aria-selected="false">
                          <i class="icon-base ti tabler-radioactive icon-sm me-1_5"></i>
                          <span class="align-middle">Riwayat Paparan</span>
                        </a>
                      </li>

                    </ul>
                  </div>

                    <!-- Email Filters -->
                   
                  </div>
                 
                  <!--/ Email Sidebar -->


                  
                  <div class="col app-emails-list">
                   <hr class="mx-n3 emails-list-header-hr" />
                         <div class="tab-content" id="pills-tabContent" style="max-height: min(500px, 50vh); overflow-y: auto;">

                         
                          <x-registrasiperiksa::modal.part-kuisoner.kesehatan></x-registrasiperiksa::modal.part-kuisoner.kesehatan>
                          <x-registrasiperiksa::modal.part-kuisoner.keluarga></x-registrasiperiksa::modal.part-kuisoner.penyakit-keluarga>
                          <x-registrasiperiksa::modal.part-kuisoner.kebiasaan></x-registrasiperiksa::modal.part-kuisoner.kebiasaan>
                          <x-registrasiperiksa::modal.part-kuisoner.imunisasi></x-registrasiperiksa::modal.part-kuisoner.imunisasi>
                          <x-registrasiperiksa::modal.part-kuisoner.paparan></x-registrasiperiksa::modal.part-kuisoner.paparan>

                      </div>
                  </div>

                      <div class="row blocking2"></div>
                        
                        <div class="col-lg-12 text-end">
                          <button type="button" id="btnSave2" onclick="save_kuisoner()" class="btn btn-primary me-3">Submit</button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                        
                         </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->

                