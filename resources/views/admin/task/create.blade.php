@extends('layouts.app')

@section('content')

    <div class="container">
      
        <h1 style=" overflow: hidden; text-align: center;color :rgb(130 138 146) !important" >Create Task</h1>
        <form action="{{url('/task/store')}}" method="post"> 
            @csrf
            <div class="row align-items-center">
                <div class="step-one row">
                    <div class="row col-12">
                        <label for="Task">Task:
                            <input type="text" name="Task" id="Task" class="form-control" required>
                        </label>
                    </div>
          
                </div>
                <div class="row col-12">
                    <button id="addTask" class="btn btn-primary open">Add</button>
                </div>
        </form>
    </div>

@endsection


