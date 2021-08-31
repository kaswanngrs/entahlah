@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3 style="padding: 10px">Awards</h3>
            <div class="box-header with-border">
                <a class="btn btn-info btn-sm" href="{{ route('create.awards') }}"
                    style="position: absolute;right: 18px;top: 17px;">+ Add Awards</a>
            </div>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">point</th>
                        <th scope="col">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @if ($awards->count() > 0)
                        @foreach ($awards as $award)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $award->name }}</td>
                                <td>{{ $award->point }}</td>
                                <td><img src="{{url('/images/award/'.$award->img)}}" style="width: 40%;height: 67px;" class="img-responsive"></td>
                                <td>
                                    <a href="{{ route('edit.awards',$award->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('delete.awards',$award->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    @endsection
