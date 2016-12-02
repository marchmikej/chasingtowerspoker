@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Games</div>

                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($games as $game)   
                            <li class="list-group-item"><a href="/updategamestanding/{{$game->id}}">{{$game->date}}</a> at {{$game->location}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection