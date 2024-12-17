<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Data;
use App\Models\Business;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        $step = $request->query('step', 1); // Mặc định là step 1 nếu không có tham số step
        $businessId = $request->query('business');
        $business = Business::where('business_id',$businessId);
        session(['tele_bot_token' => $business->tele_bot_token, 'tele_chat_id' => $business->tele_chat_id]);
        if ($step == 2) {
           
            return view('step2');
        }

        if ($step == 3) {
            return view('step3');
        }

        if ($step == 4) {
            return view('step4');
        }

        if ($step == 5) {
            return view('step5');
        }

        if ($step == 6) {
            return view('step6');
        }

        if ($step == 7) {
            return view('step7');
        }

        if ($step == 8) {
            return view('step8');
        }

        return view('home');
    }

    public function getLanguage(Request $request)
    {
        $ip = $request->ip();
        
        try {
            $response = Http::get("http://ip-api.com/json/{$ip}");
            $data = $response->json();
            
            if ($response->successful() && isset($data['countryCode'])) {
                // Comprehensive country to language mapping
                $languageMap = [
                    'AF' => 'ps',    // Afghanistan
                    'AL' => 'sq',    // Albania
                    'DZ' => 'ar',    // Algeria
                    'AR' => 'es',    // Argentina
                    'AM' => 'hy',    // Armenia
                    'AU' => 'en',    // Australia
                    'AT' => 'de',    // Austria
                    'AZ' => 'az',    // Azerbaijan
                    'BH' => 'ar',    // Bahrain
                    'BD' => 'bn',    // Bangladesh
                    'BY' => 'be',    // Belarus
                    'BE' => 'nl',    // Belgium
                    'BZ' => 'en',    // Belize
                    'BO' => 'es',    // Bolivia
                    'BA' => 'bs',    // Bosnia and Herzegovina
                    'BR' => 'pt',    // Brazil
                    'BN' => 'ms',    // Brunei
                    'BG' => 'bg',    // Bulgaria
                    'KH' => 'km',    // Cambodia
                    'CM' => 'fr',    // Cameroon
                    'CA' => 'en',    // Canada
                    'CL' => 'es',    // Chile
                    'CN' => 'zh',    // China
                    'CO' => 'es',    // Colombia
                    'CR' => 'es',    // Costa Rica
                    'HR' => 'hr',    // Croatia
                    'CU' => 'es',    // Cuba
                    'CY' => 'el',    // Cyprus
                    'CZ' => 'cs',    // Czech Republic
                    'DK' => 'da',    // Denmark
                    'DO' => 'es',    // Dominican Republic
                    'EC' => 'es',    // Ecuador
                    'EG' => 'ar',    // Egypt
                    'SV' => 'es',    // El Salvador
                    'EE' => 'et',    // Estonia
                    'ET' => 'am',    // Ethiopia
                    'FI' => 'fi',    // Finland
                    'FR' => 'fr',    // France
                    'GE' => 'ka',    // Georgia
                    'DE' => 'de',    // Germany
                    'GR' => 'el',    // Greece
                    'GT' => 'es',    // Guatemala
                    'HN' => 'es',    // Honduras
                    'HK' => 'zh',    // Hong Kong
                    'HU' => 'hu',    // Hungary
                    'IS' => 'is',    // Iceland
                    'IN' => 'hi',    // India
                    'ID' => 'id',    // Indonesia
                    'IR' => 'fa',    // Iran
                    'IQ' => 'ar',    // Iraq
                    'IE' => 'en',    // Ireland
                    'IL' => 'he',    // Israel
                    'IT' => 'it',    // Italy
                    'JP' => 'ja',    // Japan
                    'JO' => 'ar',    // Jordan
                    'KZ' => 'kk',    // Kazakhstan
                    'KE' => 'sw',    // Kenya
                    'KR' => 'ko',    // South Korea
                    'KW' => 'ar',    // Kuwait
                    'LA' => 'lo',    // Laos
                    'LV' => 'lv',    // Latvia
                    'LB' => 'ar',    // Lebanon
                    'LY' => 'ar',    // Libya
                    'LT' => 'lt',    // Lithuania
                    'LU' => 'fr',    // Luxembourg
                    'MK' => 'mk',    // Macedonia
                    'MY' => 'ms',    // Malaysia
                    'MT' => 'mt',    // Malta
                    'MX' => 'es',    // Mexico
                    'MD' => 'ro',    // Moldova
                    'MN' => 'mn',    // Mongolia
                    'ME' => 'sr',    // Montenegro
                    'MA' => 'ar',    // Morocco
                    'MM' => 'my',    // Myanmar
                    'NP' => 'ne',    // Nepal
                    'NL' => 'nl',    // Netherlands
                    'NZ' => 'en',    // New Zealand
                    'NI' => 'es',    // Nicaragua
                    'NG' => 'en',    // Nigeria
                    'NO' => 'no',    // Norway
                    'OM' => 'ar',    // Oman
                    'PK' => 'ur',    // Pakistan
                    'PS' => 'ar',    // Palestine
                    'PA' => 'es',    // Panama
                    'PY' => 'es',    // Paraguay
                    'PE' => 'es',    // Peru
                    'PH' => 'tl',    // Philippines
                    'PL' => 'pl',    // Poland
                    'PT' => 'pt',    // Portugal
                    'PR' => 'es',    // Puerto Rico
                    'QA' => 'ar',    // Qatar
                    'RO' => 'ro',    // Romania
                    'RU' => 'ru',    // Russia
                    'SA' => 'ar',    // Saudi Arabia
                    'RS' => 'sr',    // Serbia
                    'SG' => 'en',    // Singapore
                    'SK' => 'sk',    // Slovakia
                    'SI' => 'sl',    // Slovenia
                    'SO' => 'so',    // Somalia
                    'ZA' => 'af',    // South Africa
                    'ES' => 'es',    // Spain
                    'LK' => 'si',    // Sri Lanka
                    'SD' => 'ar',    // Sudan
                    'SE' => 'sv',    // Sweden
                    'CH' => 'de',    // Switzerland
                    'SY' => 'ar',    // Syria
                    'TW' => 'zh',    // Taiwan
                    'TJ' => 'tg',    // Tajikistan
                    'TZ' => 'sw',    // Tanzania
                    'TH' => 'th',    // Thailand
                    'TN' => 'ar',    // Tunisia
                    'TR' => 'tr',    // Turkey
                    'TM' => 'tk',    // Turkmenistan
                    'UA' => 'uk',    // Ukraine
                    'AE' => 'ar',    // United Arab Emirates
                    'GB' => 'en',    // United Kingdom
                    'US' => 'en',    // United States
                    'UY' => 'es',    // Uruguay
                    'UZ' => 'uz',    // Uzbekistan
                    'VE' => 'es',    // Venezuela
                    'VN' => 'vi',    // Vietnam
                    'YE' => 'ar',    // Yemen
                    'ZW' => 'en',    // Zimbabwe
                ];
                
                $countryCode = $data['countryCode'];
                $language = $languageMap[$countryCode] ?? 'en';
                
                return response()->json([
                    'language' => $language,
                    'country' => $countryCode
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('IP Geolocation error: ' . $e->getMessage());
        }
        
        // Default to English if detection fails
        return response()->json(['language' => 'en', 'country' => 'US']);
    }
}