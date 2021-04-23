<?php 

namespace App\Modules\Base;

use App\Modules\Base\BaseRepo;
use App\Modules\Base\Table;

class TableRepo extends BaseRepo{

	public function getModel(){
		return new Table;
	}
	public function index2($filter = false, $search = false, $type)
	{
		if ($filter and $search) {
			return $this->model->$filter($search)->where('type', $type)->orderBy("$filter", 'ASC')->paginate();
		} else {
			return $this->model->where('type', $type)->orderBy('id', 'DESC')->paginate();
		}
	}

	public function getListType($type, $campo='name', $id='id')
	{
		dd(session('my_company'));
		return Table::where('my_company', session('my_company')->id)->where('type', $type)->orderBy($campo,'ASC')->pluck($campo, $id)->toArray();
	}

	public function getListGroupType($type, $group, $config=1, $campo='name', $id='id')
	{
		if ($config) {
			$list = Table::where('my_company', session('my_company')->id)->where('type', $type)->orderBy($campo,'ASC')->get();
			foreach ($list as $key => $u) {
				$r[config('options.'.$group.'.'.$u->relation_id)][$u->$id] = $u->$campo;
			}
		} else {
			$list = Table::where('my_company', session('my_company')->id)->where('type', $type)->with($group)->orderBy($campo,'ASC')->get();
			foreach ($list as $key => $u) {
				$r[$u->$group->name][$u->$id] = $u->$campo;
			}
		}
		return $r;
	}
}