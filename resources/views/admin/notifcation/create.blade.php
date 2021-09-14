@extends('layouts.app')

@section('content')
<style>


</style>
<div class="container-fluid mt-3">
    <h1 style=" text-align: center;color :rgb(130 138 146) !important;">Send Notification</h1>

    <form action="{{ url('/notifction/store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12 ">
                <label for="exampleFormControlSelect1">Users</label>
                <select class="form-control" name=id_user>
                    @foreach ($user as $users)
                    <option value="{{ $users->id }}" >{{ $users->name}}</option>
                    @endforeach
                </select>
              </div>

            <div class="col-12 ">
                <div class="form-group">
                    <label for="#Message">Message:</label>
                    <textarea name="message" id="Message" class="form-control  col-12" required></textarea>

                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class=" col-12">
                        <button type="submit" class="btn btn-primary open col-12">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

@endsection
