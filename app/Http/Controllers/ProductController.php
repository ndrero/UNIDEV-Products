<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;
    private $request;

    public function __construct(Product $product, Request $request)
    {
        $this->product = $product;
        $this->request = $request;
    }

    /**
     * Devolve todos os produtos registrados se houver algum
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all();

        if(!$products){
            return response('Ainda não há produtos registrados', 404);
        }
    }

    /**
     * Devolve um produto a partir do seu ID se houver algum
     *
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        $product = $this->product->find($id);

        if(!$product){
            return response('Não foi possível encontrar um produto com esse ID', 404);
        }
        return $product;
    }

    /**
     * Devolve os produtos com baixo estoque
     *
     * @return \Illuminate\Http\Response
     */
    public function getWithLowStock($quantity = 20)
    {
        return $this->product->getWithLowStock($quantity);
    }

    /**
     * Grava um novo produto
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $this->product->store($request);

        if(!$product)
        {
            return response('Não foi possível registrar no banco de dados', 404);
        }
        return $product;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
