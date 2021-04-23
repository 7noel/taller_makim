<?php

namespace App\Modules\Operations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Car extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	use SoftDeletes;

	protected $fillable = ['company_id', 'my_company', 'placa', 'brand_id', 'modelo_id', 'year', 'version', 'body', 'color', 'vin', 'motor', 'codigo', 'f_revision', 'f_llamada', 'f_recordatorio', 'f_next_pr', 'contact_name', 'contact_email', 'contact_phone', 'contact_mobile'];

	public function company()
	{
		return $this->belongsTo('App\Modules\Finances\Company', 'company_id');
	}
	public function modelo()
	{
		return $this->belongsto('App\Modules\Operations\Modelo');
	}
}
