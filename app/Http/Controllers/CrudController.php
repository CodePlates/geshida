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
        $this->authorize('viewAny', $model);

        $query = $model::query();
        if (method_exists($this, 'setupIndex')) {
            $this->setupIndex($query);
        }
        
        $this->crud->appendData(['dataItems' => $query->get()]);
        return dashboard_view('index', $this->crud);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = $this->crud->getModel();
        $this->authorize('create', $model);

        if (method_exists($this, 'setupCreate')) {
            $this->setupCreate();
        }
        
        $this->crud->appendData(['dataItem' => new $model]);
        $this->crud->populateFormRelationshipData();
        return dashboard_view('create', $this->crud);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = $this->crud->getModel();
        $this->authorize('create', $model);

        if (method_exists($this, 'setupCreate')) {
            $this->setupCreate();
        }

        $datatype = $this->crud->datatype();
        $dataItem = new $model;

        foreach ($this->crud->getFields() as $fieldName => $field) {            
            if (method_exists($field, 'saveAction')) 
                $field->saveAction($dataItem, $request->{$fieldName});
            else
                $dataItem->{$fieldName} = $request->{$fieldName};
        }
        $dataItem->save();

        if (method_exists($this, 'afterSave')) {
            $this->afterSave($request, $dataItem);
        }

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
        $this->authorize('update', $dataItem);

        if (method_exists($this, 'setupEdit')) {
            $this->setupEdit($dataItem);
        }
        
        $this->crud->appendData(compact('dataItem'));
        $this->crud->populateFormRelationshipData();
        return dashboard_view('edit', $this->crud);
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
        $this->authorize('update', $dataItem);
        
        if (method_exists($this, 'setupEdit')) {
            $this->setupEdit($dataItem);
        }

        foreach ($this->crud->getFields() as $fieldName => $field) {            
            if (method_exists($field, 'updateAction')) 
                $field->updateAction($dataItem, $request->{$fieldName});
            elseif (method_exists($field, 'saveAction')) 
                $field->saveAction($dataItem, $request->{$fieldName});
            else
                $dataItem->{$fieldName} = $request->{$fieldName};
        }
        $dataItem->save();

        if (method_exists($this, 'afterSave')) {
            $this->afterSave($request, $dataItem);
        }

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
        $dataItem = $this->crud->find($id);
        $this->authorize('delete', $dataItem);

        $dataItem->delete();
        $model = $this->crud->getModel();
        return redirect(crud_route("index", $model));
    }
}
