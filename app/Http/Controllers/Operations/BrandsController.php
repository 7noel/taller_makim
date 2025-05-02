<?php namespace App\Http\Controllers\Operations;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Modules\Operations\BrandRepo;
use App\Modules\Operations\ModeloRepo;

class BrandsController extends Controller {

	protected $repo;
	protected $modeloRepo;

	public function __construct(BrandRepo $repo, ModeloRepo $modeloRepo) {
		$this->repo = $repo;
		$this->modeloRepo = $modeloRepo;
	}

	public function index()
	{
		$models = $this->repo->index2('name', request()->get('name'));
		return view('partials.index',compact('models'));
	}

	public function create()
	{
		return view('partials.create');
	}

	public function store()
	{
		$this->repo->save(request()->all());
		return redirect()->route('brands.index');
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$model = $this->repo->findOrFail($id);
		return view('partials.edit', compact('model'));
	}

	public function update($id)
	{
		$this->repo->save(request()->all(), $id);
		return redirect()->route('brands.index');
	}

	public function destroy($id)
	{
		$model = $this->repo->destroy($id);
		if (request()->ajax()) {	return $model; }
		return redirect()->route('operations.brands.index');
	}

	public function modelosByWarehouse($warehouse_id)
	{
		$modelos = $this->modeloRepo->modelosByWarehouse($warehouse_id);
		return response()->json($modelos);
	}

	public function ajaxMarcas()
	{
		$marcas = $this->repo->allOrderName();
		return \Response::json($marcas);
	}

	public function ajaxModelos($brand_id)
	{
		$modelos = $this->modeloRepo->modelosByBrand($brand_id);
		return \Response::json($modelos);
	}

	public function ajaxCrearMarca()
	{
		$data = request()->all();
		if (trim($data['brand_id']) == '') {
			if( $this->repo->findByName($data['marca']) ) {
				return ['error' => ['marca' => 'La Marca ya existe']];
			}
			$marca = $this->repo->save([
				'name' => $data['marca'],
			]);
			$brand_id = $marca->id;

		} else {
			// dd($this->modeloRepo->findByName($data['brand_id'], $data['modelo']));
			if( $this->modeloRepo->findByName($data['brand_id'], $data['modelo']) ) {
				return ['error' => ['modelo' => 'El Modelo ya existe para esta marca']];
			}
			$brand_id = $data['brand_id'];
		}
		
		$modelo = $this->modeloRepo->save([
			'brand_id' => $brand_id,
			'name' => $data['modelo'],
		]);

		return [
			'marca' => [
				'id' => $brand_id,
				'name' => $data['marca']
			],
			'modelo' => [
				'id' => $modelo->id,
				'name' => $modelo->name
			]
		];
	}
}