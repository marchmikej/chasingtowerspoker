@extends('layouts.app')

@section('headscript')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Player');
        data.addColumn('number', 'Place');
        data.addColumn('number', 'Points');
        data.addColumn('number', 'Money');
        data.addColumn('string', 'Knocked Out By');
        data.addRows([
            @foreach($game->finishes as $finish)
            	@if($finish->knocked_out_by_id > 0)
	               	['{{$finish->user->name}}', {{$finish->place}}, {{$finish->points()}}, {{$finish->money()}}, '{{$finish->knockedOutBy()->name}}'],
	            @else
	            	['{{$finish->user->name}}', {{$finish->place}}, {{$finish->points()}}, {{$finish->money()}}, 'N/A'],
	            @endif
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
                <div class="panel-heading">Results for {{$game->date}} at {{$game->location}}</div>

                <div class="panel-body">
                    <div id="table_div"></div>
                </div>
            </div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        	<div class="panel panel-default">
          		<div class="panel-heading">Update Standings</div>
		        <div class="panel-body">
		        	@if(Auth::user()->editor == 1)
            @foreach($game->finishes as $finish)
            	                <div class="container">
  						<div class="row">
            	<form class="form-inline" action="/updategamefinish" method="POST">
	                <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                <input type="hidden" name="id" value="{{$finish->id}}">

					    <div class="col-sm-2">
					    	{{$finish->points()}}
	            	<div class="form-group">
	            		<select name="user_id" class="form-control" id="user_id">
	            			@foreach ($users as $user)
	            				@if($finish->user_id == $user->id)
	            					<option value="{{$user->id}}" selected>{{$user->name}}</option>
	            				@else
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endif
							@endforeach
	            		</select>
	                </div>
	                	</div>
					    <div class="col-sm-2">
		            <div class="form-group">
        		        <label for="place">Placed</label>
                		<select name="place" class="form-control" id="place">
                			@for ($i = 1; $i <= $game->number_of_players; $i++)
                				@if($finish->place == $i)
									<option value="{{$i}}" selected>{{$i}}</option>
								@else
									<option value="{{$i}}">{{$i}}</option>
								@endif
							@endfor
                		</select>
                    </div>
	                	</div>
					    <div class="col-sm-4">
       		        <div class="form-group">
        		        <label for="knocked_out_by_id">Knocked Out By</label>
                		<select name="knocked_out_by_id" class="form-control" id="knocked_out_by_id">
                			<option value="0">Not Knocked Out</option>
                			@foreach ($users as $user)
                				@if($finish->knocked_out_by_id == $user->id)
                					<option value="{{$user->id}}" selected>{{$user->name}}</option>
                				@else
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endif
							@endforeach
                		</select>
                    </div>
	                	</div>
					    <div class="col-sm-2">

            		<button type="submit" class="btn btn-primary">Update</button>
            	</div>
            </form>
            </div>
        </div>
        		<hr size=2>
        	@endforeach
        	@endif
        		</div>
            </div>
        	@if(count($game->finishes) < $game->number_of_players)
            	<form class="form" action="" method="POST">
	                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="panel panel-default">
                		<div class="panel-heading">Add Player</div>
		                <div class="panel-body">
		       		        <div class="form-group">
                		        <label for="user_id">Player</label>
                        		<select name="user_id" class="form-control" id="user_id">
                        			@foreach ($users as $user)
    									<option value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
                        		</select>
		                    </div>	                	
        		            <div class="form-group">
                		        <label for="place">Placed</label>
                        		<select name="place" class="form-control" id="place">
                        			@for ($i = 1; $i <= $game->number_of_players; $i++)
    									<option value="{{$i}}">{{$i}}</option>
									@endfor
                        		</select>
		                    </div>
		       		        <div class="form-group">
                		        <label for="knocked_out_by_id">Knocked Out By</label>
                        		<select name="knocked_out_by_id" class="form-control" id="knocked_out_by_id">
                        			<option value="0">Not Knocked Out</option>
                        			@foreach ($users as $user)
    									<option value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
                        		</select>
		                    </div>
            			</div>
            		</div>
            		<button type="submit" class="btn btn-primary">Submit</button>
        		</form>	
        	@endif
        </div>
    </div>
</div>
@endsection