<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'company_translations';

    protected $fillable = [
        'name',
        'locale',
        'company_id'
    ];
}
