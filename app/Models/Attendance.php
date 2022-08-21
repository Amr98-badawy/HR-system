<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Attendance extends Model
{
    use HasFactory;
    use LogsActivity;

    public const DAY_STATUS = [
        'wh' => 'Weekly Vacation',
        'wd' => 'Working_day',
        'ad' => 'Absent Day',
        'pd' => 'Sick Leave',
        'cv' => 'Casual Vacation',
        'ov' => 'Official Vacation'
    ];

    protected $table = 'attendances';

    protected $fillable = [
        'employee_id', 'check_in', 'check_out', 'work_hour',
        'day_status', 'delay', 'additional', 'note'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->LogAll()
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} Attendance")
            ->useLogName('Attendance Module');
    }
}
