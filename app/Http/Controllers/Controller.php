<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
        return $this->product->getById($id);
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
        return $this->product->getByCategory($category);
    }

}
