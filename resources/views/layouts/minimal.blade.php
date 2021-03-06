<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OLE BMS - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('icons/bootstrap-icons.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{asset('css/custom.css')}}?<?php echo md5(time())?>" rel="stylesheet" />
    <style>
        .list-group-item :hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
          <a class="navbar-brand text-success" href="/home">OLE BMS</a>
        @if(session()->get('company_id'))
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-menu-up"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              {{ session()->get('trading_name') }} | {{ session()->get('financial_year') }} | {{ session()->get('financial_period') }}
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{request()->is('dashboard') ? 'active' : ''}}" data-toggle="tooltip" title="{{ __('global.dashboard') }}">
                        <i class="bi bi-speedometer2 fa-menu d-none d-sm-block"></i> <span class="d-block d-sm-none">{{ __('global.dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-item  {{request()->is('sales') ? 'open' : ''}}">
                    <a class="nav-link " href="{{url('sales')}}" data-toggle="tooltip" title="{{ __('global.menu.sales.title') }}">
                        <i class="bi bi-graph-up fa-menu d-none d-sm-block"></i> <span class="d-block d-sm-none">{{ __('global.menu.sales.title') }}</span>
                    </a>
                </li>
                <li class="nav-item  {{request()->is('purchases') ? 'open' : ''}}">
                    <a class="nav-link " href="{{url('purchases')}}" data-toggle="tooltip" title="{{ __('global.menu.purchases.title') }}">
                        <i class="bi bi-cart3 fa-menu d-none d-sm-block"></i> <span class="d-block d-sm-none">{{ __('global.menu.purchases.title') }}</span>
                    </a>
                </li>
                @if(count(array_intersect(session()->get('grant'), ['SU','inventory_access']))==1)
                <li class="nav-item ">
                    <a class="nav-link {{request()->is('inventory/*') ? 'active' : ''}}" href="{{ route('items.index') }}"  data-toggle="tooltip" title="{{ __('global.menu.inventory.title') }}">
                      <span><i class="bi bi-box fa-menu d-none d-sm-block"></i></span> <span class="d-block d-sm-none">{{ __('global.menu.inventory.title') }}</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link dropdown {{request()->is('calendars') ? 'active' : ''}}" href="/calendars" data-toggle="tooltip" title="{{ __('global.menu.calendars.title') }}">
                        <i class="bi bi-calendar fa-menu d-none d-sm-block"></i>  <span class="d-block d-sm-none">{{ __('global.menu.calendars.title') }}</span>
                    </a>
                  </li>
                <li class="nav-item">
                    <a class="nav-link dropdown {{request()->is('customers/*') ? 'active' : ''}}" href="{{ route('customers.index') }}" id="navCustomer" data-toggle="tooltip" title="{{ __('global.menu.customers.title') }}">
                        <i class="bi bi-person fa-menu d-none d-sm-block"></i>  <span class="d-block d-sm-none">{{ __('global.menu.customers.title') }}</span>
                    </a>
                  </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown {{request()->is('suppliers/*') ? 'active' : ''}}" href="#" id="navSupplier" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" title="{{ __('global.menu.suppliers.title') }}">
                        <i class="bi bi-truck fa-menu d-none d-sm-block"></i> <span class="d-block d-sm-none">{{ __('global.menu.suppliers.title') }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navSupplier">
                        @if(count(array_intersect(session()->get('grant'), ['SU','suppliers_access']))==1)
                            <li><a class="dropdown-item {{request()->is('suppliers/suppliers') ? 'active' : ''}}" href="{{ route('suppliers.index') }}">{{ __('suppliers.title') }}</a></li>
                        @endif
                        @if(count(array_intersect(session()->get('grant'), ['SU','supplier_items_access']))==1)
                            <li><a class="dropdown-item {{request()->is('suppliers/items') ? 'active' : ''}}" href="{{ url('suppliers/items') }}">{{ __('supplier_items.title') }}</a></li>
                        @endif
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                @if(count(array_intersect(session()->get('grant'), ['SU','documents_access']))==1)
                <li class="nav-item">
                    <a class="nav-link {{request()->is('documents') ? 'active' : ''}}" href="/documents" data-toggle="tooltip" title="{{ __('global.menu.documents.title') }}">
                        <i class="bi bi-file-earmark fa-menu d-none d-sm-block"></i> <span class="d-block d-sm-none">{{ __('global.menu.documents.title') }}</span>
                    </a>
                  </li>
                  @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown {{request()->is('accounting/*') ? 'active' : ''}}" href="#" id="navAccounting" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" title="{{ __('global.menu.accounting.title') }}">
                        <i class="bi bi-book fa-menu d-none d-sm-block"></i> <span class="d-block d-sm-none">{{ __('global.menu.accounting.title') }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navAccounting">
                        @if(count(array_intersect(session()->get('grant'), ['SU','asset_groups_access']))==1)
                            <li><a class="dropdown-item {{request()->is('accounting/asset-groups') ? 'active' : ''}}" href="{{ route('asset-groups.index') }}">{{ __('asset_groups.title') }}</a></li>
                        @endif
                        @if(count(array_intersect(session()->get('grant'), ['SU','asset_types_access']))==1)
                            <li><a class="dropdown-item {{request()->is('accounting/asset-types') ? 'active' : ''}}" href="{{ route('asset-types.index') }}">{{ __('asset_types.title') }}</a></li>
                        @endif
                        @if(count(array_intersect(session()->get('grant'), ['SU','assets_access']))==1)
                            <li><a class="dropdown-item {{request()->is('accounting/assets') ? 'active' : ''}}" href="{{ route('assets.index') }}">{{ __('assets.title') }}</a></li>
                        @endif
                        @if(count(array_intersect(session()->get('grant'), ['SU','counters_access']))==1)
                            <li><a class="dropdown-item {{request()->is('accounting/counters') ? 'active' : ''}}" href="{{ route('counters.index') }}">{{ __('counters.title') }}</a></li>
                        @endif
                        @if(count(array_intersect(session()->get('grant'), ['SU','journal_entries_access']))==1)
                            <li><a class="dropdown-item {{request()->is('accounting/journal-entries') ? 'active' : ''}}" href="{{ route('journal-entries.index') }}">{{ __('journal_entries.title') }}</a></li>
                        @endif
                        @if(count(array_intersect(session()->get('grant'), ['SU','journals_access']))==1)
                            <li><a class="dropdown-item {{request()->is('accounting/journals') ? 'active' : ''}}" href="{{ route('journals.index') }}">{{ __('journals.title') }}</a></li>
                        @endif
                        @if(count(array_intersect(session()->get('grant'), ['SU','ledgers_access']))==1)
                            <li><a class="dropdown-item {{request()->is('accounting/ledgers') ? 'active' : ''}}" href="{{ route('ledgers.index') }}">{{ __('ledgers.title') }}</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item {{request()->is('accounting/roll-over') ? 'active' : ''}}" href="{{ route('roll-over') }}">Roll Over</a></li>

                    </ul>
                  </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown {{request()->is('human-resource/*') ? 'active' : ''}}" href="#" id="navHr" data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" title="{{ __('global.menu.employees.title') }}">
                        <i class="bi bi-suit-heart fa-menu d-none d-sm-block"></i> <span class="d-block d-sm-none">{{ __('global.menu.hr.title') }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navHr">
                        @if(count(array_intersect(session()->get('grant'), ['SU','employees_access']))==1)
                        <li><a class="dropdown-item {{request()->is('human-resource/employees') ? 'active' : ''}}" href="{{ route('employees.index') }}">{{ __('employees.title') }}</a></li>
                        @endif

                        @if(count(array_intersect(session()->get('grant'), ['SU','employee_disciplinary_actions_access']))==1)
                        <li><a class="dropdown-item {{request()->is('human-resource/employee-disciplinary-actions') ? 'active' : ''}}" href="{{ route('employee-disciplinary-actions.index') }}">{{ __('employee_disciplinary_actions.title') }}</a></li>
                        @endif
                        @if(count(array_intersect(session()->get('grant'), ['SU','employee_documents_access']))==1)
                        <li><a class="dropdown-item {{request()->is('human-resource/employee-documents') ? 'active' : ''}}" href="{{ route('employee-documents.index') }}">{{ __('employee_documents.title') }}</a></li>
                        @endif

                        @if(count(array_intersect(session()->get('grant'), ['SU','employee_positions_access']))==1)
                        <li><a class="dropdown-item {{request()->is('human-resource/positions') ? 'active' : ''}}" href="{{ route('positions.index') }}">{{ __('employee_positions.title') }}</a></li>
                        @endif

                        @if(count(array_intersect(session()->get('grant'), ['SU','employee_loans_access']))==1)
                        <li><a class="dropdown-item {{request()->is('human-resource/employee-loans') ? 'active' : ''}}" href="{{ route('employee-loans.index') }}">{{ __('employee_loans.title') }}</a></li>
                        @endif

                    </ul>
                  </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown {{request()->is('payroll/*') ? 'active' : ''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" title="{{ __('global.menu.payroll.title') }}">
                      <i class="bi bi-wallet2 fa-menu d-none d-sm-block"></i> <span class="d-block d-sm-none">{{ __('global.menu.payroll.title') }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(count(array_intersect(session()->get('grant'), ['SU','payroll_templates_access']))==1)
                        <li><a class="dropdown-item {{request()->is('payroll/payroll-templates') ? 'active' : ''}}" href="{{  route('payroll-template.index') }}">{{ __('payroll_templates.title') }}</a></li>
                        @endif
                        @if(count(array_intersect(session()->get('grant'), ['SU','payroll_transaction_codes_access']))==1)
                        <li><a class="dropdown-item {{request()->is('payroll/payroll-transaction-codes') ? 'active' : ''}}" href="{{  route('payroll-transaction-codes.index') }}">{{ __('payroll_transaction_codes.title') }}</a></li>
                        @endif
                        @if(count(array_intersect(session()->get('grant'), ['SU','payroll_transactions_access']))==1)
                        <li><a class="dropdown-item {{request()->is('payroll/payroll-transactions') ? 'active' : ''}}" href="{{  route('payroll-transactions.index') }}">{{ __('payroll_transactions.title') }}</a></li>
                        @endif
                      <li><hr class="dropdown-divider"></li>
                        @if(count(array_intersect(session()->get('grant'), ['SU','payroll_run_access']))==1)
                        <li><a class="dropdown-item {{request()->is('payroll/run') ? 'active' : ''}}" href="#">{{ __('payroll.run') }}</a></li>
                        @endif
                    </ul>
                  </li>
                  @if(count(array_intersect(session()->get('grant'), ['SU','setup_access']))==1)
                  <li class="nav-item">
                    <a href="/setup" class="nav-link {{request()->is('setup') ? 'active' : ''}}" data-toggle="tooltip" title="{{ __('global.menu.setup.title') }}">
                        <i class="bi bi-gear fa-menu d-none d-sm-block"></i> <span class="d-block d-sm-none">{{ __('global.menu.setup.title') }}</span>
                    </a>
                </li>@endif

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown {{request()->is('user-management/*') ? 'active' : ''}}" href="#" id="userMaement" data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" title="{{ __('global.menu.users.title') }}">
                        <i class="bi bi-people fa-menu d-none d-sm-block"></i> <span class="d-block d-sm-none">{{ __('global.menu.users.title') }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userMaement">
                        @if(count(array_intersect(session()->get('grant'), ['SU','users_access']))==1)
                      <li><a class="dropdown-item {{request()->is('user-management/users') ? 'active' : ''}}" href="{{ route('users.index') }}">{{ __('users.title') }}</a></li>
                      @endif
                      @if(count(array_intersect(session()->get('grant'), ['SU','roles_access']))==1)
                      <li><a class="dropdown-item {{request()->is('user-management/roles') ? 'active' : ''}}" href="{{  route('roles.index') }}">{{ __('roles.title') }}</a></li>
                      @endif
                      @if(\Auth::user()->email=='stuart@itecassist.co.za')
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item {{request()->is('user-management/permissions') ? 'active' : ''}}" href="{{ route('permissions.index') }}">{{ __('permissions.title') }}</a></li>
                      @endif
                    </ul>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="tooltip" title="">
                        &nbsp;
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown {{request()->is('help/*') ? 'active' : ''}}" href="#" id="navHelp" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-question fa-menu d-none d-sm-block"></i> <span class="d-block d-sm-none">{{ __('global.help') }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navHelp">
                      <li><a class="dropdown-item {{request()->is('help/inventory') ? 'active' : ''}}" href="{{ route('help_inventory') }}">{{ __('global.menu.inventory.title') }}</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
            </ul>
            <span class="navbar-text">
                <div class="btn-group  dropstart">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">{{ __('global.logout') }}</a></li>
                    </ul>
                  </div>
            </span>
          </div>
          @endif
        </div>
      </nav>

<div class="app-body">
    <div class="container-fluid">
        @yield('content')
    </div>
</div>

<form id="logoutform" action="{{ url('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/jquery/dist/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>
</html>

