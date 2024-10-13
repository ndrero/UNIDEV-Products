<?php

namespace App\Models;

use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'preco', 'estoque', 'categorias'];

    public function index()
    {
        $products = $this->all();

        $products->map(function ($product){
            $categories = json_decode($product['categorias'], true);

            $product['categorias'] = $categories;

            return $product;
        });

        return $products;
    }

    public function getWithLowStock($quantity)
    {
        $products = $this
            ->where('estoque', '<', $quantity)
            ->orderBy('estoque')
            ->get();

        return $products;
    }

    public function getCategories()
    {
        $categories = $this
            ->index()
            ->pluck('categorias')
            ->flatMap(function ($item){
                return $item;
            })
            ->unique()
            ->values();

        return $categories;
    }

    public function getByCategory($category)
    {
        $products = $this
            ->all()
            ->filter(function ($product) use ($category){
                return in_array($category, json_decode($product['categorias']));
            })
            ->values();

        return $products;
    }

    public function store(ProductRequest $request)
    {
        $data = $request->only(['nome', 'preco', 'estoque', 'categorias']);

        $data['categorias'] = json_encode($data['categorias']);

        return $this->create($data);
    }

    public function updateProduct($request, $id)
    {
        $product = $this->find($id);

        if(!$product){
            return false;
        }
        $product
            ->fill($request->all())
            ->save();
        return true;
    }

}
