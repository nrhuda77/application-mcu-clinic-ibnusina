
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

                      

                        @if ($url == 'detail-riwayat-kesehatan' )
                          <x-kuisoner::part-kuisoner.kesehatan></x-kuisoner::part-kuisoner.kesehatan>
                        @elseif($url == 'detail-riwayat-penyakit-keluarga')
                          <x-kuisoner::part-kuisoner.keluarga></x-kuisoner::part-kuisoner.keluarga>
                        @elseif($url == 'detail-riwayat-kebiasaan')
                          <x-kuisoner::part-kuisoner.kebiasaan></x-kuisoner::part-kuisoner.kebiasaan>
                        @elseif($url == 'detail-riwayat-imunisasi')
                          <x-kuisoner::part-kuisoner.imunisasi></x-kuisoner::part-kuisoner.imunisasi>
                        @elseif($url == 'detail-riwayat-paparan')
                          <x-kuisoner::part-kuisoner.paparan></x-kuisoner::part-kuisoner.paparan>
                        @endif
                                  
          
                      <div class="row blocking2"></div>
                        
                        <div class="col-lg-12 text-end">
                          <button type="button" id="btnSave2" onclick="save_kuisoner()" class="btn btn-primary me-3">Submit </button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                        
                         </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->

                