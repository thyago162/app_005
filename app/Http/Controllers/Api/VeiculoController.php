<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Veiculo\VeiculoRequest;
use App\Models\Veiculo;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
           $veiculos = Veiculo::paginate(10);

           return response()->json([
               'veiculos' => $veiculos
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * 
     */
    public function find($search)
    {
        try {
            $veiculos = Veiculo::where('veiculo', 'like', '%'.$search.'%')
                ->orWhere('marca', 'like', '%'.$search.'%')
                ->orWhere('descricao', 'like', '%'.$search.'%')
                ->paginate(10);
            return response()->json(['veiculos' => $veiculos]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VeiculoRequest $request)
    {
        try {
           $veiculos = Veiculo::create($request->all());
           
           return response()->json([
               'veiculos' => $veiculos
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['error' => $th->getMessage()], 400);
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
        try {
            return response()->json([
                'veiculos' => Veiculo::findOrFail($id)
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VeiculoRequest $request, $id)
    {
        try {
            $veiculo = Veiculo::find($id)->update($request->all());
            /*$data = $request->all();
            $indices = array_keys($data);
            foreach ($indices as $indice) {
                $veiculo->indice = $data[$indice];
            }

            $veiculo->save();*/
      
            return response()->json([
                'veiculos' => $veiculo
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return response()->json([
                'veiculos' => Veiculo::find($id)->delete()
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
