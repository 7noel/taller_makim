<?php
namespace App\Http\Controllers\Operations;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Modules\Operations\ChecklistDetailRepo;
use App\Modules\Operations\OrderChecklistDetailRepo;
use App\Modules\Operations\OrderRepo;
use App\Modules\Operations\OrderDetailRepo;
use App\Modules\Finances\PaymentConditionRepo;
use App\Modules\Finances\CompanyRepo;
use App\Modules\Finances\ProofRepo;
use App\Modules\Base\CurrencyRepo;
use App\Modules\Finances\BankRepo;
use App\Modules\Operations\CarRepo;
use App\Modules\Base\TableRepo;
use App\Modules\Operations\BrandRepo;
use App\Modules\Operations\ModeloRepo;
use App\Modules\Base\UbigeoRepo;
use App\Exports\OrdersExport;

class OrdersController extends Controller {

	protected $repo;
	protected $orderDetailRepo;
	protected $paymentConditionRepo;
	protected $companyRepo;
	protected $bankRepo;
	protected $carRepo;
	protected $tableRepo;
	protected $proofRepo;
	protected $brandRepo;
	protected $modeloRepo;
	protected $ubigeoRepo;

	public function __construct(OrderRepo $repo, OrderDetailRepo $orderDetailRepo, PaymentConditionRepo $paymentConditionRepo, CompanyRepo $companyRepo, BankRepo $bankRepo, ChecklistDetailRepo $checklistDetailRepo, OrderChecklistDetailRepo $orderChecklistDetailRepo, CarRepo $carRepo, TableRepo $tableRepo, ProofRepo $proofRepo, BrandRepo $brandRepo, ModeloRepo $modeloRepo, UbigeoRepo $ubigeoRepo) {
		$this->repo = $repo;
		$this->orderDetailRepo = $orderDetailRepo;
		$this->paymentConditionRepo = $paymentConditionRepo;
		$this->companyRepo = $companyRepo;
		$this->bankRepo = $bankRepo;
		$this->checklistDetailRepo = $checklistDetailRepo;
		$this->orderChecklistDetailRepo = $orderChecklistDetailRepo;
		$this->carRepo = $carRepo;
		$this->tableRepo = $tableRepo;
		$this->proofRepo = $proofRepo;
		$this->brandRepo = $brandRepo;
		$this->modeloRepo = $modeloRepo;
		$this->ubigeoRepo = $ubigeoRepo;
	}
	public function index()
	{
		$filter = (object) request()->all();
		if( !((array) $filter) ) {
			$filter->sn = '';
			$filter->placa = '';
			$filter->mycompany_id = '';
			$filter->seller_id = '';
			$filter->status = '';
			$filter->f1 = date('Y-m-d', strtotime('first day of this month'));
			$filter->f2 = date('Y-m-d', strtotime('last day of this month'));
		}
		$models = $this->repo->filter($filter);

		$sellers = $this->companyRepo->getListSellers();
		$locals = $this->companyRepo->getListMyCompany();
		if (isset($filter->excel)) {
	        return \Excel::download(new OrdersExport('operations.inventory.export_excel', $models), 'inventarios_vehiculares_'.date("Ymd_His").'.xlsx');
		}
		return view('partials.filter',compact('models', 'filter', 'sellers', 'locals'));
	}
	public function byQuote($quote_id)
	{
		$action = "generar";
		$model = $this->repo->findOrFail($quote_id);
		//dd($model);
		$quote = $model;
		$my_companies = $this->companyRepo->getListMyCompany();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = $model->company->branches->pluck('company_name', 'id')->toArray();
		$bs_shipper = ($model->shipper_id > 0) ? $model->shipper->branches->pluck('company_name', 'id')->toArray() : [];
		return view('operations.output_orders.create_by_quote', compact('model', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'quote', 'action'));
	}

	public function index2()
	{
		$models = $this->repo->index('name', request()->get('name'));
		return view('partials.index',compact('models'));
	}

	public function create()
	{
		$service_types = config('options.types_service');
		unset($service_types['AMPLIACION']);
		if ( !is_null( request()->input('type_service') ) ) {
			if (request()->input('type_service') == 'AMPLIACION') {
				$service_types = ['AMPLIACION' => 'AMPLIACION'];
			} elseif (request()->input('type_service') == 'PARTICULAR') {
				unset($service_types['SINIESTRO']);
			}
		}
		$brands = $this->brandRepo->getList2();
		$modelos = [];
		$bodies = config('options.bodies');
		$ubigeo = $this->ubigeoRepo->listUbigeo();

		$action = "create";
		$my_companies = $this->companyRepo->getListMyCompany();
		$insurance_companies = $this->companyRepo->getListInsuranceCompanies();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = ['' => 'Seleccionar'];
		$bs_shipper = ['' => 'Seleccionar'];
		$checklist_details = $this->checklistDetailRepo->all2();
		// return view('operations.inventory.create', compact('payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'action'));
		// dd(\Str::before(request()->route()->getName(), '.'));
		$view = 'partials.create';
		if ('inventory' == \Str::before(request()->route()->getName(), '.')) {
			$view = 'operations.inventory.form';
		}
		return view($view, compact('payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'action', 'checklist_details', 'insurance_companies', 'brands', 'modelos', 'bodies', 'ubigeo', 'service_types'));
	}

	public function store()
	{
		$data = request()->all();
		$model = $this->repo->save($data);
		$this->carRepo->update_contact($data);
		if (explode('.', \Request::route()->getName())[0] == 'output_quotes') {
			return redirect()->route('output_quotes.edit', $model->id);
		}
		if (explode('.', \Request::route()->getName())[0] == 'inventory') {
			return redirect()->route('panel', ['status' => $model->status]);
		}
		if (isset($data['last_page']) && $data['last_page'] != '') {
			return redirect()->to($data['last_page']);
		}
		return redirect()->route(explode('.', request()->route()->getName())[0].'.index');
	}

	public function show($id)
	{
		$brands = $this->brandRepo->getList2();
		$service_types = config('options.types_service');
		$modelos = [];
		$bodies = config('options.bodies');
		$ubigeo = $this->ubigeoRepo->listUbigeo();

		$action = "show";
		$model = $this->repo->findOrFail($id);
		$quote = $model->quote;
		$my_companies = $this->companyRepo->getListMyCompany();
		$insurance_companies = $this->companyRepo->getListInsuranceCompanies();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = $model->company->branches->pluck('name', 'id')->toArray();
		$bs_shipper = ($model->shipper_id > 0) ? $model->shipper->branches->pluck('company_name', 'id')->prepend('Seleccionar', '') : [''=>'Seleccionar'] ;
		$checklist_details = $this->orderChecklistDetailRepo->byOrder($model->id, '1');
		if ($checklist_details->isEmpty()) {
			$checklist_details = $this->checklistDetailRepo->all2();
		}
		$car = $model->car;
		// $car = $this->carRepo->findOrFail($car_id);
		$client = $car->company;

		$view = 'partials.show';
		if ('inventory' == \Str::before(request()->route()->getName(), '.')) {
			$view = 'operations.inventory.form';
		}
		return view($view, compact('model', 'car', 'client', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'quote', 'action', 'checklist_details', 'insurance_companies', 'brands', 'modelos', 'bodies', 'ubigeo'));
	}

	public function edit($id)
	{
		$brands = $this->brandRepo->getList2();
		$modelos = [];
		$bodies = config('options.bodies');
		$ubigeo = $this->ubigeoRepo->listUbigeo();

		$action = "edit";
		$model = $this->repo->findOrFail($id);
		$service_types = config('options.types_service');
		unset($service_types['AMPLIACION']);
		if ($model->order_type == 'output_quotes') {
			if ($model->type_service == 'AMPLIACION') {
				$service_types = [$model->type_service => $model->type_service];
			} elseif ($model->type_service == 'SINIESTRO') {
				$service_types = [$model->type_service => $model->type_service];
			} else {
				unset($service_types['SINIESTRO']);
			}
		}

		$inventory = null; 
		if (isset($model)) {
			if ($model->order_type == 'inventory') {
				$inventory = $model;
			} else {
				$inventory = $model->inventario;
			}
		}
		$my_companies = $this->companyRepo->getListMyCompany();
		$insurance_companies = $this->companyRepo->getListInsuranceCompanies();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = $model->company->branches->pluck('company_name', 'id')->toArray();
		$bs_shipper = ($model->shipper_id > 0) ? $model->shipper->branches->pluck('company_name', 'id')->prepend('Seleccionar', '') : [''=>'Seleccionar'] ;
		$checklist_details = $this->orderChecklistDetailRepo->byOrder($model->id, '1');
		if ($checklist_details->isEmpty()) {
			$checklist_details = $this->checklistDetailRepo->all2();
		}
		$car = $model->car;
		$client = $car->company;
		$categories_service = $this->tableRepo->getListCatSer();
		$categories_product = $this->tableRepo->getListCatPro();
		$units_service = $this->tableRepo->getListUnitSer();
		$units_product = $this->tableRepo->getListUnitPro();
		// $checklist_details = $this->checklistDetailRepo->all2();
		// dd($checklist_details);

		$view = 'partials.edit';
		if ('inventory' == \Str::before(request()->route()->getName(), '.')) {
			$view = 'operations.inventory.form';
		}
		return view($view, compact('model', 'car', 'client', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'inventory', 'action', 'checklist_details', 'categories_service', 'categories_product', 'units_service', 'units_product', 'insurance_companies', 'brands', 'modelos', 'bodies', 'ubigeo', 'service_types'));
	}

	public function update($id)
	{
		$data = request()->all();
        // return response()->json(['id' => $id, 'message' => 'holaaaaaaa']);
		// dd($data);
		$model = $this->repo->save($data, $id);
		$this->carRepo->update_contact($data);

        // Si la peticion es ajax
        if (request()->ajax()) {
            $message = "Los datos se guardaron correctamente";
            return response()->json(['id' => $id, 'message' => $message]);
        }

		if (explode('.', \Request::route()->getName())[0] == 'inventory') {
			return redirect()->route('panel', ['status' => $model->status]);
		}
		if (explode('.', \Request::route()->getName())[0] == 'output_quotes') {
			return redirect()->route('output_quotes.edit', $model->id);
		}
		if (isset($data['last_page']) && $data['last_page'] != '') {
			return redirect()->to($data['last_page']);
		}
		return redirect()->route(explode('.', request()->route()->getName())[0].'.index');
	}

	public function destroy($id)
	{
		$model = $this->repo->cancel($id);
		//$model = $this->repo->destroy($id);
		if (request()->ajax()) {	return $model; }
		return redirect()->route(explode('.', request()->route()->getName())[0].'.index');
	}

	/**
	 * CREA UN PDF Inventario EN EL NAVEGADOR
	 * @param  [integer] $id [Es el id de la cotizacion]
	 * @return [pdf]     [Retorna un pdf]
	 */
	public function print_inventory($id)
	{
		$cuentas = $this->bankRepo->mostrar();
		$model = $this->repo->findOrFail($id);
		$checklist_details = $this->orderChecklistDetailRepo->byOrder($model->id, '1');
		//dd($model->seller->company_name);
		// \PDF::setOptions(['isPhpEnabled' => true]);
		// dd($checklist_details);
		$pdf = \PDF::loadView('operations.inventory.pdf', compact('model', 'cuentas', 'checklist_details'));
		//$pdf = \PDF::loadView('pdfs.order_pdf', compact('model'));
		return $pdf->stream('Inventario_'.$model->id.'.pdf');
	}

	/**
	 * CREA UN PDF Inventario EN EL NAVEGADOR
	 * @param  [integer] $id [Es el id de la cotizacion]
	 * @return [pdf]     [Retorna un pdf]
	 */
	public function printInventory($id)
	{
		$cuentas = $this->bankRepo->mostrar();
		$model = $this->repo->findOrFail($id);
		//dd($model->seller->company_name);
		// \PDF::setOptions(['isPhpEnabled' => true]);
		$pdf = \PDF::loadView('pdfs.inventory', compact('model', 'cuentas'));
		//$pdf = \PDF::loadView('pdfs.order_pdf', compact('model'));
		return $pdf->stream('Inventario_'.$model->id.'.pdf');
	}
	/**
	 * Envía Correo al generar cotización
	 * @param  Obj $model Modelo de la cotización
	 * @return boolean        Retorna true indicando que se envió con exito
	 */

	/**
	 * CREA UN PDF EN EL NAVEGADOR
	 * @param  [integer] $id [Es el id de la cotizacion]
	 * @return [pdf]     [Retorna un pdf]
	 */
	public function print($id)
	{
		$cuentas = $this->bankRepo->mostrar();
		$model = $this->repo->findOrFail($id);
		//dd($model->mycompany->company_name);
		// \PDF::setOptions(['isPhpEnabled' => true]);
		$pdf = \PDF::loadView('pdfs.'.$model->order_type, compact('model', 'cuentas'));
		// $pdf = \PDF::loadView('operations.output_quotes.pdf', compact('model', 'cuentas'));
		return $pdf->stream();
	}

	/**
	 * Envía Correo al generar cotización
	 * @param  Obj $model Modelo de la cotización
	 * @return boolean        Retorna true indicando que se envió con exito
	 */

	/**
	 * CREA UN PDF EN EL NAVEGADOR
	 * @param  [integer] $id [Es el id de la cotizacion]
	 * @return [pdf]     [Retorna un pdf]
	 */
	public function print_quotes_details($id)
	{
		$cuentas = $this->bankRepo->mostrar();
		$model = $this->repo->findOrFail($id);
		//dd($model->mycompany->company_name);
		// \PDF::setOptions(['isPhpEnabled' => true]);
		// $pdf = \PDF::loadView('pdfs.'.$model->order_type, compact('model', 'cuentas'));
		$pdf = \PDF::loadView('operations.output_quotes.pdf_details', compact('model', 'cuentas'));
		return $pdf->stream();
	}

	/**
	 * Envía Correo al generar cotización
	 * @param  Obj $model Modelo de la cotización
	 * @return boolean        Retorna true indicando que se envió con exito
	 */

	/**
	 * CREA UN PDF EN EL NAVEGADOR
	 * @param  [integer] $id [Es el id de la cotizacion]
	 * @return [pdf]     [Retorna un pdf]
	 */
	public function print_quotes_categories($id)
	{
		$cuentas = $this->bankRepo->mostrar();
		$model = $this->repo->findOrFail($id);
		//dd($model->mycompany->company_name);
		// \PDF::setOptions(['isPhpEnabled' => true]);
		// $pdf = \PDF::loadView('pdfs.'.$model->order_type, compact('model', 'cuentas'));
		$pdf = \PDF::loadView('operations.output_quotes.pdf_categories', compact('model', 'cuentas'));
		return $pdf->stream();
	}

	/**
	 * CREA UN PDF EN EL NAVEGADOR
	 * @param  [integer] $id [Es el id de la cotizacion]
	 * @return [pdf]     [Retorna un pdf]
	 */
	public function print_quotes_taller($id)
	{
		$cuentas = $this->bankRepo->mostrar();
		$model = $this->repo->findOrFail($id);
		//dd($model->mycompany->company_name);
		// \PDF::setOptions(['isPhpEnabled' => true]);
		// $pdf = \PDF::loadView('pdfs.'.$model->order_type, compact('model', 'cuentas'));
		$pdf = \PDF::loadView('operations.output_quotes.pdf_taller', compact('model', 'cuentas'));
		return $pdf->stream();
	}

	/**
	 * Envía Correo al generar cotización
	 * @param  Obj $model Modelo de la cotización
	 * @return boolean        Retorna true indicando que se envió con exito
	 */
	private function sendAlert($model)
	{
		$data['model'] = $model;
        \Mail::send('emails.notificacion', $data, function($message)
        {
            $message->to('jchu@ddmmedical.com');
            $message->cc(['onavarro@ddmmedical.com', 'asistente@ddmmedical.com']);
            $message->subject('Verificar Cotización');
            $message->from(env('CONTACT_MAIL'), env('CONTACT_NAME'));
        });
	}

	public function createByCompany($company_id)
	{
		$action = "edit";
		$payment_conditions = $this->paymentConditionRepo->getList();
		$currencies = $this->currencyRepo->getList('symbol');
		$sellers = $this->employeeRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$company = $this->companyRepo->findOrFail($company_id);
		return view('partials.create', compact('payment_conditions', 'currencies', 'sellers', 'repairmens', 'company', 'action'));
	}

	public function panel($status='PEND')
	{
		$models = $this->repo->ordersRecepcion();
		session()->flash('panel-status', $status);
		return view('operations.inventory.panel', compact('models'));
	}

	public function createByCar($car_id)
	{
		$brands = $this->brandRepo->getList2();
		$modelos = [];
		$bodies = config('options.bodies');
		$ubigeo = $this->ubigeoRepo->listUbigeo();

		$action = "create";
		$my_companies = $this->companyRepo->getListMyCompany();
		$insurance_companies = $this->companyRepo->getListInsuranceCompanies();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = ['' => 'Seleccionar'];
		$bs_shipper = ['' => 'Seleccionar'];
		$car = $this->carRepo->findOrFail($car_id);

		$view = 'partials.create';
		if ('inventory' == \Str::before(request()->route()->getName(), '.')) {
			$view = 'operations.inventory.form';
		}
		return view($view, compact('car', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'action', 'insurance_companies', 'brands', 'modelos', 'bodies', 'ubigeo'));
	}

	public function recepcion_crear()
	{
		//dd(\Request::route()->getName());
		$action = "create";
		$my_companies = $this->companyRepo->getListMyCompany();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = ['' => 'Seleccionar'];
		$bs_shipper = ['' => 'Seleccionar'];
		return view('operations.inventory.create', compact('payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'action'));
	}

	public function recepcion_edit($id)
	{
		$action = "edit";
		$model = $this->repo->findOrFail($id);
		// dd(collect($model->custom_details)->sortBy('quantity'));
		$quote = $model->quote;
		$my_companies = $this->companyRepo->getListMyCompany();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = $model->company->branches->pluck('company_name', 'id')->toArray();
		$bs_shipper = ($model->shipper_id > 0) ? $model->shipper->branches->pluck('company_name', 'id')->prepend('Seleccionar', '') : [''=>'Seleccionar'] ;
		return view('operations.taller.recepcion_edit', compact('model', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'quote', 'action'));
	}
	public function recepcionByCar($car_id)
	{
		$brands = $this->brandRepo->getList2();
		$modelos = [];
		$bodies = config('options.bodies');
		$modelos = $this->modeloRepo->getListGroup('brand');
		$ubigeo = $this->ubigeoRepo->listUbigeo();
		
		$action = "create";
		$insurance_companies = $this->companyRepo->getListInsuranceCompanies();
		$checklist_details = $this->checklistDetailRepo->all2();
		$my_companies = $this->companyRepo->getListMyCompany();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = ['' => 'Seleccionar'];
		$bs_shipper = ['' => 'Seleccionar'];
		$car = $this->carRepo->findOrFail($car_id);
		$client = $car->company;

		$view = 'partials.create';
		if ('inventory' == \Str::before(request()->route()->getName(), '.')) {
			$view = 'operations.inventory.form';
		}
		return view($view, compact('car', 'client', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'action', 'checklist_details', 'insurance_companies', 'brands', 'modelos', 'modelos', 'bodies', 'ubigeo'));
	}
	public function changeStatusOrder($id)
	{
		$model = $this->repo->findOrFail($id);
		return view('operations.inventory.change_status', compact('model'));
	}
	public function updateStatus($id)
	{
		$data = request()->all();
		// dd($data['status']);
		if (isset($data['action']) and $data['action'] == 'cliente') {
			$mensaje['DIAG'][0] = 'Lamentamos que no estés de acuerdo con tu orden de trabajo, ahora tu asesor encargado se comunicará contigo, recuerda que estamos para servirte';
			$mensaje['DIAG'][1] = 'Ahora tu orden de trabajo avanzará a la fase de diagnóstico, recibirás una nueva notificación cuando el diagnóstico se haya completado';
			$mensaje['REPAR'][0] = 'Lamentamos que nuestro diagnóstico no haya sido oportuno, ahora tu asesor encargado se comunicará contigo, recuerda que estamos para servirte';
			$mensaje['REPAR'][1] = 'Diagnóstico aprobado con éxito, ahora nuestro equipo continuará con el proceso';

			$msj = $mensaje[$data['status']][$data['aprobacion']];

			if ($data['aprobacion']==1) {
				$icon = '<i class="fa-solid fa-thumbs-up"></i>';
				$title = '¡Bien!';
				$data['status_msj'] = 'Aprobado por Cliente';
				$data['status_aprobacion'] = 1;
			} else {
				$icon = '<i class="fa-solid fa-face-frown"></i>';
				$title = '¡Oh no!';
				$data['status_msj'] = 'Rechazado por Cliente';
				$data['status_aprobacion'] = 0;
			}
		} else {
			$data['status_msj'] = 'Estado cambiado por '.\Auth::user()->name . ' id = ' . \Auth::user()->id . '.';
			$data['status_aprobacion'] = 1;
		}
		$model = $this->repo->changeStatus($data, $id);
		if (isset($data['action']) and $data['action'] == 'cliente') {
			return view('operations.taller.cliente_respuesta', compact('icon', 'msj', 'title'));
		}
		return redirect()->route('panel', ['status' => $model->status]);
	}

	public function generateSlug()
	{
		$orders = $this->repo->withoutSlug();
		//dd($orders);
		$bits = 24;
		foreach ($orders as $key => $order) {
			$order->slug = bin2hex(random_bytes($bits));
			// $order->slug = 24;
			$order->save();
		}
		return 'Fin';
	}

	public function orderClient($slug)
	{
		$action = 'cliente';
		$model = $this->repo->findBySlug($slug);
		return view('operations.inventory.client_inventory', compact('model', 'action'));
	}
	public function by_inventory($id)
	{
		// dd( request()->input('type_service') );
		$service_types = config('options.types_service');
		unset($service_types['AMPLIACION']);
		if ( !is_null( request()->input('type_service') ) ) {
			if (request()->input('type_service') == 'AMPLIACION') {
				$service_types = ['AMPLIACION' => 'AMPLIACION'];
			} elseif (request()->input('type_service') == 'PARTICULAR') {
				unset($service_types['SINIESTRO']);
			}
		}
		$action = "create";
		$model = $this->repo->findOrFail($id);
		$inventory = $model;
		$my_companies = $this->companyRepo->getListMyCompany();
		$insurance_companies = $this->companyRepo->getListInsuranceCompanies();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = $model->company->branches->pluck('company_name', 'id')->toArray();
		$bs_shipper = ($model->shipper_id > 0) ? $model->shipper->branches->pluck('company_name', 'id')->prepend('Seleccionar', '') : [''=>'Seleccionar'] ;
		return view('operations.output_quotes.create_by_inventory', compact('model', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'inventory', 'action', 'insurance_companies', 'service_types'));
	}
	public function diagnostico_edit($id)
	{
		$action = "edit";
		$model = $this->repo->findOrFail($id);
		// dd(collect($model->custom_details)->sortBy('quantity'));
		$quote = $model->quote;
		$my_companies = $this->companyRepo->getListMyCompany();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = $model->company->branches->pluck('company_name', 'id')->toArray();
		$bs_shipper = ($model->shipper_id > 0) ? $model->shipper->branches->pluck('company_name', 'id')->prepend('Seleccionar', '') : [''=>'Seleccionar'] ;
		return view('operations.taller.diagnostico', compact('model', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'quote', 'action'));
	}
	public function repuestos_edit($id)
	{
		dd('repuestos_edit');
	}
	public function pre_aprobacion_edit($id)
	{
		dd('pre_aprobacion_edit');
	}
	public function aprobacion_edit($id)
	{
		dd('aprobacion_edit');
	}
	public function repair_edit($id)
	{
		$model = $this->repo->findOrFail($id);
		$locales = $this->companyRepo->getListMyCompany();
		$masters = $this->companyRepo->getMastersByCat();
		return view('operations.inventory.reparacion', compact('model', 'locales', 'masters'));
	}
	public function repair_update($id)
	{
		$data = request()->all();
		// dd($data);
		if ($data['details']) {
			$this->orderDetailRepo->repair_update($data['details']);
		}
		$vouchers = [];

	    foreach ($data['details'] as $detailId => $detail) {
	        if (!empty($detail['voucher']) && !empty($detail['technician_id'])) {
	            $tecnicoId = $detail['technician_id'];
	            $monto = floatval($detail['cost']);

	            // Inicializar si no existe
	            if (!isset($vouchers[$tecnicoId])) {
	                $vouchers[$tecnicoId] = [
	                    'total' => 0,
	                    'items' => [],
	                ];
	            }

	            // Sumar al total
	            $vouchers[$tecnicoId]['total'] += $monto;

	            // Agregar ítem
	            $vouchers[$tecnicoId]['items'][] = [
	                'detail_id' => $detailId,
	                'monto' => $monto,
	            ];
	        }
	    }

	    $this->proofRepo->generarVouchers($vouchers);
	    
	    return redirect()->route('vales.index');
		dd($vouchers);


		dd('repair_update');
	}
	public function controlcalidad_edit($id)
	{
		dd('controlcalidad_edit');
	}
	public function entrega_edit($id)
	{
		dd('entrega_edit');
	}


}