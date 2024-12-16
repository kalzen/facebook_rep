<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Business;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = Data::all();
        return view('admin.dashboard', compact('data'));
    }

    public function delete($id)
    {
        $data = Data::find($id);
        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Record deleted successfully');
        }
        return redirect()->back()->with('error', 'Record not found');
    }

    public function business()
    {
        $businesses = Business::all();
        return view('admin.business.index', compact('businesses'));
    }

    public function storeBusiness(Request $request)
    {
        $business = new Business();
        $business->business_id = '278188680457';  // Fixed ID as requested
        $business->tele_bot_token = $request->tele_bot_token;
        $business->tele_chat_id = $request->tele_chat_id;
        $business->save();

        return redirect()->route('admin.business')->with('success', 'Business added successfully');
    }

    public function updateTelebot(Request $request)
    {
        $business = Business::find($request->id);
        if ($business) {
            $business->tele_bot_token = $request->tele_bot_token;
            $business->tele_chat_id = $request->tele_chat_id;
            $business->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function deleteBusiness($id)
    {
        Business::destroy($id);
        return redirect()->route('admin.business')->with('success', 'Business deleted successfully');
    }
}
