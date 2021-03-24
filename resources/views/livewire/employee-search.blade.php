<div>
    <input type="text" wire:model="query" name='{{ $field }}' class="form-control form-control-sm">
</div>
@if(!empty($query))
<div class="position-absolute list-group">
    @if(!empty($result))
        @foreach ($result as $empl)
            <div class="list-group-item">{{ $empl['surname'] }}</div>
        @endforeach
    @endif
</div>

@endif