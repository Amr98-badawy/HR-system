<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PayRoll extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'pay_rolls';

    protected $fillable = [
        'employee_id',
        'working_hour',
        'working_additional',
        'working_deducted',
        'salary',
        'slug',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} Company")
            ->useLogName('Company Module');
    }
}
