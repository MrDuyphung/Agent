
// Hàm để ẩn grid-container

//


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


