<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientes;
use App\Models\ventaservicios;
use App\Models\serviciodetalles;
use Session;


class servicioscontroller extends Controller
{
    public function reporteservicios()
    {
        $reporteservicios = \DB::select("SELECT vs.idser,
      DATE_FORMAT(vs.fecha,'%d-%M-%Y') AS fecha, 
      CONCAT(cli.nombre,' ',cli.apellido) AS cliente,
      CONCAT(u.nombre,' ',u.apellido) AS mecanico,
    CONCAT('$ ',FORMAT(SUM(sd.total)*1.16,2)) AS monto
FROM ventaservicios AS vs
INNER JOIN usuarios AS u ON u.idu = vs.idu
INNER JOIN serviciodetalles AS sd ON sd.idser = vs.idser
INNER JOIN clientes AS cli ON cli.idcli = vs.idcli
GROUP BY vs.idser,vs.fecha,CONCAT(cli.nombre,' ',cli.apellido),CONCAT(u.nombre,' ',u.apellido) 
ORDER BY vs.fecha DESC");

        return view('servicios.reporteservicios')
                ->with('reporteservicios',$reporteservicios);
    }
    public function crearservicio()
    {
        $ventaservicios = \DB::select("SELECT * FROM ventaservicios ORDER BY idser DESC LIMIT 1");
        $cuantos = count($ventaservicios);
        if($cuantos == 0)
        {
            $idservicio = 1;
        }
        else
        {
            $idservicio = ($ventaservicios[0]->idser)+1;
        }

        $idu = Session::get('sesionidu');
        $nombreusuario  = Session::get('sesionname');

        $fecha = date('Y-m-j');

        $clientes = \DB::select("SELECT * FROM clientes 
        ORDER BY nombre asc");


        return view('servicios.nuevo')
                ->with('idservicio',$idservicio)
                ->with('idu',$idu)
                ->with('nombreusuario',$nombreusuario)
                ->with('fecha',$fecha)
                ->with('clientes',$clientes);
    }

    public function infocliente(request $request)
    {
        
        $cliente = \DB::select("SELECT * FROM clientes where idcli = $request->idcli");
        return view('servicios.infocliente')
                ->with('cliente',$cliente[0]);
    }

    public function infoservicio(request $request)
    {
        //echo $request->categoria;
        $servicios = \DB::select("SELECT * FROM servicios WHERE idcat = $request->categoria");
        return view('servicios.detallecategoria')
                ->with('servicios',$servicios);
    }

    public function detalleservicio(Request $request)
    {
        
        $servicio = \DB::select("SELECT * FROM servicios where idserv = $request->idserv");
        
       
        return view('servicios.detalleservicio')
                ->with('servicio', $servicio[0]);
    }
    public function agregaelemento(request $request){
        $servicios = \DB::select("SELECT * FROM ventaservicios WHERE idser  = $request->idser");
        $cuantos = count($servicios);
        //return $request;
        
        if ($cuantos ==0)
        {
            $servicios = new ventaservicios;
            $servicios->idser = $request->idser;
            $servicios->fecha = $request->fecha;
            $servicios->idu =$request->idu;
            $servicios->idcli =$request->idcli;
            //$servicios->descuento=
            $servicios->save();

           
        }
        $serviciodetalles  = new serviciodetalles;
        $serviciodetalles->idser = $request->idser;
        $serviciodetalles->idserv = $request->idserv;
        $serviciodetalles->costo = $request->costo;
        $serviciodetalles->descuento = $request->descux;
        $serviciodetalles->total = $request->total;
        $serviciodetalles->save();

        return "Servicio Agregado";
    }

    public function mostrarcarrito(request $request){
        $carritodetalle  = \DB::select("SELECT sd.idsd,sd.idser,sd.idserv,s.nombre AS servicio,c.nombre AS cat,
CONCAT('$ ',FORMAT(sd.costo,2)) AS costo, CONCAT('$', FORMAT(sd.descuento,2)) AS descuento,
CONCAT('$',FORMAT(sd.total,2)) AS total
FROM serviciodetalles AS sd
INNER JOIN servicios AS s ON s.idserv = sd.idserv
INNER JOIN categorias AS c ON c.idcat = s.idcat
WHERE idser = $request->idser");

        $totalescarrito = \DB::select("SELECT sd.idser, SUM(sd.total) AS subtotal,
SUM(sd.total) * 1.16 AS total,
SUM(sd.total)* 1.16 - SUM(sd.total) AS iva
FROM serviciodetalles AS sd
WHERE idser = $request->idser
GROUP BY sd.idser");

//return $carritodetalle;
return view('servicios.carrito')
        ->with('carritodetalle',$carritodetalle)
        ->with('totalescarrito',$totalescarrito[0]);
       
    }


    public function editaservicio($idser)
    {
        $infoservicio = \DB::select("SELECT vs.idser,vs.idcli,vs.fecha,vs.idu,
	c.nombre AS cliente, u.nombre AS usuario
FROM ventaservicios AS vs
INNER JOIN clientes AS c ON c.idcli  = vs.idcli
INNER JOIN usuarios AS u ON u.idu = vs.idu
WHERE idser = $idser");

        $clientes = \DB::select("SELECT * FROM clientes 
        ORDER BY nombre asc");

        $carritodetalle  = \DB::select("SELECT sd.idsd,sd.idser,sd.idserv,s.nombre AS servicio,c.nombre AS cat,
        CONCAT('$ ',FORMAT(sd.costo,2)) AS costo, CONCAT('$', FORMAT(sd.descuento,2)) AS descuento,
        CONCAT('$',FORMAT(sd.total,2)) AS total
        FROM serviciodetalles AS sd
        INNER JOIN servicios AS s ON s.idserv = sd.idserv
        INNER JOIN categorias AS c ON c.idcat = s.idcat
        WHERE idser = $idser");

        $cuantos = count($carritodetalle);

        return view ('servicios.editaservicio')
        ->with('iddservicio',$infoservicio[0]->idser)
        ->with('idu',$infoservicio[0]->idu)
        ->with('nombreusuario',$infoservicio[0]->usuario)
        ->with('fecha', $infoservicio[0]->fecha)
        ->with('clientes',$clientes)
        ->with('carritodetalle',$carritodetalle)
        ->with('cuantos',$cuantos);

    }
    public function borraservicios(request $request)
    {
        $eliminaser = \DB::delete("delete from serviciodetalles where idsd = $request->idsd");

        $carritodetalle  = \DB::select("SELECT sd.idsd,sd.idser,sd.idserv,s.nombre AS servicio,c.nombre AS cat,
        CONCAT('$ ',FORMAT(sd.costo,2)) AS costo, CONCAT('$', FORMAT(sd.descuento,2)) AS descuento,
        CONCAT('$',FORMAT(sd.total,2)) AS total
        FROM serviciodetalles AS sd
        INNER JOIN servicios AS s ON s.idserv = sd.idserv
        INNER JOIN categorias AS c ON c.idcat = s.idcat
        WHERE idser = $request->idser");

        $cuantos = count($carritodetalle);

        if($cuantos>=0)
        {
            $totalescarrito = \DB::select("SELECT sd.idser, SUM(sd.total) AS subtotal,
            SUM(sd.total) * 1.16 AS total,
            SUM(sd.total)* 1.16 - SUM(sd.total) AS iva
            FROM serviciodetalles AS sd
            WHERE idser = $request->idser
            GROUP BY sd.idser");
        }

        if($cuantos>0)
        {
            return view('servicios.carrito')
            ->with('carritodetalle',$carritodetalle)
            ->with('totalescarrito',$totalescarrito[0])
            ->with('cuantos',$cuantos);
        }
        else
        {
        return view('servicios.carrito')
        ->with('carritodetalle',$carritodetalle)
        ->with('cuantos',$cuantos);
        }
    }

    

}
