<input type="hidden" id="customer_id" value="{{ $data->id }}">
<nav class="navbar navbar-expand-lg navbar-light"  style="background-color: #EDF1ED">
  <div class="container-fluid">
    <div class="navbar-brand"><span style="cursor:pointer" onclick="openNav()">&#9776;</span> ({{ $data->account_number }}) {{ $data->description }}</div>
    <ul class="nav nav-pills" id="detailTab">
      <li class="nav-item">
        <a class="nav-link active" id="detail-tab" data-bs-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true">Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="contacts-tab" data-bs-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false" >Contacts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="cycles-tab" data-bs-toggle="tab" href="#cycles" role="tab" aria-controls="cycles" aria-selected="false">Cycles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="tasks-tab" data-bs-toggle="tab" href="#tasks" role="tab" aria-controls="tasks" aria-selected="false">Tasks</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="loans-tab" data-bs-toggle="tab" href="#loans" role="tab" aria-controls="loans" aria-selected="false">Loans</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="quotes-tab" data-bs-toggle="tab" href="#quotes" role="tab" aria-controls="quotes" aria-selected="false">Quotes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="invoices-tab" data-bs-toggle="tab" href="#invoices" role="tab" aria-controls="invoices" aria-selected="false">Invoices</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="transactions-tab" data-bs-toggle="tab" href="#transactions" role="tab" aria-controls="transactions" aria-selected="false">Transactions</a>
      </li>
    </ul>
  </div>
</nav>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
      @include('customers.form_customers', $data)
  </div>
  <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
      @include('customers.form_contacts', $contacts)
  </div>
  <div class="tab-pane fade" id="transactions" role="tabpanel" aria-labelledby="transactions-tab">

  </div>
  <div class="tab-pane fade" id="quotes" role="tabpanel" aria-labelledby="quotes-tab">

  </div>
  <div class="tab-pane fade" id="invoices" role="tabpanel" aria-labelledby="invoices-tab">

  </div>
  <div class="tab-pane fade" id="cycles" role="tabpanel" aria-labelledby="cycles-tab">
      @include('customers.form_cycles', $cycles)
  </div>
  <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">

  </div>
  <div class="tab-pane fade" id="loans" role="tabpanel" aria-labelledby="loans-tab">

  </div>
</div>

