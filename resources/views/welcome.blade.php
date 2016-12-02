@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Upcoming Games</div>
                <div class="panel-body">                  
                    @foreach($upcomingGames as $upcomingGame)
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-2">
                                    Location: {{$upcomingGame->location}}
                                </div>
                                <div class="col-sm-2">
                                    Date: {{$upcomingGame->date}}
                                </div>  
                                @if($upcomingGame->host_id > 0)                              
                                    <div class="col-sm-2">
                                        Host: {{$upcomingGame->host()->name}}
                                    </div>                                  
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @foreach ($blogs as $blog)
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $blog->title }} {{$blog->user->name}}</div>

                    <div class="panel-body">
                            <p>{{ $blog->body }}</p>              
                    </div>
                </div>
            @endforeach
            <div class="panel panel-default">
                <div class="panel-heading">Add a Message</div>

                <div class="panel-body">
                    <form class="form" action="" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">      
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" id="body" name="body" rows="6" placeholder="Body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
