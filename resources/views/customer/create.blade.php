@extends('components.main')

@section('content')
  <x-form method="POST" action="{{ url('customer') }}">
        <x-input input="Nama" type="text" name="nama" value=""/>
        <x-input input="Asal" type="text" name="asal" value=""/>
        <x-input input="Tanggal Lahir" type="date" name="tanggal_lahir" value=""/>
        <button type="submit" class="btn btn-primary">Submit</button>
  </x-form>
@endsection