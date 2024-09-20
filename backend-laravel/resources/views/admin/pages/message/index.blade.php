@extends('admin.layouts.layout')
@section('content')
    <div class="contain" style="display: flex;,gap: 10px;">
        @foreach ($messages as $key => $message)
            <div>
                <div style="color: green;padding: 10px;, border: 2px solid black; "><b>userId: {{ $key }}</b></div>
                <ul>
                    @foreach ($message as $item)
                        {{-- @dd($message) --}}
                        @if ($item->role == 'admin')
                            <li style="color: red"><b>admin: </b>{{ $item->message }}</li>
                        @endif
                        <li><b>user:</b>{{ $item->message }}</li>
                    @endforeach
                </ul>
                <input type="text" placeholder="Reply">
                <button>Gửi</button>
            </div>
        @endforeach
    </div>
@endsection
@section('scripts')
    @vite('resources/js/app.js')
    <script type="module">
        Echo.channel('chatroom')
            .listen('MessageEvent', (e) => {
                console.log(e.message);
                console.log("hi");
            });
        console.log("hi");
    </script>
@endsection
