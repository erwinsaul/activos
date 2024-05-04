<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Activo;

class ActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activos = DB::table('activos')
                ->select('activos.*', DB::raw('cantidad_inicial - COALESCE(SUM(bajas.cantidad), 0) AS stock_actual'))
                ->leftJoin('bajas', 'activos.id', '=', 'bajas.activo_id')
                ->groupBy('activos.id', 'activos.nombre', 'activos.descripcion', 'activos.cantidad_inicial')
                ->orderBy('activos.codigo')
                ->get();


        return view('activos.index', ['activos' => $activos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function generarCodigo($ultimoCodigo)
    {        
        if ($ultimoCodigo) {
            $numero = (int)substr($ultimoCodigo, 2) + 1;
            return 'CM' . str_pad($numero, 3, '0', STR_PAD_LEFT);
        } else {
            return 'CM001';
        }
    }
    public function create()
    {
        // Generar código autocalculado
        $ultimoActivo = Activo::latest()->first();
        $ultimoCodigo = $ultimoActivo ? $ultimoActivo->codigo : null;
        $nuevoCodigo = $this->generarCodigo($ultimoCodigo);
        return view('activos.create', ['codigo' => $nuevoCodigo]);
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string',
                'descripcion' => 'required|string',
                'cantidad_inicial' => 'required|numeric|min:0',
            ]);
    
            Activo::create([
                'nombre' => strtoupper($request->nombre),
                'descripcion' => strtoupper($request->descripcion),
                'cantidad_inicial' => $request->cantidad_inicial,
            ]);
    
            return redirect()->route('activos.index')->with('success', 'Activo creado correctamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activo = Activo::findOrFail($id);
        return view('activos.show', compact('activo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activo = Activo::findOrFail($id);
        return view('activos/edit', compact('activo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'cantidad_inicial' => 'required|numeric|min:0',
        ]);

        $activo = Activo::findOrFail($id);
        $activo->update($request->all());
        return redirect()->route('activos.index')->with('success', 'Activo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activo = Activo::findOrFail($id);
        $activo->delete();
        return redirect()->route('activos/index')->with('success', 'Activo eliminado correctamente.');
    }
}
