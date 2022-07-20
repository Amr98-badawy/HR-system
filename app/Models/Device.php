<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Device extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'devices';

    protected $fillable = [
        'name',
        'mac_address',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'mac_address', 'status'])
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} Device")
            ->useLogName('Device Module');
    }
}
