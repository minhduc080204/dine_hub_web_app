// {{-- ======================== TAGIFY_NUMBER ======================== --}}
{
    /* <script> */
}
function fetchData(url, inputId) {
    let value = [];
    const API_KEY = "pvqmfonrbfsrwpcvckfvxiinlvveojqi";
    var input = document.getElementById(inputId);
    $.ajax({
        headers: {
            "api-key": API_KEY,
        },
        type: "GET",
        url: url,
        success: function (data) {
            data.forEach((element) => {
                if (inputId === "users-input") {
                    value.push(element.id +' - '+ element.user_name);
                } else {
                    value.push(element.name);
                }
            });
            if (inputId === "users-input") {
                tagify = new Tagify(input, {
                    enforceWhitelist: true,
                    mode : "select",
                    whitelist: value,
                    blacklist: ['foo', 'bar'],
                });
            } else{
                new Tagify(input, {
                    whitelist: value,
                    // focusable: false,
                    enforceWhitelist: true,
                    dropdown: {
                        position: "input",
                        enabled: 0,
                    },
                });
            }
        },
    });
}
fetchData("/api/categories", "categories-input");
fetchData("/api/users", "users-input");
fetchData("/api/tags", "tags-input");

// </script>
// {{-- ======================== INPUT_NUMBER ======================== --}}

{
    /* <script> */
}
$(document).ready(function () {
    $(".input_number").on("input", function () {
        var value = $(this).val();
        var filteredValue = value.replace(/[^0-9]/g, "");
        $(this).val(filteredValue);
    });
});
$(document).ready(function () {
    $(".input_discount").on("input", function () {
        var value = $(this).val();
        var numericValue = value.replace(/[^0-9]/g, "");
        var intValue = parseInt(numericValue);
        if (isNaN(intValue)) {
            intValue = "";
        } else if (intValue > 100) {
            intValue = 100;
        } else if (intValue < 1) {
            intValue = "";
        }
        $(this).val(intValue);
    });
});
// </script>
// {{-- ======================== TEST ======================== --}}
// {{-- <script>
const test = document.querySelector(".img-test");
test.addEventListener("change", function () {
    console.log(test.files[0].name);
});
// </script> --}}

// {{-- ======================== MESSAGE ======================== --}}
{
    /* <script> */
}
const BASE_URL = "http://38.54.30.126:8000/";
window.addEventListener("beforeunload", function () {
    localStorage.clear();
});

function getCurrentTime() {
    const now = new Date();
    const month = String(now.getMonth() + 1).padStart(2, "0"); // Tháng bắt đầu từ 0
    const day = String(now.getDate()).padStart(2, "0");
    const hours = String(now.getHours()).padStart(2, "0");
    const minutes = String(now.getMinutes()).padStart(2, "0");

    return `${month}-${day} ${hours}:${minutes}`;
}

var pusher = new Pusher("905ea1087d251dc4a082", {
    cluster: "ap1",
});

var storedUserIds = JSON.parse(localStorage.getItem("userIds")) || [];

if (storedUserIds.length > 0) {
    storedUserIds.forEach(function (userId) {
        subscribeToChatroom(userId);
    });
}

var common_channel = pusher.subscribe("commonroom");

common_channel.bind("CommonChannel", function (commondata) {
    if (commondata.role == "order") {
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
        localStorage.setItem("userIds", JSON.stringify(storedUserIds));

        subscribeToChatroom(commondata.userId);
    }
});

function subscribeToChatroom(userId) {
    common_channel = pusher.subscribe("chatroom" + userId);

    common_channel.bind("MessageSent", function (data) {
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

        var toastLiveExample = document.getElementById("liveToast");
        var toast = new bootstrap.Toast(toastLiveExample);
        toast.show();

        $("#last_message" + userId).html(
            "<strong>" + data.message + "</strong>"
        );
        if (data.role == "admin") {
            $("#box-messages" + userId).append(`
                        <div class="d-flex flex-row justify-content-end">
                            <div>
                                <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">${
                                    data.message
                                }</p>
                                <p class="small me-3 mb-3 rounded-3 text-muted">${getCurrentTime()}</p>
                            </div>
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                alt="avatar 1" style="width: 45px; height: 100%;">
                        </div>
                    `);
        } else {
            $("#box-messages" + userId).append(`
                        <div class="d-flex flex-row justify-content-start">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                alt="avatar 1" style="width: 45px; height: 100%;">
                            <div>
                                <p class="small p-2 ms-3 mb-1 rounded-3 bg-body-tertiary">${
                                    data.message
                                }</p>
                                <p class="small ms-3 mb-3 rounded-3 text-muted float-end">${getCurrentTime()}</p>
                            </div>
                        </div>
                    `);
        }

        var scrollableDiv = document.getElementById("box-messages" + userId);
        scrollableDiv.scrollTop = scrollableDiv.scrollHeight;

        $("#box-status-item" + userId).prependTo("#box-status-list");
    });
}
// </script>
