<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['logo', 'slogan', 'contact_phone', 'contact_email', 'facebook', 'instagram', 'lindin', 'youtube'];
}
