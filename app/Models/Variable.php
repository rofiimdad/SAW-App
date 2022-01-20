<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Variable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'alternative_id',
        'criteria_id',
        'value',
    ];

    /**
     * Get the alternative that owns the Variable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alternative(): BelongsTo
    {
        return $this->belongsTo(Alternative::class, 'id', 'alternative_id');
    }
}
