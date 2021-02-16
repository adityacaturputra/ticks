@extends('layouts.dashboard');

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Theater</h3>
                </div>
                @if (isset($theater))
                    <div class="col-4 text-right">
                        <button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash"></i></button>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="{{ route($url , $theater->id ?? '') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($theater))
                            @method('put')
                        @endif
                        <div class="form-group">
                            <label for="movie">Movie</label>
                            <input type="hidden" name="theater_id" value="{{ $theater->id }}">
                            <select name="movie_id" class="form-control">
                                <option value="">Pilih Movie</option>
                                @foreach ($movies as $movie)
                                    <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="studio">Studio</label>
                            <input type="text" class="form-control @error('studio') is-invalid @enderror" name="studio" value="{{ old('studio') ?? $theater->studio ?? '' }}">
                            @error('studio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ?? $theater->price ?? '' }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group form-row mt-4">
                            <div class="col-2 align-self-center">
                                <label for="seats">Seats</label>
                            </div>
                            <div class="col-5">
                                <input type="number" class="form-control @error('rows') is-invalid @enderror" name="rows" value="{{ old('rows') ?? $theater->rows ?? '' }}" placeholder="Rows">
                                @error('rows')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5">
                                <input type="number" class="form-control @error('columns') is-invalid @enderror" name="columns" value="{{ old('columns') ?? $theater->columns ?? '' }}" placeholder="Columns">
                                @error('columns')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-2">
                            <div class="form-group mb-0">
                                <label for="status">Status</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="coming soon" id="coming-soon" @if ((old('status') ?? $theater->status ?? '') == 'coming soon') checked @endif>
                                <label for="coming-soon" class="form-check-label">Coming Soon</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="in theater" id="in-theater" @if ((old('status') ?? $theater->status ?? '') == 'in theater') checked @endif>
                                <label for="in-theater" class="form-check-label">In Theater</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="finish" id="finish" @if ((old('status') ?? $theater->status ?? '') == 'finish') checked @endif>
                                <label for="finish" class="form-check-label">Finish</label>
                            </div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="button" onclick="window.history.back()" class="btn btn-secondary btn-sm">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">{{ $button }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@if (isset($theater))
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                    <button class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin hapus theater {{ $theater->name }}</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('dashboard.theaters.delete', $theater->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
