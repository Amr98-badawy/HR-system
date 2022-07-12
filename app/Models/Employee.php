<?php

namespace App\Models;

use App\Traits\SetSlugTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Employee extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SetSlugTrait;

    public const GENDER = [
        'm' => 'Male',
        'f' => 'Female',
    ];

    protected $table = 'employees';

    protected $dates = [
        'date_of_birth',
        'date_of_employment',
    ];

    protected $fillable = [
        'slug', 'account_no', 'first_name', 'second_name', 'family_name',
        'gender', 'job_title', 'date_of_birth', 'id_card', 'address',
        'mobile', 'date_of_employment', 'office_tel', 'nationality', 'company_id', 'department_id',
        'section_id', 'salary',
        'bank_account', 'shift_id',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')
            ->singleFile();

        $this->addMediaCollection('military_status')
            ->singleFile();

        $this->addMediaCollection('criminal_record')
            ->singleFile();

        $this->addMediaCollection('collage_certificate')
            ->singleFile();

        $this->addMediaCollection('birth_certificate')
            ->singleFile();

        $this->addMediaCollection('additional_files');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit('crop', 50, 50)
            ->performOnCollections('photo');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getSalaryAttribute($value)
    {
        return $value / 100;
    }

    public function setSalaryAttribute($value)
    {
        $this->attributes['salary'] = $value * 100;
    }

}
