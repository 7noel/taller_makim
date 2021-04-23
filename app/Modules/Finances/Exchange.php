<?php namespace App\Modules\Finances;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exchange extends Model implements Auditable {

	use \OwenIt\Auditing\Auditable;
	use SoftDeletes;

	protected $fillable = ['date', 'currency_id', 'is_sunat', 'sales', 'purchase', 'my_company'];

	public function scopeDate($query, $name){
		if (trim($name) != "") {
			$query->where('date', 'LIKE', "%$name%");
		}
	}
	public function currency()
	{
		return $this->belongsto('App\Modules\Base\Currency');
	}

}
