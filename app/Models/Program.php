<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Program extends Model
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
        'start_date',
        'end_date',
    ];

    /**
     * Get all of the users that are assigned this program.
     */
    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'programmable');
    }

    /**
     * Get all of the challenges that are assigned this program.
     */
    public function challenges(): MorphToMany
    {
        return $this->morphedByMany(Challenge::class, 'programmable');
    }

    /**
     * Get all of the companies that are assigned this program.
     */
    public function companies(): MorphToMany
    {
        return $this->morphedByMany(Company::class, 'programmable');
    }
}
