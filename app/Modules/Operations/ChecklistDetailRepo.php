<?php namespace App\Modules\Operations;

use App\Modules\Base\BaseRepo;
use App\Modules\Operations\ChecklistDetail;

class ChecklistDetailRepo extends BaseRepo{

	public function getModel(){
		return new ChecklistDetail;
	}
	public function index($filter = false, $search = false)
	{
		if ($filter and $search) {
			return ChecklistDetail::$filter($search)->with('checklist')->orderBy("$filter", 'ASC')->paginate();
		} else {
			return ChecklistDetail::with('brand')->orderBy('id', 'DESC')->paginate();
		}
	}

	public function getListGroup($group, $name='name', $id='id')
	{
		$r = [];
		foreach ($this->model->with($group)->get() as $key => $u) {
			$r[$u->$group->name][$u->$id] = $u->$name;
		}
		if (count($r)==1) {
			return $r;
		} else {
			return [''=>'Seleccionar'] + $r;
		}
		
	}
}