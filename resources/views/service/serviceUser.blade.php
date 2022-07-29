<!DOCTYPE html>
<html lang="en">
    <head>
        <title itemprop="name">Simple CRUD</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        {{-- Bootstrap Icon --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

        {{-- JQuery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        {{-- CDN Socket.io --}}
        <script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script>

        <style type="text/css">
        .chat-online {
            color: #34ce57;
        }

        .chat-offline {
            color: #e4606d;
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            max-height: 400px;
            overflow-y: scroll;
        }

        .chat-message-left,
        .chat-message-right {
            display: flex;
            flex-shrink: 0;
        }

        .chat-message-left {
            margin-right: auto;
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto;
        }
        .py-3 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }
        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }
        .flex-grow-0 {
            flex-grow: 0 !important;
        }
        .border-top {
            border-top: 1px solid #dee2e6 !important;
        }
        </style>
    </head>
    <body>
        @include('partials.navbar')
            <div id="snippetContent"> 
                <main class="content">
                    <div class="container p-0"> 
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-12 col-lg-5 col-xl-3 border-right">
                                    @foreach ($users as $user)
                                        <a href="{{ route('service/user', $user['id']) }}" class="list-group-item list-group-item-action border-0">
                                        <div class="d-flex align-items-start">
                                            <img src="https://ui-avatars.com/api/?name=Customer Sevice" class="rounded-circle mr-1" alt="Customer Sevice" width="40" height="40" />
                                            <div class="flex-grow-1 ml-3">
                                                Customer Sevice
                                                <div class="small">
                                                    Admin
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    @endforeach
                                    <hr class="d-block d-lg-none mt-1 mb-0" />
                                </div>
                                <div class="col-12 col-lg-7 col-xl-9">
                                    @if ($id)
                                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                            <div class="d-flex align-items-center py-1">
                                                <div class="position-relative"><img src="https://ui-avatars.com/api/?name=Customer Service" alt="Customer Service" class="rounded-circle mr-1" width="40" height="40" /></div>
                                                <div class="flex-grow-1 pl-3">
                                                    <strong>Customer Service</strong>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="position-relative">
                                            <div id="append-chat" class="chat-messages p-4">
                                                @foreach ($messages as $message)
                                                    @if ($message['user_id'] == Auth::id())
                                                        <div class="chat-message-right pb-4">
                                                            <div>
                                                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40" />
                                                                <div class="text-muted small text-nowrap mt-2">{{ date("h:i A", strtotime($message['created_at'])) }}</div>
                                                            </div>
                                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                                <div class="font-weight-bold mb-1">You</div>
                                                                {{ $message['message'] }}
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="chat-message-left pb-4">
                                                            <div>
                                                                <img src="https://ui-avatars.com/api/?name=Customer Service" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40" />
                                                                <div class="text-muted small text-nowrap mt-2">{{ date("h:i A", strtotime($message['created_at'])) }}</div>
                                                            </div>
                                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                                <div class="font-weight-bold mb-1">Customer Service</div>
                                                                {{ $message['message'] }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                    @endif
                                    <div class="flex-grow-0 py-3 px-4 border-top">
                                        <form id="chat-form">
                                            <div class="input-group">
                                                <input type="text" id="message-input" class="form-control" placeholder="Type your message" />
                                                <button class="btn btn-primary" type="submit">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main> 
            </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

        <script>
            $(function() {
                let user_id = '{{ Auth::id() }}';
                let other_user_id = '{{ ($otherUser) ? $otherUser->id : '' }}';
                let otherUserName = '{{ ($otherUser) ? $otherUser->name : '' }}'
                let ip_address = '127.0.0.1';
                let socket_port = '3000';
                let socket = io(ip_address + ':' + socket_port, {query:{user_id:user_id}});

                $(".chat-messages").animate({scrollTop:$(".chat-messages").prop("scrollHeight")}, 1000);

                $("#chat-form").on("submit", function(e){
                    e.preventDefault();
                    let message = $("#message-input").val();
                    if (message.trim().length == 0) {
                        $("#message-input").focus();
                    }else{
                        let data = {
                            user_id:user_id,
                            other_user_id:other_user_id,
                            message:message,
                            otherUserName:'{{ Auth::user()->name }}',
                        }
                        socket.emit('send_message', data);
                        $("#message-input").val('');
                    }
                })

                socket.on('receive_message', function(data){
                    if ((data.user_id == user_id && data.other_user_id == other_user_id) || (data.user_id == other_user_id && data.other_user_id == user_id)) {
                        if (data.user_id == user_id) {
                            let html = `<div class="chat-message-right pb-4">
                                            <div>
                                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="rounded-circle mr-1" alt="{{ Auth::user()->name }}" width="40" height="40" />
                                                <div class="text-muted small text-nowrap mt-2">${data.time}</div>
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                <div class="font-weight-bold mb-1">You</div>
                                                ${data.message}
                                            </div>
                                        </div>`
                                        $("#append-chat").append(html);
                        }else{
                            let html = `<div class="chat-message-left pb-4">
                                            <div>
                                                <img src="https://ui-avatars.com/api/?name=Customer Service" class="rounded-circle mr-1" alt="Customer Service" width="40" height="40" />
                                                <div class="text-muted small text-nowrap mt-2">${data.time}</div>
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                <div class="font-weight-bold mb-1">Customer Service</div>
                                                ${data.message}
                                            </div>
                                        </div>`
                                        $("#append-chat").append(html);
                        }
                        $(".chat-messages").animate({scrollTop:$(".chat-messages").prop("scrollHeight")}, 1000);
                    }
                });

                // socket.on('user_connection', function(data){
                //     $("#status_"+data).html('<span class="fa fa-circle chat-online"></span> Online');
                // });

                // socket.on('user_disconnected', function(data){
                //     $("#status_"+data).html('<span class="fa fa-circle chat-offline"></span> Offline');
                // });
            });
        </script>
    </body>
</html>