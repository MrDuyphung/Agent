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
        <form id="searchForm" class="search-form" action="#" method="get">

            <div class="input-group rounded-pill">
                <input id="search_word" type="text" class="form-control rounded-pill" placeholder="Try your first search here...">
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
    <button class="btn btn-outline-info" onclick="openForm()"> <i class="mdi mdi-account-search"></i>
        Person Searching
    </button>
    <button class="btn btn-inverse-success" onclick="openForm2()"> <i class="mdi mdi-camera-iris"></i>
        Upload Photo/Video
    </button>
    </div>


    <div class="form-popup" id="myForm">
        <form action="/action_page.php" class="form-container">
            <h1 style="text-align: center;">Add Input Here</h1>

            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" required>

            <label for="age"><b>Age</b></label>
            <input type="number" placeholder="Enter Age" name="age" required>

            <label for="gender"><b>Gender</b></label><br>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>

            <label for="phone"><b>Phone</b></label>
            <input type="tel" placeholder="Enter Phone Number" name="phone" required>

            <label for="mail"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" required><br>

            <label for="cccd"><b>CCCD</b></label>
            <input type="text" placeholder="Enter CCCD" name="cccd" required>

            <label for="address"><b>Address</b></label>
            <input type="text" placeholder="Enter Address" name="address" required><br>

            <label for="picture" id="picture-label"><b>Picture</b></label><br>
            <input type="file" id="picture" name="picture" accept="image/*" onchange="displaySelectedImage(event)">
            <button type="button" onclick="removePicture()">Remove</button><br>

            <!-- Thẻ img để hiển thị hình ảnh được chọn -->
            <img id="selected-image" src="#" alt="Selected Image" style="display: none; max-width: 300px; max-height: 300px;">

            <button type="submit" class="btn">
                <i class="mdi mdi-arrow-up"></i>Search Now</button>
            <button type="button" class="close-btn" onclick="closeForm()">
                <i class="mdi mdi-close" style="color: red;"></i> <!-- Sử dụng icon dấu x màu đỏ -->
            </button>
        </form>


    </div>
    <div class="form-popup" id="myForm2">
        <form action="/upload" class="form-container" enctype="multipart/form-data">
            <h1>Upload Photo/Video</h1>

            <!-- Ô nhập message -->
            <label for="message"><b>Message</b></label>
            <input id="message" name="message" placeholder="Enter your message" required><br>

            <!-- Ô chọn file -->
            <label for="file"><b>File</b></label>
            <input type="file" id="file" name="file" accept="image/*, video/*" onchange="displayDemoMedia(event)" required>

            <!-- Hiển thị hình ảnh demo -->
            <img id="demo-image" src="#" alt="Demo Image" style="display: none; max-width: 300px; max-height: 300px;">

            <!-- Hiển thị video demo -->
            <video id="demo-video" src="#" controls style="display: none; max-width: 300px;"></video>

            <button type="submit" class="btn"><i class="mdi mdi-arrow-up"></i>Send</button>
            <button type="button" class="close-btn" onclick="closeForm2()"> <i class="mdi mdi-close" style="color: red;"></i></button>
        </form>
    </div>
    <div class="overlay" id="overlay"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>



        {{--$(document).ready(function(){--}}
        {{--    $('#search_word').keyup(function(e){--}}
        {{--        if(e.keyCode == 13){ // Kiểm tra xem phím nhấn có phải là Enter không--}}
        {{--            SubmitSearch(); // Gọi hàm SubmitSearch() để thực hiện tìm kiếm--}}
        {{--        }--}}
        {{--    });--}}

        {{--    $('#searchForm').submit(function(e){--}}
        {{--        e.preventDefault(); // Ngăn chặn gửi yêu cầu mặc định của form--}}

        {{--        var searchWord = $('#search_word').val().trim(); // Lấy dữ liệu từ input--}}
        {{--        if (searchWord !== '') { // Kiểm tra xem từ khóa tìm kiếm có rỗng hay không--}}
        {{--            // Gửi yêu cầu AJAX chỉ khi từ khóa tìm kiếm không rỗng--}}
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
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        <!-- Trong hàm displayUserMessage -->



        function openForm() {
            document.getElementById("myForm").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
        function openForm2() {
            document.getElementById("myForm2").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function closeForm2() {
            document.getElementById("myForm2").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }

        function displayDemoMedia(event) {
            const file = event.target.files[0];
            const fileType = file.type.split('/')[0]; // Lấy loại file

            if (fileType === 'image') {
                const img = document.getElementById('demo-image');
                const video = document.getElementById('demo-video');
                img.style.display = 'block';
                video.style.display = 'none';
                img.src = URL.createObjectURL(file);
            } else if (fileType === 'video') {
                const img = document.getElementById('demo-image');
                const video = document.getElementById('demo-video');
                img.style.display = 'none';
                video.style.display = 'block';
                video.src = URL.createObjectURL(file);
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            const searchForm = document.querySelector('.search-form');
            const chatContainer = document.querySelector('.chat-container');
            const gridContainer = document.querySelector('.grid-container');

            searchForm.addEventListener('submit', function (event) {
                event.preventDefault();

                const searchInput = searchForm.querySelector('input[type="text"]');
                const searchTerm = searchInput.value;

                // Tạo tin nhắn của người dùng
                const userMessage = document.createElement('div');
                userMessage.classList.add('chat-bubble', 'user-chat');
                userMessage.innerHTML = `
            <span class="message">${searchTerm}</span>
        `;

                // Hiển thị tin nhắn của người dùng trong khung chat
                chatContainer.appendChild(userMessage);

                // Ẩn grid-container
                gridContainer.classList.add('hidden');
                // Xóa nội dung trong ô tìm kiếm sau khi đã xử lý
                searchInput.value = '';
            });
            $('#search_word').keypress(function(event) {
                if (event.keyCode === 13) {

                    var search_word = document.getElementById('search_word').value;
                    console.log(search_word);
                    $.ajax({
                        url: "http://localhost/SearchEngine/public/api/person",
                        type: "GET",
                        data: { data: search_word },
                        success: function(response) {
                            console.log(response)
                            var person = response.map(function (current, index){
                                return `<div class="profile">
                                               <img class="profile-picture" src="${current.image}">
                                          <div class="profile-info">
                                            <p>Tên: ${current.name}</p>
                                            <p>Giới tính: ${current.gender}</p>
                                            <p>Tuổi: ${current.age}</p>
                                            <p>Số ID/Hộ chiếu: ssss</p>
                                            <p>Số điện thoại: ${current.phone}</p>
                                            <p>Email: ${current.email}</p>
                                            <p>Địa chỉ: ${current.address}</p>
                                            <p>Biography: ${current.Biography}</p>
                                          </div>
                                        </div>`;
                            });

                            $.ajax({
                                url: "{{route('history.search')}}",
                                type: "GET",
                                data: {
                                    search_word: search_word,
                                    history: person
                                },
                                success: function (response) {
                                    var history = response.map(function (current, index){
                                        return ` <li><a data-number="${index}" href="#">${current.search_word}</a></li>`
                                    })
                                    console.log(history.join(''))
                                    document.querySelector('.search-list').innerHTML = history.join('')

                                    var searchItems = document.querySelectorAll('.search-list li a');
                                    searchItems.forEach(function(item) {
                                        item.addEventListener('click', function(event) {
                                            event.preventDefault();
                                            console.log('click event added');
                                            var index = item.getAttribute('data-number');
                                            console.log(response[index].content);

                                            // Tạo tin nhắn của người dùng
                                            const userMessage = document.createElement('div');
                                            userMessage.classList.add('chat-bubble', 'user-chat');
                                            userMessage.innerHTML = `
                                                <span class="message">${response[index].search_word}</span>
                                            `;

                                            // Hiển thị tin nhắn của người dùng trong khung chat
                                            chatContainer.appendChild(userMessage);

                                            // Ẩn grid-container
                                            gridContainer.classList.add('hidden');

                                            const systemMessage = document.createElement('div');
                                            systemMessage.classList.add('chat-bubble', 'system-chat');
                                            systemMessage.innerHTML = `<span class="message">Hệ thống trả lời:</span>${response[index].content.join('')}`;

                                            chatContainer.appendChild(systemMessage);
                                        });
                                    });
                                },
                                error: function (xhr) {
                                    console.error(xhr.responseText);
                                }
                            })
                            const systemMessage = document.createElement('div');
                            systemMessage.classList.add('chat-bubble', 'system-chat');
                            systemMessage.innerHTML = `<span class="message">Hệ thống trả lời:</span>${person.join('')}`;

                            chatContainer.appendChild(systemMessage);
                        },
                        error: function(xhr) {
                            // Xử lý lỗi nếu có
                            console.error(xhr.responseText);
                        }
                    });
                }
            });


        });

    </script>

    <script src="{{asset('assets/js/checkmepls.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection



