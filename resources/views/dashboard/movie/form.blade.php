@extends('layouts.dashboard');

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Movie</h3>
                </div>
                @if ($button == 'Update')
                    <div class="col-4 text-right">
                        <button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash"></i></button>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="{{ route($url , $movie->id ?? '') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($button == 'Update')
                            @method('put')
                        @endif
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $movie->title ?? '' }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ old('description') ?? $movie->description ?? '' }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <div class="custom-file">
                                <label for="thumbnail" class="custom-file-label">Thumbnail</label>
                                <input type="file" name="thumbnail" class="custom-file-input">
                                @error('thumbnail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
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
@if ($button == 'Update')
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                    <button class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin hapus movie {{ $movie->name }}</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('dashboard.movies.delete', ['id' => $movie->id]) }}" method="POST">
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
