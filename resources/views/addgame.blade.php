@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add a Poker Game</div>

                <div class="panel-body">
                    <form class="form" action="" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="poker_season_id">Poker Season</label>
                            <select name="poker_season_id" class="form-control" id="poker_season_id">
                              <option value="0">No Season</option>
                                @foreach ($seasons as $season)
                                    <option value="{{$season->id}}">{{$season->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date-input">Date</label>
                            <input class="form-control" name="date" type="date" value="{{date('Y-m-d')}}" id="date-input">
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input class="form-control" name="location" type="text" id="location" placeholder="Location">
                        </div>
                        <div class="form-group">
                            <label for="host_id">Host</label>
                            <select name="host_id" class="form-control" id="host_id">
                                <option value="0" selected>No Host</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="poker_game_type_id">Format</label>
                            <select name="poker_game_type_id" class="form-control" id="poker_game_type_id">
                              <option value="0">No Format</option>
                                @foreach ($gameTypes as $gameType)
                                    <option value="{{$gameType->id}}">{{$gameType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="expenses">Expenses</label>
                            <input class="form-control" name="expenses" type="number" id="expenses" placeholder="Expenses">
                        </div>
                        <div class="form-group">
                            <label for="buyin">Buy In</label>
                            <input class="form-control" name="buyin" type="number" id="buyin" placeholder="Buy In">
                        </div>
                        <div class="form-group">
                            <label for="number_of_players">Number of Players</label>
                            <input class="form-control" name="number_of_players" type="number" id="number_of_players" placeholder="Number of Players">
                        </div>
                        <div class="form-group">
                            <label for="knockout_payment">Knockout Payment</label>
                            <input class="form-control" name="knockout_payment" type="number" id="knockout_payment" placeholder="Knockout Payment">
                        </div>                        
                        <div class="form-group">
                            <label for="payout1">1st Place Payout</label>
                            <input class="form-control" name="payout1" type="number" id="payout1" value="0" >
                        </div>
                        <div class="form-group">
                            <label for="payout2">2nd Place Payout</label>
                            <input class="form-control" name="payout2" type="number" id="payout2" value="0" >
                        </div>
                        <div class="form-group">
                            <label for="payout3">3rd Place Payout</label>
                            <input class="form-control" name="payout3" type="number" id="payout3" value="0" >
                        </div>
                        <div class="form-group">
                            <label for="payout4">4th Place Payout</label>
                            <input class="form-control" name="payout4" type="number" id="payout4" value="0" >
                        </div>
                        <div class="form-group">
                            <label for="payout5">5th Place Payout</label>
                            <input class="form-control" name="payout5" type="number" id="payout5" value="0" >
                        </div>
                        <div class="form-group">
                            <label for="payout6">6th Place Payout</label>
                            <input class="form-control" name="payout6" type="number" id="payout6" value="0" >
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
