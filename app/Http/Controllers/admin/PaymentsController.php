<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentsController extends Controller
{
    // List All Payments
    public function list(Request $request)
    {
        $query = Payment::with(['hire', 'employer', 'freelancer']); // Include relationships

        // Apply sorting
        if ($request->has('sort')) {
            if ($request->sort == '3') {
                $query->orderBy('payment_date', 'desc'); // Latest Payments
            }elseif ($request->sort == '2') {
                $query->orderBy('payment_date', 'asc'); // Earliest Payments
            } elseif ($request->sort == '1') {
                $query->where('isPaid', true); // Paid Payments
            } elseif ($request->sort == '0') {
                $query->where('isPaid', false); // Paid Payments
            }
        }

        // Apply keyword search
        if ($request->has('keyword')) {
            $query->whereHas('employer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        $payments = $query->paginate(10); // Paginate results
        return view('admin.payments.list', compact('payments'));
    }

    // Edit Payment Page
    public function edit($id) {
        $payment = Payment::with(['hire', 'employer', 'freelancer'])->findOrFail($id);

        // Pass the payment method explicitly if needed
        $paymentMethod = $payment->payment_method;

        return view('admin.payments.edit', compact('payment'));
    }

    // Update Changes
    public function update(Request $request, $id) {
        $payment = Payment::findOrFail($id);
        
        // Check if 'proof' file is uploaded and update its path
        if ($request->hasFile('proof')) {
            // Delete old proof file if exists
            if ($payment->proof && Storage::exists('public/' . $payment->proof)) {
                Storage::delete('public/' . $payment->proof);
            }
    
            // Store the new proof file in 'public/storage/payments' with a generated filename
            $proofPath = $request->file('proof')->store('payments', 'public');
        
            // Save the relative path to the database (no 'public' prefix)
            $payment->proof = $proofPath;
        }
        
        // Update the payment status
        $payment->isPaid = $request->isPaid;
        
        // Save the updated payment record
        $payment->save();
        
        // Flash message for success
        session()->flash('success', 'Payment updated successfully!');
    
        // Redirect to the payments list
        return redirect()->route('admin.payments.list');
    }
    
}
