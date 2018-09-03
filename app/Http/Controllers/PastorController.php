<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Pastor;
use App\Persona;
class PastorController extends Controller
{
	   public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = Pastor::join('personas','pastores.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.apellidos','personas.tipo_documento',
            'personas.num_documento','personas.direccion','personas.telefono','personas.avatar',
            'personas.email','pastores.nombre_conyugue','pastores.telefono_conyugue','pastores.sueldo','pastores.fecha_ingreso')
            ->orderBy('personas.id', 'desc')->paginate(3);
        }
        else{
            $personas = Pastor::join('personas','pastores.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.apellidos','personas.tipo_documento',
            'personas.num_documento','personas.direccion','personas.telefono','personas.avatar',
            'personas.email','pastores.nombre_conyugue','pastores.telefono_conyugue','pastores.sueldo','pastores.fecha_ingreso')         
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function store(Request $request)
    {
        
        try{
            DB::beginTransaction();
            $persona = new Persona();
	        $persona->nombre = $request->nombre;
	        $persona->apellidos = $request->apellidos;
	        $persona->tipo_documento = $request->tipo_documento;
	        $persona->num_documento = $request->num_documento;
	        $persona->direccion = $request->direccion;
	        $persona->telefono = $request->telefono;
	        $persona->avatar = $request->avatar;
	        $persona->email = $request->email;

            $pastor = new Pastor();
            $pastor->id = $persona->id;
            $pastor->nombre_conyugue = $request->nombre_conyugue;
            $pastor->telefono_conyugue = $request->telefono_conyugue;
            $pastor->sueldo = $request->sueldo;
            $pastor->fecha_ingreso = $request->fecha_ingreso;
            $pastor->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

        
        
    }

    public function update(Request $request)
    {

        
        try{
            DB::beginTransaction();

            //Buscar primero el pastor a modificar
            $pastor = Pastor::findOrFail($request->id);

            $persona = Persona::findOrFail($pastor->id);

       		$persona->nombre = $request->nombre;
	        $persona->apellidos = $request->apellidos;
	        $persona->tipo_documento = $request->tipo_documento;
	        $persona->num_documento = $request->num_documento;
	        $persona->direccion = $request->direccion;
	        $persona->telefono = $request->telefono;
	        $persona->avatar = $request->avatar;
	        $persona->email = $request->email;

            $pastor->nombre_conyugue = $request->nombre_conyugue;
            $pastor->telefono_conyugue = $request->telefono_conyugue;
            $pastor->id = $persona->id;
            $pastor->sueldo = $request->sueldo;
            $pastor->fecha_ingreso = $request->fecha_ingreso;
            $pastor->save();
         

            
      

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }
}
