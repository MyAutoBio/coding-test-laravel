<?php

namespace App\Concerns\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class TypeScope implements Scope
{
    protected string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function apply(Builder $builder, Model $model)
    {
        return $builder->where('type', $this->type);
    }
}
