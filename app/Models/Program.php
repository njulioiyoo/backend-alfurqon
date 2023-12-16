<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Content
{
    use HasFactory, AsSource, Attachable;

    protected static function boot()
    {
        parent::boot();
        $type = 'program';

        static::addGlobalScope('', function (Builder $builder) use ($type) {
            $builder->where('type', $type);
        });

        self::creating(function ($model) use ($type) {
            $model->type = $type;
        });
    }
}
