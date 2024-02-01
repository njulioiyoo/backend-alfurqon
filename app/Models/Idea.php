<?php

namespace App\Models;

use App\Orchid\Presenters\UserPresenter;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use Searchable;
    protected $table   = 'users';
    protected $guarded = [];

    /**
     * Get the presenter for the model.
     *
     * @return UserPresenter
     */
    public function presenter()
    {
        return new UserPresenter($this);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
