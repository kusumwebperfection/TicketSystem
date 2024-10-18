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
            'payment_method_id' => 'required|string',
        ]);
        
        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        try {
            // Create a PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => 1099, // Amount in cents (e.g., $10.99)
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'automatic',
                'confirm' => true,
                'return_url' => route('payment.success'),
            ]);
            
            // Log the PaymentIntent ID for debugging or records
            Log::info('PaymentIntent created:', ['id' => $paymentIntent->id]);
    
            return response()->json([
                'success' => true,
                'message' => 'Payment successful!',
                'transaction_id' => $paymentIntent->id, // Include transaction ID in the response
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    
    
    public function success(Request $request)
    {
        // Assuming you are storing the transaction ID in the session
        $transactionId = $request->session()->get('transaction_id', 'N/A');
    
        return view('payment.success', [
            'message' => 'Thank you for your payment!',
            'details' => [
                'amount' => '10.99', // Replace with actual payment amount
                'currency' => 'USD',
                'transaction_id' => $transactionId, // Use the transaction ID from the session
            ],
        ]);
    }
    
    
}
