<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordResetToken;
use App\Models\VerifyEmailToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;


class AuthenticationController extends Controller
{
    // Register Operation
    function show_register()
    {
        return view("authentication.register");
    }

    function register(Request $request)
    {
        $validated_data = $request->validate([
            "name" => ["required", "min:3"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "min:6"],
            "confirmation_password" => ["required_with:password", "same:password", "min:6"]
        ]);

        $new_user = new User();
        $new_user->name = $validated_data["name"];
        $new_user->email = $validated_data["email"];
        $new_user->password = Hash::make($validated_data["password"]);
        $new_user->save();

        $token = Str::random(60);
        $hashed_token = Hash::make($token);
        VerifyEmailToken::create([
            'email' => $validated_data["email"],
            'token' => $hashed_token
        ]);

        Mail::send('authentication.email.messages.verify_email', ['token' => $token, 'email' => $validated_data["email"]], function ($message) use ($validated_data) {
            $message->to($validated_data["email"]);
            $message->subject('Verify Email');
        });

        // log the user in
        Auth::login($new_user);

        if (Auth::check()) {
            return redirect("/");
        }

        return view("authentication.register");
    }




    // Login Operation
    function show_login()
    {
        return view("authentication.login");
    }

    function login(Request $request)
    {
        $validated_data = $request->validate([
            "email" => ["required", "email", "exists:users,email"],
            "password" => ["required", "min:6"],
        ]);

        if (Auth::attempt($validated_data)) {
            $request->session()->regenerate();
            return redirect("/");
        }

        return view("authentication.login");
    }




    // Forgot Password Operation
    function show_forgot_password()
    {
        return view("authentication.forgot_password");
    }

    function forgot_password(Request $request)
    {
        $validated_data = $request->validate([
            "email" => ["required", "email", "exists:users,email"],
        ]);

        $token = Str::random(60);
        $hashed_token = Hash::make($token);
        PasswordResetToken::updateOrCreate(
            ['email' => $request->email],
            ['token' => $hashed_token, 'created_at' => Carbon::now()]
        );

        Mail::send('authentication.email.messages.reset_password', ['token' => $token, 'email' => $validated_data["email"]], function ($message) use ($validated_data) {
            $message->to($validated_data["email"]);
            $message->subject('Reset Your Password');
        });

        return redirect()->route("authentication.forgot_password")->with('success_message', 'We Have Sent Reset Password Link!');
    }




    // Reset Password Operation
    function show_reset_password(Request $request, $token)
    {
        $email = $request->query("email");
        $email_record = PasswordResetToken::where('email', $email)->first();

        if ($email_record && Hash::check($token, $email_record->token)) {
            if ($email_record->is_expired()) {
                $email_record->delete();
                return redirect()->route("authentication.forgot_password")->with('warning_message', 'The Reset Password Link Has Expired!');
            }
            return view("authentication.reset_password");
        }

        return redirect()->route("authentication.forgot_password")->with('fail_message', 'You Do Not Have Reset Password Link!');
    }

    function reset_password(Request $request, $token)
    {
        $validated_data = $request->validate([
            "password" => ["required", "min:6"],
            "confirmation_password" => ["required_with:password", "same:password", "min:6"]
        ]);

        $email = $request->query("email");
        $email_record = PasswordResetToken::where('email', $email)->first();

        if ($email_record && Hash::check($token, $email_record->token)) {
            if ($email_record->is_expired()) {
                $email_record->delete();
                return redirect()->route("authentication.forgot_password")->with('warning_message', 'The Reset Password Link Has Expired!');
            }

            $user = User::where('email', $email)->first();
            $user->password = Hash::make($validated_data["password"]);
            $user->save();

            $email_record->delete();

            return redirect()->route("authentication.login")->with('success_message', 'You Have Reset The Password Successfully!');
        }

        return redirect()->route("authentication.forgot_password")->with('fail_message', 'There Was an Unknow Error!!!');
    }




    // Verify Email
    function verify_email(Request $request, $token)
    {
        $email = $request->query("email");
        $email_record = VerifyEmailToken::where('email', $email)->first();
        if ($email_record && Hash::check($token, $email_record->token)) {
            $user = User::where('email', $email)->first();
            $user->email_verified_at = Carbon::now();
            $user->update();
            $email_record->delete();
            return view("authentication.email_verified")->with('success_message', 'Congratulations, You Verified Your Email Successfully!!!');
        }
        return view("authentication.email_verified")->with('fail_message', 'The Verification Link Is Invalid!!!');
    }
}
