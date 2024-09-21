@extends('admin.layouts.layout')
@section('content')
    <div class="contain" style="display: flex;,gap: 10px;">
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
                <script>
                    function send() {
                        var message = $('#message').val();
                        $.ajax({
                            url: 'http://127.0.0.1:8000/admin/sendmessage',
                            type: 'POST',
                            data: {
                                message: message,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Lấy CSRF token từ thẻ meta
                            },
                            success: function(response) {
                                $('#message').val('')
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText)
                                alert('Error sending message');
                            }
                        });
                    }

                    $('#chat-form').on('submit', function(e) {
                        e.preventDefault();
                        send()
                    });
                </script>
            </div>
        @endforeach
    </div>
@endsection
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('905ea1087d251dc4a082', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('chatroom');
    channel.bind('MessageSent', function(data) {
        $('#chatbox').append('<li style="color: red"><b>admin: </b>' + JSON.stringify(data.message) + '</li>');
    });

    
</script>
