<?php

namespace sisControl\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //use HasFactory;
     protected $table = 'categoria';

    protected $primaryKey = 'idcategoria';

    public $timestamps = false;


    protected $fillable = [
    	'nombre',
    	'descripcion',
    	'condicion'
    ];

    protected $guarded = [

    ];
}