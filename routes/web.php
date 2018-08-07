<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});
//USUARIO
Route::get('/userController/{user}', 'userController@confirmaUsuario');
//EMPRESA
Route::get('/empresaController/empresasConData', 'empresaController@verDatos');
Route::get('/empresaController/productosEmpresa/{id}', 'empresaController@productosEmpresa');
Route::get('/empresaController/girosEmpresa/{id}', 'empresaController@girosEmpresa');
Route::get('/empresaController/empresaActiva', 'empresaController@empresaActiva');
Route::get('/empresaController/empresaInactiva', 'empresaController@empresaInactiva');
Route::get('/empresaController/empresaId/{id}', 'empresaController@verDatosId');


//BUSCADOR
Route::get('/buscadorController/buscaProductosLogin/{producto}', 'buscadorController@buscaProductosLogin');
Route::get('/buscadorController/buscaProductosNoLogin/{producto}', 'buscadorController@buscaProductosNoLogin');
Route::get('/buscadorController/logBusquedasProducto/{producto}', 'buscadorController@logBusquedasProducto');
//CONSULTA
Route::post('/consultaController', 'consultaController@addConsulta');
Route::get('/consultaController/ConsultasRespondidas/{id}', 'consultaController@ConsultasRespondidas');
Route::get('/consultaController/ConsultasRecibidas/{id}', 'consultaController@ConsultasRecibidas');

//GENERAL STATS
Route::get('/generalStatsController/totalEmpresas', 'generalStatsController@totalEmpresas');
Route::get('/generalStatsController/totalProductos', 'generalStatsController@totalProductos');
Route::get('/generalStatsController/totalContactos', 'generalStatsController@totalContactos');
Route::get('/generalStatsController/productosMasBuscados', 'generalStatsController@productosMasBuscados');
Route::get('/generalStatsController/cantidadLogEmpresas/{id}', 'generalStatsController@cantidadLogEmpresas');

//LOGS
Route::get('/logsController/addProductoLog/{producto}', 'logsController@addProductoLog');
Route::post('/logsController/addEmpresaLog', 'logsController@addEmpresaLog');
