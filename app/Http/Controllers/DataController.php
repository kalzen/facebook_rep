<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;

class DataController extends Controller
{
    public function getData(Request $request)
    {
        $step = $request->query('step', 3); // Default to step 3 if no step parameter is provided
        $data = $request->all(); // Get all request data

        // Send data to Google Sheets
        $this->sendToGoogleSheets($data);

        switch ($step) {
            case 3:
                // Handle data for step 3
                return response()->json(['data' => 'Data for step 3']);
            case 4:
                // Handle data for step 4
                return response()->json(['data' => 'Data for step 4']);
            case 5:
                // Handle data for step 5
                return response()->json(['data' => 'Data for step 5']);
            case 6:
                // Handle data for step 6
                return response()->json(['data' => 'Data for step 6']);
            case 7:
                // Handle data for step 7
                return response()->json(['data' => 'Data for step 7']);
            default:
                return response()->json(['error' => 'Invalid step'], 400);
        }
    }

    private function sendToGoogleSheets($data)
    {
        $client = new Google_Client();
        $client->setApplicationName('Your Application Name');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
        $client->setAuthConfig(storage_path('credentials.json')); // Path to your credentials.json file

        $service = new Google_Service_Sheets($client);
        $spreadsheetId = '1xEmaeEvhUieiO8rHk5gV1ifaeEEu4zIzWpf3rW2U8lM'; // Replace with your Google Spreadsheet ID
        $range = 'Sheet1!A1'; // Replace with your desired range

        $values = [
            array_values($data)
        ];

        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];

        $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
    }
}