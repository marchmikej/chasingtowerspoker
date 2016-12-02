@extends('layouts.app')

@section('headscript')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('number', 'Points');
        data.addColumn('number', 'Winnings');
        data.addColumn('number', 'BuyIn');
        data.addColumn('number', 'Knockouts');
        data.addRows([
            @foreach($standings as $standing)
               ['{{$standing["name"]}}', {{$standing["points"]}}, {{$standing["money"]}}, {{$standing["buyin"]}}, {{$standing["knockouts"]}}],
            @endforeach
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));
        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{$season->name}} Standings</div>

                <div class="panel-body">
                    <div id="table_div"></div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">{{$season->name}} Games</div>

                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($season->games as $game)   
                            <li class="list-group-item"><a href="/updategamestanding/{{$game->id}}">{{$game->date}}</a> at {{$game->location}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection