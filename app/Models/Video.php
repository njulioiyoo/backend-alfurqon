<?php

namespace App\Models;

use Orchid\Attachment\Attachable;
use App\Orchid\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Video extends Content
{
    use HasFactory, Attachable;

    /**
     * @return UserPresenter
     */
    public function presenter()
    {
        return new UserPresenter($this);
    }

    protected static function boot()
    {
        parent::boot();
        $type = 'video';

        static::addGlobalScope('', function (Builder $builder) use ($type) {
            $builder->where('type', $type);
        });

        self::creating(function ($model) use ($type) {
            $model->type = $type;
            $model->author    = Auth::user()->id;
        });
    }
}
