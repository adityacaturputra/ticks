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
                            <label for="theater">Theater</label>
                            <input type="text" class="form-control @error('theater') is-invalid @enderror" name="theater" value="{{ old('theater') ?? $theater->theater ?? '' }}">
                            @error('theater')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="10">{{ old('address') ?? $theater->address ?? '' }}</textarea>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <div class="form-group mb-0">
                                <label for="status">Status</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="active" id="active" @if ((old('status') ?? $theater->status ?? '') == 'active') checked @endif>
                                <label for="active" class="form-check-label">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="inactive" id="inactive" @if ((old('status') ?? $theater->status ?? '') == 'inactive') checked @endif>
                                <label for="inactive" class="form-check-label">Inactive</label>
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
