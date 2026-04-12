<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Entrada;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class entradaController extends Controller
{
    //
    public function index()
    {
        $entradas = Entrada::with([ 
            'partido.equipoLocal:id,nombre',
            'partido.equipoVisitante:id,nombre',
            'partido.estadio:id,nombre',
         ])->get();

        $data = [
            'entradas' => $entradas,
            'status' => 200
        ];

        if($entradas->isEmpty())
        {
            $data =[
                'message' => 'no hay entradas',
                'status' => 200
            ];

            return response()->json($data, 200);
        }

        return response()->json($data, 200);
    }

    public function store (Request $request)
    {

    }

    public function show ($id)
    {
        $entrada = Entrada::with([
            'partido.equipoLocal:id,nombre',
            'partido.equipoVisitante:id,nombre',
            'partido.estadio:id,nombre',
        ])->find($id);

        $data = [
            'entradas' => $entrada,
            'status' => 200
        ];

        if(!$entrada)
        {
            $data =[
                'message' => 'no hay entradas',
                'status' => 404
            ];

            return response()->json($data, 200);
        }

        return response()->json($data, 200);
    }

    public function porPartido($id)
    {
        $entradas = Entrada::where('partido_id', $id)->get();
        
        $data = [
            'data' => $entradas,
            'status' => 200
        ];

        if(!$entradas)
        {
            $data =[
                'message' => 'no hay entradas para este partido',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        return response()->json($data);
    }

    public function edit ()
    {

    }

    public function delete ()
    {

    }
    
}
