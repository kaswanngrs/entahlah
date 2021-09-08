@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="color: white; overflow: hidden; text-align: center">Edit New Awards</h1>
        <form action="{{ route('update.awards', $award->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row align-items-center  mr-4">

                <div class="step-one row">
                    <div class="row col-6">
                        <label for="">name:
                            <input type="text" name="name" value="{{ $award->name }}" id="name" class="form-control"
                                required>
                        </label>
                        @if ($errors->has('name'))
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>

                    <div class="row col-6">
                        <label for="">point:
                            <input type="text" name="point" id="point" value="{{ $award->point }}" class="form-control"
                                required></label>

                    </div>
                    @if ($errors->has('point'))
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    @endif

                    <div class="row col-lg-10">
                        <div class="custom-file" style="margin-top: 7%;">
                            <input type="file" name="img" class="custom-file-input" id="imge" required>
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            <div class="invalid-feedback">imge</div>

                        </div>
                        @if ($errors->has('img'))
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        @endif
                        <br>
                        <center><img src="{{ url('/images/award/' . $award->img) }}" class="rounded mx-auto d-block"
                                style="text-align: center!important;
                                width: 200px;
                                height: 200px;margin-top: 3%; "></center>

                    </div>
                </div>
                <div class=" col">
                    <center><button type="submit" class="btn btn-primary open">Save</button></center>
                </div>
        </form>
    </div>

@endsection
