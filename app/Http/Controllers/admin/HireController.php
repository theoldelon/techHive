<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Hire;
use Illuminate\Http\Request;

class HireController extends Controller
{
    // Admin All Hire Details
    public function index(Request $request) {
        // Get the 'sort' parameter from the request; default to '1' (Latest)
        $sort = $request->get('sort', '1');
        
        // Query the hires with sorting based on hired_date
        $hires = Hire::with('job', 'freelancer', 'employer', 'payment') // Include the 'payment' relationship
        ->orderBy('hired_date', $sort == '0' ? 'ASC' : 'DESC')
        ->paginate(10);
    
    
        // Return the view with the sorted data
        return view('admin.hires.hires-list', [
            'hires' => $hires,
            'sort' => $sort, // Pass the sort value for use in the view
        ]);
    }    
    
    // Delete Job Application
    public function destroyJobApplication(Request $request) {
        $id = $request->id;

        $hire = Hire::find($id);

        if ($hire == null) {
            session()->flash('error','Hiring Transaction Not Found!');
            return response()->json([
                'status' => false,
            ]);
        }

        $hire->delete();
        session()->flash('success','Hiring Transaction Deleted Successfully!');
        return response()->json([
            'status' => true,
        ]);
    }
}
