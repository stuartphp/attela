@extends('layouts.admin')
@section('title', __('global.menu.inventory.title'))
@section('content')

    <div id="loadImg"><img src="/images/ajax-loader.gif" width="100px"/></div>
    <div id="result" class="content-panel" style="background-color: #ffffff">
        <span style="font-size:30px; cursor:pointer" onclick="openNav()">&#9776; open</span>
        <!-- Display Dashboard stuff-->
        <div class="row ms-2 mt-2">
            <div class="card me-3 mb-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
            <div class="card me-3 mb-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
            <div class="card me-3 mb-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
            <div class="card me-3 mb-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
            <div class="card me-3 mb-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
            <div class="card me-3 mb-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
            <div class="card me-3 mb-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        </div>
    </div>
    <div id="mySidenav" class="sidenav">
        
    <div class="head mb-1 ms-2 me-2">
        {{ __('inventory_items.title') }}<span style="float:right"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></span>
    </div>
    <div class="list-group ms-3 me-3">
        <form action="{{ url('human-resource/employee-benefits') }}" method="get">
            <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control form-control-sm" name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($search)) value="{{$search}}" @endif>
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit">
                    <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </form>
        @foreach ($data as $item)
        <button type="button" class="list-group-item list-group-item-action" id="{{ $item->id}}">{{ strlen($item->item_code.' '.$item->description)>48 ? substr($item->item_code.' '.$item->description,0,46).'...' : $item->item_code.' '.$item->description }}</button>
        @endforeach
        {{ $data->links() }}
    <div class="d-grid pt-1">
        <button class="btn btn-outline-success btn-sm btn-block" id="create_record" type="button">{{ __('global.add_new_record') }}</button>
    </div>
    </div>

    
</div>

@endsection
@section('scripts')
<script>
    function openNav() {
  //document.getElementById("mySidenav").style.width = "300px";
  $('#mySidenav').toggle('show');
}

function closeNav() {
  //document.getElementById("mySidenav").style.width = "0";
  $('#mySidenav').toggle('hide');
}
    $(function(){
        $('#arrow_list_open').hide();
        $('#loadImg').hide();
        @if(isset($_REQUEST['page']) && $_REQUEST['page']>1)
        $('#'+{{ $data[0]->id}}).addClass('active');
        getDetail({{ $data[0]->id}});
        @endif
        $('#list-panel').show();
    });
    $('.list-group-item').on('click', function(){
        $('#loadImg').show();
        closeNav();
        $('.list-group-item').removeClass('active');
        $(this).addClass('active');
        let id = $(this).attr('id');
        
        getDetail(id);
    })

    function loadDash()
    {
        alert('hi');
    }
    function getDetail(id)
    {
        
        $.ajax({
            url:'/inventory/items/'+id,
            method:'GET',
            dataType:'html',
            success: function(response){
                $('#result').html(response);
            }
        });
        $('#loadImg').hide();
    }
    $('#create_record').click(function(){
        $('.list-group-item').removeClass('active');
        $.ajax({
            url:'/inventory/items/create',
            method:'GET',
            dataType:'html',
            success: function(response){
                $('#result').html(response);
            }
        });
    })


</script>
@endsection
