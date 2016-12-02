@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        	<div class="panel panel-default">
          		<div class="panel-heading">Stats</div>
          			@foreach($game->finishes as $finish)
          			    <div class="container">
  							<div class="row">
  								<div class="col-sm-2">
								 	Player: {{$finish->user->name}}
							 	</div>
  								<div class="col-sm-2">
								 	Points: {{$finish->points()}}
							 	</div>
								<div class="col-sm-2">
								 	Money: {{$finish->money()}}
							 	</div>
						 	</div>
					 	</div>
					@endforeach
		        </div>
		    </div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        	<div class="panel panel-default">
          		<div class="panel-heading">Results for {{$game->date}} at {{$game->location}}</div>
		        <div class="panel-body">
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