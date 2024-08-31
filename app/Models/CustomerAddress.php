<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerAddress extends Model
{
    use HasFactory;
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function getFullAddressAttribute(): string
    {
        #check if address2 exist then add prefix Address 1: and Address 2 otherwise Address:
        return ($this->address_2)? "Address 1: $this->address_1 Address 2: $this->address_2 $this->zip," .
            " $this->city, $this->state, $this->country" : "Address: $this->address_1 $this->zip, $this->city," .
            " $this->state, $this->country";
    }
}
