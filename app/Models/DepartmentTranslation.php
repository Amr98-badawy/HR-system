<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DepartmentTranslation extends Model
{
    use LogsActivity;
    public $timestamps = false;

    protected $table = 'department_translations';

    protected $fillable = [
        'name',
        'locale',
        'department_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} CompanyTranslations")
            ->useLogName('CompanyTranslations Module');
    }
}
