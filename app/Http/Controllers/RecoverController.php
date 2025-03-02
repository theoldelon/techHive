<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RecoverController extends Controller
{
    /**
     * Display the recover password page.
     *
     * @return \Illuminate\View\View
     */
    public function recover()
    {
        return view('recover');
    }


    /**
     * Handle sending the password reset link.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLink(Request $request)
    {
        $messages = [
            'email.exists' => "The email you entered does not exist.",
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Send the password reset link
        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', 'Password reset link sent to your email address.');
        } else {
            return back()->withErrors(['email' => 'Unable to send password reset link. Please try again.']);
        }
    }



    /**
     * Show the password reset form.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
// In RecoverController.php
public function showResetForm(Request $request, $token = null)
{

    $token = $request->route('token');  // Get token from the route, if applicable

    return view('front.reset-password')->with([
        'token' => $token,
        'email' => $request->email
    ]);
}


    /**
     * Handle the password reset logic.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
{

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => [
            'required',
            'confirmed',
            'min:9', // Ensure password is confirmed and meets minimum length
            function ($attribute, $value, $fail) use ($request) {
                $user = \App\Models\User::where('email', $request->email)->first();
                if ($user && Hash::check($value, $user->password)) {
                    $fail('The new password cannot be the same as the old password.');
                }
            },
        ],
    ]);

    // If validation fails, return back with errors
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Attempt to reset the password
    $response = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user) use ($request) {
            // Update the user's password
            $user->forceFill([
                'password' => Hash::make($request->password),
            ])->save();
        }
    );

    // If the password was successfully reset
    if ($response == Password::PASSWORD_RESET) {
        // Delete the used token from the database
        \DB::table('password_resets')->where('email', $request->email)->delete();

        // Set a session message and pass it to the reset page
        session()->flash('status', 'Your password has been reset!');
        // No redirection here; stay on the current page
    }

    // If the reset link is invalid or expired, return error message
    if ($response == Password::INVALID_TOKEN) {
        return back()->withErrors(['email' => 'The reset link has expired or has already been used.']);
    }

    // If there is any other error, return the error message
    return back()->withErrors(['email' => 'You can now go to Login Page']);

}

}