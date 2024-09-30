<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $product;
    private $request;

    public function __construct(Product $product, Request $request)
    {
        $this->product = $product;
        $this->request = $request;
    }

    // Seleciona todos os produtos
    public function getAll()
    {
        return $this->product->getAll();
    }

    // Seleciona um produto pelo seu ID
    public function getById($id)
    {
        $product = $this->product->getById($id);

        if(!$product){
            return response('Não foi encontrado um produto com esse ID', 404);
        }

        return $product;
    }

    // Seleciona produtos com menos de 20 itens em estoque
    public function getWithLowStock()
    {
        return $this->product->getWithLowStock();
    }

    // Filtra os produtos por categoria
    public function getByCategory()
    {
        $category = $this->request->get('palavraChave');
        $products = $this->product->getByCategory($category);

        if($products->isEmpty()){
            return response('Não foi encontrado um produto nessa categoria', 404);
        }

        return $products;
    }


    // Informa todas as categorias
    public function getCategories()
    {
        return $this->product->getCategories();
    }
}
