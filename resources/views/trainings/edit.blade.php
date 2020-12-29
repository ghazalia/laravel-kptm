@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Trainings') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('training:update', $training->id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Training Title</label>
                            <input type="text" class="form-control" name="title" value="{{$training->title}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Training description</label>
                            <textarea class="form-control" name="description">{{$training->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="Trainer">Trainer Name</label>
                            <input type="text" class="form-control" name="trainer" value="{{$training->trainer}}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update My Training</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
