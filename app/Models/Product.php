<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'name', 'description', 'price', 'quantity', 'views', 'searches', 'purchases', 'image_path'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}
public function views()
{
    return $this->hasMany(ProductView::class);
}



public function similarProducts()
{
    return Product::where('category_id', $this->category_id)
                  ->where('id', '!=', $this->id)
                  ->limit(4)
                  ->get();
}
public function viewedByUsers()
{
    return $this->belongsToMany(User::class, 'product_views')
                ->withTimestamps()
                ->withPivot('view_count');
}

}

