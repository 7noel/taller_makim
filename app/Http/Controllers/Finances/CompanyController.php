<?php

namespace App\Http\Controllers\Finances;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Modules\Finances\CompanyRepo;
use App\Modules\Finances\Company;
use App\Modules\Base\UbigeoRepo;
use App\Modules\Base\TableRepo;

use App\Http\Requests\Finances\FormCompanyRequest;

class CompanyController extends Controller {

	protected $repo;
	protected $ubigeoRepo;
	protected $tableRepo;
	protected $idTypeRepo;

	public function __construct(CompanyRepo $repo, UbigeoRepo $ubigeoRepo, TableRepo $tableRepo) {
		$this->repo = $repo;
		$this->ubigeoRepo = $ubigeoRepo;
		$this->tableRepo = $tableRepo;
	}

	public function register()
	{
		$ubigeo = $this->ubigeoRepo->listUbigeo();
		return view('partials.create', compact('ubigeo'));
	}

	public function my_company()
	{
		$id = session('my_company')->id;
		$model = $this->repo->findOrFail($id);
		// dd($model);
		$jobs = $this->tableRepo->getListType('jobs');
		$ubigeo = $this->ubigeoRepo->listUbigeo($model->ubigeo_code);
		return view('finances.companies.edit', compact('model', 'ubigeo', 'jobs'));
	}
	public function save_my_company($id)
	{
		// $id = session('my_company')->id;
		$data = request()->all();
		//dd($data);
		
		$model = $this->repo->save($data, $id);

		// Si el usuario editado es el que está logueado, actualiza la variable de sesión
		if (auth()->user()->my_company == $model->id) {
	        session(['my_company' => $model]);
	    }
		return redirect()->to('/');
		// if (isset($data['last_page']) && $data['last_page'] != '') {
		// 	return redirect()->to($data['last_page']);
		// }
		// return redirect()->route($this->getType().'.index');
	}

	public function ajaxList(Request $request)
	{
	    $type = explode('.', \Request::route()->getName())[0];
	    //dd(\Request::route()->getName());

	    $query = Company::where('entity_type', $type);

	    // Búsqueda general
	    if ($search = $request->input('search.value')) {
	        $query->where(function ($q) use ($search) {
	            $q->where('company_name', 'like', "%{$search}%")
	              ->orWhere('doc', 'like', "%{$search}%");
	        });
	    }

	    $total = $query->count();

	    // Ordenamiento
	    if ($order = $request->input('order')) {
	        $columns = ['id', 'company_name', 'doc'];
	        $columnIndex = $order[0]['column'];
	        $dir = $order[0]['dir'];
	        $query->orderBy($columns[$columnIndex], $dir);
	    }

	    // Paginación
	    $start = intval($request->input('start'));
		$length = intval($request->input('length'));
		$page = ($start / $length) + 1;
		$query->forPage($page, $length);


	    $models = $query->get();

	    $data = $models->map(function ($model) use ($type) {
			if ($type=='employees') {
				$dir_view_actions ="humanresources.{$type}.partials.actions";
			} else {
				$dir_view_actions ="finances.{$type}.partials.actions";
			}
			return [
				'id' => $model->id,
				'company_name' => $model->company_name,
	            'doc'        => config('options.client_doc.'.$model->id_type).' '.$model->doc,
	            'job'        => optional($model->job)->name,
	            'local'      => optional($model->mycompany)->brand_name,
	            'vale'       => (isset($model->config['vale']) and $model->config['vale']!='' ) ? 'SI' : 'NO',
				'acciones' => view($dir_view_actions, compact('model', 'type'))->render()
			];

	    });

	    return response()->json([
	        'draw' => intval($request->input('draw')),
	        'recordsTotal' => $total,
	        'recordsFiltered' => $total,
	        'data' => $data,
	    ]);
	}

	public function index()
	{
		$models = [];
		// $models = $this->repo->index('name', request()->get('name'));
		return view('partials.index',compact('models'));
	}

	public function create()
	{
		$jobs = $this->tableRepo->getListType('jobs');
		$ubigeo = $this->ubigeoRepo->listUbigeo();
		$locales = $this->repo->getListMyCompany();
		return view('partials.create', compact('ubigeo', 'jobs', 'locales'));
	}

	public function store(FormCompanyRequest $request)
	{
		$data = request()->all();
		$model = $this->repo->save($data);
		if (isset($data['crear_vehiculo'])) {
			return redirect()->route('cars.create_by_client', ['client_id' => $model->id]);
		}
		if (isset($data['last_page']) && $data['last_page'] != '') {
			return redirect()->to($data['last_page']);
		}
		return redirect()->route($this->getType().'.index');
	}

	public function show($id)
	{
		$model = $this->repo->findOrFail($id);
		$jobs = $this->tableRepo->getListType('jobs');
		$ubigeo = $this->ubigeoRepo->listUbigeo($model->ubigeo_code);
		$locales = $this->repo->getListMyCompany();
		return view('partials.show', compact('model', 'jobs', 'ubigeo', 'locales'));
	}

	public function edit($id)
	{
		$model = $this->repo->findOrFail($id);
		$jobs = $this->tableRepo->getListType('jobs');
		$ubigeo = $this->ubigeoRepo->listUbigeo($model->ubigeo_code);
		$locales = $this->repo->getListMyCompany();
		return view('partials.edit', compact('model', 'ubigeo', 'jobs', 'locales'));
	}

	public function update($id, FormCompanyRequest $request)
	{
		$data = request()->all();
		//dd($data);
		
		$this->repo->save($data, $id);
		if (isset($data['last_page']) && $data['last_page'] != '') {
			return redirect()->to($data['last_page']);
		}
		return redirect()->route($this->getType().'.index');
	}

	public function destroy($id)
	{
		$model = $this->repo->destroy($id);
		if (request()->ajax()) {	return $model; }
		return redirect()->route($this->getType().'.index');
	}
	public function ajaxAutocomplete($type = '', $my_company = '')
	{
		$term = request()->get('term');
		$models = $this->repo->autocomplete($type, $my_company, $term);
		$result = $models->map(function ($model){
			return [
				'value' => $model->company_name,
				'id' => $model->id,
				'country' =>$model->country,
				'company_name' =>$model->company_name,
				'email' =>$model->email,
				'phone' =>$model->phone,
				'mobile' =>$model->mobile,
				'id_type' =>$model->id_type,
				'label' => config('options.client_doc.'.$model->id_type).' '.$model->doc.' '.$model->company_name,
				'branches' => $model->branches->map(function ($branch){
					return ['id' => $branch->id, 'company_name' => $branch->company_name];
				})
			];
		});
		return response()->json($result);
	}
	public function getType()
	{
		return explode('.', request()->route()->getName())[0];
	}
}
