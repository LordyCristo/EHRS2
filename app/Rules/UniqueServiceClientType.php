<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;

class UniqueServiceClientType implements ValidationRule
{
    protected $id;
    /**
     * Create a new rule instance.
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $serviceId = request()->input('service_id');
        $clientType = request()->input('client_type');
        $exists = \App\Models\Fees::where('service_id', $serviceId)
            ->where('client_type', $clientType);
        if ($this->id) {
            $exists = $exists->where('id', '!=', $this->id);
        }

        if ($exists->exists()) {
            $fail('Service and client type combination already exists');
        }
    }
}
