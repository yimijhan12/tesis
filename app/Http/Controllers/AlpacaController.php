<?php

namespace App\Http\Controllers;
use DB;
use App\Alpaca;
use Illuminate\Http\Request;

class AlpacaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function index(Request $request)
    {
       //if(!$request->ajax()) return('/');
       //$fundo = Fundo::all();
       $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $alpacas = Alpaca::join('fundo','alpacas.idfundo','=','fundo.fund_id')
            ->select('alpacas.alpa_id','alpacas.idfundo','alpacas.alpa_arete','alpacas.alpa_nombre','fundo.fund_nombre','alpacas.alpa_fotos','alpacas.alpa_peso_nac','alpacas.alpa_arete_padre','alpacas.alpa_arete_madre','alpacas.alpa_descripcion','alpacas.alpa_condicion','alpacas.created_at')
            ->orderBy('alpacas.alpa_id', 'desc')->paginate(6);
        }
        else{
            $alpacas = Alpaca::join('fundo','alpacas.idfundo','=','fundo.fund_id')
            ->select('alpacas.alpa_id','alpacas.idfundo','alpacas.alpa_arete','alpacas.alpa_nombre','fundo.fund_nombre','alpacas.alpa_fotos','alpacas.alpa_peso_nac','alpacas.alpa_arete_padre','alpacas.alpa_arete_madre','alpacas.alpa_descripcion','alpacas.alpa_condicion')
            ->where('alpacas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('alpacas.alpa_id', 'desc')->paginate(6);
        }
                return [
            'pagination' => [
                'total'        => $alpacas->total(),
                'current_page' => $alpacas->currentPage(),
                'per_page'     => $alpacas->perPage(),
                'last_page'    => $alpacas->lastPage(),
                'from'         => $alpacas->firstItem(),
                'to'           => $alpacas->lastItem(),
            ],
            'alpacas' => $alpacas
        ];
    }

    
    
    public function store(Request $request)
    {
       
        $alpaca = new Alpaca();
        $alpaca->idfundo = $request->idfundo;
        $alpaca->alpa_arete = $request->alpa_arete;
        $alpaca->alpa_nombre = $request->alpa_nombre;
        $alpaca->alpa_peso_nac = $request->alpa_peso_nac;
        $alpaca->alpa_fotos = $request->alpa_fotos;
        $alpaca->alpa_arete_padre = $request->alpa_arete_padre;
        $alpaca->alpa_arete_madre = $request->alpa_arete_madre;
        $alpaca->alpa_descripcion = $request->alpa_descripcion;
        $alpaca->alpa_condicion = '1';
        $alpaca->save();
    }
    public function update(Request $request)
    {
   
        $alpaca = Alpaca::findOrFail($request->alpa_id);
        $alpaca->idfundo = $request->idfundo;
        $alpaca->alpa_arete = $request->alpa_arete;
        $alpaca->alpa_nombre = $request->alpa_nombre;
        $alpaca->alpa_peso_nac = $request->alpa_peso_nac;
        $alpaca->alpa_fotos = $request->alpa_fotos;
        $alpaca->alpa_arete_padre = $request->alpa_arete_padre;
        $alpaca->alpa_arete_madre = $request->alpa_arete_madre;
        $alpaca->alpa_descripcion = $request->alpa_descripcion;
        $alpaca->alpa_condicion = '1';
        $alpaca->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $alpaca = Alpaca::findOrFail($request->alpa_id);
        $alpaca->alpa_condicion = '0';
        $alpaca->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $alpaca = Alpaca::findOrFail($request->alpa_id);
        $alpaca->alpa_condicion = '1';
        $alpaca->save();
    }
    
    public function destroy($id)
    {
        //
    }



}
