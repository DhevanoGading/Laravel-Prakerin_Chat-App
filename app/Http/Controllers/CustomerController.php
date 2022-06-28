<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use Illuminate\Http\Request;
use App\Models\Customer;
use Exception;

class CustomerController extends Controller
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
        $datas = Customer::all();

        if ($datas) {
            return ApiFormatter::createApi(200, 'Read data customer successfully!', $datas);
        } else {
            return ApiFormatter::createApi(400, 'Read data customer failed!');
        }

        // return view('customer.index', compact(
        //     'datas'
        // ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Customer;
        return view('customer.create', compact(
            'model'
        ));
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
                'nama' => 'required',
                'asal' => 'required',
                'tanggal_lahir' => 'required'
            ]);

            $customer = Customer::create([
                'nama' => $request->nama,
                'asal' => $request->asal,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            $data = Customer::where('id', '=', $customer->id)->get();

            if ($data) {
                return ApiFormatter::createApi(200, 'Create data customer successfully!', $data);
            } else {
                return ApiFormatter::createApi(400, 'Create data customer failed!');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Create data customer failed!');
        }

        // $model = new Customer;
        // $model->nama = $request->nama;
        // $model->asal = $request->asal;
        // $model->tanggal_lahir = $request->tanggal_lahir;
        // $model->save();

        // return redirect('customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Customer::where('id', '=', $id)->get();

        if ($data) {
            return ApiFormatter::createApi(200, 'Show data customer successfully!', $data);
        } else {
            return ApiFormatter::createApi(400, 'Show data customer failed!');
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
        $model = Customer::find($id);
        return view('customer.edit', compact(
            'model'
        ));
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
                'nama' => 'required',
                'asal' => 'required',
                'tanggal_lahir' => 'required'
            ]);

            $customer = Customer::findOrFail($id);

            $customer->update([
                'nama' => $request->nama,
                'asal' => $request->asal,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            $data = Customer::where('id', '=', $customer->id)->get();

            if ($data) {
                return ApiFormatter::createApi(200, 'Update data customer successfully!', $data);
            } else {
                return ApiFormatter::createApi(400, 'Update data customer failed!');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Update data customer failed!');
        }

        // $model = Customer::find($id);
        // $model->nama = $request->nama;
        // $model->asal = $request->asal;
        // $model->tanggal_lahir = $request->tanggal_lahir;
        // $model->save();

        // return redirect('customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $data = $customer->delete();

        if ($data) {
            return ApiFormatter::createApi(200, 'Delete data customer successfully!');
        } else {
            return ApiFormatter::createApi(400, 'Delete data customer failed!');
        }

        // $model = Customer::find($id);
        // $model->delete();
        // return redirect('customer');
    }
}
