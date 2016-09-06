<?php

namespace App\Http\Controllers;

use App\Gameplan;
use App\GameplanBar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Bar;
use App\Hopper;

class GameplansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bars = Bar::all();
        $bars = $bars->pluck('name', 'id');
        $bars = $bars->all();
//        dd($bars);
        $data = [
            'bars' => $bars
        ];
        return view('gameplans.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->flash('fail', 'Your gameplan was NOT created. Please fix errors.');
//        dd($request);
//        $this->validate($request, Gameplan::$rules);
        // gameplan features //
        $gameplan = new Gameplan();
        $gameplan->author_id = Auth::id();
        $gameplan->date = $request->get('date');
//        dd(Auth::id());
        $gameplan->save();
        $bars = explode(',', $request->get('hidden-bar-input'));
//        dd($gameplan->id);
        foreach($bars as $key => $bar){
            $gpbar = new GameplanBar();
            if($bar == ''){
                break;
            }
            $gpbar->gameplan_id = $gameplan->id;
            $gpbar->bar_id = $bar;
            $gpbar->save();
        }

        session()->flash('success', 'Your gameplan was created successfully!');
        return redirect()->action('GameplansController@show', $gameplan->id);
    }

    public function addHopper($gameplanid)
    {
        session()->flash('fail', 'You did NOT join the Gameplan. Please fix errors.');
        $hopper = new Hopper();
        $hopper->gameplan_id = $gameplanid;
        $hopper->hopper_id = Auth::id();
        $hopper->save();
        dd($hopper);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gameplan = Gameplan::find($id);
        if (!$gameplan) {
            abort(404);
        }
        $data = [
            'gameplan' => $gameplan
        ];
        return view('gameplans.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gameplan = Gameplan::find($id);
        if (!$gameplan) {
            abort(404);
        }
        $data = [
            'gameplan' => $gameplan
        ];
        return view('gameplans.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        session()->flash('fail', 'Gameplan ' . $id . ' was NOT updated. Please fix errors.');
//        $this->validate($request, Gameplan::$rules);
        $gameplan = Gameplan::find($id);
        if (!$gameplan) {
            abort(404);
        }
        $gameplan->date = $request->get('date');
        foreach($request->get('bars') as $key => $bar){
            $column = "bar$key";
            $gameplan->$column = $bar;
        }
        $gameplan->save();
        session()->flash('success','Gameplan ' . $id . ' was updated successfully!');
        return redirect()->action('GameplansController@show', $gameplan->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
