<div>
    <div class="head mb-1 ms-2 me-2">
        {{ __('customers.title') }}<span style="float:right"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></span>
        <div class="row gx-2 align-ite-s-center">
            <div class="col-sm-2">
                <input  wire:model="size" type="text" class="form-control form-control-sm"/>
            </div>
            <div class="col-sm-10">
                <input wire:model="search" type="text" class="form-control form-control-sm mb-2" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2">
            </div>

        </div>
    </div>
    <div class="list-group ms-3 me-3">
        @foreach ($data as $item)
        <button type="button" onclick="getDetail({{ $item->id}})" class="list-group-item list-group-item-action @if($item->is_active==0) list-group-item-danger @else  list-group-item-success @endif" id="C{{ $item->id}}">{{ strlen($item->description)>48 ? substr($item->description,0,46).'...' : $item->description }}</button>
         @endforeach
        {{ $data->onEachSide(1)->links() }}
    <div class="d-grid pt-1">
        <button class="btn btn-outline-success btn-sm btn-block" id="create_record" type="button">{{ __('global.add_new_record') }}</button>
        <a class="btn btn-outline-warning btn-sm btn-block mt-3" id="inventory_help" type="button" href="{{ url('customers/help') }}">{{ __('global.help') }}</a>
        <p>&nbsp;</p>
    </div>
</div>
