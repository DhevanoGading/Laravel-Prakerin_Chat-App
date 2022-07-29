<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\User;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        $messages = [];
        $otherUser = null;
        if ($id) {
            $otherUser = User::findorfail($id);
            $group_id = (Auth::id() > $id) ? Auth::id() . $id : $id . Auth::id();
            $messages = Chat::where('group_id', $group_id)->get()->toArray();
        }
        $users = User::where('level', '=', 'user')->get()->toArray();
        // $users = User::where('id', '!=', Auth::id())->get()->toArray();
        return view('service.serviceAdmin', compact('users', 'messages', 'otherUser', 'id'));
    }

    public function indexUser(Request $request, $id = null)
    {
        $messages = [];
        $otherUser = null;
        if ($id) {
            $otherUser = User::findorfail($id);
            $group_id = (Auth::id() > $id) ? Auth::id() . $id : $id . Auth::id();
            $messages = Chat::where('group_id', $group_id)->get()->toArray();
        }
        $users = User::where('level', '=', 'admin')->get()->toArray();
        // $users = User::where('id', '!=', Auth::id())->get()->toArray();
        return view('service.serviceUser', compact('users', 'messages', 'otherUser', 'id'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
