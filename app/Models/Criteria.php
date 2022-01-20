<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Criteria extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'value',
    ];

    /**
     * Get all of the variables for the Alternative
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variables(): HasMany
    {
        return $this->hasMany(Variable::class, 'criteria_id', 'id');
    }
}
