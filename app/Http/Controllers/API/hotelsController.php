<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\hotels;

class hotelsController extends Controller

{
    public function get()
    {

    
        try {
            $data = hotels::get();
            return response() -> json ($data,200);
        } catch (\Throwable $th) {
            return response () -> json (['error' => $th ->getMessage()], 500);
        };
    }


    public function create ( request $request ) {
        try {

            // Verificar si el hotel ya tiene 3 habitaciones
            $existingRooms = hotels::where('hotel', $request['hotel'])->count();
            if ($existingRooms >= 3) {
                return response()->json(['error' => 'El hotel ya tiene el máximo de 3 habitaciones asignadas.'], 400);
            }
            $data [ 'ciudad'] = $request [ 'ciudad'];
            $data [ 'hotel'] = $request [ 'hotel'];
            $data [ 'habitacion'] = $request [ 'habitacion'];
            $data [ 'cantidad'] = $request [ 'cantidad'];
            $res = hotels :: create ($data);
            return response () -> json ( $res, 200);
        } catch (\Throwable $th) {
            return response () -> json (['error' => $th ->getMessage()], 500);
        }
    }

    public function getById($id){
try {
    $data = hotels:: find($id);
    return response () -> json($data, 200);
} catch (\Throwable $th) {
    return response () -> json (['error' => $th ->getMessage()], 500);
}
    }


    public function update ( request $request,$id ) {
 try {

    // Obtener el nombre del hotel actual
    $hotelName = hotels::find($id)->hotel;

    $existingRooms = hotels::where('hotel', $hotelName)->count();
    if ($existingRooms >= 3 && $request['hotel'] == $hotelName) {
        return response()->json(['error' => 'El hotel ya tiene el máximo de 3 habitaciones asignadas.'], 400);
    }

    $data [ 'ciudad'] = $request [ 'ciudad'];
    $data [ 'hotel'] = $request [ 'hotel'];
    $data [ 'habitacion'] = $request [ 'habitacion'];
    $data [ 'cantidad'] = $request [ 'cantidad'];
    hotels:: find ($id) -> update ($data);
    $res = hotels :: find ($id);
    return response () -> json ( $res, 200);
 } catch (\Throwable $th) {
    return response () -> json (['error' => $th ->getMessage()], 500);
 }
}



public function delete ($id) {
    try {
       $res = hotels :: find ($id) -> delete();
       return response () -> json ( ["deleted" => $res], 200);
    } catch (\Throwable $th) {
       return response () -> json (['error' => $th ->getMessage()], 500);
    }
   }


   


}
