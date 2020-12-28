@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ( session()->has('alert'))
            <div class="alert {{ session()->get('alert-type') }}">
                {{ session()->get('alert')}}
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Training Index') }}
                    <div class="float-right">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword"/>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <table>
                        <thead>
                            <th>Training Id </th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Creator</th>
                            <th>Trainer</th>
                            <th>Show</th>
                        </thead>
                        <tbody>
                            @foreach($trainings as $training)
                            <tr>
                                <td>{{ $training->id }}</td>
                                <td>{{ $training->title }} </td>
                                <td>{{ $training->description }} </td>
                                <td>{{ $training->user->name }}
                                    <strong>{{$training->user->email}}</strong>
                                </td>
                                <td> {{ $training->trainer }} </td>
                                <!-- {{ url('training/' . $training->id) }}" -->
                                <td><a class="btn btn-primary" href="{{ route('training:show', $training->id) }}">Show</a>
                                    <a class="btn btn-secondary" href="{{ route('training:edit', $training->id) }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ route('training:delete', $training->id) }}">Delete</a>
                                </td>
                            </tr> @endforeach </tbody>
                    </table>
                    {{ $trainings
                            ->appends([
                                  'keyword' => request()->get('keyword')])
                            ->links()
                    }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
