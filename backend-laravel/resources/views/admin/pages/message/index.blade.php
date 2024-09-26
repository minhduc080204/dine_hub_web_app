@extends('admin.layouts.layout')
@section('content')
    {{-- <div class="contain" style="display: flex;,gap: 10px;">
        @foreach ($messages as $key => $message)
            <div>
                <div style="color: green;padding: 10px; border: 2px solid black; "><b>userId:
                        {{ $key }}</b>
                    <ul id="chatbox">
                        @foreach ($message as $item)
                            @if ($item->role == 'admin')
                                <li style="color: red"><b>admin: </b>{{ $item->message }}</li>
                            @endif
                            <li><b>user:</b>{{ $item->message }}</li>
                        @endforeach
                    </ul>
                    <form id="chat-form" method="POST">
                        @csrf
                        <input type="text" id="message" placeholder="Reply">
                        <button type="submit">Gửi</button>
                    </form>
                </div>
                
            </div>
        @endforeach
    </div> --}}
    {{-- @dd($messages) --}}
    @php
        $currrentMessages = $messages->first();
        $currentUserId = $currrentMessages->first()->user_id;
    @endphp

    <div id="message_container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0" id="chat3" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="row pt-4">
                            <div class="col-md-6 col-lg-5 col-xl-4">

                                <div class="input-group rounded boxinput-chating mb-3" style="width: 95%;">
                                    <input type="search" class="form-control rounded" placeholder="Search"
                                        aria-label="Search" aria-describedby="search-addon" />
                                    <i class="bi bi-search"></i>
                                </div>

                                <div id="box-status" data-mdb-perfect-scrollbar-init
                                    style="position: relative; height: 450px">
                                    <ul class="list-unstyled mb-0" id="box-status-list">
                                        @foreach ($messages as $key => $contents)
                                            <li class="p-2 border-bottom rounded-2 box-status-item"
                                                id="box-status-item{{ $contents[0]->user->user_id }}">
                                                <a href="" class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row">
                                                        <div>
                                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                                alt="avatar" class="d-flex align-self-center me-3"
                                                                width="60">
                                                            <span class="badge bg-success badge-dot"></span>
                                                        </div>
                                                        <div class="pt-1">
                                                            <p class="fw-bold mb-0">{{ $contents[0]->user->user_name }}</p>
                                                            <p id="last_message" class="small text-muted">
                                                                {{ $contents[0]->content }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="pt-1">
                                                        <p class="small text-muted mb-1">
                                                            {{ substr($contents[0]->created_at, 5, -3) }}
                                                        </p>
                                                        <span class="badge bg-danger rounded-pill float-end">3</span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>

                            <div id="box-chating" class="col-md-6 col-lg-7 col-xl-8" style="height: 100%">

                                <div id="box-messages" class="pt-3 pe-3" data-mdb-perfect-scrollbar-init
                                    style="position: relative; height: 450px">
                                    @foreach ($currrentMessages->reverse() as $content)
                                        @if ($content->role == 'admin')
                                            <div class="d-flex flex-row justify-content-end">
                                                <div>
                                                    <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">
                                                        {{ $content->content }}</p>
                                                    <p class="small me-3 mb-3 rounded-3 text-muted">
                                                        {{ substr($content->created_at, 5, -3) }}
                                                    </p>
                                                </div>
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                    alt="avatar 1" style="width: 45px; height: 100%;">
                                            </div>
                                        @else
                                            <div class="d-flex flex-row justify-content-start">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                                    alt="avatar 1" style="width: 45px; height: 100%;">
                                                <div>
                                                    <p class="small p-2 ms-3 mb-1 rounded-3 bg-body-tertiary">
                                                        {{ $content->content }}</p>
                                                    <p class="small ms-3 mb-3 rounded-3 text-muted float-end">
                                                        {{ substr($content->created_at, 5, -3) }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>

                                <div class="boxinput-chating">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                        alt="avatar 3" style="width: 40px; height: 100%;">
                                    <input type="text" class="form-control form-control-lg" id="send_message_input"
                                        placeholder="Type message" tabindex="1">
                                    <button tabindex="3"><i class="bi bi-image"></i></button>
                                    <button id="send_message_button" tabindex="2"><i class="bi bi-send-fill"></i></button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        var scrollableDiv = document.getElementById("box-messages");
        scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
    </script>
    <script>
        $('#send_message_button').on('click', function(e) {
            var message = $('#send_message_input').val();
            $('#send_message_input').val('')
            $.ajax({
                url: 'http://127.0.0.1:8000/admin/messages/sendmessage',
                type: 'POST',
                data: {
                    userId: {{ $currentUserId }},
                    content: message,
                    role: 'admin',
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                success: function(response) {

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText)
                    alert('Error sending message');
                }
            });
        });
    </script>
@endsection
{{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    function getCurrentTime() {
        const now = new Date();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');

        return `${month}-${day} ${hours}:${minutes}`;
    }

    var pusher = new Pusher('905ea1087d251dc4a082', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('chatroom{{ $currentUserId }}');
    channel.bind('MessageSent', function(data) {
        $('#last_message').html('<strong>' + data.message + '</strong>');
        let algin = ''
        if (data.role == 'admin') {
            $('#box-messages').append(`
                <div class="d-flex flex-row justify-content-end">
                    <div>
                        <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">${data.message}</p>
                        <p class="small me-3 mb-3 rounded-3 text-muted">${getCurrentTime()}</p>
                    </div>
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                        alt="avatar 1" style="width: 45px; height: 100%;">
                </div>
            `);
        } else {
            $('#box-messages').append(`
                <div class="d-flex flex-row justify-content-start">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                        alt="avatar 1" style="width: 45px; height: 100%;">
                    <div>
                        <p class="small p-2 ms-3 mb-1 rounded-3 bg-body-tertiary">${data.message}</p>
                        <p class="small ms-3 mb-3 rounded-3 text-muted float-end">${getCurrentTime()}</p>
                    </div>
                </div>
            `);

        }

        var scrollableDiv = document.getElementById("box-messages");
        scrollableDiv.scrollTop = scrollableDiv.scrollHeight;

        $('#box-status-item{{ $currentUserId }}').prependTo('#box-status-list');;
    });
</script> --}}
