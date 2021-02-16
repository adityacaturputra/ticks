<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use App\Models\Theater;
use App\Models\ArrangeMovie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
