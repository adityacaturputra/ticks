<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use App\Models\Theater;
use App\Models\ArrangeMovie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ArrangeMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Theater $theater)
    {
        $q = $request->input('q');
        // $theaters = $theaters
        //             ->when($q, function($query) use ($q){
        //                 return $query->where('theater', 'like', '%'.$q.'%');})
        //             ->paginate(10);

        $request = $request->all();

        return view('dashboard.arrange_movie.list', [
            'active' => 'Theaters',
            'request' => $request,
            'theater' => $theater
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Theater $theater, Movie $movies)
    {
        $movies = $movies->get();

        return view('dashboard.arrange_movie.form', [
            'url' => 'dashboard.theaters.arrange.movie.store',
            'theater' => $theater,
            'movies' => $movies,
            'button' => 'Create',
            'active' => 'Theaters'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ArrangeMovie $arrMovie)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required',
            'theater_id' => 'required',
            'studio' => 'required',
            'price' => 'required',
            'rows' => 'required',
            'columns' => 'required',
            'schedules' => 'required',
            'status' => 'required'
        ]);
        if($validator->fails()){
            return redirect()
                ->route('dashboard.theaters.arrange.movie.create', $request->input('theater_id'))
                ->withErrors($validator)
                ->withInput();
        }else{
            $seats = [
                'rows' => $request->input('rows'),
                'columns' => $request->input('columns')
            ];

            $arrMovie->theater_id = $request->input('theater_id');
            $arrMovie->movie_id = $request->input('movie_id');
            $arrMovie->studio = $request->input('studio');
            $arrMovie->price = $request->input('price');
            $arrMovie->status = $request->input('status');
            $arrMovie->seats = json_encode($seats);
            $arrMovie->schedules = json_encode($request->input('schedules'));
            $arrMovie->save();
            return redirect()
                ->route('dashboard.theaters.arrange.movie', $request->input('theater_id'))
                ->with('message', __('messages.store', ['title' => $request->input('studio')]));
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
