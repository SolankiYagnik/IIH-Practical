<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', "DESC")->get();

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'contact_number' => 'required',
            'gender' => 'required',
            // 'profile_img' => 'required|profile_img|mimes:jpeg,png,jpg|max:2048',
            'hobbies' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);

        // $imageName = time().'.'.$request->profile_img->extension();
        // $request->profile_img->move(public_path('images'), $imageName);
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->contact_number = $data['contact_number'];
        $user->gender = $data['gender'];
        // $user->profile_img = 'images/'.$imageName;;
        $user->hobbies = implode(',', $data['hobbies']);
        $user->country_id = $data['country'];
        $user->state_id = $data['state'];
        $user->city_id = $data['city'];
        $user->save();

        return response()->json('Application submited successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json('User Deleted successfully!');
    }
}
