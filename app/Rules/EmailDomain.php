<?php

namespace App\Rules;

use App\Models\AllowedDomain;
use Illuminate\Contracts\Validation\Rule;

class EmailDomain implements Rule {

    public function passes($attribute, $value) {
        $domain = explode('@', $value)[1] ?? null;
        if (!$domain) {
            return false;
        }
        return AllowedDomain::where('name', $domain)->exists();
    }

    public function message() {
        return 'The email domain is not allowed.';
    }
}
