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
     *  Se houver algum, devolve todos os produtos registrados
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = $this->product->index();

        if(!$products){
            return response('Ainda não há produtos registrados', 404);
        }

        return $products;
    }

    /**
     * Devolve um produto a partir do seu ID se houver algum
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function getById($id)
    {
        $product = $this->product->find($id);

        if(!$product){
            return response('Não foi encontrado um produto com esse ID', 404);
        }
        return $product;
    }

    /**
     * Devolve os produtos com baixo estoque
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function getWithLowStock($quantity = 20)
    {
        return $this->product->getWithLowStock($quantity);
    }

    /**
     * Devolve as categorias existentes
     *
     * @return  \Illuminate\Http\JsonResponsev
     */
    public function getCategories()
    {
        return $this->product->getCategories();
    }

    /**
     * Devolve os produtos existentes na categoria informada
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function getByCategory()
    {
        $category = $this->request->query('palavraChave');

        if(empty($category)){
            return response('Não há produtos nessa categoria');
        }
        return $this->product->getByCategory($category);
    }

    /**
     * Grava um novo produto
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $product = $this->product->store($request);

        if(!$product){
            return response('Não foi possível registrar no banco de dados', 404);
        }
        return response('Produto registrado com sucesso', 200);
    }

    /**
     * Atualiza o produto com as informações inseridas com base no ID
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(ProductRequest $request, $id)
    {
        $updated = $this->product->updateProduct($request, $id);

        if(!$updated){
            return response('Não foi encontrado um produto com esse ID', 404);
        }
        return response('Produto atualizado com sucesso', 200);
    }

    /**
     * Remove um produto do banco de dados com base no ID
     *
     * @param  id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);

        if(!$product){
            return response('Não foi encontrado um produto com esse ID', 404);
        }
        $product->delete();

        return response('Produto deletado com sucesso', 200);
    }
}
