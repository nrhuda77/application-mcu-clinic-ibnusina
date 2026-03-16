
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


                        @if ($url == 'detail-score-jakarta-cardiovascular' )
                          <x-scorepemeriksaan::part-modal.modal-jakarta-cardiovascular></x-scorepemeriksaan::part-modal.modal-jakarta-cardiovascular>
                        @elseif($url == 'detail-score-pemeriksaan-napfa' )
                          <x-scorepemeriksaan::part-modal.modal-pemeriksaan-napfa></x-scorepemeriksaan::part-modal.modal-pemeriksaan-napfa>
                        @endif
                                  
          
                      <div class="row blocking2"></div>
                        
                        <div class="col-12 text-end mt-5">
                          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary me-3">Submit </button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                        
                         </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->

                