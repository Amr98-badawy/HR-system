<?php

namespace App\Traits;

trait GenerateUniqueCodeTrait
{
    public function generateUniqueCode(string $str = null, $model, string $field)
    {
        do {
            $code = random_int(100, 999999);
        } while ($model->query()->where($field, '=', $code)->first());

        if ($str) {
            return $str . '-' . $code;
        }

        return $code;
    }
}
