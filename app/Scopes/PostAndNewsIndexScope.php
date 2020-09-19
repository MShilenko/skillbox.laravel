<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PostAndNewsIndexScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $rows = ['id', 'title', 'slug', 'created_at', 'excerpt'];
        $builder->select($rows)->with(['tags' => function ($tag) {
            $tag->select(['id', 'name']);
        }])->latest();
    }
}
