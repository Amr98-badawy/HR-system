<?php

namespace App\Models;

use App\Traits\SetSlugTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Employee extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SetSlugTrait;

    protected $table = 'employees';

    public Const GENDER = [
        'm' => 'Male',
        'f' => 'Female',
    ];

    protected $dates = [
        'date_of_birth',
        'date_of_employment',
    ];

    protected $fillable = [
        'slug', 'account_no', 'name',
        'gender', 'title', 'date_of_birth', 'id_card', 'address',
        'mobile', 'date_of_employment', 'office_tel', 'nationality', 'department_id',
        'section_id', 'job_id', 'salary',
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

        $this->addMediaCollection('additionl_files');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit('crop', 50, 50)
            ->performOnCollections('photo');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
