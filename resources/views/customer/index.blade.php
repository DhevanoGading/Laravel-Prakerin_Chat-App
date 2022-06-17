@extends('components.main')

@section('content')
  <br>
  {{-- @if (auth()->user()->level == 1 || auth()->user()->level == 2) --}}
  @if (auth()->user()->level == "superadmin" || auth()->user()->level == "admin")
  <center>
      <a class="btn btn-success" href="{{ url('customer/create') }}">Tambah</a>
    </center>
    <br>   
  @endif
  @component('components.table')
    @foreach ($datas as $value)
        <tr>
            <th scope="row">{{ $value->id }}</th>
            <td>{{ $value->nama }}</td>
            <td>{{ $value->asal }}</td>
            <td>{{ $value->tanggal_lahir }}</td>
            {{-- @if (auth()->user()->level == 1 || auth()->user()->level == 2) --}}
            @if (auth()->user()->level == "superadmin" || auth()->user()->level == "admin")
              <td class="d-flex"><a href="{{ url('customer/'.$value->id.'/edit') }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
              @endif
            @if (auth()->user()->level == "superadmin")
                <x-form action="{{ url('customer/'.$value->id) }}" method="POST">
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                </x-form>
              </td>
            @endif
        </tr>
    @endforeach
  @endcomponent
@endsection