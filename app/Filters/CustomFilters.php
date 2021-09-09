<?php

namespace App\Filters;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CustomFilters
{
    protected BaseFormRequest $request;
    protected Builder $builder;

    /**
     * @param BaseFormRequest $request
     */
    public function __construct(BaseFormRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {
            $name = Str::camel($name);
            if (! method_exists($this, $name)) {
                continue;
            }
            $this->$name($value);
        }
        return $this->builder;
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return $this->request->all();
    }
}
