<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Admin Dashboard - All Users
    public function index(Request $request) {

        // Start the query builder
        $users = User::orderBy('created_at','DESC');
    
        // Check if there is a search keyword and filter the results
        if ($request->has('keyword') && $request->get('keyword') != '') {
            $keyword = $request->get('keyword');
            $users = $users->where(function($query) use ($keyword) {
                $query->where('id', 'like', '%' . $keyword . '%')
                      ->orWhere('name', 'like', '%' . $keyword . '%')
                      ->orWhere('email', 'like', '%' . $keyword . '%')
                      ->orWhere('mobile', 'like', '%' . $keyword . '%')
                      ->orWhere('role', 'like', '%' . $keyword . '%');
            });
        }
    
        // Apply role-based filtering based on the request
        if ($request->sort == '3') {
            // Display all users
            $users = $users->whereIn('role', ['admin', 'freelancer','user']);
        } else if ($request->sort == '2') {
            // Display only admins
            $users = $users->where('role', 'admin');
        } else if ($request->sort == '1') {
            // Display only freelancers
            $users = $users->where('role', 'freelancer');
        } else if ($request->sort == '0') {
            // Display only clients
            $users = $users->where('role', 'user');
        }
    
        // Apply pagination
        $users = $users->paginate(6);
    
        return view('admin.users.list', [
            'users' => $users
        ]);
    }
    
    
    

    // Admin Function - Open Edit User Page
    public function edit($id) {
        $user = User::findOrFail($id);

        $roles = User::select('role')->distinct()->pluck('role'); // Get unique roles

        return view('admin.users.edit',[
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    // Admin Function - Save Edited User Page
    public function update($id, Request $request) {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'role' => 'required', 
        ]);

        if ($validator->passes()) {

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->designation = $request->designation;
            $user->mobile = $request->mobile;
            $user->role = $request->role; 
            $user->isActive = $request->isActive;
            $user->save();

            session()->flash('success','User Profile Updated Successfully!');

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

    // Admin Function - Delete User
    public function destroy(Request $request) {
        $id = $request->id;

        $user = User::find($id);

        if ($user == null) {
            session()->flash('error','User Not Found!');
            return response()->json([
                'status' => false,
            ]);
        }

        $user->delete();
        session()->flash('success','User Deleted Successfully!');
            return response()->json([
                'status' => true,
            ]);
    }

    // Admin Create User
    public function create() {
        $roles = User::select('role')->distinct()->pluck('role'); 
        $user = new User(); // Create an empty User instance
    
        return view('admin.users.create', compact('roles', 'user'));
    }
    

    //  Admin Process User Registration
    public function processRegister(Request $request) {
        $roles = User::select('role')->distinct()->pluck('role')->toArray(); // Get unique roles as an array
    
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:' . implode(',', $roles), // Allow only roles from the database
            'password' => 'required|min:6|same:confirmPassword',
            'confirmPassword' => 'required',
        ]);
    
        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->password = Hash::make($request->password);
            $user->save();
    
            session()->flash('success', 'User Created Successfully!');
    
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
    
    
}
