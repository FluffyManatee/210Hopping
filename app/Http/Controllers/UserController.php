<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Review;

class UserController extends Controller
{

    public function index()
    {
        return view ('users.index');
    }

    public function show($id)
    {
		$user = User::find($id);
		if (!$user) {
			abort(404);
		}
		$reviews = Review::where('created_by', $id)->orderBy('created_at')->get();

		$data = [
			'user' => $user,
			'reviews' => $reviews
		];
		return view('users.show', $data);
    }

    public function edit($id)
    {
		$user = User::find($id);
		if (!$user) {
			abort(404);
		}

		$data = [
			'user' => $user
		];
		return view('users.edit', $data);
    }

    public function update(Request $request, $id)
    {
		session()->flash('fail', 'Your information was NOT updated. Please fix errors.');
		$v = Validator::make($request->all(), User::$updateRules);
		$v->sometimes('email', 'required|email|max:244|unique:users', function($input) use($id) {
			return User::find($id)->email !== $input->email;
		});
		if ($v->fails()) {
			return redirect()->back()->withInput()->withErrors($v);
		}
		$user = User::find($id);
		if (!$user) {
			abort(404);
		}

		$user->name = $request->input('first_name');
		$user->name = $request->input('last_name');
		$user->email = $request->input('email');
		$user->save();
		session()->flash('success', 'Your information was updated successfully!');
		return redirect()->action('UserController@index', $user->id);
    }

	public function editPassword($id)
	{
		$user = User::find($id);
		if (!$user) {
			abort(404);
		}

		$data = [
			'user' => $user
		];
		return view('user.password', $data);
	}

	public function updatePassword(Request $request, $id) {
		session()->flash('fail', 'Your password was NOT updated. Please fix errors.');
		$this->validate($request, User::$passwordRules);
		$user = User::find($id);
		if (!$user) {
			abort(404);
		}
		$user->password = Hash::make($request->input('password'));
		$user->save();
		session()->flash('success', 'Your password was updated successfully!');
		return redirect()->action('UserController@index', $user->id);
	}

    public function destroy($id)
    {
		$user = User::find($id);
		$user->delete();
		// Do we want to delete the user reviews if account is deleted?
		$reviews = Review::where('created_by', $id)->orderBy('created_at');
		$reviews->delete();
		//
		session()->flash('success', 'Your account was deleted successfully!');
		return redirect()->action('BarsController@index');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $data = User::searchBy($searchTerm);
        $data->orderBy('name', 'asc');
        return view('users.index')->with('data', $data);
//        need a users index plz and ty

    }
}
