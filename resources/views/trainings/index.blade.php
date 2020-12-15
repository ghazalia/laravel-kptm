@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Training Index') }}</div>

                <div class="card-body">
                    @foreach($trainings as $training)
                    {{ $training->id }} - {{ $training->title }} <br>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
