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
		$models = $this->repo->index('name', \Request::get('name'));
		return view('partials.index',compact('models'));
	}

	public function create()
	{
		return view('partials.create');
	}

	public function store()
	{
		$this->repo->save(\Request::all());
		return \Redirect::route('brands.index');
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
		$this->repo->save(\Request::all(), $id);
		return \Redirect::route('brands.index');
	}

	public function destroy($id)
	{
		$model = $this->repo->destroy($id);
		if (\Request::ajax()) {	return $model; }
		return redirect()->route('operations.brands.index');
	}

	public function modelosByWarehouse($warehouse_id)
	{
		$modelos = $this->modeloRepo->modelosByWarehouse($warehouse_id);
		return \Response::json($modelos);
	}
}