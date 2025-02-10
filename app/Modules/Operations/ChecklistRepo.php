<?php namespace App\Modules\Operations;

use App\Modules\Base\BaseRepo;
use App\Modules\Operations\Checklist;
use App\Modules\Operations\ChecklistDetailRepo;

class ChecklistRepo extends BaseRepo{

	public function getModel(){
		return new Checklist;
	}

	public function getList2($name='name', $id='id')
	{
		return Checklist::pluck($name, $id)->toArray();
	}
	public function save($data, $id=0){
		$data = $this->prepareData($data);
		$modeloRepo= new ChecklistDetailRepo;
		$model = parent::save($data, $id);
		if (isset($data['modelos'])) {
			$modeloRepo->saveMany2($data['modelos'], ['key' => 'checklist_id', 'value' => $model->id]);
		}
		return $model;
	}

	public function prepareData($data)
	{
		// dd($data);
		foreach ($data['modelos'] as $key => $detail) {
			$data['modelos'][$key]['type'] = $data['type'];
			$data['modelos'][$key]['category'] = $data['modelos'][$key]['description'];
		}
		return $data;
	}

}