<?php

namespace App\Models;

use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Content
{
    use HasFactory, Attachable;

    protected static function boot()
    {
        parent::boot();
        $type = 'about';

        static::addGlobalScope('', function (Builder $builder) use ($type) {
            $builder->where('type', $type);
        });

        self::creating(function ($model) use ($type) {
            $model->type = $type;
        });
    }
}
