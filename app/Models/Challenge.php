<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Challenge extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, int>
     */
    protected $fillable = [
        'title',
        'description',
        'difficulty',
    ];

    /**
     * @return MorphToMany
     */
    public function programs(): MorphToMany
    {
        return $this->morphToMany(Program::class, 'programmable');
    }
}
