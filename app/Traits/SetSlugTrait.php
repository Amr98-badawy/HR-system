<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SetSlugTrait
{
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
}
