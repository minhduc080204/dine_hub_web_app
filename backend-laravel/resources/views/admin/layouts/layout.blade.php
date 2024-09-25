<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.components.head')

<body>
    @include('admin.layouts.components.header')
    @include('admin.layouts.components.sidebar')
    <main id="main" class="main">
        @include('admin.layouts.components.pageTitle')
        @yield('content')
    </main>

    @include('admin.layouts.components.footer')
    @include('admin.layouts.components.php')
    @include('admin.layouts.components.scripts')
    @yield('scripts')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
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

        var common_channel = pusher.subscribe('commonroom');
        console.log("))))))))))))))))))))))0");

        common_channel.bind('CommonChannel', function(commondata) {
            if (commondata.userId) {
                common_channel = pusher.subscribe('chatroom' + commondata.userId);
                common_channel.bind('MessageSent', function(data) {
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

                    $('#box-status-item' + commondata.userId).prependTo('#box-status-list');;
                });
            }
        })
    </script>
</body>

</html>
