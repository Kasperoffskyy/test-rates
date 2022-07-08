<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'code',
    ];

    /**
     * @param Builder $query
     * @param string $code
     * @return Builder
     */
    public function scopeFindByCode(Builder $query, string $code): Builder
    {
        return $query->where('code', $code);
    }

    /**
     * @return BelongsTo
     */
    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }
}
