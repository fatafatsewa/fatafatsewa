<div class="modal fade" id="applyEmiDialog" tabindex="-1" role="dialog" aria-labelledby="applyEmiDialogTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="form-apply--emi">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Apply EMI</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body emi--modal--body">
          <div id="error-wrapper"></div>

          <input type="hidden" name="_token" id="emi-token" value="{{ csrf_token() }}">
          <input type="hidden" name="product_id" value="{{ $result['detail']['product_data'][0]->id }}"
            id="emi-product-id">
          <div class="form-group">
            <label for="">Full Name</label>
            <input type="text" class="form-control" placeholder="Full Name" required name="full_name"
              id="emi-full-name">
          </div>
          <div class="form-group">
            <label for="">Email Address</label>
            <input type="email" id="emi-email" class="form-control" placeholder="Email Address" required name="email">
          </div>
          <div class="form-group">
            <label for="">Bank</label>
            <select name="bank" id="emi-bank" class="form-control" required>
              <option value=""></option>
              @foreach ($result['banks'] as $bank)
                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">EMI Type</label>
            <select name="emi_type" id="emi-type" class="form-control" required>
              <option value=""></option>
              <option value="Loan">Loan</option>
              <option value="Card">Card</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn--submit-emi-apply">Apply</button>
        </div>
      </form>
    </div>
  </div>
</div>
