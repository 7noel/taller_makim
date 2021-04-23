<?php namespace App\Modules\Finances;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentCondition extends Model implements Auditable {

	use \OwenIt\Auditing\Auditable;
	use SoftDeletes;

	protected $fillable = ['name', 'description', 'to_sales', 'to_purchases', 'my_company'];

	public function scopeName($query, $name){
		if (trim($name) != "") {
			$query->where('name', 'LIKE', "%$name%");
		}
	}
}
