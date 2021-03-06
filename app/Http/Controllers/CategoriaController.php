<?php

namespace sisControl\Http\Controllers;

use Illuminate\Http\Request;

use sisControl\Http\Requests;
use sisControl\Categoria;
use Illuminate\Support\Facades\Redirect;
use sisControl\Http\Requests\CategoriaFormRequest;
use DB;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //
    public function __construct(){

    }

    public function index(Request $request){

    	if($request){
    		$query = trim($request -> get('searchText'));
    		$categorias = DB::table('categoria') -> where('nombre','LIKE','%'.$query.'%')
    		-> where('condicion','=','1')
    		-> orderBy('idcategoria','desc')
    		-> paginate(8);

    		return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);

    	}
    }

    public function create(){

    	return view('almacen.categoria.create');

    }

    public function store(CategoriaFormRequest $request){

    	$categoria = new Categoria;
    	$categoria -> nombre = $request->get('nombre');
    	$categoria -> descripcion = $request->get('descripcion');
    	$categoria -> condicion = '1';
    	$categoria -> save();

    	return Redirect::to('almacen/categoria');
    	//return redirect('almacen/categoria');
    }

    public function show($id){

    	return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);

    }

    public function edit($id){

    	return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);

    }

    public function update(CategoriaFormRequest $request, $id){

    	$categoria = Categoria::findOrFail($id);
    	$categoria -> nombre = $request->get('nombre');
    	$categoria -> descripcion = $request->get('descripcion');
    	$categoria -> update();

    	return Redirect::to('almacen/categoria');
    	//return redirect('almacen/categoria');
    }

    public function destroy($id){

    	$categoria = Categoria::findOrFail($id);
    	$categoria -> condicion = '0';
    	$categoria -> update();

    	return Redirect::to('almacen/categoria');
    	//return redirect('almacen/categoria');
    }
}
