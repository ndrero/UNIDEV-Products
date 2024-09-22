<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $product;

    // Construct

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    // Get all
    public function getAll()
    {
        return $this->product->getAll();
    }


    public function getById($id)
    {
        return $this->product->getById($id);
    }

}
