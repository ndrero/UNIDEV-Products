<?php

namespace App\Models;

use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'preco', 'estoque'];


    public function getWithLowStock($quantity)
    {
        $products = $this
            ->where('estoque', '<', $quantity)
            ->orderBy('estoque')
            ->get();

        return $products;
    }

    public function store(ProductRequest $request)
    {
        $data = $request->only(['nome', 'preco', 'estoque']);

        return $this->create($data);
    }
}
