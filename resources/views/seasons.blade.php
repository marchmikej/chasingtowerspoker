@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Seasons</div>

                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($seasons as $season)   
                            <li class="list-group-item"><a href="seasons/{{$season->id}}">{{$season->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection