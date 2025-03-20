<?php

namespace App\Http\Controllers\admin;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\FreelancerController;
use App\Http\Controllers\Controller;
use App\Models\Freelancers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class FreelancerVerificationController extends Controller
{
    // All Freelancer Verification Requests
    public function index(Request $request) {
        $sort = $request->get('sort', '1');
        $search = $request->get('keyword', '');  // Use 'keyword' instead of 'search'
        
        $freelancers = Freelancers::with('user:id,name');
        
        // Handle sorting
        if ($sort == '1') { // Latest
            $freelancers = $freelancers->orderBy('created_at', 'DESC');
        } elseif ($sort == '0') { // Oldest
            $freelancers = $freelancers->orderBy('created_at', 'ASC');
        } elseif ($sort == '2') { // Verified
            $freelancers = $freelancers->where('isVerified', 1)->orderBy('created_at', 'DESC');
        } elseif ($sort == '3') { // Pending
            $freelancers = $freelancers->where('isVerified', 0)->orderBy('created_at', 'DESC');
        }
        
        // Handle search if there's a search term
        if ($search != '') {
            $freelancers = $freelancers->where(function ($query) use ($search) {
                $query->where('id', 'like', "%$search%") // Search Freelancer ID
                      ->orWhereHas('user', function ($query) use ($search) {
                          $query->where('id', 'like', "%$search%")  // Search User ID
                                ->orWhere('name', 'like', "%$search%")
                                ->orWhere('email', 'like', "%$search%"); // Search User email
                      });
            });
        }
        
        $freelancers = $freelancers->paginate(10);
        
        return view('admin.freelancer-verifications.list', compact('freelancers', 'sort', 'search'));
    }
    
    // Admin - Edit Update Status of Verification Request
    public function edit($id) {
        $freelancer = Freelancers::findOrFail($id);

        return view('admin.freelancer-verifications.edit', [
            'freelancer' => $freelancer,
        ]);
    }

    // Admin - Update the Edited Freelancer Verification Request
    public function update(Request $request, $id) {
        $freelancer = Freelancers::findOrFail($id);
    
        // Check if files are uploaded and update paths accordingly
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $resumePath = $file->store('freelancers', 'public');
            $freelancer->resume = $resumePath;
        }
    
        if ($request->hasFile('valid_id')) {
            $file = $request->file('valid_id');
            $validIdPath = $file->store('freelancers', 'public');
            $freelancer->valid_id = $validIdPath;
        }
    
        if ($request->hasFile('selfie_with_id')) {
            $file = $request->file('selfie_with_id');
            $selfiePath = $file->store('freelancers', 'public');
            $freelancer->selfie_with_id = $selfiePath;
        }
    
        if ($request->hasFile('diploma')) {
            $file = $request->file('diploma');
            $diplomaPath = $file->store('freelancers', 'public');
            $freelancer->diploma = $diplomaPath;
        }
    
        if ($request->hasFile('certificate')) {
            $file = $request->file('certificate');
            $certificatePath = $file->store('freelancers', 'public');
            $freelancer->certificate = $certificatePath;
        }
    
        // Check if isVerified is being set properly
        Log::info('Updating freelancer status', ['isVerified' => $request->isVerified]);
    
        // Update freelancer verification status
        $freelancer->isVerified = $request->isVerified;
        $freelancer->isFeatured = $request->isFeatured ? 1 : 0;
        
        $freelancer->save();
    
        return redirect()->route('admin.freelancer-verifications.list')->with('success', 'Freelancer verification updated successfully!');
    }
    
    // Admin - View Resume
    public function viewResume($freelancerId)
    {
        // Find the freelancer
        $freelancer = Freelancers::findOrFail($freelancerId);
    
        // Retrieve the resume file name
        $resumeFileName = $freelancer->resume;
    
        // Remove any leading paths or slashes from the file name
        $resumeFileName = basename($resumeFileName);
    
        // Construct the correct public path
        $publicPath = asset('storage/freelancers/' . $resumeFileName);
    
        // Redirect the user to the public URL
        return redirect($publicPath);
    }    
    
    // Delete Freelancer Verification Request
    public function destroyVerification(Request $request) {
        $id = $request->id;

        $freelancers = Freelancers::find($id);

        if ($freelancers == null) {
            session()->flash('error','Freelancer Verification Request Not Found!');
            return response()->json([
                'status' => false,
            ]);
        }

        $freelancers->delete();
        session()->flash('success','Freelancer Verification Request Deleted Successfully!');
        return response()->json([
            'status' => true,
        ]);
    }
}
