<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'class', 'picture'];

    /**
     * Get all votes for this candidate.
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Get the total vote count for this candidate.
     */
    public function getVoteCountAttribute(): int
    {
        return $this->votes()->count();
    }
}
