<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Dompdf\Dompdf;

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
                        "description" => $product["title"],
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
    public function save()
    {  
        if(empty($this->request->getPOST("customer_id") || empty($this->request->getPOST("total")))){
            return redirect()->back()->with("error", "Datos incompletos, no se puede realizar la venta. Intente de nuevo");
        }
        try{
            $customer = new Customer();
            $cliente = $customer->find($this->request->getPOST("customer_id"));
            $data = [
                "customer_id" => $this->request->getPOST("customer_id"),
                "employee_id" => session("user_id"),
                "total"=> $this->request->getPOST("total"),
                "created_at" => date("Y-m-d h:i:s")
            ];
            $sales = new Sale();
            $saleId = $sales->insert($data); //se inserta la venta general
            foreach(session("carrito") as $row){ //se recorren los detalles de la venta
                $saleDetails = new SaleDetail();
                $products= new Product();
                $data = [
                    "sale_id" => $saleId,
                    "product_id"=>$row["id"],
                    "quantity"=>$row["quantity"],
                    "price"=>$row["price"]
                ];
                $saleDetails->insert($data); //insertamos detalles de la venta
                //restamos existencias
                $product = $products->find($row["id"]);
                $newQuantity = $product["quantity"] - $row["quantity"];
                $products->update($row["id"], ["quantity"=> $newQuantity]);
            }
            // guardar factura en pdf
            
            $dompdf = new Dompdf();
            $dompdf->loadHtml( view("sales/factura", [
                "cliente"=>$cliente["name"],
                "carrito"=> session("carrito")]));
    
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('letter', 'landscape');
    
            // Render the HTML as PDF
            $dompdf->render();
    
            // Output the generated PDF to Browser
            $dompdf->stream();

            //borrar el carrito
            session()->remove("carrito");
            return redirect()->to(base_url("/sale"))->with("sucess", "Venta actualizada correctamente");

            }catch(\Throwable $th){
                return redirect()->back()->with("error", $th->getMessage());
    
            };
    
           
    }
}