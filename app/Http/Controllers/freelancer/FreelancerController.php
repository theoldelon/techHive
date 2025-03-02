<?php

namespace App\Http\Controllers\freelancer;

use App\Http\Controllers\Controller;
use App\Models\Freelancers;
use App\Models\Hire;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FreelancerController extends Controller
{

    // Freelancer Dashboard
    public function freelancerDashboard() {
        $user = Auth::user(); 

        return view ('freelancer.freelancer-dashboard', compact('user'));
    }

    // Freelancer Verify Now Page
    public function verifyNow() {
        return view ('freelancer.verify-now');
    }

    // Verify Credentials Function
    public function verifyCredentials(Request $request) {
        $user = Auth::user();
        
        // Use firstOrNew instead of firstOrCreate
        $freelancer = Freelancers::firstOrNew(['user_id' => $user->id]);
    
        // Validate the files
        $request->validate([
            'valid_id' => 'nullable|mimes:png,jpg,jpeg,webp',
            'selfie_with_id' => 'nullable|mimes:png,jpg,jpeg,webp',
            'diploma' => 'nullable|mimes:png,jpg,jpeg,webp',
            'certificate' => 'nullable|mimes:png,jpg,jpeg,webp',
            'resume' => 'nullable|mimes:pdf,doc,docx',
            'profile_picture' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048', // Added validation for profile picture
        ], [
            'valid_id.mimes' => 'Valid ID must be a file of type: png, jpg, jpeg, webp.',
            'selfie_with_id.mimes' => 'Selfie with Valid ID must be a file of type: png, jpg, jpeg, webp.',
            'diploma.mimes' => 'Diploma must be a file of type: png, jpg, jpeg, webp.',
            'certificate.mimes' => 'Certificate must be a file of type: png, jpg, jpeg, webp.',
            'resume.mimes' => 'Resume must be a file of type: pdf, doc, docx.',
            'profile_picture.mimes' => 'Profile Picture must be a file of type: png, jpg, jpeg, webp.',
            'profile_picture.max' => 'Profile Picture must not exceed 2MB.',
        ]);
        
        $uploadedFiles = [];
    
        // Loop through all possible file fields including profile_picture
        foreach (['valid_id', 'selfie_with_id', 'diploma', 'certificate', 'resume', 'profile_picture'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $filePath = $file->storeAs(
                    'freelancers', // Directory within 'storage/app'
                    time() . '_' . $fileField . '.' . $file->getClientOriginalExtension(),
                    'public' // Store in the 'public' disk
                );
    
                // Set the file path in the freelancer model instance
                $freelancer->$fileField = '/storage/' . $filePath;
                $uploadedFiles[$fileField] = $filePath;
            }
        }
    
        // Save the instance to persist all updates at once
        $freelancer->save();
    
        // Check if any files were uploaded and return the appropriate response
        if (count($uploadedFiles) > 0) {
            session()->flash('success', 'Credentials Updated Successfully!');
            return response()->json([
                'status' => true,
                'errors' => [],
                'uploaded_files' => $uploadedFiles
            ]);
        } else {
            session()->flash('error', 'No credentials uploaded!');
            return response()->json([
                'status' => false,
                'errors' => ['No files uploaded.'],
            ]);
        }
    }
    

    // Details of the Hiring Transaction
    public function hireDetails($id) {
        // Fetch the transaction and related job details
        $transaction = JobApplication::findOrFail($id);
        $job = $transaction->job; // assuming there's a relationship between JobApplication and Job
    
        // Fetch related hire details if necessary
        $hire = Hire::where('job_id', $job->id)->first(); // Adjust the condition as needed
    
        return view('freelancer.hire-details', compact('transaction', 'job', 'hire'));
    }    

    // Freelancer Update Project Link
    public function updateLink(Request $request, $id) {
        
        // Retrieve the hire record and check if it exists
        $hire = Hire::find($id);
        
        if (!$hire) {
            return redirect()->back()->with('error', 'Hire record not found.');
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'progress_link' => 'required',
            'hire_status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        // Update the hire record
        $hire->progress_link = $request->progress_link;
        $hire->hire_status = $request->hire_status;
        $hire->save();

        // Return a success response
        return redirect()->back()->with('success', 'Project Progress Link Updated Successfully!');
    }
}
