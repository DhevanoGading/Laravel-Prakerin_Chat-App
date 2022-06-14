@extends('components.main')

@section('content')
  <br>
  <center>
    <a class="btn btn-success" href="{{ url('customer/create') }}">Tambah</a>
  </center>
  <br>
  @component('components.table')
    @foreach ($datas as $value)
        <tr>
            <th scope="row">{{ $value->id }}</th>
            <td>{{ $value->nama }}</td>
            <td>{{ $value->asal }}</td>
            <td>{{ $value->tanggal_lahir }}</td>
            <td><a href="{{ url('customer/'.$value->id.'/edit') }}" class="btn btn-primary">Edit</a></td>
            <td>
              <form action="{{ url('customer/'.$value->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
        </tr>
    @endforeach
  @endcomponent
@endsection