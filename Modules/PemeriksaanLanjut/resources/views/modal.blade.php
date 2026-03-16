
              <div class="modal fade" id="modal-pop" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title"></h4>
                      </div>
                      <form id="form" class="" >
                        @csrf


                       <div class="row g-0 ">

                      

                        @if ($url == 'detail-fisik-kulit-mata' )
                          <x-pemeriksaanlanjut::part-modal.modal-fisik></x-pemeriksaanlanjut::part-modal.modal-fisik>
                        @elseif($url == 'detail-vital-kondisi-umum' )
                          <x-pemeriksaanlanjut::part-modal.modal-vital></x-pemeriksaanlanjut::part-modal.modal-vital>
                        @elseif($url == 'detail-genital-anus')
                          <x-pemeriksaanlanjut::part-modal.modal-genital></x-pemeriksaanlanjut::part-modal.modal-genital>
                        @elseif($url == 'detail-thoraks-abdomen')
                          <x-pemeriksaanlanjut::part-modal.modal-thorack></x-pemeriksaanlanjut::part-modal.modal-thorack>
                        @endif
                                  
          
                      <div class="row blocking2"></div>
                        
                        <div class="col-12 text-end">
                          <button type="button" id="btnSave2" onclick="save()" class="btn btn-primary me-3">Submit </button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                        
                         </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->

                