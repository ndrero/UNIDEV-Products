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
     * Devolve um JSON com todos os produtos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->product->all();
    }

    /**
     * Devolve um produto a partir do seu ID
     *
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        return $this->product->find($id);
    }

    /**
     * Devolve os produtos com baixo estoque
     *
     * @return \Illuminate\Http\Response
     */
    public function getWithLowStock($quantity = 20)
    {
        $products = $this->product
            ->where('estoque', '<', $quantity)
            ->orderBy('estoque')
            ->get();

        return $products;
    }

    /**
     * Grava um novo produto
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->only(['nome', 'preco', 'estoque']);

        return $this->product->create($data);
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
