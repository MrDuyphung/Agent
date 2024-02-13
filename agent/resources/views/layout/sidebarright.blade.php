<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Sidebar</title>
    <!-- Link CSS và thư viện cần thiết -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <style>
        /* CSS cho sidebar */
        .sidebar {
            width: 200px;
            height: 100vh;
            background-color: #333;
            color: #fff;
            transition: width 0.3s ease;
            position: fixed;
            top: 0;
            right: 0; /* Đặt sidebar ở bên phải */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .content {
            margin-right: 200px;
            transition: margin-right 0.3s ease;
        }

        .toggle-btn {
            position: absolute;
            top: 10px;
            right: 10px; /* Đặt toggle button ở góc trên bên phải */
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
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        .new-chat-icon-button {
            margin-right: 0px;
        }
    </style>
</head>
<body>

<!-- HTML cho sidebar -->
<div class="sidebar" id="sidebar">
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="zmdi zmdi-arrow-right"></i>
    </button><br>
    <a class="nav-link new-chat name" href="#" onclick="addNewChat()">
        <span class="new-chat-icon-button"><i class="zmdi zmdi-plus" style="color: white;"></i></span>
        <span class="menu-title" style="color: white;">New Search</span>
    </a>
    <!-- Thêm các mục menu khác nếu cần -->
</div>

<div id="new-chat" style="display: none;">
    <h2>New Chat</h2>
    <p>This is the content of the new chat.</p>
</div>

<!-- Thêm nội dung chính của trang -->
<div class="content">
    <!-- Your main content here -->
</div>

<!-- JavaScript -->
<script>
    function addNewChat() {
        document.getElementById("new-chat").style.display = "block";
        document.getElementById("new-chat").scrollIntoView({ behavior: "smooth" });
    }

    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        var content = document.querySelector(".content");
        var toggleBtn = document.querySelector(".toggle-btn");
        var newChatLink = document.querySelector(".new-chat");

        if (sidebar.style.width === "200px") {
            sidebar.style.width = "50px";
            content.style.marginRight = "50px";
            toggleBtn.innerHTML = '<i class="zmdi zmdi-arrow-left"></i>';
            newChatLink.innerHTML = '<span class="new-chat-icon-button"><i class="zmdi zmdi-plus" style="color: white;"></i></span>';
        } else {
            sidebar.style.width = "200px";
            content.style.marginRight = "200px";
            toggleBtn.innerHTML = '<i class="zmdi zmdi-arrow-right"></i>';
            newChatLink.innerHTML = '<span class="new-chat-icon-button"><i class="zmdi zmdi-plus" style="color: white;"></i></span><span class="menu-title" style="color: white;">New Search</span>';
        }
    }
</script>

</body>
</html>
