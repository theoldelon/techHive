<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Hire;
use App\Models\User;
use App\Models\Review;
use App\Models\JobType;
use App\Models\Category;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Mail\JobNotificationEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{
    // Jobs Page
    public function index(Request $request) {

        $categories = Category::where('status',1)->get();
        $jobTypes = JobType::where('status',1)->get();

        $jobs = Job::where('status',1);

        // Search through Keywords
        if (!empty($request->keyword)) {
            $jobs = $jobs->where(function($query) use ($request){
                $query->orWhere('title','like','%'.$request->keyword.'%');
                $query->orWhere('keywords','like','%'.$request->keyword.'%');
            });
        }

        // Search through Location
        if (!empty($request->location)) {
            $jobs = $jobs->where('location',$request->location);
        }

        // Search through Category
        if (!empty($request->category)) {
            $jobs = $jobs->where('category_id',$request->category);
        }

        $jobTypeArray = [];
        // Search through Job Type
        if (!empty($request->jobType)) {
            $jobTypeArray = explode(',',$request->jobType);

            $jobs = $jobs->whereIn('job_type_id',$jobTypeArray);
        }

        // Search through Experience
        if (!empty($request->experience)) {
            $jobs = $jobs->where('experience',$request->experience);
        }

        $jobs = $jobs->with(['jobType','category']);

        if ($request->sort == '0') {
            $jobs = $jobs->orderBy('created_at','ASC');
        } else {
            $jobs = $jobs->orderBy('created_at','DESC');
        }
        
        $jobs = $jobs ->paginate(6);

        return view('front.jobs',[
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'jobs' => $jobs,
            'jobTypeArray' => $jobTypeArray,
        ]);
    }

    // Job Details Page
    public function detail($id) {

        $job = Job::where([
            'id' => $id,
            'status' => 1,
        ])->with(['jobType','category'])->first();

        if ($job == null) {
            abort(404);
        }

        $count = 0;

        if (Auth::user()) {

            $count = SavedJob::where([
                'user_id' => Auth::user()->id,
                'job_id' => $id,
            ])->count();
        }

        // Fetch Applicants

        $applications = JobApplication::where('job_id',$id)->with('user')->get();

        return view('front.jobDetail',['job' => $job,
                                        'count' => $count,
                                        'applications' => $applications
                                    ]);
    }

    // Apply Job Function
    public function applyJob(Request $request) {
        $id = $request->id;

        $job = Job::where('id',$id)->first();

        // If Job not found in DB
        if ($job == null) {
            $message = 'Job does not exist!';

            session()->flash('error',$message);
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }

        // User can't apply on their own Job
        $employer_id = $job->user_id;

        if ($employer_id == Auth::user()->id) {
            $message = 'You cannot apply on your own Job!';

            session()->flash('error', $message);
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }

        // User can't apply for the job twice
        $jobApplicationCount = JobApplication::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id,
        ])->count();

        if ($jobApplicationCount > 0) {
            $message = 'You have already applied for this job!';

            session()->flash('error', $message);
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }

        $application = new JobApplication();
        $application->job_id = $id;
        $application->user_id = Auth::user()->id;
        $application->employer_id = $employer_id;
        $application->applied_date = now();
        $application->save();

        // Send Notification Email to Employer
        $employer = User::where('id',$employer_id)->first();

        $mailData = [
            'employer' => $employer,
            'user' => Auth::user(),
            'job' => $job,
        ];

        Mail::to($employer->email)->send(new JobNotificationEmail($mailData));

        $message = 'You have successfully applied for this Job!';

        session()->flash('success', $message);
        return response()->json([
            'status' => false,
            'message' => $message,
        ]);
    }

    // Save Job Function
    public function saveTheJob(Request $request) {
        $id = $request->id;

        $job = Job::find($id);

        if ($job == null) {
            session()->flash('error','Job not found!');
            return response()->json([
                'status' => false,
            ]);
        }

        // Check if User already saved the job
        $count = SavedJob::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id,
        ])->count();

        if ($count > 0) {
            $message = 'You have already saved this Job!';

            session()->flash('error', $message);
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }

        $savedJob = new SavedJob;
        $savedJob->job_id = $id;
        $savedJob->user_id = Auth::user()->id;
        $savedJob->save();

        $message = 'Job saved successfully!';

        session()->flash('success', $message);
        return response()->json([
            'status' => false,
            'message' => $message,
        ]);
    }

    // Hire Freelancer
    public function hireFreelancer(Request $request) {
        // Step 1: Validate the incoming request
        $validated = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'freelancer_id' => 'required|exists:users,id',
            'application_id' => 'required|exists:job_applications,id',
        ]);
    
        // Step 2: Retrieve job, application, and other relevant entities
        $job = Job::find($validated['job_id']);
        $application = JobApplication::find($validated['application_id']);
        $freelancerId = $validated['freelancer_id'];
    
        Log::info('Hiring Process Initialized', [
            'job_id' => $job->id,
            'freelancer_id' => $freelancerId,
            'application_id' => $application->id,
        ]);
    
        // Step 3: Verify the employer is authorized
        if ($job->user_id != Auth::id()) {
            Log::error('Unauthorized employer', [
                'job_user_id' => $job->user_id,
                'auth_user_id' => Auth::id(),
            ]);
    
            return response()->json([
                'status' => false,
                'message' => 'You are not authorized to hire for this job!'
            ], 403);
        }
    
        // Step 4: Verify freelancer's application belongs to them
        if ($application->user_id != $freelancerId) {
            Log::error('Freelancer ID mismatch', [
                'application_user_id' => $application->user_id,
                'freelancer_id' => $freelancerId,
            ]);
    
            return response()->json([
                'status' => false,
                'message' => 'Application does not belong to the freelancer!'
            ], 400);
        }
    
        // Step 5: Check if the freelancer is already hired
        $existingHire = Hire::where([
            ['job_id', '=', $job->id],
            ['freelancer_id', '=', $freelancerId],
        ])->exists();
    
        if ($existingHire) {
            Log::error('Freelancer already hired', [
                'job_id' => $job->id,
                'freelancer_id' => $freelancerId,
            ]);
    
            return response()->json([
                'status' => false,
                'message' => 'This freelancer is already hired for the job.'
            ], 400);
        }
    
        // Step 6: Create the Hire record
        try {
            $hire = Hire::create([
                'job_id' => $job->id,
                'job_application_id' => $application->id,
                'freelancer_id' => $freelancerId,
                'employer_id' => Auth::id(),
                'hired_date' => now(),
            ]);
    
            Log::info('Freelancer hired successfully', [
                'hire_id' => $hire->id,
                'job_id' => $job->id,
                'freelancer_id' => $freelancerId,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Freelancer successfully hired!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error hiring freelancer', [
                'error' => $e->getMessage(),
                'job_id' => $job->id,
                'freelancer_id' => $freelancerId,
            ]);
    
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while hiring the freelancer. Please try again.',
            ], 500);
        }
    }
}