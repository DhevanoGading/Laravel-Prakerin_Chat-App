@extends('components.main')

@section('content')
  <x-form method="POST" action="{{ url('customer/'.$model->id) }}">
    <x-input input="" type="hidden" name="_method" value="PUT"/>
    <x-input input="Nama" type="text" name="nama" value="{{ $model->nama }}"/>
    <x-input input="Asal" type="text" name="asal" value="{{ $model->asal }}"/>
    <x-input input="Tanggal Lahir" type="date" name="tanggal_lahir" value="{{ $model->tanggal_lahir }}"/>
    <button type="submit" class="btn btn-primary">Submit</button>
  </x-form>
@endsection