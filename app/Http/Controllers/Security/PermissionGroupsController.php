<?php namespace App\Http\Controllers\Security;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Security\PermissionGroupRepo;

class PermissionGroupsController extends Controller {

	protected $repo;

	public function __construct(PermissionGroupRepo $repo) {
		$this->repo = $repo;
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
		//dd(\Request::route()->getAction()['as']);
		return \Redirect::route('permission_groups.index');
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
		return \Redirect::route('permission_groups.index');
	}

	public function destroy($id)
	{
		$model = $this->repo->destroy($id);
		if (\Request::ajax()) {	return $model; }
		return redirect()->route('permission_groups.index');
	}

}
