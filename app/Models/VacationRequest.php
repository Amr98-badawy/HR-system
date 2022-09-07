<?php

namespace App\Models;

use App\Traits\SetSlugTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class VacationRequest extends Model
{
    use SetSlugTrait;
    use LogsActivity;

    const REQUEST_STATUS = [
        "p" => "Pending",
        "a" => "Accepted",
        "r" => "Rejected",
    ];

    const REQUEST_TYPE = [
        "v" => "Vacation",
        "s" => "Sick Vacation",
    ];

    protected $fillable = [
        "employee_id",
        "type",
        "status",
        "message",
        "slug",
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->LogAll()
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} Vacation Request")
            ->useLogName('Vacation Requests Module');
    }
}
