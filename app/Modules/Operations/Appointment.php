<?php

namespace App\Modules\Operations;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $fillable = ['my_company', 'start_at', 'canceled_at', 'placa', 'modelo', 'company_name', 'type_service', 'preventivo', 'email', 'mobile', 'status', 'comment'];
    protected $dates = ['start_at', 'canceled_at'];
protected $casts = [
        'start_at'  => 'datetime:Y-m-d\TH:i'
   ];

    public function scopeName($query, $name){
        if (trim($name) != "") {
            $query->where('name', 'LIKE', "%$name%");
        }
    }
}
