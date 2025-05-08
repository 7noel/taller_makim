<?php 

namespace App\Modules\Base;

use App\Modules\Base\BaseRepo;
use App\Modules\Base\Table;

class TableRepo extends BaseRepo{

	public function getModel(){
		return new Table;
	}

	public function prepareData($data)
	{
		$data['type'] = explode('.', request()->route()->getName())[0];
		
		return $data;
	}
	public function indexTable($filter = false, $search = false, $type)
	{
		if ($filter and $search) {
			return $this->model->$filter($search)->where('type', $type)->orderBy("$filter", 'ASC')->get();
		} else {
			return $this->model->where('type', $type)->orderBy('id', 'DESC')->get();
		}
	}

	public function getListType($type, $campo='name', $id='id')
	{
		//dd(session('my_company'));
		// return Table::where('my_company', session('my_company')->id)->where('type', $type)->orderBy($campo,'ASC')->pluck($campo, $id)->toArray();
		return Table::where('type', $type)->orderBy($campo,'ASC')->pluck($campo, $id)->toArray();
	}

	public function getListCatSer()
	{
		return Table::with('childs')->where('type', 'categories')->where('value_3', '')->orderBy('name','ASC')->get();
	}

	public function getListCatPro()
	{
		return Table::with('childs')->where('type', 'categories')->where('value_3', '1')->orderBy('name','ASC')->get();
	}

	public function getListCat($type='products')
	{
		if ($type=='products') {
			return Table::where('type', 'categories')->where('value_3', '1')->orderBy('name','ASC')->pluck('name', 'id')->toArray();
		}
		return Table::where('type', 'categories')->where('value_3', '')->orderBy('name','ASC')->pluck('name', 'id')->toArray();
	}

	public function getListSubCat($relation_id)
	{
		return Table::where('type', 'sub_categories')->where('relation_id', $relation_id)->orderBy('name','ASC')->pluck('name', 'id')->toArray();
	}

	public function getListUnt($type='products')
	{
		if ($type=='products') {
			return Table::where('type', 'units')->where('code', '!=', 'ZZ')->orderBy('id','ASC')->pluck('symbol', 'id')->toArray();
		}
		return Table::where('type', 'units')->where('code', 'ZZ')->orderBy('id','ASC')->pluck('symbol', 'id')->toArray();
	}

	public function getListUnitSer()
	{
		return Table::where('type', 'units')->where('code', 'ZZ')->orderBy('name','ASC')->get();
	}

	public function getListUnitPro()
	{
		return Table::where('type', 'units')->where('code', '!=', 'ZZ')->orderBy('name','ASC')->get();
	}

	public function getListTypeByGroup($type, $group, $campo='name', $id='id')
	{
		return Table::where('relation_id', $group)->where('type', $type)->orderBy($campo,'ASC')->pluck($campo, $id)->toArray();
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
	public function getListDoc($type, $campo='name', $id='id', $serie='')
	{
		if ($serie=='') {
			return Table::where('my_company', session('my_company')->id)->where('type', $type)->orderBy($campo,'DESC')->pluck($campo, $id)->toArray();
		}
		return Table::where('my_company', session('my_company')->id)->where('type', $type)->where('name', $serie)->orderBy($campo,'DESC')->pluck($campo, $id)->toArray();
	}

	public function getFirstSerie($type_doc='output_quotes')
	{
		return Table::where('my_company', session('my_company')->id)->where('value_1', $type_doc)->first();
	}

	public function save($data, $id=0){
		$data = $this->prepareData($data);
		$modeloRepo= new TableRepo;
		$model = parent::save($data, $id);
		if (isset($data['modelos'])) {
			$modeloRepo->saveMany2($data['modelos'], ['key' => 'relation_id', 'value' => $model->id]);
		}
		return $model;
	}
}