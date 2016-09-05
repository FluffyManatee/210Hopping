<?php
namespace App\Http\Controllers;
use Geocoder\Provider\GoogleMaps;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bar;
use Ivory\HttpAdapter\Guzzle6HttpAdapter;
class BarsController extends Controller
{
	public function index()
	{
		$bars = Bar::orderBy('bars.beer_rating', 'desc')->get();
        $data = [
		'bars' => $bars
		];
//        dd($data);
        return view ('bars.index', $data);
    }

	public function create()
	{
		return view('bars.create');
	}

	public function store(Request $request)
	{
		session()->flash('fail', 'Your post was NOT created. Please fix errors.');
		$this->validate($request, Bar::$rules);
		// $adapter  = new Guzzle6HttpAdapter();
		// $geocoder = new GoogleMaps($adapter);
		$bar = new Bar();
		$bar->type = $request->get('type');
		$bar->name = $request->get('name');
		$bar->address = $request->get('address');
        ///latlong stuff
        // $latlong = $geocoder->geocode($bar->address)->first();
        // $bar->latitude = $latlong->getLatitude();
        // $bar->longitude = $latlong->getLongitude();
        //dd($latlong->getLatitude(), $latlong->getLongitude());
        $bar->phone = $request->get('phone');
		$bar->website = $request->get('website');
		$bar->email = $request->get('email');
		$bar->save();
		session()->flash('success', 'Your post was created successfully!');
		return redirect()->action('BarsController@show', $bar->id);
	}
	public function show($id)
	{

		$bar = Bar::find($id);
		if (!$bar) {
			abort(404);
		}
		$data = [
		'bar' => $bar
		];
		return view('bars.show', $data);
	}

	public function edit($id)
	{
		$bar = Bar::find($id);
		if (!$bar) {
			abort(404);
		}
		$data = [
		'bar' => $bar
		];
		return view('bars.edit', $data);
	}

	public function update(Request $request, $id)
	{
		session()->flash('fail', $bar->name . ' was NOT updated. Please fix errors.');
		$this->validate($request, Bar::$rules);
		$bar = Bar::find($id);
		if (!$bar) {
			abort(404);
		}
		$bar->type = $request->get('type');
		$bar->name = $request->get('name');
		$bar->address = $request->get('address');
		$bar->phone = $request->get('phone');
		$bar->website = $request->get('website');
		$bar->email = $request->get('email');
		$bar->save();
		session()->flash('success', $bar->name . ' was updated successfully!');
		return redirect()->action('BarsController@show', $bar->id);
	}

	public function destroy(Request $request, $id)
	{
		$bar = Bar::find($id);
		if (!$bar) {
			abort(404);
		}
		$bar->delete();
		$request->session()->flash('success', $bar->name . ' was deleted successfully!');
		return redirect()->action('BarsController@index');
	}

	public function nearby($latitude, $longitude)
	{
		$bars = Bar::all();
		$data = [];
		foreach($bars as $bar)
		{
			$distance = $bar->getDistance($latitude, $longitude, $bar->latitude, $bar->longitude);
//            dd($distance);
			if($distance<15){
//				var_dump($distance);
				$data[] = $bar;
			}
		}
        $data = [
            'bars' => $data
        ];
//		dd($data);
		return view('bars.results', $data);
	}

	public function search(Request $request)
	{
		$searchTerm = $request->input('searchTerm');
		$features = $request->input('features');
		$features = explode(',', $features);
		$bars = Bar::searchBy($searchTerm, $features);
		$bars = $bars->orderBy('bars.beer_rating', 'desc')->get();
//        dd($bars);
		$data = [
		'bars' => $bars
		];
		return view('bars.results', $data);
	}

	public function recent()
	{
		$recent = Bar::recentBarsSpecialsEvents();
        $data = [
		'recent' => $recent
		];
		return view('bars.recent', $data);
	}
}

