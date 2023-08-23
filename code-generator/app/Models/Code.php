<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable = ['code'];

    //Automatyczne zarządzanie przez model kolumnami created_at i updated_at
    public $timestamps = true;
}
