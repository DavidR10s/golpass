<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;

class equipoController extends Controller
{
    //
    public function index()
    {
        $equipos = Equipo::select([
            'nombre',
            'localidad',
            'logo_url',
        ])->get();

        $data = [
            'equipos' => $equipos,
            'status' => 200
        ];

        if ($equipos->isEmpty()) 
        {
            $data = [
                'message' => 'No hay equipos disponibles',
                'status' => 404
            ];
            return response()->json($data, 404); 
        }
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $equipo = Equipo::select([
            'nombre',
            'localidad',
            'logo_url',
        ])->find($id);

        $data = [
            'equipo' => $equipo,
            'status' => 200
        ];
        if (!$equipo) 
        {
            $data = [
                'message' => 'Equipo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404); 
        }
        return response()->json($data, 200);
    }
}
