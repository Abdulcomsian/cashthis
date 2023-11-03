<div class="container">
    <div class="row">
        <input type="hidden" name="update-card-status-id" id="update-card-status-id" value="{{$card->id}}">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDisabled" id="card-status-pending" @if($card->status == \AppConst::PENDING) checked @endif>
            <label class="form-check-label" for="card-status-pending">
              Pending
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDisabled" id="card-status-completed" @if($card->status == \AppConst::COMPLETED) checked @endif>
            <label class="form-check-label" for="card-status-completed">
              Payment Sent
            </label>
          </div>
        <div>
            <button class="btn btn-primary edit-card-status">Update</button>
        </div>
    </div>
</div>