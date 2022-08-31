<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'payroll_no',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} Payroll")
            ->useLogName('Payroll Module');
    }

    public function getRouteKeyName()
    {
        return 'payroll_no';
    }
}
