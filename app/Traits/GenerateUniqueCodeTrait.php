<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait GenerateUniqueCodeTrait
{
    public function generateUniqueCode(string $str = null, Model $model, string $field, int $start, int $finish)
    {
        do {
            $code = $str ? $str . '-' . random_int($start, $finish) : random_int($start, $finish);
        } while ($model->query()->where($field, '=', $code)->first());

        return $code;
    }
}
