@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Add Trainings') }}</div>

                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Training Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Training Title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Training description</label>
                            <textarea class="form-control" name="description" placeholder="Enter Training Description"> {{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="Trainer">Trainer Name</label>
                            <input type="text" class="form-control" name="trainer" placeholder="Enter Trainer Name" value="{{old('trainer')}}">
                        </div>
                        <div class="form-group">
                            <label for="attachment">File Attachment</label>
                            <input type="file" class="form-control" name="attachment">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Store My Training</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
