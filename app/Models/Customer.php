<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    public function addresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
