<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReviewsController extends Controller
{

	public function index()
	{
		$reviews = Review::orderDesc(10);
		$data = [
			'reviews' => $reviews
		];
		return view ('reviews.index', $data);
	}

	public function create()
	{
		return view('reviews.create');
	}

	public function store(Request $request)
	{
		session()->flash('fail', 'Your post was NOT created. Please fix errors.');
		$this->validate($request, Review::$rules);

		$review = new Review();
		$review->title = $request->get('title');
		$review->content = $request->get('content');
		$review->created_by = Auth::user()->id;
		$review->beer_rating = $request->get('beer_rating');
		// Will change based on view
		$review->bar_id = $request->get('bar_id');
		//
		$review->timestamp();
		$review->save();
		session()->flash('success', 'Your post was created successfully!');
		return redirect()->action('ReviewsController@index');
	}

	public function show($id)
	{
		$review = Review::find($id);
		if (!$review) {
			abort(404);
		}
		$data = [
			'review' => $review
		];
		return view('reviews.show', $data);
	}

	public function edit($id)
	{
		$review = Review::find($id);
		if (!$review) {
			abort(404);
		}
		$data = [
			'review' => $review
		];
		return view('reviews.edit', $data);
	}

	public function update(Request $request, $id)
	{
		session()->flash('fail', 'Your review was NOT updated. Please fix errors.');
		$this->validate($request, Review::$rules);

		$review = Review::find($id);
		if (!$review) {
			abort(404);
		}
		$review->title = $request->get('title');
		$review->date = $request->get('date');
		$review->content = $request->get('content');
		$review->review_pic = $request->get('review_pic');
		$review->save();
		session()->flash('success', 'Your was updated successfully!');
		return redirect()->action('ReviewsController@show', $review->id);
	}

	public function destroy(Request $request, $id)
	{
		$review = Event::find($id);
		if (!$review) {
			abort(404);
		}
		$review->delete();
		$request->session()->flash('success', 'Your review was deleted successfully!');
		return redirect()->action('ReviewsController@index');
	}
}
