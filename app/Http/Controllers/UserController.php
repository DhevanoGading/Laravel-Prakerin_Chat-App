<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Exception;

class UserController extends Controller
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
    public function index()
    {
        $datas = User::all();

        if ($datas) {
            return ApiFormatter::createApi(200, 'Read data user successfully!', $datas);
        } else {
            return ApiFormatter::createApi(400, 'Read data user failed!');
        }
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
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $data = User::where('id', '=', $user->id)->get();

            if ($data) {
                return ApiFormatter::createApi(200, 'Create data user successfully!', $data);
            } else {
                return ApiFormatter::createApi(400, 'Create data user failed!');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Create data user failed!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::where('id', '=', $id)->get();

        if ($data) {
            return ApiFormatter::createApi(200, 'Show data user successfully!', $data);
        } else {
            return ApiFormatter::createApi(400, 'Show data user failed!');
        }
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
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->nama,
                'email' => $request->asal,
                'password' => bcrypt($request->password)
            ]);

            $data = User::where('id', '=', $user->id)->get();

            if ($data) {
                return ApiFormatter::createApi(200, 'Update data user successfully!', $data);
            } else {
                return ApiFormatter::createApi(400, 'Update data user failed!');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Update data user failed!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $data = $user->delete();

        if ($data) {
            return ApiFormatter::createApi(200, 'Delete data customer successfully!');
        } else {
            return ApiFormatter::createApi(400, 'Delete data customer failed!');
        }
    }
}
