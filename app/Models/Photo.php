<?php

namespace App\Models;

use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Content
{
    use HasFactory, Attachable;

    protected static function boot()
    {
        parent::boot();
        $type = 'photo';

        static::addGlobalScope('', function (Builder $builder) use ($type) {
            $builder->where('type', $type);
        });

        self::creating(function ($model) use ($type) {
            $model->type = $type;
        });
    }
}
