<?php namespace App\Http\Controllers\Operations;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Modules\Operations\ChecklistRepo;
use App\Modules\Operations\ChecklistDetailRepo;

class ChecklistController extends Controller {

	protected $repo;
	protected $checklistDetailRepo;

	public function __construct(ChecklistRepo $repo, ChecklistDetailRepo $checklistDetailRepo) {
		$this->repo = $repo;
		$this->checklistDetailRepo = $checklistDetailRepo;
	}

	public function index()
	{
		$models = $this->repo->index2('name', request()->get('name'));
		return view('partials.index',compact('models'));
	}

	public function create()
	{
		$types = ['INVENTARIO' => 'INVENTARIO'];
		$categories = ['EXTERIOR' => 'EXTERIOR', 'INTERIOR' => 'INTERIOR', 'MOTOR' => 'MOTOR', 'HERRAMIENTAS/EMERGENCIA' => 'HERRAMIENTAS/EMERGENCIA'];
		return view('partials.create', compact('types', 'categories'));
	}

	public function store()
	{
		$this->repo->save(request()->all());
		return redirect()->route('checklist.index');
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$types = ['INVENTARIO' => 'INVENTARIO'];
		$categories = ['EXTERIOR' => 'EXTERIOR', 'INTERIOR' => 'INTERIOR', 'MOTOR' => 'MOTOR', 'HERRAMIENTAS/EMERGENCIA' => 'HERRAMIENTAS/EMERGENCIA'];
		$model = $this->repo->findOrFail($id);
		return view('partials.edit', compact('model', 'types', 'categories'));
	}

	public function update($id)
	{
		$this->repo->save(request()->all(), $id);
		return redirect()->route('checklist.index');
	}

	public function destroy($id)
	{
		$model = $this->repo->destroy($id);
		if (request()->ajax()) {	return $model; }
		return redirect()->route('operations.checklist.index');
	}

}