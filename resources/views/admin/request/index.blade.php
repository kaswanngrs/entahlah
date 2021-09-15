@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3 style="padding: 10px">Request</h3>
            <div class="box-header with-border">
            </div>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">code</th>
                        <th scope="col">Winer</th>
                        <th scope="col">point</th>
                        <th scope="col">Image</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @if ($Winer->count() > 0)
                        @foreach ($Winer as $winer)
                            @php
                                $User = App\User::where('id', '=', $winer->user_id)->first();
                                $award = App\awards::where('id', '=', $winer->award_id)->first();
                            @endphp
                            <tr>
                                <th scope="row">{{ $winer->id }}</th>
                                <td>{{ $User->name }}</td>
                                <td>{{ $winer->code }}</td>
                                <td>{{ $award->name }}</td>
                                <td>{{ $award->point }}</td>
                                <td><img src="{{ url('/images/award/' . $award->img) }}" style="width: 40%;height: 67px;"
                                        class="img-responsive"></td>
                                <td>
                                    <form action="{{ route('changestatus',$winer->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button  type="Submit" class="btn btn-xs {{ $winer->status ==1 ? 'btn-success disabled' : 'btn-warning' }}">
                                          @if($winer->status ==1)
                                           Aprrove
                                          @else
                                          Pending
                                          @endif
                                        </button>
                                      </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        {{$Winer->links() }}
    @endsection
