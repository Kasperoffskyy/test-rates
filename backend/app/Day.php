<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Day extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'date',
    ];

    /**
     * @return HasOne
     */
    public function rate(): HasOne
    {
        return $this->hasOne(Rate::class);
    }

    /**
     * @return HasMany
     */
    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

}
