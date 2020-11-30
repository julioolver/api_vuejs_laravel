<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$rowsPerPage = $request->get('page', 10);

        $materiais = Person::orderBy('nome')->with('contact')->paginate();
        return response()->json($materiais);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        try {
            $person = Person::create($dados);
            if($person){
                $person->contact()
                ->create($dados);
            }
            return response()->json('success', 200);
        } catch (\Throwable $th) {
            return response()->json('error', 404);
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
        try {
            $person = Person::with('contact')->find($id);
            return response()->json($person, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 404);
        }
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
        $person = Person::with('contact')->findOrFail($id);
        $dados = $request->all();

        try {
            $person->update($request->all());
            if ($person) {
                $person->contact()
                ->update($dados['contact']);
            }
            return response()->json('success', 200);
        } catch (\Throwable $th) {
            return response()->json('error', 403);
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
        $person = Person::with('contact')->findOrFail($id);
        $person->delete();

        return response()->json('Deleted Successfully', 200);
    }
}
