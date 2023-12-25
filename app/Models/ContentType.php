<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use App\Orchid\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentType extends Content
{
    use HasFactory, AsSource;

    /**
     * @return UserPresenter
     */
    public function presenter()
    {
        return new UserPresenter($this);
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeContent(Builder $query)
    {
        return $query->where('type', 'contents');
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeNewsType(Builder $query)
    {
        return $query->where('type', 'news_type');
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeProgramType(Builder $query)
    {
        return $query->where('type', 'program_type');
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeFacilityType(Builder $query)
    {
        return $query->where('type', 'facility_type');
    }
}
