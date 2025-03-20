<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Hire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // Open Payment Form
    public function showPaymentForm($paymentId) {
        // Load the payment with the associated hire, freelancer, and employer
        $payment = Payment::with('hire', 'freelancer', 'employer')->findOrFail($paymentId);
    
        // Ensure `hireId` is defined
        $hireId = $payment->hire ? $payment->hire->id : null;
    
        // Pass the payment and hireId to the view
        return view('front.account.edit-hires.payment.form', compact('payment', 'hireId'));
    }
    
    // Store Payment Details
    public function sendPayment(Request $request) {
        // Step 1: Validate the request
        $validated = $request->validate([
            'hire_id' => 'required|exists:hires,id',
            'employer_id' => 'required|exists:users,id',
            'freelancer_id' => 'required|exists:users,id',
            'reference_id' => 'required|string',
            'payment_method' => 'required|integer',
            'bank_name' => 'nullable|string',
            'proof' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
            'job_salary' => 'required|numeric', // Validate job_salary
            'service_fee' => 'required|numeric', // Validate service_fee
            'amount_payable' => 'required|numeric', // Validate amount_payable
        ]);
        
        // Step 2: Handle proof file if uploaded
        if ($request->hasFile('proof')) {
            // Store the proof file and assign the path to the validated data
            $validated['proof'] = $request->file('proof')->store('payment_proofs', 'public');
        }
    
        // Step 3: Create the payment record
        try {
            // Create a new payment record using the validated data
            Payment::create([
                'hire_id' => $validated['hire_id'],
                'employer_id' => $validated['employer_id'],
                'freelancer_id' => $validated['freelancer_id'],
                'reference_id' => $validated['reference_id'],
                'payment_method' => $validated['payment_method'],
                'bank_name' => $validated['bank_name'] ?? null, // Nullable field
                'proof' => $validated['proof'] ?? null, // Nullable field
                'job_salary' => $validated['job_salary'],
                'service_fee' => $validated['service_fee'],
                'amount_payable' => $validated['amount_payable'],
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging and return back with an error message
            Log::error('Payment creation failed: ' . $e->getMessage());
            return back()->withErrors('Error creating payment.')->withInput();
        }
    
        // Step 4: Redirect with success message
        return redirect()->route('account.hires')->with('success', 'Payment record created successfully!');
    }
}
