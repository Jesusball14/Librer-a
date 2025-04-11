<?php

namespace App\Models;

use App\Models\Author;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;


    protected $fillable= [
        'title',
        'authors_id',
        'category_id',
        'stock'
    ];

    // Método para verificar disponibilidad
    public function hasStock($quantity)
    {
        return $this->stock >= $quantity;
    }

    // Método para disminuir stock
    public function decreaseStock($quantity)
    {
        $this->stock -= $quantity;
        $this->save();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }


    public function author(){
        return $this->belongsTo(Author::class, 'authors_id');
    }

    public function getAuthorFullNameAttribute()
    {
        return $this->author ? "{$this->author->name} {$this->author->lastname}" : 'Sin autor';
    }

    public function getCategoryNameAttribute()
    {
        return $this->category ? "{$this->category->name}" : 'Sin autor';
    }


    public function cartItems(){
        return $this->hasMany(Cart::class);
    }


    public function totalSold(){
        return $this->hasMany(Purchase::class)
            ->selectRaw('product_id, sum(quantity) as total')
            ->groupBy('product_id');
    }

}

