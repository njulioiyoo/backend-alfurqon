<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($contact) {
            $contact->created_at    = date('Y-m-d h:i:s');
        });
    }
}
