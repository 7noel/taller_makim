<?php 

namespace App\Modules\Base;

abstract class BaseRepo{

	protected $model;

	public function __construct() {
		$this->model = $this->getModel();
	}

	abstract public function getModel();
	
	public function find($id){
		return $this->model->where('my_company', session('my_company')->id)->where('id', $id)->first();
	}
	public function findOrFail($id){
		return $this->model->where('my_company', session('my_company')->id)->where('id', $id)->firstOrFail();
	}
	public function firstOrCreate($atributes, $values){
		return $this->model->firstOrCreate($atributes, $values);
	}
	public function all()
	{
		return $this->model->where('my_company', session('my_company')->id)->get();
	}
	public function index($filter = false, $search = false)
	{
		if ($filter and $search) {
			return $this->model->where('my_company', session('my_company')->id)->$filter($search)->orderBy("$filter", 'ASC')->paginate();
		} else {
			return $this->model->where('my_company', session('my_company')->id)->orderBy('id', 'DESC')->paginate();
		}
	}

	public function getList($name='name', $id='id')
	{
		return $list = [""=>'Seleccionar'] + $this->model->where('my_company', session('my_company')->id)->orderBy($name, 'ASC')->pluck($name, $id)->toArray();
	}
	
	public function getListGroup($group, $name='name', $id='id')
	{
		foreach ($this->model->where('my_company', session('my_company')->id)->with($group)->oederBy($name, 'ASC')->get() as $key => $u) {
			$r[$u->$group->name][$u->$id] = $u->$name;
		}
		if (isset($r)) {
			return [''=>'Seleccionar'] + $r;
		} else {
			return [''=>'Seleccionar'];
		}
		
	}
	public function all_with_deleted()
	{
		return $this->model->where('my_company', session('my_company')->id)->withTrashed()->get();
	}
	public function all_only_deleted()
	{
		return $this->model->where('my_company', session('my_company')->id)->onlyTrashed()->get();
	}
	public function jsonArray($array,$value,$label)
	{
		foreach ($array as $valor) {
			$data[]=array("value"=>$valor[$value],
				'label'=>$valor[$label],
				'id'=>$valor
			);
		}
		return Response::json($data);
	}
	public function destroy($id)
	{
		$model=$this->findOrFail($id);
		$model->delete();
		$message = $model->name. ' fue eliminado';
		if (\Request::ajax()) {
			return response()->json([
				'id'=>$model->id,
				'message'=>$message
			]);
		}
		\Session::flash('message', $message);
		return $model;
	}
	public function save($data, $id=0)
	{
		$data = $this->prepareData($data);
		$data['my_company'] = session('my_company')->id;
		return $this->model->updateOrCreate([$this->model->getKeyName() => $id], $data);
	}
	public function prepareData($data)
	{
		return $data;
	}
	/**
	 * Graba varias items hijos de 2 tablas padres. Para eliminar se debe enviar el campo is_deleted
	 * @param  [array] $allData [contiene los elementos a ingresar]
	 * @param  [array] $k1      [tiene key y value del padre desde donde ingresa]
	 * @param  [string] $k2      [nombre del key de los items]
	 * @param  [array] $k3      [tiene key y value del tipo de modelo en un polimorfismo]
	 * @return [array]          [retorna los ids de los elementos eliminados]
	 */
	public function syncMany2($allData,$k1,$k2,$k3=[])
	{
		$toSave = [];
		$toEdit = [];
		$toDelete = [];
		$new_ids = [];
		foreach ($allData as $key => $data) {
			if (isset($data["id"]) and $data["id"]>0) {
				$new_ids[] = $data["id"];
			}
		}
		$old_ids = $this->model->where($k1['key'],$k1['value'])->pluck('id')->toArray();
		$toDelete = array_diff($old_ids, $new_ids);
		# Elimina registros
		if (isset($toDelete) and count($toDelete)>0) {
			$this->model->whereIn('id', $toDelete)->delete();
		}
		# Guardar registros
		foreach ($allData as $key => $data) {
			$data['my_company'] = session('my_company')->id;
			$data[$k1['key']] = $k1['value'];
			if (empty($k3)) {
				$model = $this->model->updateOrCreate([$k1['key'] => $k1['value'], $k2 => $data[$k2]], $data);
			} else {
				$model = $this->model->updateOrCreate([$k1['key'] => $k1['value'], $k2 => $data[$k2], $k3['key'] => $k3['value']], $data);
			}
			
		}

		return $toDelete;
	}

	/**
	 * Graba varias items hijos de 2 tablas padres. Para eliminar se debe enviar el campo is_deleted
	 * @param  [array] $allData [contiene los elementos a ingresar]
	 * @param  [array] $k1      [tiene key y value del padre desde donde ingresa]
	 * @param  [string] $k2      [nombre del key de los items]
	 * @param  [array] $k3      [tiene key y value del tipo de modelo en un polimorfismo]
	 * @return [array]          [retorna los ids de los elementos eliminados]
	 */
	public function syncMany($allData,$k1,$k2,$k3=[])
	{
		$toSave = [];
		$toEdit = [];
		$toDelete = [];
		foreach ($allData as $key => $data) {
			if (isset($data['is_deleted'])) {
				if (isset($data['id']) and $data['id']>0) {
					# Array con ids a eliminar
					$toDelete[] = $data[$k2];
				}
			} else {
				# Array con data para Agregar
				$toSave[] = $data;
			}
		}
		# Elimina registros
		if (isset($toDelete)) {
			if (empty($k3)) {
				$this->model->where($k1['key'], $k1['value'])->whereIn($k2, $toDelete)->delete();
			} else {
				$this->model->where($k3['key'], $k3['value'])->where($k1['key'], $k1['value'])->whereIn($k2, $toDelete)->delete();
			}
		}
		# Guardar registros
		foreach ($toSave as $key => $data) {
			$data['my_company'] = session('my_company')->id;
			$data[$k1['key']] = $k1['value'];
			if (empty($k3)) {
				$model = $this->model->updateOrCreate([$k1['key'] => $k1['value'], $k2 => $data[$k2]], $data);
			} else {
				$model = $this->model->updateOrCreate([$k1['key'] => $k1['value'], $k2 => $data[$k2], $k3['key'] => $k3['value']], $data);
			}
			
		}

		return $toDelete;
	}

	/**
	 * Graba varias items hijos de 2 tablas padres
	 * @param  [array] $allData [contiene los elementos a ingresar]
	 * @param  [array] $k1      [tiene key y value del padre desde donde ingresa]
	 * @param  [string] $k2      [nombre del key de los items]
	 * @return [boolean]          [description]
	 */
	public function syncMany_old($allData,$k1,$k2)
	{
		$new_ids = [];
		foreach ($allData as $key => $data) {
			$new_ids[] = $data["$k2"];
		}
		$old_ids = $this->model->where($k1['key'],$k1['value'])->pluck($k2)->toArray();
		$toDelete = array_diff($old_ids, $new_ids);
		$toSave = array_diff($new_ids, $old_ids);
		$toEdit = array_intersect($old_ids, $new_ids);
		if (!empty($toDelete)) {
			$this->model->where($k1['key'], $k1['value'])->whereIn($k2,$toDelete)->delete();
		}
		foreach ($allData as $key => $data) {
			$data['my_company'] = session('my_company')->id;
			if (in_array($data[$k2], $toSave)) {
				$data[$k1['key']] = $k1['value'];
				$this->save($data);
			} else if (in_array($data[$k2], $toEdit)) {
				$model = $this->model->where($k1['key'],$k1['value'])->where($k2, $data["$k2"])->first();
				$model->fill($data);
				$model->save();
			}
		}
		return true;
	}

	public function saveFile($folder = '', $file, $nameOld = '')
	{
		$name = $file->getClientOriginalName();
		if ($nameOld == '') {
			$nameOld = $name;
		}
		if (\Storage::exists($folder.'/'.$nameOld)) {
			\Storage::delete($folder.'/'.$nameOld);
		}
		$i=1;
		while (file_exists($public_path.'/storage/'.$name)) {
			$name = $name."-$i";
			$i++;
		}
		\Storage::disk('local')->put('storage/'.$name,  \File::get($file));
	}

	public function saveImageBase64($base64, $name)
	{
		$data = base64_decode($base64);
		\Storage::disk('public')->put($name.".jpg", $data);
	}
	public function prepareDataImage($data, $images)
	{
		foreach ($images as $key => $image) {
			if (isset($data[$image])) {
				$data[$image] = $data[$image]->getClientOriginalName();
			} else if (isset($data['delete_'.$image])) {
				$data[$image] = '';
			}
			else {
				unset($data[$image]);
			}
		}
		return $data;
	}

	/**
	 * Graba varios hijos
	 * @param  array $items Contiene los items
	 * @param  array $k     contiene 2 elemento el primero con clave key y el segundo con value que pertenecen al padre
	 * @return true        [description]
	 */
	public function saveMany($items, $k)
	{
		foreach ($items as $key => $data) {
			$data = $this->prepareData($data);
			$data['my_company'] = session('my_company')->id;
			$data[$k['key']] = $k['value'];
			if (isset($data['id'])) {
				$model = $this->findOrFail($data['id']);
				if (isset($data['name']) and trim($data['name']) == '') {
					$model->delete();
				} else {
					$model->fill($data);
					$model->save();
				}
			} else {
				if (isset($data['name']) and trim($data['name']) != '') {
					$this->model->create($data);
				}
			}
		}
		return true;
	}
	public function saveMany2($items, $k)
	{
		$toSave = [];
		$toDelete = [];
		foreach ($items as $key => $data) {
			if (isset($data['is_deleted'])) {
				if (isset($data['id']) and $data['id']>0) {
					# Array con ids a eliminar
					$toDelete[] = $data['id'];
				}
			} else {
				# Array con data para Agregar
				$toSave[] = $data;
			}
		}
		# Elimina registros
		if (isset($toDelete)) {
			$this->model->whereIn('id', $toDelete)->delete();
		}
		# Guardar registros
		foreach ($toSave as $key => $data) {
			$data['my_company'] = session('my_company')->id;
			$data[$k['key']] = $k['value'];
			if (isset($data['id'])) {
				$model = $this->model->updateOrCreate(['id' => $data['id']], $data);
			} else {
				$this->model->create($data);
			}
		}

		return true;
	}
}