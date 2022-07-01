@extends('components.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
                <div class="card-header text-center"><h4>Home Page</h4></div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} --}}
                    <div class="content">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <style>
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
</script> --}}
@endsection
