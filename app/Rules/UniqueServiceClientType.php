<?php

namespace App\Rules;

use App\Models\Fees;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Translation\PotentiallyTranslatedString;

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
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $serviceId = request()->input('service_id');
        $clientType = request()->input('client_type');
        $exists = Fees::where('service_id', $serviceId)
            ->where('client_type', $clientType);
        if ($this->id) {
            $exists = $exists->where('id', '!=', $this->id);
        }

        if ($exists->exists()) {
            $fail('Service and client type combination already exists');
        }
    }
}
