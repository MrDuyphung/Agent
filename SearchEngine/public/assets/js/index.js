
    // Hàm để ẩn grid-container
    function hideGridContainer() {
    const gridContainer = document.querySelector('.grid-containe');
    gridContainer.style.display = 'none'; // Ẩn grid-container
}


    // Hàm để gửi yêu cầu tìm kiếm


    // $(document).ready(function(){
    //     $('#searchForm').submit(function(e){
    //         e.preventDefault(); // Ngăn chặn gửi yêu cầu mặc định của form
    //         var searchWord = $('#search_word').val(); // Lấy dữ liệu từ input
    //
    //         $.ajax({
    //             url: "{{ route('search.save') }}", // Đường dẫn tới route xử lý lưu dữ liệu
    //             type: "POST",
    //             data: {
    //                 search_word: searchWord
    //             },
    //             success: function(response) {
    //                 // Xử lý phản hồi từ server nếu cần
    //                 console.log(response);
    //             },
    //             error: function(xhr) {
    //                 // Xử lý lỗi nếu có
    //                 console.error(xhr.responseText);
    //             }
    //         });
    //     });
    // });

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

    //
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


    document.addEventListener('DOMContentLoaded', function () {
        const userSearchLink = document.getElementById('userSearchLink');
        const fileUploadLink = document.getElementById('fileUploadLink');
        const userSearchForm = document.getElementById('userSearchForm');
        const fileUploadForm = document.getElementById('fileUploadForm');

        userSearchLink.addEventListener('click', function (event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a
            userSearchForm.classList.remove('hidden'); // Hiển thị form tìm kiếm người dùng
            fileUploadForm.classList.add('hidden'); // Ẩn form tải file từ máy tính
        });

        fileUploadLink.addEventListener('click', function (event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a
            userSearchForm.classList.add('hidden'); // Ẩn form tìm kiếm người dùng
            fileUploadForm.classList.remove('hidden'); // Hiển thị form tải file từ máy tính
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        const showSearchFormButton = document.getElementById('showSearchFormButton');
        const searchForm = document.getElementById('searchForm');

        showSearchFormButton.addEventListener('click', function () {
            searchForm.classList.toggle('hidden'); // Toggle hiển thị/ẩn form khi nút được nhấp vào
        });
    });
    function displaySelectedImage(event) {
        var selectedImage = document.getElementById('selected-image');
        var input = event.target;

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                selectedImage.src = e.target.result;
                selectedImage.style.display = 'block'; // Hiển thị hình ảnh được chọn
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removePicture() {
        var selectedImage = document.getElementById('selected-image');
        selectedImage.src = '#'; // Đặt lại đường dẫn hình ảnh
        selectedImage.style.display = 'none'; // Ẩn hình ảnh
    }


