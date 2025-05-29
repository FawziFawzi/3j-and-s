<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'name',
        'description',
        'image',
        'money',
        'owner_name',
        'status',
        'category'
    ];

    // Search filters
    public function scopeByName(Builder $query, string $name = null): Builder
    {
        if (!$name) return $query;
        return $query->where('name', 'like', "%{$name}%");
    }

    public function scopeByCategory(Builder $query, string $category = null): Builder
    {
        if (!$category) return $query;
        return $query->where('category', 'like', "%{$category}%");
    }

    public function scopeByDescription(Builder $query, string $description = null): Builder
    {
        if (!$description) return $query;
        return $query->where('description', 'like', "%{$description}%");
    }
}
