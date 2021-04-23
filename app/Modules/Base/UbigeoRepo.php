<?php 

namespace App\Modules\Base;

use App\Modules\Base\Ubigeo;

class UbigeoRepo extends BaseRepo{

	public function getModel(){
		return new Ubigeo;
	}
	public function listDepartamentos()
	{
		return Ubigeo::where('id', '!=', 1868)->groupBy('departamento')->pluck('departamento','departamento')->toArray();
	}
	public function listProvincias($departamento='LIMA')
	{
		$provincias = Ubigeo::where('departamento','=',$departamento)->groupBy('provincia')->pluck('provincia','provincia')->toArray();
		return $provincias;
	}
	public function listDistritos($provincia='LIMA')
	{
		$distritos = Ubigeo::where('provincia','=',$provincia)->groupBy('distrito')->pluck('distrito','code')->toArray();
		return $distritos;
	}
	public function listDistritos2($provincia='LIMA')
	{
		$distritos = Ubigeo::where('provincia','=',$provincia)->groupBy('distrito')->pluck('distrito','distrito')->toArray();
		return $distritos;
	}
	public function listUbigeo($code='0')
	{
		$ubi=Ubigeo::firstWhere('code', $code);
		if (is_null($ubi)) {
			$ubigeo['value']['departamento'] = 'LIMA';
			$ubigeo['value']['provincia'] = 'LIMA';
			$ubigeo['value']['distrito'] = '';
			$ubigeo['departamento'] = $this->listDepartamentos();
			$ubigeo['provincia'] = $this->listProvincias();
			$ubigeo['distrito'] = $this->listDistritos();
		} else {
			$ubigeo['value']['departamento'] = $ubi->departamento;
			$ubigeo['value']['provincia'] = $ubi->provincia;
			$ubigeo['value']['distrito'] = $ubi->code;
			$ubigeo['departamento'] = $this->listDepartamentos();
			$ubigeo['provincia'] = $this->listProvincias($ubi->departamento);
			$ubigeo['distrito'] = $this->listDistritos($ubi->provincia);
		}
		$ubigeo['departamento'] = ['' => 'Seleccionar'] + $ubigeo['departamento'];
		$ubigeo['provincia'] = ['' => 'Seleccionar'] + $ubigeo['provincia'];
		$ubigeo['distrito'] = ['' => 'Seleccionar'] + $ubigeo['distrito'];
		return $ubigeo;
	}
	public function listUbigeo2($departamento='LIMA',$provincia='LIMA',$distrito='')
	{
		$ubi=Ubigeo::where('departamento',$departamento)->where('provincia',$provincia)->where('distrito',$distrito)->first();
		if (is_null($ubi)) {
			$ubigeo['value']['departamento'] = $departamento;
			$ubigeo['value']['provincia'] = $provincia;
			$ubigeo['value']['distrito'] = '';
			$ubigeo['departamento'] = $this->listDepartamentos();
			$ubigeo['provincia'] = $this->listProvincias();
			$ubigeo['distrito'] = $this->listDistritos2();
		} else {
			$ubigeo['value']['departamento'] = $ubi->departamento;
			$ubigeo['value']['provincia'] = $ubi->provincia;
			$ubigeo['value']['distrito'] = $ubi->distrito;
			$ubigeo['departamento'] = $this->listDepartamentos();
			$ubigeo['provincia'] = $this->listProvincias($ubi->departamento);
			$ubigeo['distrito'] = $this->listDistritos2($ubi->provincia);
		}
		$ubigeo['departamento'] = ['' => 'Seleccionar'] + $ubigeo['departamento'];
		$ubigeo['provincia'] = ['' => 'Seleccionar'] + $ubigeo['provincia'];
		$ubigeo['distrito'] = ['' => 'Seleccionar'] + $ubigeo['distrito'];
		return $ubigeo;
	}
	public function ajaxProvincias($departamento)
	{
		$provincias = Ubigeo::select('provincia')->where('departamento','=',$departamento)->groupBy('provincia')->get();
		return $provincias;
	}
	public function ajaxDistritos($provincia)
	{
		$distritos = Ubigeo::select('code','distrito')->where('provincia','=',"$provincia")->get();
		return $distritos;
	}
	public function ajaxDistritos2($provincia)
	{
		$distritos = Ubigeo::select('distrito')->where('provincia','=',$provincia)->get();
		return $distritos;
	}
	public function findByCode($code)
	{
		return Ubigeo::where('code', $code)->first();
	}
	public function autocomplete($term)
	{
		return Ubigeo::Where('distrito','like',"%$term%")->get();
	}
}