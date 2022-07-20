<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SectionTranslation extends Model
{
    use LogsActivity;

    public $timestamps = false;

    protected $table = 'section_translations';

    protected $fillable = [
        'name',
        'locale',
        'section_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} Section")
            ->useLogName('Section Module');
    }
}
