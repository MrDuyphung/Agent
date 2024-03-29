@extends('layout.master')
@section('content')

    <script>
        function redirectToWelcome() {
            window.location.href = "http://localhost/SearchEngine/public"; // Chuyển hướng về trang chính
        }

        function redirectToTopic(topicId) {
            window.location.href = "http://localhost/SearchEngine/public/search/" + topicId;
        }



        // Hàm để hiển thị kết quả tìm kiếm trong chat-container và thêm vào lịch sử tìm kiếm trong sidebar
        function displaySearchResults(results) {
            const chatContainer = document.querySelector('.chat-container');
            const searchHistoryContainer = document.querySelector('.search-list');

            // Duyệt qua từng kết quả
            results.forEach(function(result) {
                const chatBubble = document.createElement('div');
                chatBubble.classList.add('chat-bubble', 'system-chat');
                chatBubble.innerHTML = `
            <span class="message">Assistant Recall:</span>
            <p>Name: ${result.name}</p>
            <p>Gender: ${result.gender}</p>
            <p>Age: ${result.age}</p>
            <p>Phone: ${result.phone}</p>
            <p>Email: ${result.email}</p>
            <p>Address: ${result.address}</p>
        `;
                chatContainer.appendChild(chatBubble);

                // Tạo mục trong lịch sử tìm kiếm và thêm vào danh sách
                const searchListItem = document.createElement('li');
                const searchLink = document.createElement('a');
                searchLink.href = '#'; // Đặt href tùy theo nhu cầu
                searchLink.textContent = `Search: ${result.name}`; // Hiển thị tên kết quả trong lịch sử tìm kiếm
                searchLink.addEventListener('click', function(event) {
                    // Xử lý sự kiện khi người dùng bấm vào mục trong lịch sử tìm kiếm
                    event.preventDefault();
                    // Thực hiện hành động tương ứng, ví dụ: hiển thị thông tin kết quả đã chọn
                    console.log('Selected search:', result);
                });
                searchListItem.appendChild(searchLink);
                searchHistoryContainer.appendChild(searchListItem);
            });
        }

        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var content = document.querySelector(".content");
            var toggleBtn = document.querySelector(".toggle-btn");
            var newChatLink = document.querySelector(".new-chat");
            var settingsLink = document.querySelector(".settings-link");
            var highlightLink = document.querySelector(".highlight-link");
            var noteLink = document.querySelector(".note-link");
            var logoutLink = document.querySelector(".logout-link");
            var searchHistory = document.querySelector(".search-history");

            if (sidebar.style.width === "200px") {
                sidebar.style.width = "50px";
                content.style.marginLeft = "250px";
                toggleBtn.innerHTML = '<i class="mdi mdi-arrow-right-bold"></i>'; // Biểu tượng mũi tên phải khi thu gọn sidebar
                newChatLink.innerHTML = '<span class="new-chat-icon-button"><i class="mdi mdi-message-plus" onclick="redirectToWelcome() style="color: white;"></i></span>'; // Chỉ hiển thị button icon khi thu gọn sidebar
                settingsLink.innerHTML = '<a class="nav-link" href="#"><span class="menu-title" style="color: white;"><i class="mdi mdi-settings"></i></span></a>'; // Chỉ hiển thị icon settings khi thu gọn sidebar
                highlightLink.innerHTML = '<a class="nav-link" href="#"><span class="menu-title" style="color: white;"><i class="mdi mdi-star"></i></span></a>'; // Chỉ hiển thị icon highlight khi thu gọn sidebar
                noteLink.innerHTML = '<a class="nav-link" href="#"><span class="menu-title" style="color: white;"><i class="mdi mdi-note"></i></span></a>'; // Chỉ hiển thị icon note khi thu gọn sidebar
                logoutLink.innerHTML = '<a class="nav-link" href="{{ route('account.logout') }}"><span class="menu-title" style="color: white;"><i class="mdi mdi-logout"></i></span></a>'; // Chỉ hiển thị icon logout khi thu gọn sidebar
                searchHistory.style.display = "none"; // Ẩn phần lịch sử tìm kiếm khi thu gọn sidebar
            } else {
                sidebar.style.width = "200px";
                content.style.marginLeft = "250px";
                toggleBtn.innerHTML = '<i class="mdi mdi-arrow-left-bold"></i>'; // Biểu tượng mũi tên trái khi mở rộng sidebar
                newChatLink.innerHTML = '<span class="new-chat-icon-button" ><i class="mdi mdi-message-plus" onclick="redirectToWelcome() style="color: white;"></i></span><span class="menu-title" style="color: white;">New Search</span>'; // Hiển thị cả button icon và text khi mở rộng sidebar
                settingsLink.innerHTML = '<a class="nav-link" href="#"><span class="menu-title" style="color: white;"><i class="mdi mdi-settings"></i>Settings</span></a>'; // Hiển thị cả icon và text của settings khi mở rộng sidebar
                highlightLink.innerHTML = '<a class="nav-link" href="#"><span class="menu-title" style="color: white;"><i class="mdi mdi-star"></i>Highlight</span></a>'; // Hiển thị cả icon và text của highlight khi mở rộng sidebar
                noteLink.innerHTML = '<a class="nav-link" href="#"><span class="menu-title" style="color: white;"><i class="mdi mdi-note"></i>Note</span></a>'; // Hiển thị cả icon và text của note khi mở rộng sidebar
                logoutLink.innerHTML = '<a class="nav-link" href="{{ route('account.logout') }}"><span class="menu-title" style="color: white;"><i class="mdi mdi-logout"></i>Logout</span></a>'; // Hiển thị cả icon và text của logout khi mở rộng sidebar
                searchHistory.style.display = "block"; // Hiển thị phần lịch sử tìm kiếm khi mở rộng sidebar
            }
        }

    </script>

    <!-- Tùy chỉnh CSS -->
    <style>
        .sidebar {
            width: 200px; /* Chiều rộng mặc định của sidebar */
            height: 100vh; /* Chiều cao của sidebar */
            background-color: #333; /* Màu nền của sidebar */
            color: #fff; /* Màu chữ của sidebar */
            transition: width 0.3s ease; /* Hiệu ứng khi thay đổi chiều rộng */
            position: relative;
            display: flex; /* Sử dụng flexbox để căn giữa nội dung */
            flex-direction: column; /* Xếp nội dung theo chiều dọc */
            justify-content: center; /* Căn giữa theo chiều dọc */
            align-items: center; /* Căn giữa theo chiều ngang */
        }

        .content {
            margin-left: 200px; /* Margin để nội dung không bị che bởi sidebar */
            transition: margin-left 0.3s ease; /* Hiệu ứng khi thay đổi margin */
        }

        .toggle-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            cursor: pointer;
            background: none;
            border: none;
            color: #fff;
        }

        .toggle-btn i {
            font-size: 20px;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: flex-start;
            padding: 10px;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link i {
            margin-right: 10px;
        }

        .new-chat {
            margin-top: 20px; /* Thêm margin top cho chức năng New Chat */
            display: flex;
            align-items: center;
        }

        .new-chat-icon-button {
            margin-right: 0px;
        }
        .search-history {
            text-align: center;
            margin-top: 20px;
        }

        .search-list {
            list-style: none;
            padding: 0;
        }

        .search-list li {
            margin-bottom: 5px;
        }

        .search-list li a {
            color: #fff;
            text-decoration: none;
        }

        .search-list li a:hover {
            text-decoration: underline;
        }
        .search-history-container {
            border: 1px solid #fff; /* Tạo viền trắng 1px xung quanh khung */
            border-radius: 5px; /* Làm tròn các góc của khung */
            padding: 10px; /* Thêm padding để tạo khoảng cách giữa viền và nội dung */
            max-height: 200px; /* Đặt chiều cao tối đa cho khung lịch sử */
            overflow-y: auto; /* Cho phép cuộn khi lịch sử tìm kiếm dài hơn */
        }


    </style>

@endsection
