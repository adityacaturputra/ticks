<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Theater;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class TheaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Theater $theaters)
    {
        $q = $request->input('q');
        $theaters = $theaters
                    ->when($q, function($query) use ($q){
                        return $query->where('theater', 'like', '%'.$q.'%');})
                    ->paginate(10);

        $request = $request->all();

        return view('dashboard.theater.list', [
            'active' => 'Theaters',
            'request' => $request,
            'theaters' => $theaters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.theater.form', [
            'active' => 'Theaters',
            'button' => 'Create',
            'url'    => 'dashboard.theaters.store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Theater $theater)
    {
        $validator = Validator::make($request->all(), [
            'theater' => 'required|unique:App\Models\Theater',
            'address' => 'required',
            'status' => 'required'
        ]);
        if($validator->fails()){
            return redirect()
                ->route('dashboard.theaters.create')
                ->withErrors($validator)
                ->withInput();
        }else{
            $theater->theater = $request->input('theater');
            $theater->address = $request->input('address');
            $theater->status = $request->input('status');
            $theater->save();
            return redirect()
                ->route('dashboard.theaters')
                ->with('message', __('messages.store', ['title' => $request->input('theater')]));
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
    public function edit(Theater $theater)
    {
        return view('dashboard.theater.form', [
            'theater' => $theater,
            'active' => 'Theaters',
            'button' => 'Update',
            'url'    => 'dashboard.theaters.update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theater $theater)
    {
        $validator = Validator::make($request->all(), [
            'theater' => 'required|unique:App\Models\Theater,theater,'.$theater->id,
            'address' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                ->route('dashboard.theaters.edit', $theater->id)
                ->withErrors($validator)
                ->withInput();
        }else{
            $theater->theater = $request->input('theater');
            $theater->address = $request->input('address');
            $theater->status = $request->input('status');
            $theater->save();
            return redirect()
                ->route('dashboard.theaters')
                ->with('message', __('messages.update', ['title' => $theater->theater]));
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
        //
    }
}
