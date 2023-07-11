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
        $carrito = (session("carrito"))?  session("carrito"): [];
        if(!empty($this->request->getPost("product")) && !empty($this->request->getPost("quantity"))){
            $code = $this->request->getPost("product");
            $quantity = $this->request->getPost("quantity");
            $product = new Product();
            $product = $product->where("code", $code)->first();

            $existe = false;
            $num = null;
           
            for($i = 0; $i < count($carrito); $i++){
                if($carrito[$i]["code"] == $code){
                    $existe = true;
                    $num = $i;
                }
            }
            if($existe){
                //buscar que las cantidades no se pase de la existencia
                if(($carrito[$num]["quantity"] + $quantity) > $product["quantity"]){
                $mensaje= "No hay existencia suficiente...";
                }else{
                    $carrito[$num]["quantity"] += $quantity;

                    //actualizar la sesion
                    session()->set([
                        "carrito" => $carrito
                    ]);
                }
            }else{

                if($product["quantity"] < $quantity){
                    $mensaje = "No hay existencia suficiente...";
                }else{
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
                    $carrito = session("carrito");
                }
            }
        }
        
        $data = [
            "title"=>"Venta de productos",
            "mensaje" => $mensaje,
            "num" => 0,
            "carrito" => $carrito,
            "total" => 0
        ];
       
        return view("sales/index", $data);
    }

    public function cancel(){
        unset($_SESSION["carrito"]);
        return redirect()->back();
    }
}
