@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3 style="padding: 10px">Tasks</h3>
                        <div class="box-header with-border">
                            <a class="btn btn-info btn-sm" href="{{route('create') }}" style="position: absolute;right: 18px;top: 17px;">+ Add Task</a>
                        </div>
                        <br>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Task</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @if ($tasks->count() > 0)
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $task->Task }}</td>
                                            <td>
                                                <a href="{{route('edit',$task->id) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ route('destroy',$task->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
@endsection
