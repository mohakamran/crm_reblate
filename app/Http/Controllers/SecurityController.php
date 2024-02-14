<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;


class SecurityController extends Controller
{

    // google 2fa
    public function google2FA()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to login page or handle unauthorized access
            return redirect()->route('login');
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has loginSecurity data
        if (!$user->loginSecurity) {
            // Handle case where loginSecurity data is not available
            return redirect()->back()->with('error', 'Login security data not found.');
        }


        // Access the 'google2fa_secret' property
        $google2fa_secret = $user->loginSecurity->google2fa_secret;

        // Generate the QR code URL
        $google2fa = new \PragmaRX\Google2FAQRCode\Google2FA();
        $google2fa_url = $google2fa->getQRCodeInline(
            'MyNotePaper Demo',
            $user->email, // Assuming 'user_email' should be 'email'
            $google2fa_secret
        );

        // Pass the data to the view
        return view('auth.2fa', compact('google2fa_url'));
    }

}
