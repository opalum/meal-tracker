<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'valid_for',
        'meal_id',
    ];

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a unique 5-character alphanumeric code.
     *
     * @return string
     */
    public static function generateCode()
    {
        $code = '';
        do {
            $code = strtoupper(Str::random(4));
        } while (self::where('code', $code)->exists());

        return $code;
    }
}
