<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $step = $request->query('step', 1); // Mặc định là step 1 nếu không có tham số step

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
}