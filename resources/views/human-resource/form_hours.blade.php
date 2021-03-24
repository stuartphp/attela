<br>
<form method="post" id="form_hours" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" id="method">


<div class="modal-footer">
    <button type="submit" class="btn btn-outline-primary btn-sm" >{{ __('global.save') }}</button>
</div>
</form>
