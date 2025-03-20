<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    // Admin - All Jobs
    public function index() {
        $jobs = Job::orderBy('created_at','DESC')->with('user','applications')->paginate(10);

        return view('admin.jobs.jobs-list',[
            'jobs' => $jobs,
        ]);
    }

    // Admin - Edit a Job
    public function edit($id) {
        $job = Job::findOrFail($id);

        $categories = Category::orderBy('name','ASC')->get();

        $jobTypes = JobType::orderBy('name','ASC')->get();

        // if ($job == null) {
        //     abort(404);
        // }

        return view('admin.jobs.job-edit',[
            'job' => $job,
            'categories' => $categories,
            'jobTypes' => $jobTypes,
        ]);
    }

    // Admin - Update the Edited Job
    public function update(Request $request, $id) {
    $job = Job::findOrFail($id);

    // Validation rules
    $rules = [
        'title' => 'required|min:5|max:255',
        'category' => 'required',
        'jobType' => 'required',
        'vacancy' => 'required',
        'salary' => 'required',
        'location' => 'required|min:5|max:70',
        'description' => 'required',
        'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'company_name' => 'required|min:5|max:70',
    ];

    // Validator
    $validator = Validator::make($request->all(), $rules);

    if ($validator->passes()) {
        $job = Job::find($id);

        if (!$job) {
            return response()->json([
                'status' => false,
                'errors' => ['job' => 'Job not found.']
            ]);
        }

        // Update job fields
        $job->title = $request->title;
        $job->category_id = $request->category;
        $job->job_type_id = $request->jobType;
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
        $job->status = $request->status;
        $job->isFeatured = (!empty($request->isFeatured)) ? $request->isFeatured : 0;

        // Handle file upload for company logo
        if ($request->hasFile('company_logo')) {
            try {
                // Delete the old logo if it exists
                if ($job->company_logo) {
                    $oldFilePath = str_replace('storage/', '', $job->company_logo); // Fix the path
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

        // Save the job to the database
        $job->save();

        // Success message
        session()->flash('success', 'Job Updated Successfully!');

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
    public function destroyJob(Request $request) {
        $id = $request->id;

        $job = Job::find($id);

        if ($job == null) {
            session()->flash('error','Job Not Found!');
            return response()->json([
                'status' => false,
            ]);
        }

        $job->delete();
        session()->flash('success','Job Deleted Successfully!');
        return response()->json([
            'status' => true,
        ]);
    }
}
