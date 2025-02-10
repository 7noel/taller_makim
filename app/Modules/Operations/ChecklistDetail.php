<?php

namespace App\Modules\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistDetail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'type', 'category', 'checklist_id'];

    public function scopeName($query, $name){
        if (trim($name) != "") {
            $query->where('name', 'LIKE', "%$name%");
        }
    }
    
    public function checklist()
    {
        return $this->belongsto('App\Modules\Operations\Checklist');
    }

}
