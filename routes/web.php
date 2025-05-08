<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Finances\Exchange;
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

Route::get('demo2', function () {
	return view('demo2');
});
Route::get('dataTable', 'HomeController@dataTable');
Route::get('/', 'HomeController@index');
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

// Route::get('cambio1/{y}/{m}', function ($y, $m) {
// 	$last_tc = Exchange::orderBy('fecha', 'desc')->first();
// 	if (is_null($last_tc) or $last_tc->fecha < date('Y-m-d')) {
// 		$cambio=0;
// 		$t_cs = getTipoCambioMes($y, $m);
// 		foreach ($t_cs as $key => $t_c) {
// 			if (is_null($last_tc) or $t_c->fecha > $last_tc->fecha) {
// 				$cambio = Exchange::create(['my_company'=>1, 'fecha'=>$t_c->fecha, 'venta'=>$t_c->venta, 'compra'=>$t_c->compra]);
// 			}
// 		}
// 		return $cambio;
// 	}
// 	return null;
// });

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/finances/companies/register', 'Finances\CompanyController@register')->name('companies.register');
Route::get('generate_slug', ['as' => 'generate_slug','uses' => 'Operations\OrdersController@generateSlug']);
Route::get('orden_cliente/{slug}', ['as' => 'order_client', 'uses' => 'Operations\OrdersController@orderClient']);

// Route::get('/home', 'HomeController@index');
Route::get('listarProvincias/{departamento}', ['as' => 'ajaxprovincias', 'uses' => 'Admin\UbigeosController@ajaxProvincias']);
Route::get('listarDistritos/{departamento}/{provincia}', ['as' => 'ajaxdistritos','uses' => 'Admin\UbigeosController@ajaxDistritos']);
Route::get('excel_productos', ['as' => 'excel','uses' => 'Storage\ProductsController@excel']);
Route::get('excel_servicios', ['as' => 'excel2','uses' => 'Storage\ProductsController@excel2']);
Route::get('listarMarcas', ['as' => 'ajaxmarcas', 'uses' => 'Operations\BrandsController@ajaxMarcas']);
Route::get('listarModelos/{brand_id}', ['as' => 'ajaxmodelos', 'uses' => 'Operations\BrandsController@ajaxModelos']);
Route::get('crear-marca', ['as' => 'ajax_crear_marca', 'uses' => 'Operations\BrandsController@ajaxCrearMarca']);
Route::get('crear-item', ['as' => 'ajax_crear_item', 'uses' => 'Storage\ProductsController@store']);

	Route::post('upload-photo', ['as'=>'upload_photo', 'uses'=>'HomeController@uploadPhoto']);
Route::group(['middleware'=>['auth']], function(){

	Route::get('change_password', ['as' => 'change_password', 'uses' => 'Security\UsersController@changePassword']);
	Route::post('update_password', ['as' => 'update_password', 'uses'=>'Security\UsersController@updatePassword']);

	Route::get('get_cpe/{id}', ['as' => 'output_vouchers.get_cpe', 'uses' => 'Finances\ProofsController@get_json_cpe']);
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

	Route::get('clients/ajax-list', 'Finances\CompanyController@ajaxList')->name('clients.ajaxList');
	Route::get('providers/ajax-list', 'Finances\CompanyController@ajaxList')->name('providers.ajaxList');
	Route::get('employees/ajax-list', 'Finances\CompanyController@ajaxList')->name('employees.ajaxList');
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
	Route::resource('document_controls','DocumentControlsController');
	Route::resource('units','TableController');
	Route::resource('categories','TableController');
	Route::resource('sub_categories','TableController');
	Route::resource('marcas','TableController');
});

Route::group(['prefix'=>'finances', 'middleware'=>['auth', 'permissions'], 'namespace'=>'Finances'], function(){
	Route::get('/companies/my_company', 'CompanyController@my_company')->name('companies.my_company');
	Route::put('/companies/save_my_company/{id}', 'CompanyController@save_my_company')->name('companies.save_my_company');
	//Route::get('my_company', ['as' => 'my_company', 'uses' => 'CompanyController@mycompany']);

	Route::resource('banks','BanksController');
	Route::get('payments/by_voucher/{proof_id}', ['as' => 'payments.by_voucher', 'uses' => 'PaymentsController@by_voucher']);
	Route::resource('payments','PaymentsController');
	Route::resource('exchanges','ExchangesController');
	Route::resource('companies','CompanyController');
	Route::resource('clients','CompanyController');
	Route::resource('shippers','CompanyController');
	Route::resource('providers','CompanyController');
	Route::resource('payment_conditions','PaymentConditionsController');

	Route::get('output_vouchers/print/{id}', ['as' => 'output_vouchers.print', 'uses' => 'ProofsController@print2']);
	Route::get('output_vouchers/print2/{id}', ['as' => 'output_vouchers.print2', 'uses' => 'ProofsController@print']);
	Route::get('output_vouchers/by_order/{order_id}', ['as' => 'output_vouchers.by_order', 'uses' => 'ProofsController@byOrder']);
	Route::get('input_vouchers/print/{id}', ['as' => 'input_vouchers.print', 'uses' => 'ProofsController@input_vouchers_print']);
	Route::get('input_vouchers/by_order/{order_id}', ['as' => 'input_vouchers.by_order', 'uses' => 'ProofsController@byOrder']);
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
	Route::resource('output_swaps','SwapsController');
	Route::get('output_swaps/by_proof/{proof_id}', ['as' => 'output_swaps.byProof', 'uses' => 'SwapsController@byProof']);
	Route::resource('input_swaps','SwapsController');
});

Route::group(['prefix'=>'guard', 'middleware'=>['auth', 'permissions'], 'namespace'=>'Security'], function(){
	Route::resource('users','UsersController');
	Route::resource('roles','RolesController');
	Route::resource('permissions','PermissionsController');
	Route::resource('permission_groups','PermissionGroupsController');
});

Route::group(['prefix'=>'storage', 'middleware'=>['auth', 'permissions'], 'namespace'=>'Storage'], function(){
	Route::resource('warehouses','WarehousesController');
	Route::resource('products','ProductsController');
	Route::resource('services','ProductsController');
	Route::resource('input_notes','OrdersController');
	Route::resource('output_notes','OrdersController');
	Route::get('stocks/kardex/{id}', ['as' => 'kardex','uses' => 'ProductsController@kardex']);
});

Route::group(['prefix'=>'humanresources', 'middleware'=>['auth', 'permissions']], function(){
	Route::resource('employees','Finances\CompanyController');
	Route::resource('jobs','Admin\TableController');
});

Route::group(['prefix'=>'operations', 'middleware'=>['auth', 'permissions'], 'namespace'=>'Operations'], function(){
	Route::resource('polls','PollController');
	Route::get('reportenacimiento', ['as'=>'cars.nacimiento', 'uses' => 'CarsController@reportNacimiento']);
	Route::resource('checklist','ChecklistController');
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
	Route::resource('appointments','AppointmentController');
	Route::resource('input_quotes','OrdersController');
	Route::resource('input_orders','OrdersController');
	Route::get('output_quotes/by_inventory/{id}', ['as'=>'output_quotes.by_inventory', 'uses'=>'OrdersController@by_inventory']);
	Route::get('orders/print/{id}', ['as' => 'print_order','uses' => 'OrdersController@print']);
	Route::get('output_quotes/print_details/{id}', ['as' => 'output_quotes.print_details','uses' => 'OrdersController@print_quotes_details']);
	Route::get('output_quotes/print_categories/{id}', ['as' => 'output_quotes.print_categories','uses' => 'OrdersController@print_quotes_categories']);
	Route::get('orders/inventory/{id}', ['as' => 'print_inventory','uses' => 'OrdersController@printInventory']);
	Route::get('print_inventory/{id}', ['as' => 'order.print_inventory','uses' => 'OrdersController@print_inventory']);
	Route::get('orders/createByCompany/{company_id}', ['as' => 'create_order_by_company','uses' => 'OrdersController@createByCompany']);

	
	Route::resource('inventory','OrdersController');
	//Route::get('recepcion_crear', ['as' => 'reception.create', 'uses' => 'OrdersController@recepcion_crear']);
	Route::post('recepcion_store', ['as' => 'reception.store', 'uses' => 'OrdersController@store']);
	Route::get('recepcion_edit/{id}', ['as' => 'reception.edit', 'uses' => 'OrdersController@recepcion_edit']);
	Route::get('recepcion_by_car/{car_id}', ['as' => 'inventory.recepcion_by_car', 'uses' => 'OrdersController@recepcionByCar']);
	Route::get('diagnostico/{id}', ['as' => 'diagnostic.edit', 'uses' => 'OrdersController@diagnostico_edit']);
	Route::get('repuestos/{id}', ['as' => 'repuestos.edit', 'uses' => 'OrdersController@repuestos_edit']);
	Route::get('aprobacion/{id}', ['as' => 'aprobacion.edit', 'uses' => 'OrdersController@aprobacion_edit']);
	Route::get('pre_aprobacion/{id}', ['as' => 'pre_aprobacion.edit', 'uses' => 'OrdersController@pre_aprobacion_edit']);
	Route::get('reparacion/{id}', ['as' => 'repair.edit', 'uses' => 'OrdersController@repair_edit']);
	Route::get('controlcalidad/{id}', ['as' => 'qc.edit', 'uses' => 'OrdersController@controlcalidad_edit']);
	Route::get('entrega/{id}', ['as' => 'entrega.edit', 'uses' => 'OrdersController@entrega_edit']);
	Route::get('change_status_order/{id}', ['as' => 'change_status_order', 'uses' => 'OrdersController@changeStatusOrder']);
	Route::put('update_status/{id}', ['as' => 'update_status_order', 'uses' => 'OrdersController@updateStatus']);
	Route::get('panel/{status?}', 'OrdersController@panel')->name('panel');
});

Route::group(['prefix'=>'logistics', 'middleware'=>['auth', 'permissions'], 'namespace'=>'Logistics'], function(){
});
