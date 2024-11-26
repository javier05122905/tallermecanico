<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tallercontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\servicioscontroller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('altavehiculos',[tallercontroller::class,'altavehiculos'])->name('altavehiculos');
Route::POST('guardavehiculos',[tallercontroller::class,'guardavehiculos'])->name('guardavehiculos');
Route::get('reportevehiculos',[tallercontroller::class,'reportevehiculos'])->name('reportevehiculos');
Route::get('editavehiculos/{idve}',[tallercontroller::class,'editavehiculos'])->name('editavehiculos');
Route::POST('guardacambios',[tallercontroller::class,'guardacambios'])->name('guardacambios');
Route::get('eliminavehiculos/{idve}',[tallercontroller::class,'eliminavehiculos'])->name('eliminavehiculos');
Route::get('desactivavehiculos/{idve}',[tallercontroller::class,'desactivavehiculos'])->name('desactivavehiculos');
Route::get('activavehiculos/{idve}',[tallercontroller::class,'activavehiculos'])->name('activavehiculos');
Route::get('principal',[tallercontroller::class,'principal'])->name('principal');
Route::get('prueba',[tallercontroller::class,'prueba'])->name('prueba');
Route::get('prueba1',[tallercontroller::class,'prueba1'])->name('prueba1');


Route::get('inicio',[logincontroller::class,'inicio'])->name('inicio');
Route::get('login',[logincontroller::class,'login'])->name('login');
Route::POST('validar',[logincontroller::class,'validar'])->name('validar');
Route::get('cerrarsesion',[logincontroller::class,'cerrarsesion'])->name('cerrarsesion');



Route::get('crearservicio',[servicioscontroller::class,'crearservicio'])->name('crearservicio');
Route::get('infocliente',[servicioscontroller::class,'infocliente'])->name('infocliente');
Route::get('infoservicio',[servicioscontroller::class,'infoservicio'])->name('infoservicio');
Route::get('detalleservicio',[servicioscontroller::class,'detalleservicio'])->name('detalleservicio');
Route::get('agregaelemento',[servicioscontroller::class,'agregaelemento'])->name('agregaelemento');
Route::get('mostrarcarrito',[servicioscontroller::class,'mostrarcarrito'])->name('mostrarcarrito');
Route::get('reporteservicios',[servicioscontroller::class,'reporteservicios'])->name('reporteservicios');
Route::get('editaservicio/{idser}',[servicioscontroller::class,'editaservicio'])->name('editaservicio');
Route::get('borraservicios',[servicioscontroller::class,'borraservicios'])->name('borraservicios');


Route::get('newpassword',[logincontroller::class,'newpassword'])->name('newpassword');
Route::get('validauser',[logincontroller::class,'validauser'])->name('validauser');
Route::get('captchanuevo',[logincontroller::class,'captchanuevo'])->name('captchanuevo');
Route::get('pruebacorreo',[logincontroller::class,'pruebacorreo'])->name('pruebacorreo');

//recuperar 2
Route::get('newpassword2',[logincontroller::class,'newpassword2'])->name('newpassword2');
Route::get('validauser2',[logincontroller::class,'validauser2'])->name('validauser2');
Route::get('reinicia/{encid}',[logincontroller::class,'reinicia'])->name('reinicia');
Route::get('cambiapass',[logincontroller::class,'cambiapass'])->name('cambiapass');