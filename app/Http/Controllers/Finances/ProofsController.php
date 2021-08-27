<?php namespace App\Http\Controllers\Finances;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Modules\Finances\ProofRepo;
use App\Modules\Finances\CompanyRepo;
use App\Modules\Storage\WarehouseRepo;
use App\Modules\Operations\OrderRepo;

class ProofsController extends Controller {

	protected $repo;
	protected $companyRepo;
	protected $warehouseRepo;
	protected $orderRepo;

	protected $proof_type;
	protected $doc;

	public function __construct(ProofRepo $repo, CompanyRepo $companyRepo, WarehouseRepo $warehouseRepo, OrderRepo $orderRepo) {
		$this->repo = $repo;
		$this->companyRepo = $companyRepo;
		$this->warehouseRepo = $warehouseRepo;
		$this->orderRepo = $orderRepo;

		$this->getType();
	}

	public function index()
	{
		if (explode('.', \Request::route()->getName())[0] == 'reception_letters') {
			$proof_type = 4;
		} elseif (explode('.', \Request::route()->getName())[0] == 'issuance_letters') {
			$proof_type = 3;
		} elseif (explode('.', \Request::route()->getName())[0] == 'reception_vouchers') {
			$proof_type = 2;
		} else {
			$proof_type = 1;
		}
		$filter = (object) \Request::all();
		if( !((array) $filter) ) {
			$filter->sn = '';
			$filter->seller_id = '';
			$filter->status_id = '';
			$filter->f1 = date('Y-m-d', strtotime('first day of this month'));
			$filter->f2 = date('Y-m-d', strtotime('last day of this month'));
		}
		$models = $this->repo->filter($filter, $proof_type);
		
		$sellers = $this->companyRepo->getListSellers();
		$payment_conditions = [];
		return view('partials.filter',compact('models', 'filter', 'sellers'));
	}

	public function issuanceVouchers()
	{
		$models = $this->repo->issuanceVouchers('number', \Request::get('name'));
		return view('finances.proofs.issuance_vouchers',compact('models'));
	}

	public function create()
	{
		// dd(\Request::route()->action['as']);
		$my_companies = $this->companyRepo->getListMyCompany();
		$proof_type = $this->proof_type;
		$sunat_transaction = 1;
		$igv_code = 1;
		$sellers = $this->companyRepo->getListSellers();
		return view('partials.create', compact('proof_type', 'sellers', 'my_companies', 'sunat_transaction', 'igv_code'));
	}


	public function byOrder($order_id)
	{
		$model = $this->orderRepo->findOrFail($order_id);
		$order = $model;
		//dd($model);
		$my_companies = $this->companyRepo->getListMyCompany();

		$sunat_transaction = 1;
		$igv_code = 1;
		$proof_type = $this->proof_type;
		$sellers = $this->companyRepo->getListSellers();
		return view('partials.create', compact('model', 'order_id', 'sellers', 'warehouses','items', 'proof_type', 'my_companies', 'sunat_transaction', 'igv_code', 'order'));
	}

	public function index2()
	{
		$models = $this->repo->index('sn', \Request::get('name'), $this->proof_type);
		return view('partials.index',compact('models'));
	}

	public function store()
	{
		//dd(\Request::all());
		$this->repo->save(\Request::all());
		return redirect()->route($this->doc.'.index');
	}

	public function show($id)
	{
		$model = $this->repo->findOrFail($id);
		$my_companies = $this->companyRepo->getListMyCompany();

		$sunat_transaction = $model->sunat_transaction;
		$igv_code = $model->igv_code;
		$proof_type = $this->proof_type;
		$sellers = $this->companyRepo->getListSellers();
		return view('partials.show', compact('model', 'sellers', 'warehouses','items', 'proof_type', 'my_companies', 'sunat_transaction', 'igv_code'));
	}

	public function edit($id)
	{
		$model = $this->repo->findOrFail($id);
		//$my_companies = $this->companyRepo->getListMyCompany();

		$sunat_transaction = $model->sunat_transaction;
		$igv_code = $model->igv_code;
		$proof_type = $this->proof_type;
		$sellers = $this->companyRepo->getListSellers();
		return view('partials.edit', compact('model', 'sellers', 'warehouses', 'items', 'proof_type', 'sunat_transaction', 'igv_code'));
	}

	public function update($id)
	{
		$this->repo->save(\Request::all(), $id);
		return redirect()->route($this->doc.'.index');
	}

	public function destroy($id)
	{
		$model = $this->repo->destroy($id);
		if (\Request::ajax()) {	return $model; }
		return redirect()->route($this->doc.'.index');
	}
	public function createByCompany($company_id)
	{
		$document_types = $this->documentTypeRepo->getList();
		$currencies = $this->currencyRepo->getList('symbol');
		$payment_conditions = $this->paymentConditionRepo->getList();
		$company = $this->companyRepo->findOrFail($company_id);
		return view('partials.create', compact('document_types', 'currencies', 'payment_conditions', 'company'));
	}
	public function getType()
	{
		$this->doc = explode('.', \Request::route()->getName())[0];
		$array = [
			'issuance_vouchers' => 1,
			'reception_vouchers' => 2,
			'issuance_letters' => 3,
			'reception_letters' => 4,
		];
		$this->proof_type = isset($array[$this->doc]) ? $array[$this->doc] : 0;
		return true;
	}
	public function ajaxAutocomplete1($company_id)
	{
		$term = \Input::get('term');
		$models = $this->repo->autocomplete1($term, $company_id);
		$result = [];
		foreach ($models as $model) {
			$result[]=[
				'value' => $model->document_type->name.' '.$model->sn,
				'id' => $model,
				'label' => $model->document_type->name.' '.$model->sn
			];
		}
		return \Response::json($result);
	}
	public function print($id)
	{
		$model = $this->repo->findOrFail($id);
		//dd(json_decode($model->response_sunat)->links);
		$r = json_decode($model->response_sunat);
		return response(file_get_contents($r->links->pdf), 200, [
			'Content-Type' => 'application/pdf',
			'Content-Disposition' => 'inline; filename="'.$r->data->filename.".pdf".'"'
		]);
	}
	public function send_email_cpe()
	{
		$data = \Request::all();
		$id = $data['cpe'];
		$email = $data['email'];
		$model = $this->repo->findOrFail($id);
		$r = json_decode($model->response_sunat);
		$data['model'] = $model;
		$data['r'] = $r;
		// dd($email);
		// return 'correo enviado x';
		\Mail::send('emails.message', $data, function($message) use ($model, $r,$email)
		{
			$message->to($email, $model->company->company_name);
			$message->sender(env('CONTACT_MAIL'));
			$message->subject('Envio de Comprobante de Pago Electrónico');
			$message->from(env('CONTACT_MAIL'), env('CONTACT_NAME'));
		});
		echo $icons['pdf'];
		return 'correo enviado';
	}
}
