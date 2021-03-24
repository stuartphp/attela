{{-- allow only numbers in input --}}
<input type="text" name="id_number" id="id_number" class="form-control form-control-sm"
onkeyup="this.value=this.value.replace(/[^\d]/,'')" required>
{{-- allow only decimal in input --}}
<input type="text" class="form-control form-control-sm text-right" id="private_contribution" name="private_contribution"
onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')" value="0.00">
{{-- Check box --}}
<div class="form-check">
    <input type="checkbox" name="is_asylum_seeker" id="is_asylum_seeker" class="form-check-input"
    onclick="$('.asylum').toggle()" @if($data->is_asylum_seeker==1) checked @endif>
</div>


{{-- Javascript --}}

# alert object
alert(alert(JSON.stringify(OBJECT, null, 4)));

{{--  Ajax --}}
$.ajax({
    url: "/human-resource/employee-jobs/"+id,
    method:'POST',
    data: new FormData(this),
    processData:false,
    contentType: false,
    cache: false,
    dataType: 'JSON',
    success: function(response)
    {
        if(response.success){
            $('#form_jobs').toggle();
            $('.card-header').html(add);

            notice('success', '{{__('global.record_updated')}}');
            $('#jobsTable').DataTable().ajax.reload(null, false);
        }else{
            let err='<ul class="text-start">';
            for(let i=0; i<response.length; i++)
            {
                err += "<li>"+response[i]+"</li>";
            }
            err +="</ul>";
            notice('error', '{{__('global.error_update')}}', err);
        }
    }
});
