<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\Category;
use App\Models\Hire;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\UserRequest;
use App\Models\SavedJob;
use App\Models\Clients;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    // User Registration Page
    public function registration()
    {
        return view('front.account.registration');
    }

    // Client Registration Page
    public function clientRegistration()
    {
        return view('front.account.clientRegistration');
    }

    // Freelancer Registration Page
    public function freelancerRegistration()
    {
        return view('front.account.freelancerRegistration');
    }

    //  Client Register Method
    public function processRegistration(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:confirmPassword',
            'confirmPassword' => 'required',
            'role' => 'required|in:user',
        ]);

        // Check validation
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Register user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Flash success message
        session()->flash('success', 'You have registered successfully!');

        // Redirect to login page after successful registration
        return response()->json([
            'status' => true,
            'redirect' => route('account.login'), // Ensure this URL points to your login route
        ]);
    }

    //  Freelancer Register Method
    public function processFreelancerRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:confirmPassword',
            'confirmPassword' => 'required',
            'role' => 'required|in:freelancer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        session()->flash('success', 'You have registered successfully!');

        return response()->json([
            'status' => true,
            'redirect' => route('account.login'),
        ]);
    }

    // User Login Page
    public function login(Request $request)
    {

        return view('front.account.login');
    }

    // Shows the Blocked Page if the user is Blocked
    public function blocked()
    {
        return view('front.blocked');
    }

    // User Login Method
    public function authenticate(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if validation passes
        if ($validator->passes()) {
            // Attempt to log the user in with the provided credentials
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user(); // Get the authenticated user

                // Check if user is active
                if ($user->isActive == 0) {
                    Auth::logout();
                    return redirect()->route('account.blocked');
                }

                // Redirect based on user role (admin or normal user)
                if ($user->role === 'admin') {
                    // Redirect admin to the admin dashboard
                    return redirect()->route('admin.dashboard');
                }

                // Redirect normal user to their account page
                return redirect()->intended(route('account.show', ['id' => $user->id]));
            } else {
                // Invalid credentials
                return redirect()->route('account.login')->with('error', 'Invalid credentials.');
            }
        } else {
            // Validation failed, redirect back with errors
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    // User Profile Page
    public function profile()
    {

        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();

        return view('front.account.profile', [
            'user' => $user
        ]);
    }

    // USer Profile Page Update Method
    public function updateProfile(Request $request)
    {

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
        ]);

        if ($validator->passes()) {

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->designation = $request->designation;
            $user->mobile = $request->mobile;
            $user->about = $request->about;
            $user->education = $request->education;
            $user->career_start = $request->career_start;
            $user->experience = $request->experience;
            $user->other = $request->other;
            $user->portfolio = $request->portfolio;
            $user->facebook = $request->facebook;
            $user->instagram = $request->instagram;
            $user->twitter = $request->twitter;
            $user->tiktok = $request->tiktok;
            $user->youtube = $request->youtube;
            $user->github = $request->github;
            $user->save();

            session()->flash('success', 'Profile Updated Successfully!');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    // User Logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Clear the session to prevent any cached data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Return redirect with proper headers
        return redirect()->route('account.login')->with('status', 'Logged out successfully.')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    // Create Job
    public function createJob()
    {

        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
        // $categories = Category::orderBy('name', 'ASC')->get();

        $jobTypes = JobType::orderBy('name', 'ASC')->where('status', 1)->get();
        // $jobTypes = JobType::orderBy('name', 'ASC')->get();

        return view('front.account.job.create', [
            'categories' => $categories,
            'jobTypes' => $jobTypes,
        ]);
    }

    // Save the Created Job
    public function saveJob(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required',
            'salary' => 'required',
            'location' => 'required|min:5|max:70',
            'description' => 'required',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'company_name' => 'required|min:5|max:70',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $job = new Job();
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->user_id = $user->id;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->website;

            // Handle file upload for company logo
            if ($request->hasFile('company_logo')) {
                try {
                    $file = $request->file('company_logo');
                    $filename = time() . '_company_logo.' . $file->getClientOriginalExtension();
                    $filePath = public_path('/clients/');
                    $file->move($filePath, $filename);
                    $job->company_logo = '/clients/' . $filename; // Assign file path to model
                } catch (\Exception $e) {
                    Log::error('File upload failed: ' . $e->getMessage());
                    return response()->json([
                        'status' => false,
                        'errors' => ['company_logo' => 'Error uploading logo.']
                    ]);
                }
            }

            $job->save();

            session()->flash('success', 'Job added successfully!');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    // All Client Requests Page
    public function myRequests()
    {
        $requests = UserRequest::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('front.account.my-requests', [
            'requests' => $requests
        ]);
    }

    // Feature a Job Request
    public function featureRequest(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'job_id' => 'required|integer', // User-inputted field
            'job_title' => 'required|string|max:255',
            'reference_id' => 'required|string|max:255',
            'bank_name' => 'nullable|string',
            'payment_method' => 'required|in:0,1,2', // Validate against expected options (e.g., 0 = Bank, 1 = PayPal, 2 = GCash)
            'proof' => 'required|mimes:png,jpg,jpeg,webp|max:20480', // Ensure file is an image
        ]);

        // Create a new instance of the model
        $userRequest = new UserRequest();
        $userRequest->job_id = $validated['job_id']; // User-inputted field
        $userRequest->job_title = $validated['job_title']; // User-inputted field
        $userRequest->bank_name = $validated['bank_name'] ?? null; // Assign null if not provided
        $userRequest->user_id = Auth::id(); // Automatically associate the logged-in user
        $userRequest->reference_id = $validated['reference_id'];
        $userRequest->payment_method = $validated['payment_method'];
        $userRequest->proof = $request->file('proof')->store('requests', 'public'); // Save the uploaded file in storage/app/public/requests
        $userRequest->amount_payable = '₱199'; // Assign the fixed value for amount_payable

        $userRequest->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your request has been successfully sent!');
    }

    // Posted Jobs
    public function myJobs()
    {

        $jobs = Job::where('user_id', Auth::user()->id)->with('jobType')->orderBy('created_at', 'DESC')->paginate(10);

        return view('front.account.job.my-jobs', [
            'jobs' => $jobs
        ]);
    }

    // Edit Posted Jobs
    public function editJob(Request $request, $id)
    {

        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
        $jobTypes = JobType::orderBy('name', 'ASC')->where('status', 1)->get();

        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $id,
        ])->first();

        if ($job == null) {
            abort(404);
        }

        return view('front.account.job.edit', [
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'job' => $job,
        ]);
    }

    // Update Job Changes
    public function updateJob(Request $request, $id)
    {
        $rules = [
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'salary' => 'required',
            'location' => 'required|min:5|max:70',
            'description' => 'required',
            'company_name' => 'required|min:5|max:70',
            'status' => 'nullable|in:0,1', // Assuming 'status' is either 0 (inactive) or 1 (active)
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $job = Job::find($id);

            if (!$job) {
                return response()->json([
                    'status' => false,
                    'errors' => ['job' => 'Job not found.']
                ]);
            }

            // Update the job fields
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->company_name = $request->company_name;

            // Handle optional status update
            if ($request->has('status')) {
                $job->status = $request->status;
            }

            // Handle file upload for company logo
            if ($request->hasFile('company_logo')) {
                try {
                    // Delete the old logo if it exists
                    if ($job->company_logo) {
                        $oldFilePath = str_replace('storage/', '', $job->company_logo);
                        Storage::delete('public/' . $oldFilePath); // Delete old logo
                    }

                    // Upload the new logo
                    $file = $request->file('company_logo');
                    $filename = time() . '_company_logo.' . $file->getClientOriginalExtension();

                    // Store the file in the 'public/clients' directory
                    $path = $file->storeAs('public/clients', $filename);

                    // Assign the relative path for database storage
                    $job->company_logo = 'storage/clients/' . $filename;
                } catch (\Exception $e) {
                    Log::error('File upload failed: ' . $e->getMessage());
                    return response()->json([
                        'status' => false,
                        'errors' => ['company_logo' => 'Error uploading logo.']
                    ]);
                }
            }

            $job->save();

            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    // Delete Job
    public function deleteJob(Request $request)
    {

        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $request->jobId
        ])->first();

        if ($job == null) {
            session()->flash('error', 'Job Not Found!');
            return response()->json([
                'status' => true
            ]);
        }

        Job::where('id', $request->jobId)->delete();
        session()->flash('success', 'Job Deleted Successfully!');
        return response()->json([
            'status' => true,
        ]);
    }

    public function myJobApplications()
    {
        $jobApplications = JobApplication::where('user_id', Auth::user()->id)
            ->with(['job', 'job.jobType', 'job.applications'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('front.account.job.my-job-applications', [
            'jobApplications' => $jobApplications,
        ]);
    }

    public function removeJobs(Request $request)
    {
        $jobApplication = JobApplication::where([
            'id' => $request->id,
            'user_id' => Auth::user()->id,
        ])->first();

        if ($jobApplication == null) {
            session()->flash('error', 'Job Application not found!');

            return response()->json([
                'status' => false,
            ]);
        }

        JobApplication::find($request->id)->delete();

        session()->flash('success', 'Job Application removed successfully!');

        return response()->json([
            'status' => true,
        ]);
    }

    public function savedJobs()
    {

        $savedJobs = SavedJob::where([
            'user_id' => Auth::user()->id,
        ])
            ->with(['job', 'job.jobType', 'job.applications'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('front.account.job.saved-jobs', [
            'savedJobs' => $savedJobs,
        ]);
    }

    public function removeSavedJob(Request $request)
    {
        $savedJob = SavedJob::where([
            'id' => $request->id,
            'user_id' => Auth::user()->id,
        ])->first();

        if ($savedJob == null) {
            session()->flash('error', 'No Jobs saved. Save a Job Now!');

            return response()->json([
                'status' => false,
            ]);
        }

        SavedJob::find($request->id)->delete();

        session()->flash('success', 'Saved Job removed successfully!');

        return response()->json([
            'status' => true,
        ]);
    }

    // User Profile Page
    public function accountPassword()
    {

        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();

        return view('front.account.accountPassword', [
            'user' => $user
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        };

        if (Hash::check($request->old_password, Auth::user()->password) == false) {
            session()->flash('error', 'Your Old Password is incorrect!');

            return response()->json([
                'status' => true,
            ]);
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        session()->flash('success', 'Password updated successfully!');

        return response()->json([
            'status' => true,
        ]);
    }

    // Forgot Password Password
    public function forgotPassword()
    {
        return view('front.account.forgot-password');
    }

    public function processForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.forgotPassword')->withInput()->withErrors($validator);
        }

        $token = Str::random(10);

        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        \DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Send Email Here
        $user = User::where('email', $request->email)->first();

        $mailData = [
            'token' => $token,
            'user' => $user,
            'subject' => 'Password Reset Request',
        ];

        Mail::to($request->email)->send(new ResetPasswordEmail($mailData));

        return redirect()->route('account.forgotPassword')->with('success', 'Password Reset email has been successfully sent to your email address!');
    }

    public function resetPassword($tokenString)
    {
        $token = \DB::table('password_reset_tokens')->where('token', $tokenString)->first();

        if ($token == null) {
            return redirect()->route('account.forgotPassword')->with('error', 'Invalid token!');
        }

        return view('front.account.reset-password', [
            'tokenString' => $tokenString,
        ]);
    }

    public function processResetPassword(Request $request)
    {
        $token = \DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if ($token == null) {
            return redirect()->route('account.forgotPassword')->with('error', 'Invalid token!');
        }

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:5',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.resetPassword', $request->token)->withErrors($validator);
        }

        User::where('email', $token->email)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('account.login')->with('success', 'You have successfully changed your password!');
    }

    // Visit User Profile Page
    public function show($id)
    {
        // Find the user by the ID passed to the method
        $user = User::findOrFail($id);

        // Find the job related to the user
        $job = $user->job;

        // Pass both user and job data to the view
        return view('front.account.show', compact('user', 'job'));
    }

    // Show Hired Freelancers
    public function hiredFreelancers(Request $request)
    {
        // Get the 'sort' parameter from the request; default to '1' (Latest)
        $sort = $request->get('sort', '1');

        // Query the hires with sorting based on hired_date
        $hires = Hire::with('job') // Only eager load the 'job' relationship
            ->orderBy('hired_date', $sort == '0' ? 'ASC' : 'DESC') // Sort by hired_date
            ->paginate(10);

        // Return the view with the sorted data
        return view('front.account.hires', [
            'hires' => $hires,
            'sort' => $sort, // Pass the sort value for use in the view
        ]);
    }

    // Client Verify Now Page
    public function verifyNow()
    {
        return view('front.account.client-verify');
    }

    // Verify Credentials Function
    public function verifyCredentials(Request $request)
    {
        $user = Auth::user();

        // Use firstOrNew instead of firstOrCreate
        $client = Clients::firstOrNew(['user_id' => $user->id]);

        // Validate the incoming files including profile_picture
        $request->validate([
            'valid_id' => 'nullable|mimes:png,jpg,jpeg,webp|max:20480',
            'selfie_with_id' => 'nullable|mimes:png,jpg,jpeg,webp|max:20480',
            'business_permit' => 'nullable|mimes:png,jpg,jpeg,webp|max:20480',
            'dti_registration' => 'nullable|mimes:png,jpg,jpeg,webp|max:20480',
            'sec_registration' => 'nullable|mimes:png,jpg,jpeg,webp|max:20480',
            'profile_picture' => 'nullable|mimes:png,jpg,jpeg,webp|max:20480', // Added validation for profile picture
        ], [
            'valid_id.mimes' => 'Valid ID must be a file of type: png, jpg, jpeg, webp.',
            'valid_id.max' => 'Valid ID must not exceed 2MB.',
            'selfie_with_id.mimes' => 'Selfie with Valid ID must be a file of type: png, jpg, jpeg, webp.',
            'selfie_with_id.max' => 'Selfie with Valid ID must not exceed 2MB.',
            'business_permit.mimes' => 'Business Permit must be a file of type: png, jpg, jpeg, webp.',
            'business_permit.max' => 'Business Permit must not exceed 2MB.',
            'dti_registration.mimes' => 'DTI Registration must be a file of type: png, jpg, jpeg, webp.',
            'dti_registration.max' => 'DTI Registration must not exceed 2MB.',
            'sec_registration.mimes' => 'SEC Registration must be a file of type: png, jpg, jpeg, webp.',
            'sec_registration.max' => 'SEC Registration must not exceed 2MB.',
            'profile_picture.mimes' => 'Profile Picture must be a file of type: png, jpg, jpeg, webp.',
            'profile_picture.max' => 'Profile Picture must not exceed 2MB.',
        ]);

        $uploadedFiles = [];

        // Loop through file fields and handle uploads
        foreach (['valid_id', 'selfie_with_id', 'business_permit', 'dti_registration', 'sec_registration'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $filePath = $file->storeAs(
                    'clients', // Store in 'public/storage/clients'
                    time() . '_' . $fileField . '.' . $file->getClientOriginalExtension(),
                    'public' // Store in the 'public' disk
                );

                // Set the file path in the client model instance
                $client->$fileField = '/storage/' . $filePath;
                $uploadedFiles[$fileField] = $filePath;
            }
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $profilePicturePath = $file->storeAs(
                'clients', // Store in 'public/storage/clients'
                time() . '_profile_picture.' . $file->getClientOriginalExtension(),
                'public' // Store in the 'public' disk
            );

            // Set the profile picture path in the client model instance
            $client->profile_picture = '/storage/' . $profilePicturePath;
            $uploadedFiles['profile_picture'] = $profilePicturePath;
        }

        // Save the instance to persist all updates at once
        $client->save();

        // Check if any files were uploaded
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


    // View Hire Transaction
    public function editHires($hireId)
    {
        $hire = Hire::with('job', 'freelancer', 'employer')->find($hireId); // Eager load job and freelancer

        return view('front.account.edit-hires', [
            'hire' => $hire,
            'freelancer' => $hire->freelancer,
            'client' => $hire->employer,
            'job' => $hire->job, // Pass job data to the view
        ]);
    }

    // Update Hire Transaction
    public function updateHires(Request $request, $hireId)
    {
        // Use $hireId passed as a parameter to find the specific hire
        $hire = Hire::with('job', 'freelancer', 'employer')->find($hireId);

        if (!$hire) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'errors' => ['Hire not found.']
                ]);
            } else {
                return redirect()->back()->withErrors(['Hire not found.']);
            }
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'assessment_link' => 'required',
            'hire_status' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            } else {
                return redirect()->back()->withErrors($validator->errors());
            }
        }

        // Update the hire record
        $hire->assessment_link = $request->assessment_link;
        $hire->hire_status = $request->hire_status;
        $hire->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return redirect()->back()->with('success', 'Hire Transaction Updated Successfully!');
        }
    }
}
