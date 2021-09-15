@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 style=" overflow: hidden; text-align: center;color :rgb(130 138 146) !important" >Create Task</h1>
        <center>


          <form action="{{route('store')}}" method="post">
            @csrf
            <div class="form">
            <label >Title</label>
            <input type="text"  name="title" placeholder="Title">

            <label for="lname">ChannelName</label>
            <input type="text"  name="channel_name" placeholder="ChannelName">

            <label for="lname">UrlLink</label>
            <input type="text"  name="url_link" placeholder="UrlLink">

            <label for="lname">Description</label>
            <textarea name="description" placeholder="Some text..."></textarea>
        </div>
            <input type="submit" value="Submit">
          </form>
    </center>
    </div>

@endsection


