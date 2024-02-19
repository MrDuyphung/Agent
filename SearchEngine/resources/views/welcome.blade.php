@extends('layout.master')
@section('content')
    <div class="content">
        <div class="grid-container">
            <h1 class="title">Hello, I'm your assistant. I'm here to help you solve problems.</h1><br>
            <!-- Ô vuông 1 -->
            <div class="grid-item">
                <i class="menu-icon mdi mdi-account"></i>
                <span class="menu-title">Give me a photo of a person. I can tell you
                    his/her all bio informations I have.</span>
            </div>
            <!-- Ô vuông 2 -->
            <div class="grid-item">
                <i class="menu-icon mdi mdi-file-music-outline"></i>
                <span class="menu-title">Give me a file of
                    voice/melody/song/sound. I can tell you
                    something I realize from them.</span>
            </div>
            <!-- Ô vuông 3 -->
            <div class="grid-item">
                <i class="menu-icon mdi mdi-image-frame"></i>
                <span class="menu-title">Give me a file of video/picture/draw, etc. I
                    can tell you something I realize from them</span>
            </div>
            <!-- Ô vuông 4 -->
            <div class="grid-item">
                <i class="menu-icon mdi mdi-car"></i>
                <span class="menu-title">Give me a number plate of car/motorbike,
                    etc. I can tell you something such as: last
                    location found, kind of vehicle, owner, etc.</span>
            </div>
            <!-- Ô vuông 5 -->
            <div class="grid-item">
                <i class="menu-icon mdi mdi-message-reply-text"></i>
                <span class="menu-title">Give me any request to find someone,
                    somewhere, something, etc</span>
            </div>
        </div>
        <div class="chat-container">
            <!-- Tin nhắn sẽ được hiển thị ở đây -->

        </div>
    </div>
    <div class="container-fluid clearfix">
        <form id="searchForm" class="search-form" action="#" method="post">
            @csrf
            <div class="input-group rounded-pill">
                <input id="search_word" name="search_word" type="text" class="form-control rounded-pill" placeholder="Try your first search here...">
                <div class="input-group-append">
                    <button class="btn btn-primary square-rounded" type="submit">
                        <i class="mdi mdi-arrow-up"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
        <button onclick="SubmitSearch()"  class="btn btn-secondary square-rounded" type="button">
            <i class="mdi mdi-attachment"></i>
        </button>
    </div>
    <style>
        .content {
            display: flex;
            justify-content: center; /* Căn giữa theo chiều ngang */
            align-items: center; /* Căn giữa theo chiều dọc */
            height: 80vh; /* Đảm bảo rằng nội dung nằm giữa màn hình */
        }

        .grid-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between; /* Các ô vuông sẽ được căn đều trên mỗi hàng */
            max-width: 800px; /* Điều chỉnh kích thước của lưới */
        }

        .grid-item {
            flex: 0 0 calc(35% - 19px); /* Chia lưới thành 3 cột và điều chỉnh khoảng cách giữa chúng */
            background-color: #d3d3d3;
            margin-bottom: 20px; /* Điều chỉnh khoảng cách dưới cùng của mỗi ô vuông */
            border-radius: 5px;
            padding: 20px;
            text-align: center;
        }

        .menu-icon {
            font-size: 36px;
        }

        .menu-title {
            display: block;
            margin-top: 10px;
        }
        .title {
            font-family: 'Roboto', sans-serif;
            font-size: 28px;
            text-align: center;
            margin-top: 30px; /* Khoảng cách từ tiêu đề đến lưới */
        }
        .chat-container {
            width: 80%;
            max-width: 1600px; /* Điều chỉnh kích thước của container chat */
            max-height: calc(80vh - 100px); /* 80% chiều cao của viewport trừ đi chiều cao của thanh search */
            display: flex;
            flex-direction: column;
            overflow-y: auto; /* Hiển thị thanh cuộn ngang khi nội dung vượt quá */
            flex-grow: 1; /* Cho phép chat-container mở rộng để điều chỉnh kích thước trong flexbox layout */
        }


        .chat-bubble {
            background-color: #d3d3d3;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .system-chat {
            align-self: flex-start; /* Đặt hệ thống chat ở bên trái */
        }

        .user-chat {
            align-self: flex-end; /* Đặt người dùng chat ở bên phải */
        }

        .search-bar {
            margin-top: 20px;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        /*.avatar {*/
        /*    width: 30px; !* Độ rộng của avatar *!*/
        /*    height: 30px; !* Độ cao của avatar *!*/
        /*    border-radius: 50%; !* Hình dạng hình tròn *!*/
        /*    margin-right: 10px; !* Khoảng cách giữa avatar và nội dung tin nhắn *!*/
        /*}*/

        /*.user-chat .avatar {*/
        /*    float: right; !* Avatar người dùng nằm bên phải *!*/
        /*}*/

        /*.system-chat .avatar {*/
        /*    float: left; !* Avatar hệ thống nằm bên trái *!*/
        /*}*/

    </style>
    <style>
        .footer {
            padding: 20px 0;
        }

        .search-form {
            display: flex;
            justify-content: center;
        }

        .input-group {
            width: 100%; /* Sử dụng toàn bộ chiều rộng của container */
        }

        .input-group input {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group-append {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .btn-secondary {
            background-color: #ffffff;
            border-color:  #ffffff;
        }

        .btn-primary {
            background-color: #6c6e72;
            border-color: #6c6e72;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .square-rounded {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .hidden {
            display: none;
        }
        .avatar {
            display: none; /* Ẩn avatar */
    </style>

    {{--        @foreach($topicNames as $topicName)--}}
    {{--            <li class="nav-item">--}}
    {{--                <a class="nav-link" href="#">--}}
    {{--                    <span class="menu-title" style="color: white;">{{ $topicName }}</span>--}}
    {{--                </a>--}}
    {{--            </li>--}}
    {{--        @endforeach--}}
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // Hàm để ẩn grid-container
    function hideGridContainer() {
        const gridContainer = document.querySelector('.grid-container');
        gridContainer.style.display = 'none'; // Ẩn grid-container
    }

    // Hàm để gửi yêu cầu tìm kiếm
    function SubmitSearch() {
        var search_word = document.getElementById('search_word').value.trim(); // Loại bỏ khoảng trắng đầu và cuối
        if (search_word !== '') {
            console.log(search_word); // Debug: Kiểm tra giá trị được nhập

            $.ajax({
                url: "{{ route('person.search') }}",
                type: "GET",
                data: { data: search_word },
                success: function(response) {
                    // Xử lý phản hồi từ máy chủ
                    console.log(response); // Debug: Kiểm tra phản hồi từ máy chủ
                    displaySearchResults(response);
                    hideGridContainer(); // Ẩn grid-container sau khi nhận được kết quả
                    // Gọi hàm để thêm bản ghi vào bảng search_topics
                    // saveSearchTopic(search_word);
                },
                error: function(xhr) {
                    // Xử lý lỗi nếu có
                    console.error(xhr.responseText);
                }
            });
        }
    }

{{--    $(document).ready(function(){--}}
{{--        $('#searchForm').submit(function(e){--}}
{{--            e.preventDefault(); // Ngăn chặn gửi yêu cầu mặc định của form--}}
{{--@csrf--}}
{{--            var searchWord = $('#search_word').val(); // Lấy dữ liệu từ input--}}

{{--            $.ajax({--}}
{{--                url: "{{ route('search.save') }}", // Đường dẫn tới route xử lý lưu dữ liệu--}}
{{--                type: "POST",--}}
{{--                data: {--}}
{{--                    search_word: searchWord--}}
{{--                },--}}
{{--                success: function(response) {--}}
{{--                    // Xử lý phản hồi từ server nếu cần--}}
{{--                    console.log(response);--}}
{{--                },--}}
{{--                error: function(xhr) {--}}
{{--                    // Xử lý lỗi nếu có--}}
{{--                    console.error(xhr.responseText);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}

    // Hàm để hiển thị tin nhắn của người dùng trong chat-container
    <!-- Trong hàm displayUserMessage -->
    <!-- Trong hàm displayUserMessage -->
    function displayUserMessage(message) {
        const chatContainer = document.querySelector('.chat-container');

        // Tạo bubble cho tin nhắn của người dùng và thêm vào chat-container
        const userBubble = document.createElement('div');
        userBubble.classList.add('chat-bubble', 'user-chat');
        userBubble.innerHTML = `
        <span class="message">${message}</span>
    `;
        chatContainer.appendChild(userBubble);

        // Cuộn xuống bottom của chat-container sau khi thêm tin nhắn
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }



    document.addEventListener('DOMContentLoaded', function () {
        const searchForm = document.querySelector('.search-form');

        searchForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const searchInput = searchForm.querySelector('input[type="text"]');
            const searchTerm = searchInput.value.trim(); // Loại bỏ khoảng trắng đầu và cuối

            // Kiểm tra nếu tin nhắn không rỗng thì hiển thị trong chat-container
            if (searchTerm !== '') {
                // Tạo bubble cho tin nhắn của người dùng và thêm vào chat-container
                const userMessage = document.createElement('div');
                userMessage.classList.add('chat-bubble', 'user-chat');
                userMessage.innerHTML = `
                    <img src="path/to/user-avatar.png" class="avatar" alt="User Avatar">
                    <span class="message">${searchTerm}</span> <!-- Thêm phần văn bản đã tìm kiếm vào tin nhắn -->
                `;
                document.querySelector('.chat-container').appendChild(userMessage);

                // Gọi hàm để gửi yêu cầu tìm kiếm
                SubmitSearch();

                // Xóa nội dung trong ô tìm kiếm sau khi đã xử lý
                searchInput.value = '';
            }
        });
    });


</script>


