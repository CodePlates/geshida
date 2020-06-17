<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CrudAction;

class CrudController extends Controller
{

    protected $crud;

    public function __construct(CrudAction $crud)
    {        
        $this->crud = $crud;
        $this->setup();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (method_exists($this, 'setupIndex')) {
            $this->setupIndex();
        }
        
        return view()->first(['crud.index'], [
            'dataKey'   => $this->crud->datatype()->getName(),
            'dataItems' => $this->crud->getAll(), 
            'datatype'  => $this->crud->datatype(),
            'fields'    => $this->crud->getFields()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
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
    public function update(Request $request, $id)
    {
        //
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
