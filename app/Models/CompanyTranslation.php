<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CompanyTranslation extends Model
{
    use LogsActivity;

    public $timestamps = false;

    protected $table = 'company_translations';

    protected $fillable = [
        'name',
        'locale',
        'company_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} CompanyTranslations")
            ->useLogName('Company Translations Module');
    }
}
