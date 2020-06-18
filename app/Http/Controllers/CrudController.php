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
        $model = $this->crud->getModel();
        $query = $model::query();
        if (method_exists($this, 'setupIndex')) {
            $this->setupIndex($query);
        }
        
        return view()->first(['crud.index'], [            
            'model'     => $this->crud->getModel(),
            'dataItems' => $query->get(), 
            'datatype'  => $this->crud->datatype(),
            'fields'    => $this->crud->getFields(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (method_exists($this, 'setupCreate')) {
            $this->setupCreate();
        }
        
        $model = $this->crud->getModel();
        return view()->first(['crud.create'], [
            'model'     => $model,
            'dataItem'  => new $model, 
            'datatype'  => $this->crud->datatype(),
            'fields'    => $this->crud->getFields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (method_exists($this, 'setupCreate')) {
            $this->setupCreate();
        }

        $model = $this->crud->getModel();
        $dataItem = new $model;
        foreach ($this->crud->getFields() as $fieldName) {
            $dataItem->{$fieldName} = $request->{$fieldName};
        }
        $dataItem->save();

        $model = $this->crud->getModel();
        return redirect(crud_route("index", $model));
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
        $dataItem = $this->crud->find($id);
        if (method_exists($this, 'setupEdit')) {
            $this->setupEdit($dataItem);
        }
        
        return view()->first(['crud.edit'], [
            'model'     => $this->crud->getModel(),
            'dataItem'  => $dataItem, 
            'datatype'  => $this->crud->datatype(),
            'fields'    => $this->crud->getFields()
        ]);
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
        $dataItem = $this->crud->find($id);
        if (method_exists($this, 'setupEdit')) {
            $this->setupEdit($dataItem);
        }

        foreach ($this->crud->getFields() as $fieldName) {
            $dataItem->{$fieldName} = $request->{$fieldName};
        }
        $dataItem->save();

        $model = $this->crud->getModel();
        return redirect(crud_route("index", $model));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->crud->delete($id);
        $model = $this->crud->getModel();
        return redirect(crud_route("index", $model));
    }
}
