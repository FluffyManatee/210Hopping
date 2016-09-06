<?php

namespace App\Http\Controllers;

use App\Gameplan;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        return view('gameplans.create');
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
//        $this->validate($request, Gameplan::$rules);
        // gameplan features //
        $gameplan = new Gameplan();
        $gameplan->author_id = Auth::id();
        $gameplan->date = $request->get('date');
        foreach($request->get('bars') as $key => $bar){
            $column = "bar$key";
            $gameplan->$column = $bar;
        }
        $gameplan->save();

        session()->flash('success', 'Your gameplan was created successfully!');
        return redirect()->action('GameplansController@show', $gameplan->id);
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
