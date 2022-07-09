<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'department_translations';

    protected $fillable = [
        'name',
        'locale',
        'department_id',
    ];
}
