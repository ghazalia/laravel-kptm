@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Training Index') }}</div>

                <div class="card-body">
                    <table>
                        <thead>
                            <th>Training Id </th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Creator</th>
                            <th>Trainer</th>
                        </thead>
                        <tbody>
                            @foreach($trainings as $training)
                            <tr>
                                <td>{{ $training->id }} </td>
                                <td>{{ $training->title }} </td>
                                <td>{{ $training->description }} </td>
                                <td>{{ $training->user->name }}
                                    <strong>{{$training->user->email}}</strong>
                                </td>
                                <td> {{ $training->trainer }} </td>
                        </tbody>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
