<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingSetting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * Get the current voting status.
     *
     * @return string not_started|started|closed
     */
    public static function getStatus(): string
    {
        $setting = self::where('key', 'voting_status')->first();

        return $setting ? $setting->value : 'not_started';
    }

    /**
     * Set the voting status.
     *
     * @param string $status not_started|started|closed
     */
    public static function setStatus(string $status): void
    {
        self::updateOrCreate(
            ['key' => 'voting_status'],
            ['value' => $status]
        );
    }
}
