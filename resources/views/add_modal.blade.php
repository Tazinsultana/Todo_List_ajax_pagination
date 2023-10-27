  <!-- Modal -->
  <div class="modal fade" id="addmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <form action=""method="post" id="add">
          @csrf
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Create To Do List</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <div class="errMsgContainer">

                     </div>
                    {{-- <input type="hidden" name="modal_id" value=""> --}}
                     
                    <div class="mb-3">
                          <label for="title" class="form-label">Title</label>
                          <input type="text" class="form-control" id="title" name="title">
                      </div>

                      <div class="mb-3 form-check">
                          <input name="is_active" type="checkbox" class="form-check-input"  id="is_active">
                          <label class="form-check-label" for="is_active">Is Active?</label>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary add_lst">Save</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
