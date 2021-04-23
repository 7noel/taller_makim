<?php 

namespace App\Modules\HumanResources;

use App\Modules\Base\BaseRepo;
use App\Modules\HumanResources\Employee;

class EmployeeRepo extends BaseRepo{

	public function getModel(){
		return new Employee;
	}
	public function autocomplete($term)
	{
		return Employee::where('full_name','like',"%$term%")->get();
	}
	public function autocompleteSeller($term)
	{
		return Employee::where("job_id","2")->where('full_name','like',"%$term%")->get();
	}
	public function save($data, $id=0)
	{
		$model = parent::save($data, $id);
		if (isset($data['signature'])) {
			$this->saveFile('img', $data['signature']);
		}

		return $model;
	}
	public function prepareData($data)
	{
		$data['full_name'] = $data['paternal_surname'].' '.$data['maternal_surname'].' '.$data['name'];
		$data = $this->prepareDataImage($data, ['signature']);
		
		return $data;
	}
	public function getListSellers()
	{
		return [""=>"Seleccionar"] + Employee::where('job_id', 8)->orWhere('id',3)->orWhere('id',1)->pluck('full_name', 'id')->toArray();
	}
}