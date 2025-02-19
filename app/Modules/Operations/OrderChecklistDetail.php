<?php

namespace App\Modules\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderChecklistDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'checklist_id', 'checklist_detail_id', 'name', 'type', 'category', 'status', 'comment'];

    public function order()
    {
        return $this->hasOne('App\Modules\Operations\Order','id','order_id');
    }
}
