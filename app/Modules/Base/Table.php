<?php

namespace App\Modules\Base;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model implements Auditable 
{
	use \OwenIt\Auditing\Auditable;
	use SoftDeletes;

	protected $fillable = ['type', 'my_company', 'name', 'description', 'symbol', 'code', 'value_1', 'value_2', 'value_3', 'relation_id', 'table_id', 'table_type', 'data'];

    protected $casts = [
        'data' => 'object',
    ];
    public function scopeName($query, $name){
        if (trim($name) != "") {
            $query->where('name', 'LIKE', "%$name%");
        }
    }
    
	public function table()
    {
        return $this->morphTo();
    }
    public function pather()
    {
    	return $this->belongsTo('App\Modules\Base\Table', 'relation_id');
    }
    public function childs()
    {
        return $this->hasMany('App\Modules\Base\Table', 'relation_id')->orderBy('name', 'ASC');
    }
}
