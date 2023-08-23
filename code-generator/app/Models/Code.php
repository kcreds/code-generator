<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Code extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'user_id'];

    //Automatyczne zarządzanie przez model kolumnami created_at i updated_at
    public $timestamps = true;

    //Relacja do tabeli user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
