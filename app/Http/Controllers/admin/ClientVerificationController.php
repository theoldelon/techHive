<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientVerificationController extends Controller
{
    // All Client Verification Request
    public function index(Request $request) {
        $sort = $request->get('sort', '1');
        $search = $request->get('keyword', '');  // Use 'keyword' instead of 'search'
        
        $clients = Clients::with('user:id,name');
        
        // Handle sorting
        if ($sort == '1') { // Latest
            $clients = $clients->orderBy('created_at', 'DESC');
        } elseif ($sort == '0') { // Oldest
            $clients = $clients->orderBy('created_at', 'ASC');
        } elseif ($sort == '2') { // Verified
            $clients = $clients->where('isVerified', 1)->orderBy('created_at', 'DESC');
        } elseif ($sort == '3') { // Pending
            $clients = $clients->where('isVerified', 0)->orderBy('created_at', 'DESC');
        }
        
        // Handle search if there's a search term
        if ($search != '') {
            $clients = $clients->where(function ($query) use ($search) {
                $query->where('id', 'like', "%$search%") // Search Freelancer ID
                      ->orWhereHas('user', function ($query) use ($search) {
                          $query->where('id', 'like', "%$search%")  // Search User ID
                                ->orWhere('name', 'like', "%$search%")
                                ->orWhere('email', 'like', "%$search%"); // Search User email
                      });
            });
        }
        
        $clients = $clients->paginate(10);
        
        return view('admin.client-verifications.list', compact('clients', 'sort', 'search'));
    }

    // Admin - Edit Update Status of Verification Request
    public function edit($id) {
        $client = Clients::findOrFail($id);
    
        return view('admin.client-verifications.edit', [
            'client' => $client, // Change 'clients' to 'client'
        ]);
    }
    

    // Admin - Update the Edited Job
    public function update(Request $request, $id) {
        $client = Clients::findOrFail($id);
    
        // Check if files are uploaded and update paths accordingly
        if ($request->hasFile('valid_id')) {
            $file = $request->file('valid_id');
            $validIdPath = $file->store('clients', 'public');
            $client->valid_id = $validIdPath;
        }
    
        if ($request->hasFile('selfie_with_id')) {
            $file = $request->file('selfie_with_id');
            $selfiePath = $file->store('clients', 'public');
            $client->selfie_with_id = $selfiePath;
        }
    
        if ($request->hasFile('business_permit')) {
            $file = $request->file('business_permit');
            $business_permitPath = $file->store('clients', 'public');
            $client->business_permit = $business_permitPath;
        }
    
        if ($request->hasFile('dti_registration')) {
            $file = $request->file('dti_registration');
            $dti_registrationPath = $file->store('clients', 'public');
            $client->dti_registration = $dti_registrationPath;
        }

        if ($request->hasFile('sec_registration')) {
            $file = $request->file('sec_registration');
            $sec_registrationPath = $file->store('clients', 'public');
            $client->sec_registration = $sec_registrationPath;
        }
    
        // Check if isVerified is being set properly
        Log::info('Updating freelancer status', ['isVerified' => $request->isVerified]);
    
        // Update freelancer verification status
        $client->isVerified = $request->isVerified;
        $client->isFeatured = $request->isFeatured ? 1 : 0;
        
        $client->save();
    
        return redirect()->route('admin.client-verifications.list')->with('success', 'Client verification updated successfully!');
    }

    // Delete Client Verification Request
    public function destroyVerification(Request $request) {
        $id = $request->id;

        $clients = Clients::find($id);

        if ($clients == null) {
            session()->flash('error','Client Verification Request Not Found!');
            return response()->json([
                'status' => false,
            ]);
        }

        $clients->delete();
        session()->flash('success','Client Verification Request Deleted Successfully!');
        return response()->json([
            'status' => true,
        ]);
    }
}
