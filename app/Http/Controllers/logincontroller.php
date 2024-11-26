<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuarios;
use App\Models\captchas;
use App\Mail\notificacion;
use App\Mail\notificacion2;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Session;


class logincontroller extends Controller
{
    public function inicio()
    {
        if(Session::get('sesionidu'))
        {
        return view ('vehiculos.inicio');
        }
        else{
            Session::flash('mensaje',"Es necesario iniciar sesion");
            return redirect()->route('login');
        }
    }

    public function login()
    {
        return view('login.login');
    }

    public function validar(request $request)
    {
        $correo = $request->correo;
        $pasword = md5($request->pasword);
        //return $pasword;
        $acceso = usuarios::where('correo','=',$correo)
                            ->where('pasword','=',$pasword)
                            ->where('activo','=','si')
                            ->where('bloqueo','=','0')
                            
                            ->get();

        $cuantos = count($acceso);
        if ($cuantos==0)
        {
            Session::flash('mensaje',"El usuario o pasword son incorrectos");
            return redirect()->route('login');
        }
        else
        {
            Session::put('sesionname',$acceso[0]->nombre .''. $acceso[0]->apellido );
            Session::put('sesionidu',$acceso[0]->idu);
            Session::put('sesiontipo',$acceso[0]->tipo);
            return redirect()->route('inicio');
        }                    
       
    }

    public function cerrarsesion()
    {
        Session::forget('sesionname');
        Session::forget('sesionidu');
        Session::forget('sesiontipo');
        Session::flush();
        Session::flash('mensaje', 'Session Cerrada Correctamente');
        return redirect()->route('login');
    }

    public function newpassword()
    {

        $idc = rand(1,4);

        $captcha = captchas::where('idcap','=',$idc)
                             ->get();
        //return $captcha;
        return view('login.recuperapass')
                ->with('captcha',$captcha[0]);
    }

    public function validauser(Request $request)
    {
        $usuario = usuarios::where('correo','=',$request->correo)
                                ->where('activo','=','Si')
                                ->get();
        $cuantos = count($usuario);

        $captcha = captchas::where('idcap','=',$request->textcap)
                             ->get();

        if ($captcha[0]->valor != $request->captcha)
        {
            $bandera = 1;
        }
        if($cuantos==0)
        {
            $bandera  = 2;
        }
        if($cuantos>=1 and $captcha[0]->valor == $request->captcha)
        {
            $bandera = 3;
        }
        if($bandera==3)
        {
          $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
           
         $passnuevo =  substr(str_shuffle($permitted_chars), 0, 10);
         $passencnuevo = md5($passnuevo);
         //echo $passnuevo;
         //echo "<br>";
        //echo $passencnuevo;

        $actualizapass =  \DB::update("update usuarios set pasword = '$passencnuevo' where correo = '$request->correo'");
        $response=Mail::to($request->correo)
        
        
        ->send(new notificacion($request->correo,$passnuevo));
         dump($response);
        echo "correo enviado";

        }

        return view('login.resultadocaptcha')
        ->with('bandera',$bandera);
       
    }

    public function captchanuevo()
    {
        $idc = rand(1, 4);

        $captcha = captchas::where('idcap','=',$idc)
                             ->get();
        return view('login.captchanuevo')
               ->with('captcha',$captcha[0]);
    }

    public function newpassword2()
    {
        return view('login.recuperapass2');
    }

    public function validauser2(Request $request)
    {
        $usuario = usuarios::where('correo','=',$request->correo)
                             ->where('activo','=','Si')
                             ->get();
        $cuantos = count($usuario);

        if($cuantos==0)
        {
            echo "El correo no existe";
        }
        else
        {
            $hoy = date("Y-m-d H:i:s");

            $idu = $usuario[0]->idu;
            $encid = Crypt::encrypt($idu);

            $actualizapass =  \DB::update("update usuarios set bloqueo= '1',
            fechavigencia = addtime('$hoy','2:00:00') where correo = '$request->correo'");

            $response=Mail::to($request->correo)
            ->send(new notificacion2($encid));
            //dump($response);*/
            
        
            echo "Se envio un correo para recuperacion de contraseña";

        }

       
    }
    public function reinicia($encid)
    {
       return view ('login.reinicio')
        ->with('encid',$encid);
    }

    public function cambiapass(request $request)
    {
        $idu = Crypt::decrypt($request->encid);
        //return "$idu";
        $pass = $request->pass;
        $pass2 = $request->pass2;
        if($pass == $pass2)
        {
         $consulta = \DB::select("SELECT IF( NOW()<=fechavigencia,'valido','novalido') AS resultado
                                    FROM usuarios
                                    WHERE idu = $idu");
         if($consulta[0]->resultado =='valido')
         {
        $pass = md5($pass);
        $actualiza  = \DB::update("UPDATE usuarios
        SET pasword = '$pass', bloqueo = 0
        WHERE idu = $idu");
        echo "El password ha sido cambiado , favor de loguearse nuevamente";
        echo "<a href = '..\login'> Clic aqui para iniciar sesion</a>";
        echo "<br>";
       
         }
         else{
            echo "El link de recuperacion ya caduco, es necesario hacer una nueva solicitud";
         }
        }
        else
        {
            echo "Password no cohincide";
        }
    }

   
}
