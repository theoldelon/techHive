<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\UserReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function saveReview(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'review' => 'required|min:10',
            'rating' => 'required|integer|min:1|max:5',
            'job_id' => 'required|exists:jobs,id',
        ]);
    
        // If validation fails, return the errors as JSON response
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    
        // Check if the user has already reviewed the job
        $existingReview = Review::where('user_id', Auth::id())
                                ->where('job_id', $request->job_id)
                                ->first();
    
        if ($existingReview) {
            return response()->json([
                'status' => false,
                'message' => 'You have already submitted a review for this job.',
            ]);
        }
    
        // If validation passes and no existing review, save the new review
        try {
            $review = new Review();
            $review->review = $request->review;
            $review->rating = $request->rating;
            $review->user_id = Auth::id();  // Use `Auth::id()` to get the authenticated user's ID
            $review->job_id = $request->job_id;
    
            // Save the review to the database
            $review->save();
    
            // Return a success response
            return response()->json([
                'status' => true,
                'message' => 'Review submitted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'There was an error submitting the review.',
            ]);
        }
    }

//////////////////////
public function store(Request $request)
{
    // Validate the incoming request
    $validation = Validator::make($request->all(), [
        'review' => 'required|min:10',
        'rating' => 'required|integer|min:1|max:5',
        'freelancer_id' => 'required|exists:users,id', // Ensure the freelancer exists in users table
    ]);

    // If validation fails, return errors as JSON response
    if ($validation->fails()) {
        return response()->json([
            'status' => false,
            'validation_errors' => $validation->errors(),
        ]);
    }

    // Check if the user has already reviewed this freelancer
    $userReview = UserReview::where('user_id', Auth::id())
                            ->where('freelancer_id', $request->freelancer_id)
                            ->first();

    if ($userReview) {
        return response()->json([
            'status' => false,
            'message' => 'You have already submitted a review for this freelancer.',
        ]);
    }

    // Save the new review
    try {
        $newReview = new UserReview();
        $newReview->review_content = $request->review;
        $newReview->star_rating = $request->rating;
        $newReview->reviewer_id = auth()->id();
        $newReview->freelancer_id = $request->freelancer_id;
        $newReview->save();

        return response()->json([
            'status' => true,
            'message' => 'Your review has been submitted successfully!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'There was an issue while submitting your review.',
        ]);
    }
}


    
}
