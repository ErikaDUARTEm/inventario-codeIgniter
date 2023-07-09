<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;

class SalesController extends BaseController
{
    public function __construct(){
        session();
    }
    public function index()
    {   
        $mensaje = null;
        if(!empty($this->request->getPost("product")) && !empty($this->request->getPost("quantity"))){
            $code = $this->request->getPost("product");
            $quantity = $this->request->getPost("quantity");
            $product = new Product();
           $product = $product->where("code", $code)->first();
            if($product["quantity"] < $quantity){
                $mensaje = "No hay existencia suficiente...";
            }
            
            if(!empty(session("carrito"))){
                $details = session("carrito");
            }else{
                $details =[];
            }
            
            $detail = [
                "id"=> $product["id"],
                "code" => $product["code"],
                "title" => $product["title"],
                "price" => $product["price"],
                "quantity" => $quantity
            ];
            array_push($details, $detail);
            session()->set([
                "carrito" => $details
            ]);
        }
        $data = [
            "title"=>"Venta de productos",
            "mensaje" => $mensaje,
            "num" => 0,
        ];
        return view("sales/index", $data);
    }
}
