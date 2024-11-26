<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipos;
use App\Models\colores;
use App\Models\vehiculos;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Session;

class tallercontroller extends Controller
{
    public function altavehiculos()
    {
        if(Session::get('sesionidu'))
        {
        $todostipos = tipos::orderby('nombre','asc')
                              ->get();

        

        $todoscolores = colores::orderby('nombre','asc')
                              ->get();
              
        return view ('vehiculos.altavehiculos')
        ->with('todostipos',$todostipos)
        ->with('todoscolores',$todoscolores);
       
        }
        else{
            Session::flash('mensaje',"Es necesario iniciar sesion");
            return redirect()->route('login');
        }
    }

    public function guardavehiculos(Request $request)
    {
        $this->validate($request,[   
            'nombre'=>'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó]+$/',
            'telefono'=> 'required|regex:/^[0-9]{10}$/',
            'direccion'=> 'required|regex:/^[0-9,A-Z][A-Z,a-z,0-9, ]+$/',
            'correo'=> 'required|email',
            'fecha'=>'required|date',
            'placa'=> 'required|regex:/^[A-Z]{3}[-][0-9]{2}[-][0-9]{2}$/',
            'foto'=>'mimes:jpg,png,gif,jpeg',
            'control_vehicular'=>'mimes:pdf,docx',

        ]);
        

        $file = $request->file('foto');
        if($file != '')
        {
        $fecha = date_create();
        $img = date_timestamp_get($fecha) . $file->getClientOriginalName();
        \Storage::disk('local')->put($img,\File::get($file));
        }
        else
        {
        $img ='sinfoto.png';
        }

        $nombrecontrol = '';
        $control = $request->file('control_vehicular');
        if($control != '')
        {
        $fecha = date_create();
        $nombrecontrol = date_timestamp_get($fecha) . $control->getClientOriginalName();
        \Storage::disk('control')->put($nombrecontrol,\File::get($control));
        }

        $vehiculos = new vehiculos;
        $vehiculos->nombre = $request->nombre;
        $vehiculos->telefono = $request->telefono;
        $vehiculos->direccion =$request->direccion;
        $vehiculos->correo =$request->correo;
        $vehiculos->fecha= $request->fecha;
        $vehiculos->placa=$request->placa;
        $vehiculos->grua=$request->grua;
        $vehiculos->cilindro =$request->cilindro;
        $vehiculos->idt = $request->idt;
        $vehiculos->idco = $request->idco; 
        $vehiculos->foto = $request->foto = $img;
        $vehiculos->control_vehicular = $request->control_vehicular = $nombrecontrol;
        $vehiculos->activo = $request->activo;
        $vehiculos->save();

        /*$insertavehiculo =  \DB::insert("INSERT INTO vehiculos
    (nombre,telefono,direccion,correo,fecha,placa,grua,cilindro,idt,idco,created_at,updated_at,activo,foto)
    VALUE ('$request->nombre',$request->telefono,'$request->direccion','$request->correo','$request->fecha','$request->placa','$request->grua',$request->cilindro, $request->idt,$request->idco,now(),now(),'$request->activo','$img')");                        
    //return $todasespecies;*/

        Session::flash('mensaje', "El vehiculo de $request->nombre se ha guardado correctamente");
        return redirect()->route('reportevehiculos');
    }

    public function reportevehiculos()
    {
        if(Session::get('sesionidu'))
        {
        $consulta  = \DB::select("SELECT v.idve,v.nombre as vehi,v.placa,v.fecha,t.nombre as tip, c.nombre as colo,v.activo,v.foto
        FROM vehiculos  AS v
        INNER JOIN tipos AS t ON t.idt = v.idt 
        INNER JOIN colores AS c ON c.idco = v.idco
        order by vehi asc");
        return view('vehiculos.reportevehiculos')
        ->with('consulta',$consulta);
    }
    else{
        Session::flash('mensaje',"Es necesario iniciar sesion");
        return redirect()->route('login');
    }
    }

    public function editavehiculos($idve)
    {

        if(Session::get('sesionidu'))
        {

        $clave = Crypt::decrypt($idve);
        $infovehiculo =  \DB::select("SELECT v.idve,v.nombre,v.telefono,v.direccion,v.correo,v.fecha,v.placa,
        v.grua,v.cilindro,v.idt,v.idco, t.nombre AS nom,c.nombre AS colo,v.activo,v.foto,v.control_vehicular
 FROM vehiculos AS v
 INNER JOIN tipos AS t ON t.idt = v.idt
 INNER JOIN colores AS c ON c.idco  =v.idco
 WHERE idve = $clave");

                if($infovehiculo[0]->control_vehicular !='')
                {
                $archivo = explode('.',$infovehiculo[0]->control_vehicular);
                $extension = $archivo[1];
                }   
                else
                {
                $extension = 'NA';
                }

        $colores = colores::where('idco','<>',$infovehiculo[0]->idco)
                            ->orderby('nombre','Asc')
                            ->get();
        //return $colores;

        $tipos = tipos::where('idt','<>',$infovehiculo[0]->idt)
                                ->orderby('nombre','Asc')
                                ->get();
 
       return view('vehiculos.editavehiculos')
       ->with('infovehiculo',$infovehiculo[0])
       ->with('colores',$colores)
       ->with('tipos',$tipos)
       ->with('extension',$extension);
    }
    else{
        Session::flash('mensaje',"Es necesario iniciar sesion");
        return redirect()->route('login');
    }
       
    }

    public function guardacambios(request $request)
    {
        $this->validate($request,[   
            'nombre'=>'required|regex:/^[A-Z][A-Z,a-z, ]+$/',
            'telefono'=> 'required|regex:/^[0-9]{10}$/',
            'direccion'=> 'required|regex:/^[0-9,A-Z][A-Z,a-z,0-9, ]+$/',
            'correo'=> 'required|email',
            'fecha'=>'required|date',
            'placa'=> 'required|regex:/^[A-Z]{3}[-][0-9]{2}[-][0-9]{2}$/',
            'foto'=>'image|mimes:jpg,jpeg,png',
            'control_vehicular'=>'mimes:pdf,docx',
        ]);

        $file = $request->file('foto');
        if($file != '')
        {
        $fecha = date_create();
        $img = date_timestamp_get($fecha) . $file->getClientOriginalName();
        \Storage::disk('local')->put($img,\File::get($file));
        }

        $nombrecontrol = '';
        $control = $request->file('control_vehicular');
        if($control != '')
        {
        $fecha = date_create();
        $nombrecontrol = date_timestamp_get($fecha) . $control->getClientOriginalName();
        \Storage::disk('control')->put($nombrecontrol,\File::get($control));
        }  

        $vehiculos =  vehiculos::find($request->idve);
        $vehiculos ->nombre = $request->nombre;
        $vehiculos->telefono = $request->telefono;
        $vehiculos->direccion =$request->direccion;
        $vehiculos->correo =$request->correo;
        $vehiculos->fecha= $request->fecha;
        $vehiculos->placa=$request->placa;
        $vehiculos->grua=$request->grua;
        $vehiculos->cilindro =$request->cilindro;
        $vehiculos->idt = $request->idt;
        $vehiculos->idco =$request->idco;
        if($file != '')
        {
        $vehiculos->foto = $request->foto = $img;
        }
        if($control != '')
        {
        $vehiculos->control_vehicular = $request->control_vehicular = $nombrecontrol;
        }
        $vehiculos->activo =$request->activo;
        
        $vehiculos->save();
        Session::flash('mensaje', "La información del vehiculo de  $request->nombre se ha editado correctamente");
        return redirect()->route('reportevehiculos');
    }

    public function desactivavehiculos($idve)
    {
        $clave = Crypt::decrypt($idve);
        $vehiculos = vehiculos::find($clave);
        $vehiculos ->activo = 'no';
        $vehiculos ->save();
        Session::flash('mensaje', "El vehiculo de clave $clave se ha desactivado correctamente");
        return redirect()->route('reportevehiculos');
    }
    public function activavehiculos($idve)
    {
        $clave = Crypt::decrypt($idve);
        $vehiculos = vehiculos::find($clave);
        $vehiculos ->activo='si';
        $vehiculos ->save();
        Session::flash('mensaje', "El vehiculo de clave $clave se ha activado correctamente");
        return redirect()->route('reportevehiculos');
    }
    public function eliminavehiculos($idve)
    {
        $clave = Crypt::decrypt($idve);
        $borravehiculo =  \DB::delete("delete from vehiculos where idve = $clave");
        Session::flash('mensaje', "El vehiculo de  clave $clave se ha eiminado correctamente");
        return redirect()->route('reportevehiculos');

    }
    public function principal()
    {
        return view('principal2');
    }
}
