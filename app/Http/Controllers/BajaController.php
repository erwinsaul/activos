<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baja;
use App\Models\Activo;

class BajaController extends Controller
{
    public function index()
    {
        $bajas = Baja::with('activo')->get();
        return view('bajas/index', compact('bajas'));
    }

    public function create($id)
    {        
        $activo = Activo::findOrFail($id);        
        
        return view('bajas/create', compact('activo'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'cantidad' => 'required',
                'motivo' => 'required',
                'fecha' => 'required',
                'activo_id' => 'required', 
            ]);

            Baja::create([
                'cantidad' => $request->cantidad,
                'motivo' => $request->motivo,
                'fecha' => $request->fecha,
                'activo_id' => $request->activo_id, 
            ]);

            return redirect()->route('activos.index')->with('success', 'Baja creada correctamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    public function show($id){        
    }

    public function edit($id){      
    }

    public function update(Request $request, $id){
       
    }

    public function destroy($id){
       
    }
}
