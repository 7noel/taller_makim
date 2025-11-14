<?php namespace App\Http\Controllers\Operations;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Modules\Operations\BrandRepo;
use App\Modules\Operations\ModeloRepo;
use App\Modules\Operations\CarRepo;
use App\Modules\Operations\Car;
use App\Modules\Finances\CompanyRepo;
use App\Modules\Base\UbigeoRepo;

use App\Http\Requests\Operations\FormCarRequest;

class CarsController extends Controller {

	protected $repo;
	protected $brandRepo;
	protected $modeloRepo;
	protected $companyRepo;
	protected $ubigeoRepo;

	public function __construct(CompanyRepo $companyRepo, CarRepo $repo, BrandRepo $brandRepo, ModeloRepo $modeloRepo, UbigeoRepo $ubigeoRepo) {
		$this->repo = $repo;
		$this->brandRepo = $brandRepo;
		$this->modeloRepo = $modeloRepo;
		$this->companyRepo = $companyRepo;
		$this->ubigeoRepo = $ubigeoRepo;
	}

	public function ajaxList(Request $request)
	{
	    $type = explode('.', \Request::route()->getName())[0];
	    //dd(\Request::route()->getName());

	    $query = Car::with('modelo.brand', 'company');

	    // Búsqueda general
	    if ($search = $request->input('search.value')) {
	        $query->where(function ($q) use ($search) {
	            $q->where('placa', 'like', "%{$search}%")
	              ->orWhere('vin', 'like', "%{$search}%");
	        });
	    }

	    $total = $query->count();

	    // Ordenamiento
	    if ($order = $request->input('order')) {
	        $columns = ['id', 'placa', 'vin'];
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
			$dir_view_actions ="operations.{$type}.partials.actions";
			return [
				'id' => $model->id,
				'placa' => $model->placa,
	            'marca_modelo' => $model->modelo->brand->name." ".$model->modelo->name,
	            'year' => $model->year,
	            'vin' => $model->vin,
	            'company_name' => $model->company->company_name,
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
		return view('partials.index',compact('models'));
	}

	public function create()
	{
		$bodies = config('options.bodies');
		$brands = $this->brandRepo->getList2();
		//dd($brands);
		// $modelos = $this->modeloRepo->getListGroup('brand');
		$modelos = [];
		$ubigeo = $this->ubigeoRepo->listUbigeo();
		return view('partials.create', compact('brands', 'modelos', 'bodies', 'ubigeo'));
	}

	public function createByClient($client_id)
	{
		$client = $this->companyRepo->find($client_id);
		$brands = $this->brandRepo->getList2();
		$modelos = [];
		$bodies = config('options.bodies');
		$modelos = $this->modeloRepo->getListGroup('brand');
		$ubigeo = $this->ubigeoRepo->listUbigeo();
		// return redirect()->route('cars.add', $client);
		return view('partials.create', compact('brands', 'modelos', 'client', 'modelos', 'bodies', 'ubigeo'));
	}

	public function store(FormCarRequest $request)
	{
		$data = request()->all();
        try {
            \DB::beginTransaction();

            // Guarda con tu repositorio
            $model = $this->repo->save($data);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error('companies.store failed', ['e' => $e]);

            // AJAX: 500 JSON | No-AJAX: back() con error+old input
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'No se pudo crear el vehículo. Inténtalo nuevamente.',
                ], 500);
            }

            return back()
                ->withInput()
                ->with('error', 'No se pudo crear el vehículo. Inténtalo nuevamente.');
        }
		
		// AJAX: JSON estándar con 201 Created
        if ($request->expectsJson() || $request->ajax()) {
        	$model->load('company', 'modelo.brand');
            return response()->json([
                'status'   => 'ok',
                'message'  => 'Vehículo creado correctamente',
                'data'     => [
                    // Expón solo lo necesario (evita filtrar datos sensibles)
                    'model'        => $model,
                ],
            ], 201);
        }

		if(isset($data['crear_ingreso'])) {
			return redirect()->route('inventory.recepcion_by_car', ['car_id' => $model->id]);
			// return redirect()->route('output_orders.by_car', ['car_id' => $model->id]);
		}
		if (isset($data['last_page'])) {
			return redirect($data['last_page']);
		}
		return redirect()->route('cars.index');
	}

	public function show($id)
	{
		$model = $this->repo->findOrFail($id);
		$brands = $this->brandRepo->getList2();
		$modelos = $model->brand->modelos->sortBy('name')->pluck('name', 'id')->toArray();
		$bodies = config('options.bodies');
		$ubigeo = $this->ubigeoRepo->listUbigeo();
		return view('partials.show', compact('model', 'brands', 'modelos', 'bodies', 'ubigeo'));
	}

	public function edit($id)
	{
		$model = $this->repo->findOrFail($id);
		$brands = $this->brandRepo->getList2();
		$modelos = $model->brand->modelos->sortBy('name')->pluck('name', 'id')->toArray();
		$bodies = config('options.bodies');
		$ubigeo = $this->ubigeoRepo->listUbigeo();
		return view('partials.edit', compact('model', 'brands', 'modelos', 'bodies', 'ubigeo'));
	}

	public function update($id, FormCarRequest $request)
	{
		// dd(request()->all());
		$data = request()->all();
		$this->repo->save($data, $id);
		if(isset($data['crear_ingreso'])) {
			return redirect()->route('inventory.recepcion_by_car', ['car_id' => $model->id]);
		}
		if (isset($data['last_page'])) {
			return redirect($data['last_page']);
		}
		return redirect()->route('cars.index');
	}

	public function destroy($id)
	{
		$model = $this->repo->destroy($id);
		if (request()->ajax()) {	return $model; }
		return redirect()->route('cars.index');
	}

	public function modelosByWarehouse($warehouse_id)
	{
		$modelos = $this->modeloRepo->modelosByWarehouse($warehouse_id);
		return response()->json($modelos);
	}
	public function getCar($placa)
	{
		$model = $this->repo->getCar($placa);
		return response()->json($model);
	}
	public function reportNacimiento()
	{
		$filter = (object) request()->all();
		if( !((array) $filter) ) {
			$filter->f1 = date('m', strtotime("+ 1 month"));
		}
		$models = $this->repo->filter($filter);
		//dd($models);

		return view('cars.filter',compact('models', 'filter'));
	}
	public function generateSlug()
	{
		$cars = $this->repo->withoutSlug();
		//dd($cars);
		foreach ($cars as $key => $car) {
			// $car->slug = bin2hex(random_bytes($value));
			$car->slug = 24;
			$car->save();
		}
		return 'Fin';
	}
}