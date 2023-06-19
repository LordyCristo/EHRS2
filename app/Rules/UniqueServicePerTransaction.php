<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class UniqueServicePerTransaction implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //chck if the service_id is unique per transaction
        $rows = request()->input('rows');
        $service_ids = array_column($rows, 'service_id');
        $unique_service_ids = array_unique($service_ids);
        if (count($service_ids) !== count($unique_service_ids)) {
            $fail('Duplicate services detected');
        }
    }
}
