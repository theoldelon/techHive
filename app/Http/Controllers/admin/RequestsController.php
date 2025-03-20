<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserRequest; // Correct model import
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    // List All Requests
    public function list(HttpRequest $request) {
        $query = UserRequest::with('employer'); // Load the employer relationship
    
        // Apply sorting
        if ($request->has('sort')) {
            if ($request->sort == '3') {
                $query->orderBy('request_date', 'desc'); // Latest Payments
            } elseif ($request->sort == '2') {
                $query->orderBy('request_date', 'asc'); // Earliest Payments
            } elseif ($request->sort == '1') {
                $query->where('isPaid', true); // Paid Payments
            } elseif ($request->sort == '0') {
                $query->where('isPaid', false); // Pending Payments
            }
        }
    
        // Apply keyword search
        if ($request->has('keyword')) {
            $query->whereHas('employer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }
    
        $requests = $query->paginate(10); // Paginate results
        return view('admin.requests.list', compact('requests')); // Corrected variable name
    }
    
    // Edit Page
    public function edit($id)
    {
        $request = UserRequest::findOrFail($id);

        // Pass the payment method explicitly if needed
        $paymentMethod = $request->payment_method;

        return view('admin.requests.edit', compact('request', 'paymentMethod'));
    }

    // Update Changes
    public function update(Request $request, $id) {
        // Get the UserRequest model instance
        $userRequest = UserRequest::findOrFail($id);
        
        // Check if 'proof' file is uploaded and update its path
        if ($request->hasFile('proof')) {  // This is the correct $request for handling file uploads
            // Delete old proof file if exists
            if ($userRequest->proof && Storage::exists('public/' . $userRequest->proof)) {
                Storage::delete('public/' . $userRequest->proof);
            }

            // Store the new proof file in 'public/storage/payments' with a generated filename
            $proofPath = $request->file('proof')->store('requests', 'public');
        
            // Save the relative path to the database (no 'public' prefix)
            $userRequest->proof = $proofPath;
        }
        
        // Update the payment status
        $userRequest->isPaid = $request->isPaid;  // Assuming you want to update this from the request

        // Save the updated payment record
        $userRequest->save();
        
        // Flash message for success
        session()->flash('success', 'Request Updated Successfully!');

        // Redirect to the payments list
        return redirect()->route('admin.requests.list');
}

}
