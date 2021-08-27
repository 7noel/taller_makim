<?php

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
Route::get('houses', function () {
    return view('welcome');
});
Route::get('/', 'HomeController@index');

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/finances/companies/register', 'Finances\CompanyController@register')->name('companies.register');

// Route::get('/home', 'HomeController@index');
Route::get('listarProvincias/{departamento}', ['as' => 'ajaxprovincias', 'uses' => 'Admin\UbigeosController@ajaxProvincias']);
Route::get('listarDistritos/{departamento}/{provincia}', ['as' => 'ajaxdistritos','uses' => 'Admin\UbigeosController@ajaxDistritos']);

Route::group(['middleware'=>['auth']], function(){
	Route::get('send_cpe', ['as' => 'output_vouchers.send_email_cpe', 'uses' => 'Finances\ProofsController@send_email_cpe']);
	Route::get('getCar/{placa}', ['as' => 'getCar', 'uses' => 'Operations\CarsController@getCar']);
	Route::get('colorsByModelo/{modelo_id}', ['as' => 'colorsByModelo', 'uses' => 'Logistics\BrandsController@colorsByModelo']);
	Route::get('modelosByWarehouse/{warehouse_id}', ['as' => 'modelosByWarehouse', 'uses' => 'Logistics\BrandsController@modelosByWarehouse']);

	Route::get('api/ubigeos/autocompleteAjax', ['as' => 'ubigeosAutocomplete', 'uses' => 'Admin\UbigeosController@autocompleteAjax']);
	// Obtener provincas y distritos x ajax
	Route::get('getDataUbigeo/{code}', ['as' => 'ajaxGetDataUbigeo','uses' => 'Admin\UbigeosController@ajaxGetDataUbigeo']);
	Route::get('listUnits/{unit_type_id}', ['as' => 'ajaxUnits','uses' => 'Storage\UnitsController@ajaxList']);
	Route::get('listSubCategories/{category_id}', ['as' => 'ajaxSubCategories','uses' => 'Storage\SubCategoriesController@ajaxList']);
	Route::get('listWarehouses', ['as' => 'ajaxWarehouses','uses' => 'Storage\WarehousesController@ajaxList']);
	//Route::get('finances/companies/autocomplete', ['as' => 'companiesAutocomplete','uses' => 'Finances\CompanyController@ajaxAutocomplete']);
	Route::get('storage/products/autocomplete/{warehouse_id}', ['as' => 'productsAutocomplete','uses' => 'Storage\ProductsController@ajaxAutocomplete']);
	Route::get('storage/products/ajaxGetData/{warehouse_id}/{product_id}', ['as' => 'ajaxGetData','uses' => 'Storage\ProductsController@ajaxGetData']);
	Route::get('guard/users/autocomplete', ['as' => 'usersAutocomplete','uses' => 'Security\UsersController@ajaxAutocomplete']);
	Route::get('api/companies/autocompleteAjax/{type}/{my_company}/', ['as' => 'companiesAutocomplete','uses' => 'Finances\CompanyController@ajaxAutocomplete']);
	Route::get('api/sellers/autocompleteAjax', ['as' => 'sellersAutocomplete','uses' => 'HumanResources\EmployeesController@ajaxAutocompleteSellers']);
	Route::get('api/products/autocompleteAjax', ['as' => 'productsAutocomplete','uses' => 'Storage\ProductsController@ajaxAutocomplete']);
	Route::get('api/stocks/autocompleteAjax/{stock_id}', ['as' => 'stocksAutocomplete','uses' => 'Storage\ProductsController@ajaxAutocomplete2']);
	Route::get('api/products/getById/{id}', ['as' => 'productsGetById','uses' => 'Storage\ProductsController@ajaxGetById']);
	Route::get('api/proofs/autocompleteAjax/1/{company_id}', ['as' => 'api_proofs_1','uses' => 'Finances\ProofsController@ajaxAutocomplete1']);
	Route::get('api/proofs/autocompleteAjax/2/{company_id}', ['as' => 'api_proofs_2','uses' => 'Finances\ProofsController@ajaxAutocomplete2']);
	Route::get('audit/{model}/{id}', ['as' => 'audit','uses' => 'Security\AuditController@getAudit']);

	Route::get('/select_company', ['as' => 'select_company','uses' => 'HomeController@select_company']);
	Route::post('/change_company', ['as' => 'change_company','uses' => 'HomeController@change_company']);
});

Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'permissions'], 'namespace'=>'Admin'], function(){
	Route::resource('document_controls','TableController');
	Route::resource('units','TableController');
	Route::resource('categories','TableController');
	Route::resource('sub_categories','TableController');
});

Route::group(['prefix'=>'finances', 'middleware'=>['auth', 'permissions'], 'namespace'=>'Finances'], function(){
	Route::resource('exchanges','ExchangesController');
	Route::resource('companies','CompanyController');
	Route::resource('clients','CompanyController');
	Route::resource('shippers','CompanyController');
	Route::resource('providers','CompanyController');
	Route::resource('payment_conditions','PaymentConditionsController');

	Route::get('output_vouchers/print/{id}', ['as' => 'output_vouchers.print', 'uses' => 'ProofsController@print']);
	Route::get('output_vouchers/by_order/{order_id}', ['as' => 'output_vouchers.by_order', 'uses' => 'ProofsController@byOrder']);
	Route::resource('output_vouchers','ProofsController');
	Route::resource('input_vouchers','ProofsController');
	Route::resource('output_letters','ProofsController');
	Route::resource('input_letters','ProofsController');
	// Route::get('output_vouchers', ['as' => 'output_vouchers.index','uses' => 'ProofsController@outputVouchers']);
	// Route::get('output_vouchers/create', ['as' => 'output_vouchers.create','uses' => 'ProofsController@create']);
	// Route::get('output_vouchers/edit/{id}', ['as' => 'output_vouchers.edit','uses' => 'ProofsController@edit']);
	// Route::get('output_vouchers/destroy/{id}', ['as' => 'output_vouchers.destroy','uses' => 'ProofsController@outputVouchersCreate']);
	// Route::get('input_vouchers', ['as' => 'input_vouchers.index','uses' => 'ProofsController@inputVouchers']);
	// Route::get('input_vouchers/create', ['as' => 'input_vouchers_create','uses' => 'ProofsController@inputVouchersCreate']);
	
	Route::resource('payments','PaymentsController');
	Route::resource('amortizations','AmortizationsController');
	Route::get('amortizations/by_proof/{proof_id}', ['as' => 'amortizations.byProof', 'uses' => 'AmortizationsController@byProof']);
	Route::resource('output_swaps','SwapsController');
	Route::get('output_swaps/by_proof/{proof_id}', ['as' => 'output_swaps.byProof', 'uses' => 'SwapsController@byProof']);
	Route::resource('input_swaps','SwapsController');
});

Route::group(['prefix'=>'guard', 'middleware'=>['auth', 'permissions'], 'namespace'=>'Security'], function(){
	Route::get('change_password', ['as' => 'change_password', 'uses' => 'UsersController@changePassword']);
	Route::post('update_password', ['as'=>'update_password', 'uses'=>'UsersController@updatePassword']);
	Route::resource('users','UsersController');
	Route::resource('roles','RolesController');
	Route::resource('permissions','PermissionsController');
	Route::resource('permission_groups','PermissionGroupsController');
});

Route::group(['prefix'=>'storage', 'middleware'=>['auth', 'permissions'], 'namespace'=>'Storage'], function(){
	Route::resource('warehouses','WarehousesController');
	Route::resource('products','ProductsController');
	Route::resource('input_notes','OrdersController');
	Route::resource('output_notes','OrdersController');
	Route::get('stocks/kardex/{id}', ['as' => 'kardex','uses' => 'ProductsController@kardex']);
});

Route::group(['prefix'=>'humanresources', 'middleware'=>['auth', 'permissions']], function(){
	Route::resource('employees','Finances\CompanyController');
	Route::resource('jobs','Admin\TableController');
});

Route::group(['prefix'=>'operations', 'middleware'=>['auth', 'permissions'], 'namespace'=>'Operations'], function(){
	Route::resource('brands','BrandsController');
	Route::resource('cars','CarsController');
	Route::get('cars/create_by_client/{client_id}', ['as' => 'cars.create_by_client', 'uses' => 'CarsController@createByClient']);

	Route::get('output_orders/by_quote/{order_id}', ['as' => 'orders.by_quote', 'uses' => 'OrdersController@byQuote']);
	// Route::get('quotes/filter', ['as' => 'quotes.filter','uses' => 'OrdersController@filter']);
	// Route::post('quotes/filter', ['as' => 'quotes.filter','uses' => 'OrdersController@filter']);
	// Route::get('orders/filter', ['as' => 'orders.filter','uses' => 'OrdersController@filter']);
	// Route::post('orders/filter', ['as' => 'orders.filter','uses' => 'OrdersController@filter']);
	Route::resource('output_quotes','OrdersController');
	Route::resource('output_orders','OrdersController');
	Route::resource('input_quotes','OrdersController');
	Route::resource('input_orders','OrdersController');
	Route::get('orders/print/{id}', ['as' => 'print_order','uses' => 'OrdersController@print']);
	Route::get('orders/createByCompany/{company_id}', ['as' => 'create_order_by_company','uses' => 'OrdersController@createByCompany']);
});

Route::group(['prefix'=>'logistics', 'middleware'=>['auth', 'permissions'], 'namespace'=>'Logistics'], function(){
});
