<input type="hidden" id="inventory_item_id" value="{{ $data->id }}">
<input type="hidden" id="company_id" value="{{ session()->get('company_id') }}">
{{-- <div class="row pl-2 pr-2">
        <div class="col"></div>
        <div class="col " ><h3>{{ $data->item_code }} {{ $data->description }}</h3></div>
        <div class="col mt-5 text-right">

        </div>
</div> --}}

    <nav class="navbar navbar-expand-lg navbar-light" id="items_nav"  style="background-color: #EDF1ED">
        <div class="container-fluid">
            <div class="row">
                <div class="col-1"><a href="#" onclick="openNav()"><i class="bi bi-list"></i></a></div>
                <div class="col-10 navbar-brand"> ({{ $data->item_code }}) {{ $data->description }}</div>
            </div>

        <ul class="nav nav-pills" id="detailTab">
        <li class="nav-item">
          <a class="nav-link active" id="detail-tab" data-bs-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true">Details</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="prices-tab" data-bs-toggle="tab" href="#prices" role="tab" aria-controls="prices" aria-selected="false" >Prices</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="options-tab" data-bs-toggle="tab" href="#options" role="tab" aria-controls="options" aria-selected="false">Options</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" id="levels-tab" data-bs-toggle="tab" href="#levels" role="tab" aria-controls="levels" aria-selected="false">Levels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="images-tab" data-bs-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">Images</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="activities-tab" data-bs-toggle="tab" href="#activities" role="tab" aria-controls="activities" aria-selected="false">Activities</a>
        </li>
      </ul>
    </div>
    </nav>


      <div class="tab-content">
        <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
            @include('inventory.form_items', $data)
        </div>

        <div class="tab-pane fade" id="prices" role="tabpanel" aria-labelledby="prices-tab">
            {{-- @include('inventory.form_prices', [$prices, $stores]) --}}
            @livewire('inventory.price', ['id'=>$data->id])
        </div>
        <div class="tab-pane fade" id="options" role="tabpanel" aria-labelledby="options-tab">
            @include('inventory.form_options', $options)
      </div>
        <div class="tab-pane fade" id="levels" role="tabpanel" aria-labelledby="levels-tab">
            @include('inventory.form_level', [$level, $stores])
        </div>
        <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
            @include('inventory.form_images', $images)
        </div>

        <div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-tab">
            @include('inventory.form_activities', [$data, $stores])
        </div>


      </div>

