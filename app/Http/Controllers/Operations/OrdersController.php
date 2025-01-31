<?php
namespace App\Http\Controllers\Operations;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Modules\Operations\OrderRepo;
use App\Modules\Finances\PaymentConditionRepo;
use App\Modules\Finances\CompanyRepo;
use App\Modules\Base\CurrencyRepo;
use App\Modules\Finances\BankRepo;

class OrdersController extends Controller {

	protected $repo;
	protected $paymentConditionRepo;
	protected $companyRepo;
	protected $bankRepo;

	public function __construct(OrderRepo $repo, PaymentConditionRepo $paymentConditionRepo, CompanyRepo $companyRepo, BankRepo $bankRepo) {
		$this->repo = $repo;
		$this->paymentConditionRepo = $paymentConditionRepo;
		$this->companyRepo = $companyRepo;
		$this->bankRepo = $bankRepo;
	}
	public function index()
	{
		$filter = (object) request()->all();
		if( !((array) $filter) ) {
			$filter->sn = '';
			$filter->placa = '';
			$filter->seller_id = '';
			$filter->status = '';
			$filter->f1 = date('Y-m-d', strtotime('first day of this month'));
			$filter->f2 = date('Y-m-d', strtotime('last day of this month'));
		}
		$models = $this->repo->filter($filter);

		$sellers = $this->companyRepo->getListSellers();
		return view('partials.filter',compact('models', 'filter', 'sellers'));
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
		$action = "create";
		$my_companies = $this->companyRepo->getListMyCompany();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = ['' => 'Seleccionar'];
		$bs_shipper = ['' => 'Seleccionar'];
		// return view('operations.inventory.create', compact('payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'action'));
		return view('partials.create', compact('payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'action'));
	}

	public function store()
	{
		$data = request()->all();
		//dd($data);
		$this->repo->save($data);
		if (isset($data['last_page']) && $data['last_page'] != '') {
			return redirect()->to($data['last_page']);
		}
		return redirect()->route(explode('.', request()->route()->getName())[0].'.index');
	}

	public function show($id)
	{
		$action = "show";
		$model = $this->repo->findOrFail($id);
		$quote = $model->quote;
		$my_companies = $this->companyRepo->getListMyCompany();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = $model->company->branches->pluck('name', 'id')->toArray();
		$bs_shipper = ($model->shipper_id > 0) ? $model->shipper->branches->pluck('company_name', 'id')->prepend('Seleccionar', '') : [''=>'Seleccionar'] ;
		return view('partials.show', compact('model', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'quote', 'action'));
	}

	public function edit($id)
	{
		$action = "edit";
		$model = $this->repo->findOrFail($id);
		// dd($model->inventory['solicitud']);
		$quote = $model->quote;
		$my_companies = $this->companyRepo->getListMyCompany();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = $model->company->branches->pluck('company_name', 'id')->toArray();
		$bs_shipper = ($model->shipper_id > 0) ? $model->shipper->branches->pluck('company_name', 'id')->prepend('Seleccionar', '') : [''=>'Seleccionar'] ;
		return view('partials.edit', compact('model', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'quote', 'action'));
	}

	public function update($id)
	{
		$data = request()->all();
		// dd($data);
		$this->repo->save($data, $id);
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
	public function printInventory($id)
	{
		$cuentas = $this->bankRepo->mostrar();
		$model = $this->repo->findOrFail($id);
		//dd($model->seller->company_name);
		// \PDF::setOptions(['isPhpEnabled' => true]);
		$pdf = \PDF::loadView('pdfs.inventory', compact('model', 'cuentas'));
		//$pdf = \PDF::loadView('pdfs.order_pdf', compact('model'));
		return $pdf->stream('Inventorio_'.$model->id.'.pdf');
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
		//$pdf = \PDF::loadView('pdfs.order_pdf', compact('model'));
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

	public function panel()
	{
		$models = $this->repo->ordersRecepcion();
		return view('operations.inventory.panel', compact('models'));
	}

	public function createByCar($car_id)
	{
		$action = "create";
		$my_companies = $this->companyRepo->getListMyCompany();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = ['' => 'Seleccionar'];
		$bs_shipper = ['' => 'Seleccionar'];
		$car = $this->carRepo->findOrFail($car_id);
		return view('partials.create', compact('car', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'action'));
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
		$action = "create";
		$my_companies = $this->companyRepo->getListMyCompany();
		$payment_conditions = $this->paymentConditionRepo->getList();
		$sellers = $this->companyRepo->getListSellers();
		$repairmens = $this->companyRepo->getListRepairmens();
		$bs = ['' => 'Seleccionar'];
		$bs_shipper = ['' => 'Seleccionar'];
		$car = $this->carRepo->findOrFail($car_id);
		return view('operations.taller.recepcion_crear', compact('car', 'payment_conditions', 'sellers', 'repairmens', 'my_companies', 'bs', 'bs_shipper', 'action'));
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
		if ($data['action'] == 'cliente') {
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
		}
		$model = $this->repo->changeStatus($data, $id);
		if ($data['action'] == 'cliente') {
			return view('operations.taller.cliente_respuesta', compact('icon', 'msj', 'title'));
		}
		return redirect()->route('home2');
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
	public function aprobacion_edit($id)
	{
		dd('aprobacion_edit');
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