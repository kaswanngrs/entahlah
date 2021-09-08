@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 style=" overflow: hidden; text-align: center;color :rgb(130 138 146) !important" >Update Task</h1>
        <center>

            <form action="{{ route('update',$task->id) }}" method="post">
                @csrf
                <div class="form">
                <label >Title</label>
                <input type="text" value="{{ $task->title }}"  name="title" placeholder="Title">

                <label for="lname">ChannelName</label>
                <input type="text" value="{{ $task->channel_name }}" name="channel_name" placeholder="ChannelName">

                <label for="lname">UrlLink</label>
                <input type="text" value="{{ $task->url_link }}" name="url_link" placeholder="UrlLink">

                <label for="lname">Description</label>
                <textarea name="description" >{{ $task->description }}</textarea>
            </div>
                <input type="submit" value="Submit">
              </form>

        {{-- <form action="{{ route('update',$task->id) }}" method="post">
            @csrf
            <div class="row align-items-center">
                <div class="step-one row">
                    <div class="row col-12">
                        <label for="Task">Task:
                            <input type="text" value="{{$task->Task}}" name="task" id="Task" class="form-control">
                        </label>
                    </div>

                </div>
                <div class="row col-12">
                    <button id="addTask" class="btn btn-primary open">Update</button>
                </div>
        </form> --}}
    </center>
    </div>

@endsection


