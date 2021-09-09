<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param $query
     * @param CustomFilters $filters
     *
     * @return Builder
     */
    public function scopeFilter($query, CustomFilters $filters): Builder
    {
        return $filters->apply($query);
    }
}
