<?php

namespace App\Http\Controllers;
use DB;
use App\Fundo;
use Illuminate\Http\Request;

class FundoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //if(!$request->ajax()) return('/');
       //$fundo = Fundo::all();
             $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $fundo = Fundo::orderBy('fund_id', 'desc')->paginate(6);
        }
        else{
            $fundo = Fundo::where($criterio, 'like', '%'. $buscar . '%')->orderBy('fund_id', 'desc')->paginate(6);
        }
        //$fundo = Fundo::paginate(3);
               return [
            'pagination' => [
                'total'        => $fundo->total(),
                'current_page' => $fundo->currentPage(),
                'per_page'     => $fundo->perPage(),
                'last_page'    => $fundo->lastPage(),
                'from'         => $fundo->firstItem(),
                'to'           => $fundo->lastItem(),
            ],
            'fundo' => $fundo
        ];

     }

    public function selectAlpaca(Request $request){
        //if (!$request->ajax()) return redirect('/');
        $fundos = Fundo::where('fund_condicion','=','1')
        ->select('fund_id','fund_nombre')->orderBy('fund_nombre', 'asc')->get();
        return ['fundos' => $fundos];
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fundo = new Fundo();
        $fundo->fund_nombre = $request->fund_nombre;
        $fundo->fund_departamento = $request->fund_departamento;
        $fundo->fund_provincia = $request->fund_provincia;
        $fundo->fund_lugar = $request->fund_lugar;
        $fundo->fund_condicion = '1';
        $fundo->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $fundo = Fundo::findOrFail($request->fund_id);
        $fundo->fund_nombre = $request->fund_nombre;
        $fundo->fund_departamento = $request->fund_departamento;
        $fundo->fund_provincia = $request->fund_provincia;
        $fundo->fund_lugar = $request->fund_lugar;
      
        $fundo->save();
    }

    public function desactivar(Request $request)
    {
        $fundo = Fundo::findOrFail($request->fund_id);
        $fundo->fund_condicion = '0';
        $fundo->save();
    }

    public function activar(Request $request)
    {
        $fundo = Fundo::findOrFail($request->fund_id);
        $fundo->fund_condicion = '1';
        $fundo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
