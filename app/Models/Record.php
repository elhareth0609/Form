<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'birth_date',
        'birth_place',
        'employment_year',
        'employment_rank',
        'status',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }
}
