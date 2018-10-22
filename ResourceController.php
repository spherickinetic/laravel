<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class ResourceController extends Controller
{
    /** @var Model|Builder */
    protected $model;
    
    protected $resource;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = $this->model->all();
        return view($this->resource . '.index')->with(compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view($this->resource . '.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return Response
     */
    public function edit($id)
    {
        $record = $this->model->find($id);
        return view($this->resource . '.edit')->with(compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->model->create($request->except('_token'));
        Session::flash('success', 'A new ' . $this->resource . ' has been added');
        return redirect(route($this->resource));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $record = $this->model->find($id);
        $record->update($request->except('_token'));
        Session::flash('success', 'The ' . $this->resource . ' was updated');
        return redirect(route($this->resource));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return Response
     */
    public function destroy($id)
    {
        $record = $this->model->find($id);
        $record->delete();
        Session::flash('success', 'The ' . $this->resource . ' has been deleted');
        return redirect(route($this->resource));
    }
}