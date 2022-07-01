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

  <div class="container">
    <div class="row chat-row">
        <div class="chat-content">
            <ul>
                
            </ul>
        </div>
            
        <div class="chat-section">
            <div class="chat-box">
                <div class="chat-input bg-primary text-white" id="chatInput" contenteditable="">
            
                </div>
            </div>
        </div>
    </div>
</div>
  <style>
    .chat-row {
      margin: 50px;
    }
    ul {
      margin: 0;
      padding: 0;
      list-style: none;
    }
    ul li {
      padding: 8px;
      background: #928787;
      margin-bottom: 20px;
    }
    ul li:nth-child(2n-2) {
      background: #c3c5c5;
    }
    .chat-input {
      border: 1px solid lightgray;
      border-radius: 10px;
      padding: 8px 10px;
    }
  </style>

<script>
$(function() {

    let ip_address = '127.0.0.1';
    let socket_port = '3000';
    let socket = io(ip_address + ':' + socket_port);

    let input = $('#chatInput');

    input.keypress(function(e) {
        let data = $(this).html();
        console.log(data);
        
        if (e.which === 13 && !e.shiftkey) {
            socket.emit('sendDataToServer', data);
            input.html('');
            return false;
        }
    });

    socket.on('sendDataToClient', (data) => {
        $('.chat-content ul').append(`<li>${data}</li>`)
    });
});
</script>
@endsection