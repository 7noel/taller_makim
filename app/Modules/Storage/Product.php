<?php namespace App\Modules\Storage;


use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements Auditable {

	use \OwenIt\Auditing\Auditable;
	use SoftDeletes;

	protected $fillable = ['name', 'intern_code', 'provider_code', 'manufacturer_code', 'description', 'sub_category_id', 'unit_id', 'currency_id', 'country', 'brand', 'last_purchase', 'profit_margin', 'admin_expense', 'value', 'price', 'use_set_value', 'is_downloadable', 'my_company'];

	public function scopeName($query, $name){
		if (trim($name) != "") {
			$query->where('name', 'LIKE', "%$name%");
		}
	}
	public function sub_category()
	{
		return $this->belongsTo('App\Modules\Base\Table','sub_category_id');
	}
	public function unit()
	{
		return $this->belongsTo('App\Modules\Base\Table','unit_id');
	}
	public function stocks()
	{
		return $this->hasMany('App\Modules\Storage\Stock');
	}
	public function accessories()
	{
		return $this->hasMany('App\Modules\Storage\ProductAccessory','product_id','id');
	}
	public function product()
	{
		return $this->hasMany('App\Modules\Storage\ProductAccessory','accessory_id','id');
	}
	public function tables()
	{
		return $this->morphMany('App\Modules\Base\Table', 'table');
	}
}
