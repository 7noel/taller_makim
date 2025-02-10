<?php

namespace App\Modules\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function scopeName($query, $name){
        if (trim($name) != "") {
            $query->where('name', 'LIKE', "%$name%");
        }
    }
    
    public function details()
    {
        return $this->hasMany('App\Modules\Operations\ChecklistDetail');
    }
}
