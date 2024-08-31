<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orders(): HasManyThrough
    {
        return $this->hasManyThrough(Order::class, OrderItem::class, 'product_id', 'id', 'id', 'order_id');
    }

    public function getTotalSalesAttribute(): float
    {
        return $this->order_items->sum(fn ($orderItem) => $orderItem->subtotal);
    }

    public function setSlugAttribute(){
        $this->attributes['slug'] = Str::slug($this->attributes['name']);
    }
}
