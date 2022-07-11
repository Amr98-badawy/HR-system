<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'section_translations';

    protected $fillable = [
        'name',
        'locale',
        'section_id',
    ];
}
