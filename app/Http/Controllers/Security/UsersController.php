<?php namespace App\Http\Controllers\Security;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Security\UserRepo;
use App\Modules\Security\RoleRepo;
use App\Modules\Finances\CompanyRepo;
use App\Http\Requests\Security\FormUserRequest;
use Illuminate\Http\Request;

use App\Http\Requests\Security\ChangePasswordRequest;

class UsersController extends Controller {

	protected $repo;
	protected $roleRepo;
	protected $companyRepo;

	public function __construct(UserRepo $repo, RoleRepo $roleRepo, CompanyRepo $companyRepo) {
		$this->repo = $repo;
		$this->roleRepo = $roleRepo;
		$this->companyRepo = $companyRepo;
	}

	public function index()
	{
		$models = $this->repo->index('name', request()->get('name'));
		return view('partials.index',compact('models'));
	}

	public function create()
	{
		$roles = $this->roleRepo->all2();
		$locales = $this->companyRepo->getListMyCompany();
		return view('partials.create', compact('roles', 'locales'));
	}

	public function store(FormUserRequest $request)
	{
		$this->repo->save(request()->all());
		return redirect()->route('users.index');
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$model = $this->repo->findOrFail($id);
		$roles = $this->roleRepo->all2();
		$locales = $this->companyRepo->getListMyCompany();
		return view('partials.edit', compact('model', 'roles', 'locales'));
	}

	public function update($id, FormUserRequest $request)
	{
		$this->repo->save(request()->all(), $id);
		return \Redirect::route('users.index');
	}

	public function destroy($id)
	{
		$model = $this->repo->destroy($id);
		if (request()->ajax()) {	return $model; }
		return redirect()->route('users.index');
	}

	public function changePassword()
	{
		return view('auth.change_password');
	}

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        $model = $this->repo->findOrFail(\Auth::user()->id);
        if (!\Hash::check($request->current_password, $model->password)) {
            return back()->withErrors('¡La contraseña actual no coincide!');
        }
        $model->password = $request->password;
        $model->save();
        return redirect()->to('/');
    }

	public function ajaxAutocomplete()
	{
		$term = request()->get('term');
		$models = $this->repo->autocomplete($term);
		$result = [];
		foreach ($models as $model) {
			$result[]=[
				'value' => $model->email.' '.$model->name,
				'id' => $model->id,
				'label' => $model->email.' '.$model->name
			];
		}
		return response()->json($result);
	}
}
