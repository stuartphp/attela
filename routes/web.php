<?php

use App\Models\InventoryItem;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

\Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('selection/{id}', [App\Http\Controllers\HomeController::class, 'selection'])->name('selection');
Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
Route::get('user-profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('user-profile');


Route::group(['middleware' => ['web', 'company','auth']], function () {

    Route::group(['prefix' => 'documents'], function () {
        Route::get('convert-invoice/{id}', [App\Http\Controllers\Documents\DocumentsController::class, 'convert_invoice']);
        Route::get('lock/{id}', [App\Http\Controllers\Documents\DocumentsController::class, 'lock']);
        Route::get('print/{id}', [App\Http\Controllers\Documents\DocumentsController::class, 'print']);
        Route::get('view/{id}', [App\Http\Controllers\Documents\DocumentsController::class, 'view']);
        Route::post('flow/{id}', [App\Http\Controllers\Documents\DocumentsController::class, 'flow']);
        Route::get('/', [App\Http\Controllers\Documents\DocumentsController::class, 'index']);
        Route::get('/{id}/edit', [App\Http\Controllers\Documents\DocumentsController::class, 'edit']);
        Route::resource('all', App\Http\Controllers\Documents\AllController::class);
        Route::resource('credit-notes', App\Http\Controllers\Documents\CreditNotesController::class);
        Route::resource('goods-delivery-notes', App\Http\Controllers\Documents\GoodsDeliveryNotesController::class);
        Route::resource('tax-invoices', App\Http\Controllers\Documents\TaxInvoicesController::class);
        Route::resource('quotations', App\Http\Controllers\Documents\QuotationsController::class);
        Route::resource('sales-orders', App\Http\Controllers\Documents\SalesOrdersController::class);
        Route::resource('receipts', App\Http\Controllers\Documents\ReceiptsController::class);
        Route::resource('supplier-invoices', App\Http\Controllers\Documents\SupplierInvoicesController::class);
        Route::resource('purchase-orders', App\Http\Controllers\Documents\PurchaseOrdersController::class);
        Route::resource('debit-notes', App\Http\Controllers\Documents\DebitNotesController::class);
        Route::resource('goods-received-notes', App\Http\Controllers\Documents\GoodsRecievedNotesController::class);
    });
    Route::group(['prefix' => 'help'], function () {
        Route::get('inventory', [App\Http\Controllers\Help\InventoryController::class, 'index'])->name('help_inventory');
    });
    Route::group(['prefix' => 'employees'], function () {
        Route::resource('employees', App\Http\Controllers\Employees\EmployeesController::class);
    });
    Route::group(['prefix' => 'payroll'], function () {
        Route::get('payslip/{id}', [App\Http\Controllers\PayRoll\PayslipController::class, 'index']);
        Route::resource('payroll-template', App\Http\Controllers\PayRoll\PayrollTemplatesController::class);
        Route::resource('payroll-transaction-codes', App\Http\Controllers\PayRoll\PayrollTransactionCodesController::class);
        Route::resource('payroll-transactions', App\Http\Controllers\PayRoll\PayrollTransactionsController::class);
    });

    Route::group(['prefix' => 'human-resource'], function () {
        Route::resource('employee-jobs', App\Http\Controllers\HumanResource\EmployeeJobsController::class);
        Route::resource('employees', App\Http\Controllers\HumanResource\EmployeesController::class);
        Route::post('employee/image', [App\Http\Controllers\HumanResource\EmployeesController::class, 'image']);
        Route::resource('employee-benefits', App\Http\Controllers\HumanResource\EmployeeBenifitsController::class);
        Route::resource('employee-disciplinary-actions', App\Http\Controllers\HumanResource\EmployeeDisciplinaryActionsController::class);
        Route::resource('employee-documents', App\Http\Controllers\HumanResource\EmployeeDocumentsController::class);
        Route::resource('employee-hours-worked', App\Http\Controllers\HumanResource\EmployeeHoursWorkedController::class);
        Route::resource('employee-emergency-contacts', App\Http\Controllers\HumanResource\EmployeeEmergencyContactsController::class);
        Route::resource('positions', App\Http\Controllers\HumanResource\PositionsController::class);
        Route::resource('employee-leave-registers', App\Http\Controllers\HumanResource\EmployeeLeaveRegistersController::class);
        Route::resource('employee-leaves', App\Http\Controllers\HumanResource\EmployeeLeavesController::class);
        Route::resource('employee-loans', App\Http\Controllers\HumanResource\EmployeeLoansController::class);
        Route::resource('employee-directives', App\Http\Controllers\HumanResource\EmployeeDirectivesController::class);
        Route::resource('employee-notes', App\Http\Controllers\HumanResource\EmployeeNotesController::class);
        Route::resource('employee-payment-details', App\Http\Controllers\HumanResource\EmployeePaymentDetailsController::class);
        Route::resource('employee-addresses', App\Http\Controllers\HumanResource\EmployeeAddressesController::class);
        Route::resource('employee-contact-details', App\Http\Controllers\HumanResource\EmployeeContactDetailsController::class);
        Route::get('employee-leaves/get-leave/{id}', [App\Http\Controllers\HumanResource\EmployeeLeavesController::class, 'get_leave']);
        Route::get('new-employee', [App\Http\Controllers\HumanResource\EmployeeNewController::class, 'index']);
    });

    Route::group(['prefix' => 'accounting'], function () {
        Route::get('roll-over', [App\Http\Controllers\Accounting\AccountingController::class, 'roll_over'])->name('roll-over');
        Route::resource('asset-groups', App\Http\Controllers\Accounting\AssetGroupsController::class);
        Route::resource('asset-types', App\Http\Controllers\Accounting\AssetTypesController::class);
        Route::resource('assets', App\Http\Controllers\Accounting\AssetsController::class);

        Route::resource('journal-entries', App\Http\Controllers\Accounting\JournalEntriesController::class);
        Route::resource('journals', App\Http\Controllers\Accounting\JournalsController::class);

    });

    Route::group(['prefix' => 'suppliers'], function () {
        Route::resource('suppliers', App\Http\Controllers\Suppliers\SuppliersController::class);
        Route::resource('items', App\Http\Controllers\Suppliers\ItemsController::class);
    });
    Route::group(['prefix'=>'calendars'], function(){
        Route::get('/get-data', [App\Http\Controllers\Calendar\CalendardsController::class, 'get_data'])->name('calendar');
        Route::resource('/data', App\Http\Controllers\Calendar\CalendardsController::class);
    });

    Route::group(['prefix' => 'customers'], function () {
        Route::resource('customers', App\Http\Controllers\Customers\CustomersController::class);
        Route::resource('contacts', App\Http\Controllers\Customers\ContactsController::class);
        Route::resource('cycles', App\Http\Controllers\Customers\CyclesController::class);
        Route::resource('tasks', App\Http\Controllers\Customers\TasksController::class);

    });

    Route::group(['prefix' => 'inventory'], function () {
        Route::get('/help', [App\Http\Controllers\Inventory\HelpController::class, 'index']);
        Route::resource('items', App\Http\Controllers\Inventory\InventoryItemsController::class);
        Route::resource('categories', App\Http\Controllers\Inventory\InventoryCategoriesController::class);
        Route::resource('images', App\Http\Controllers\Inventory\InventoryImagesController::class);
        Route::resource('levels', App\Http\Controllers\Inventory\InventoryLevelsController::class);
        Route::get('activities-data/{id}', [App\Http\Controllers\Inventory\InventoryActivitiesController::class, 'get_data']);
        Route::resource('activities', App\Http\Controllers\Inventory\InventoryActivitiesController::class);
        Route::resource('options', App\Http\Controllers\Inventory\InventoryOptionsController::class);
        Route::resource('prices', App\Http\Controllers\Inventory\InventoryPricesController::class);
        Route::resource('units', App\Http\Controllers\Inventory\InventoryUnitsController::class);
        Route::get('item/{id}', [\App\Http\Controllers\Inventory\DetailController::class, 'index']);
    });

    Route::group(['prefix'=>'user-management'], function(){
        Route::get('/dashboard', [App\Http\Controllers\UserManagement\DashboardController::class, 'index']);
        Route::resource('users', App\Http\Controllers\UserManagement\UsersController::class);
        Route::resource('roles', App\Http\Controllers\UserManagement\RolesController::class);
        Route::resource('permissions', App\Http\Controllers\UserManagement\PermissionsController::class);
    });

    Route::group(['prefix'=>'search'], function(){
        Route::post('inventory-items', [App\Http\Controllers\Search\InventoryController::class, 'index']);
        Route::post('document-items', [App\Http\Controllers\Search\InventoryController::class, 'document']);
        Route::post('customers', [App\Http\Controllers\Search\CustomerController::class, 'index']);
        Route::post('employees/{id?}', [App\Http\Controllers\Search\EmployeesController::class, 'index']);
        Route::post('disciplinary', [App\Http\Controllers\Search\DisciplinarySearch::class, 'index']);
        Route::post('country/{id?}', [App\Http\Controllers\Search\CountrySearch::class, 'index']);
        Route::post('zone/{id}', [App\Http\Controllers\Search\CountrySearch::class, 'zone']);
    });

    Route::group(['prefix' => 'setup'], function () {
        Route::get('/', [App\Http\Controllers\Setup\SetupController::class, 'index']);
        Route::resource('companies', App\Http\Controllers\Setup\CompaniesController::class);
        Route::resource('counters', App\Http\Controllers\Setup\CountersController::class);
        Route::resource('countries', App\Http\Controllers\Setup\CountriesController::class);
        Route::resource('accounting', App\Http\Controllers\Setup\AccountingController::class);
        Route::resource('delivery-groups', App\Http\Controllers\Setup\DeliveryGroupsController::class);
        Route::resource('disciplinary-reasons', App\Http\Controllers\Setup\DisciplanaryReasonsController::class);
        Route::resource('documents', App\Http\Controllers\Setup\DocumentsController::class);
        Route::resource('stores', App\Http\Controllers\Setup\StoresController::class);
        Route::resource('leave', App\Http\Controllers\Setup\LeaveController::class);
        Route::resource('ledgers', App\Http\Controllers\Setup\LedgersController::class);
        Route::resource('lookups', App\Http\Controllers\Setup\LookupsController::class);
        Route::resource('payroll-transaction-codes', App\Http\Controllers\Setup\PayrollTransactionCodesController::class);
        Route::resource('payments', App\Http\Controllers\Setup\PaymentsController::class);

    });
    // Route::group(['prefix'=>'test'], function(){
    //     // Route::resource('/items', App\Http\Controllers\Test\TestController::class)->name('*','test_items');
    // });

});


Route::get('pdf/samples', [\App\Http\Controllers\PDF\SamplesController::class, 'index']);
Route::get('sales', function(){
    $data = InventoryItem::paginate(15);
    //dd($data);
    return view('sales', compact('data'));
});
Route::get('crud', [App\Http\Controllers\CrudController::class, 'index']);
Route::get('crud/table/{tbl}', [App\Http\Controllers\CrudController::class, 'table']);
Route::post('crud/generate', [App\Http\Controllers\CrudController::class, 'generate']);
