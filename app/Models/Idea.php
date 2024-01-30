<?php

namespace App\Models;

use App\Orchid\Presenters\IdeaPresenter;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use Searchable;
    protected $table   = 'contents';

    protected $fillable = [
        'name',
    ];

    /**
     * Get the presenter for the model.
     *
     * @return IdeaPresenter
     */
    public function presenter()
    {
        return new IdeaPresenter($this);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        dd($this->name);
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
