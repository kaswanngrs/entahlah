@extends('layouts.app')

@section('content')

    <div class="container">
        {{-- action="/users/update/{{$user->id}}" method="POST" --}}
        <h1 style="color: white; overflow: hidden; text-align: center">Add New Awards</h1>
        <form action="{{ route('store.awards') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row align-items-center  mr-4">

                <div class="step-one row">
                    <div class="row col-4">
                        <label for="">name:
                            <input type="text" name="name" id="name" class="form-control" required>
                        </label>
                    </div>

                    <div class="row col-4">
                        <label for="">point:
                            <input type="text" name="point" id="point" class="form-control" required></label>
                    </div>

                    <div class="row col-4">
                        <div class="">
                            <div class="form-group">
                                <label for="">Type</label>
                              <select class="selectpicker form-control" name="type">
                                <option value="pubg">pubg</option>
                                <option value="googleplay" >googleplay</option>
                                <option value="freefire" >freefire</option>
                              </select>
                            </div>
                          </div>
                    </div>



                </div>

                <div class="custom-file">
                    <input type="file" name="img" class="custom-file-input" id="imge" required>
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    <div class="invalid-feedback">imge</div>
                </div>


                <div class="row col-12 mt-3">
                    <button type="submit" class="btn btn-primary open">Save</button>
                </div>
        </form>
    </div>

@endsection
