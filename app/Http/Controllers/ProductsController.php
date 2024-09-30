<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $product;
    private $request;

    // Construct

    public function __construct(Product $product, Request $request)
    {
        $this->product = $product;
        $this->request = $request;
    }

    // Get all
    public function getAll()
    {
        return $this->product->getAll();
    }

    // Get by id
    public function getById($id)
    {

        $product = $this->product->getById($id);

        if (!$product)
        {

            return response('Não foi encontrado um produto com esse ID', 404);

        }

        return $product;
    }

    // Get with low stock
    public function getWithLowStock()
    {

        return $this->product->getWithLowStock();

    }

    // Get by category or filtreded by category
    public function getByCategory()
    {
        $category = $this->request->get('palavraChave');
        $product = $this->product->getByCategory($category);

        if ($product->isEmpty())
        {

            return response('Não foi encontrado um produto nessa categoria', 404);

        }

        return $product;
    }


    // Get all categories
    public function getCategories()
    {

        return $this->product->getCategories();

    }
}
