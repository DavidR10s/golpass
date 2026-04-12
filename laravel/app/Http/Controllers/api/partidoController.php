<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Partido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class partidoController extends Controller
{
    //
    public function index ()
    {
        $partidos = Partido::with([
            'equipoLocal:id,nombre', 
            'equipoVisitante:id,nombre', 
            'estadio:id,nombre',
        ])->get();
        
        $data = [
                'partidos' => $partidos,
                'status' => 200
            ];

        if($partidos->isEmpty())
        {
            $data = [
                'message:' => 'No hay partidos',
                'status:' => 200
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
        $partido = Partido::with([
            'equipoLocal:id,nombre', 
            'equipoVisitante:id,nombre', 
            'estadio:id,nombre',
        ])->find($id);

        $data = [
            'partido' => $partido,
            'status' => 200
        ];

        if(!$partido)
        {
            $data =[
                'message' => 'partido no existe',
                'status' => 404
            ];

            return response()->json($data, 200);
        }

        return response()->json($data, 200);
    }

    public function edit ()
    {

    }

    public function delete ()
    {

    }
}
