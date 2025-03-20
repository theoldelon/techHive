<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    // Admin All Job Applications
    public function index() {
        $applications = JobApplication::orderBy('created_at','DESC')
                        ->with('job','user','employer')
                        ->paginate(10);

        return view('admin.job-applications.job-applications-list',[
            'applications' => $applications,
        ]);
    }

    // Delete Job Application
    public function destroyJobApplication(Request $request) {
        $id = $request->id;

        $jobApplication = JobApplication::find($id);

        if ($jobApplication == null) {
            session()->flash('error','Job Application Not Found!');
            return response()->json([
                'status' => false,
            ]);
        }

        $jobApplication->delete();
        session()->flash('success','Job Application Deleted Successfully!');
        return response()->json([
            'status' => true,
        ]);
    }
}
