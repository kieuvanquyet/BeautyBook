<?php

namespace App\Models;

use App\Traits\BelongsToCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use BelongsToCategory, HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'name', 'description', 'duration', 'price'];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
}
