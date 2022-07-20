<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SiteLanguage extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'locale'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'locale'])
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} Section")
            ->useLogName('Section Module');
    }
}
