<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Your Name</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
        const BASE_URL = 'http://38.54.30.126:8000/';
        window.addEventListener('beforeunload', function() {
            localStorage.clear();
        });

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

        var storedUserIds = JSON.parse(localStorage.getItem('userIds')) || [];

        if (storedUserIds.length > 0) {
            storedUserIds.forEach(function(userId) {
                subscribeToChatroom(userId);
            });
        }

        var common_channel = pusher.subscribe('commonroom');

        common_channel.bind('CommonChannel', function(commondata) {
            if (commondata.role == 'order') {

                $("#toastcontainer").append(`                    
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <div>
                            <a href="${BASE_URL}admin/order">
                                <strong>Có đơn hàng mới!</strong>
                                <h6 class="text-end">${getCurrentTime()}</h6>
                            </a>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
            }

            if (commondata.userId && !storedUserIds.includes(commondata.userId)) {
                storedUserIds.push(commondata.userId + "");
                localStorage.setItem('userIds', JSON.stringify(storedUserIds));

                subscribeToChatroom(commondata.userId);
            }
        })

        function subscribeToChatroom(userId) {
            common_channel = pusher.subscribe('chatroom' + userId);

            common_channel.bind('MessageSent', function(data) {

                $("#toastcontainer").html(`
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="..." class="rounded me-2" alt="...">
                            <strong class="me-auto">Minhduc</strong>
                            <small>Just now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            ${data.message}
                        </div>
                    </div>
                `);

                var toastLiveExample = document.getElementById('liveToast')
                var toast = new bootstrap.Toast(toastLiveExample)
                toast.show()

                $('#last_message' + userId).html('<strong>' + data.message + '</strong>');
                if (data.role == 'admin') {
                    $('#box-messages' + userId).append(`
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
                    $('#box-messages' + userId).append(`
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

                var scrollableDiv = document.getElementById("box-messages" + userId);
                scrollableDiv.scrollTop = scrollableDiv.scrollHeight;

                $('#box-status-item' + userId).prependTo('#box-status-list');
            });
        }
    </script>


    <!-- Favicons -->
    <link href="https://i.pinimg.com/236x/0f/3f/eb/0f3feb96466565cc39d182dc3808085d.jpg" rel="icon">
    {{-- <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/custom.css" rel="stylesheet">

    <!-- Tagify  -->
    <link href="/assets/vendor/tagify/tagify.css" rel="stylesheet">

    <!-- Jquery  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <!-- MDB5 CSS -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
        rel="stylesheet"
    />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script> --}}
</head>
