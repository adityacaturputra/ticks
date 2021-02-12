<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Movie $movies)
    {
        $active = 'Movies';

        $q = $request->input('q');

        $movies = $movies->when($q, function($query) use ($q){
                    return $query->where('name', 'like', '%'.$q.'%');
                })
                ->paginate(10);

        $request = $request->all();
        return view('dashboard/movie/list' , [
            'movies' => $movies,
            'active' => $active,
            'request' => $request
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/movie/form' , [
            'active' => 'Movies',
            'button'    => 'Create',
            'url'       => 'dashboard.movies.store'
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movie $movie)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|unique:App\Models\Movie,title',
            'description'   => 'required',
            'thumbnail'     => 'required|image'
        ]);
        if($validator->fails()){
            return redirect()
                ->route('dashboard.movies.create')
                ->withErrors($validator)
                ->withInput();
        }else{
            $image = $request->file('thumbnail');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->putFileAs('public/movies', $image, $fileName);

            $movie->title = $request->input('title');
            $movie->description = $request->input('description');
            $movie->thumbnail = $fileName;
            $movie->save();

            return redirect()->route('dashboard.movies');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {

        return view('dashboard.movie.form', [
            'movie'     => $movie,
            'active'    => 'Movies',
            'button'    => 'Update',
            'url'       => 'dashboard.movies.update'
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
