<?php

namespace App\Modules\Operations;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	use SoftDeletes;

	protected $fillable = ['mov', 'is_downloadable', 'sn', 'series', 'number', 'order_type', 'type_op', 'document_type_id', 'company_id', 'car_id', 'placa', 'kilometraje', 'type_service', 'preventivo', 'branch_id', 'shipper_id', 'shipper_branch_id', 'payment_condition_id', 'currency_id', 'attention', 'matter', 'delivery_period', 'installation_period', 'delivery_place', 'offer_period', 'seller_id', 'repairman_id', 'diag_at', 'repu_at', 'approved_at', 'repar_at', 'checked_at', 'invoiced_at', 'sent_at', 'canceled_at', 'status', 'with_tax', 'gross_value', 'discount', 'discount_items', 'subtotal', 'tax', 'total', 'amortization', 'exchange', 'exchange_sunat', 'order_id', 'proof_id', 'user_id', 'comment', 'inventory', 'diagnostico', 'aprobacion', 'reparacion', 'control_calidad', 'status_lug', 'slug', 'my_company'];
	// protected $casts = [
	// 	'inventory' => 'array',
	// ];
	protected $casts = [
		'inventory' => 'object',
		'diagnostico' => 'object',
		'aprobacion' => 'object',
		'reparacion' => 'object',
		'control_calidad' => 'object',
		
		'status_log' => 'object',
		'custom_details' => 'object',

		'diag_at' => 'datetime',
		'repu_at' => 'datetime',
		'approved_at' => 'datetime',
		'repar_at' => 'datetime',
		'checked_at' => 'datetime',
		'send_at' => 'datetime',
	];
	protected static function booted()
    {
        static::creating(function ($model) {
            $model->slug = generateSlug(); // Generates a random string of 10 characters
        });
    }

	public function scopeName($query, $name){
		if (trim($name) != "") {
			$query->where('number', 'LIKE', "%$name%")->orWhere('created_at', 'LIKE', "%name%");
		}
	}

	//CPE Relacionado
	public function proof()
	{
		return $this->belongsTo('App\Modules\Finances\Proof');
	}
	public function orders()
	{
		return $this->hasMany('App\Modules\Operations\Order', 'order_id');
	}
	public function quote()
	{
		return $this->belongsTo('App\Modules\Operations\Order', 'order_id');
	}
	public function mycompany()
	{
		return $this->belongsTo('App\Modules\Finances\Company', 'my_company');
	}
	public function company()
	{
		return $this->belongsTo('App\Modules\Finances\Company', 'company_id');
	}
	public function car()
	{
		return $this->belongsTo('App\Modules\Operations\Car', 'car_id');
	}
	public function shipper()
	{
		return $this->belongsTo('App\Modules\Finances\Company', 'shipper_id');
	}
	public function user()
	{
		return $this->belongsTo('App\Modules\Security\Company','user_id');
	}
	public function currency()
	{
		return $this->belongsTo('App\Modules\Base\Currency', 'currency_id');
	}
	public function payment_condition()
	{
		return $this->belongsTo('App\Modules\Finances\PaymentCondition', 'payment_condition_id');
	}
	public function seller()
	{
		return $this->belongsTo('App\Modules\Finances\Company', 'seller_id');
	}
	public function repairman()
	{
		return $this->belongsTo('App\Modules\Finances\Company', 'repairman_id');
	}
	public function details()
	{
		return $this->hasMany('App\Modules\Operations\OrderDetail')->orderBy('category_id', 'desc')->orderBy('sub_category_id', 'desc');
	}
	public function attributes()
	{
		return $this->morphMany('App\Modules\Base\Attribute', 'attribute');
	}
	public function order_checklist_details()
	{
		return $this->hasMany('App\Modules\Operations\ChecklistDetail');
	}
}
