<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log; // Import Log facade

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Validate request data
        $request->validate([
            'billing_zip' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'payment_method_id' => 'required|string', // Add this validation
        ]);
    
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        try {
            // Create a PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => 1099, // Amount in cents (e.g., $10.99)
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id, // Use the payment method ID from Stripe
                'confirmation_method' => 'automatic', // You can use 'automatic' here
                'confirm' => true, // Confirm the payment
                'return_url' => route('payment.success'), // URL to redirect to after payment
            ]);
    
            return response()->json(['success' => true, 'message' => 'Payment successful!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    

    public function success()
    {
        return view('payment.success', [
            'message' => 'Thank you for your payment!',
            'details' => [
                'amount' => '10.99', // Replace with actual payment amount or fetch from session or database
                'currency' => 'USD',
                'transaction_id' => '12345ABCDE' // Replace with actual transaction ID if available
            ],
        ]);
    }
    
}
