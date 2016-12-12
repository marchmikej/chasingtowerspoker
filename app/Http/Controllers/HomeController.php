<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Blog;
use App\PokerGame;
use App\PokerGameFinish;
use App\PokerGameType;
use App\PokerSeason;
use App\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('America/New_York');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('updated_at', 'desc')->get();
        $upcomingGames = PokerGame::where('date','>',date("Y-m-d"))->get();
        $wins = PokerGameFinish::where('user_id', \Auth::id())->where('place',1)->count();
        $totalWinnings = 0;
        $averagePlace = 0;
        $averagePlaceLast6Months = 0;
        $gamesLast6Months = 0;
        $allFinishes = PokerGameFinish::where('user_id', \Auth::id())->get();
        $sixMonthDate = date("Y-m-d", strtotime("-6 months"));
        foreach ($allFinishes as $finish) {
            $totalWinnings = $totalWinnings + $finish->money();
            $averagePlace = $averagePlace + $finish->place;
            if($finish->pokerGame->date > $sixMonthDate) {
                $averagePlaceLast6Months = $averagePlaceLast6Months + $finish->place;
                $gamesLast6Months++;
            }
        }
        if($gamesLast6Months > 0) {
            $averagePlaceLast6Months = $averagePlaceLast6Months / $gamesLast6Months;
        }
        $averagePlace = $averagePlace / count($allFinishes);
        $dashboard = array(
            'wins' => $wins,
            'totalWinnings' => $totalWinnings,
            'averagePlace' => $averagePlace,
            'averagePlaceLast6Months' => $averagePlaceLast6Months,
        );
        return view('welcome', compact('blogs', 'upcomingGames', 'dashboard'));
    }

    public function submitBlog(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $blog = new Blog;
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        $blog->user_id = \Auth::id();
        $blog->save();

        return redirect('/');

        //$blogs = Blog::orderBy('updated_at', 'desc')->get();
        //$upcomingGames = PokerGame::where('date','>',date("Y-m-d"))->get();
        //return view('welcome', compact('blogs', 'upcomingGames'));
    }

    public function addgame()
    {
        $users = User::all();
        $gameTypes = PokerGameType::all();
        $seasons = PokerSeason::all();
        return view('addgame', compact('users', 'gameTypes', 'seasons'));
    }

    public function storegame(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'location' => 'required',
            'poker_season_id' => 'required|integer',
            'host_id' => 'required|integer',
            'expenses' => 'required|integer',
            'buyin' => 'required|integer',
            'knockout_payment' => 'required|integer',
            'number_of_players' => 'required|integer',
            'poker_game_type_id' => 'required|integer',
            'payout1' => 'required|integer',
            'payout2' => 'required|integer',
            'payout3' => 'required|integer',
            'payout4' => 'required|integer',
            'payout5' => 'required|integer',
            'payout6' => 'required|integer',
        ]);

        $pokerGame = new PokerGame;
        $input = $request->all();
        $pokerGame->date = $request->input('date');
        $pokerGame->location = $request->input('location');
        $pokerGame->poker_season_id = $request->input('poker_season_id');
        $pokerGame->host_id = $request->input('host_id');
        $pokerGame->expenses = $request->input('expenses');
        $pokerGame->buyin = $request->input('buyin');
        $pokerGame->knockout_payment = $request->input('knockout_payment');
        $pokerGame->number_of_players = $request->input('number_of_players');
        $pokerGame->poker_game_type_id = $request->input('poker_game_type_id');
        $pokerGame->payout1 = $request->input('payout1');
        $pokerGame->payout2 = $request->input('payout2');
        $pokerGame->payout3 = $request->input('payout3');
        $pokerGame->payout4 = $request->input('payout4');
        $pokerGame->payout5 = $request->input('payout5');
        $pokerGame->payout6 = $request->input('payout6');
        $pokerGame->save();

        return redirect('updategamestanding/'.$pokerGame->id);
    }

    public function updateStandings($id)
    {
        $game = PokerGame::findorfail($id);
        $users = User::all();
        return view('updategamestandings', compact('game', 'users'));
    }

    public function storeStandings($id, Request $request)
    {
        $pokerGameFinish = new PokerGameFinish;
        $pokerGameFinish->knocked_out_by_id = $request->input('knocked_out_by_id');
        $pokerGameFinish->place = $request->input('place');
        $pokerGameFinish->user_id = $request->input('user_id');
        $pokerGameFinish->poker_game_id = $id;
        $pokerGameFinish->save();

        return redirect('updategamestanding/'.$id);
    }

    public function seasons()
    {
        $seasons = PokerSeason::all();
        return view('seasons', compact('seasons'));
    }

    public function showseason($id) 
    {
        $season = PokerSeason::findorfail($id);
        $standings = array();
        foreach($season->games as $game)
        {
            foreach ($game->finishes as $pokerFinish) {
                if(isset($standings[$pokerFinish->user_id]))
                {
                    $standings[$pokerFinish->user_id]["money"] += $pokerFinish->money();
                    $standings[$pokerFinish->user_id]["points"] += $pokerFinish->points();
                    $standings[$pokerFinish->user_id]["buyin"] += $game->buyin;
                    $standings[$pokerFinish->user_id]["knockouts"] += $pokerFinish->knockouts();
                } else
                {
                    $standings[$pokerFinish->user_id] =  array(
                        "money" => $pokerFinish->money(), 
                        "points" => $pokerFinish->points(), 
                        "name" => $pokerFinish->user->name, 
                        "buyin" => $game->buyin,
                        "knockouts" => $pokerFinish->knockouts(),
                    );
                }
            }
        }
        //return $standings;
        return view('showseason', compact('season', 'standings'));   
    }

    public function updateGameFinish(Request $request)
    {
        $pokerGameFinish = PokerGameFinish::findorfail($request->input('id'));
        $pokerGameFinish->knocked_out_by_id = $request->input('knocked_out_by_id');
        $pokerGameFinish->place = $request->input('place');
        $pokerGameFinish->user_id = $request->input('user_id');
        $pokerGameFinish->save();        
        return redirect('updategamestanding/'.$pokerGameFinish->poker_game_id); 
    }

    public function showgames()
    {   
        $games = PokerGame::orderBy('date', 'desc')->get();
        return view('showgames', compact('games'));   
    }

    public function profile()
    {   
        $user = Auth::user();
        return view('profile', compact('user'));   
    }

    public function updatepassword(Request $request) {
        $user = Auth::user();

        $validation = $this->validate($request, [
            // Here's how our new validation rule is used.
            //'password' => 'hash:' . $user->password,
            'password' => 'required|min:6|confirmed',
            'current_password' => 'required',
        ]);

        //if(bcrypt($request->input('current_password')) != $user->password) {
        if(!Auth::attempt(['email' => $user->email, 'password' => $request->input('current_password')])) {
            return redirect('/profile')
                ->withErrors("Current Password Invalid")
                ->withInput();
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect('/profile')
            ->withErrors("Password Updated")
            ->withInput();
    }    
}
