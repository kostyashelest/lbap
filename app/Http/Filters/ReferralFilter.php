<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ReferralFilter extends QueryFilter
{
    public function email($value)
    {
        $this->builder->whereHas('user', function (Builder $query) use ($value) {
            $query->where('email', $value);
        });
    }
}
