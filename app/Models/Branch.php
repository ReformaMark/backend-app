<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Passport\HasApiTokens;

class Branch extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'branch_id');
    }
    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class, 'branch_id');
    }
}
