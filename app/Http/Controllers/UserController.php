<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationCode;
use App\Models\PendingPool;
use App\Models\RemovedPool;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function storeEmail(Request $request)
    {
        // Validating Requirements
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        if($validatedData)
        {
            // Storing Email in User Model

            User::create([
                'email' => $request->email
            ]);

            // dd($request->email);

            return redirect()->back()->with('success', 'User Stored!');
            // return redirect()->back()->with('success', 'Email saved!');
        }else {
            return redirect()->back()->with('failed', 'Fill all fields');
        }
    }

    public function checkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->get();
        if($user->all() != null){
            $this->sendVerificationCode($request->email);
            session()->put('email', $request->email);

            return redirect('/show')->with('success', 'You email stored in session');
        } else {
            return redirect()->back()->with('failed', 'Email not found.');
        }
    }

    private function sendVerificationCode($email)
    {
        $verificationCode = mt_rand(100000, 999999);
        session()->put('verificationCode', $verificationCode);

        $mailData = [
        "code" => $verificationCode,
        ];

        Mail::to($email)->send(new VerificationCode($mailData));
    }

    public function show()
    {
        return view('verification', [
            'users' => User::all(),
        ]);
    }

    public function confirmCode(Request $request)
    {
        if(session()->get('verificationCode') == $request->code)
        {
            return view('home');
        } else
            return redirect()->back()->with('failed', 'Verification Code is incorrect');
    }

    public function changeEmail()
    {
        if(User::where('email', Session()->get('email'))->get()->all() != null) {
            return view('EmailInteraction.changeEmail', [
                'user' => User::where('email', Session()->get('email'))->get()->all()
            ]);
        } else {
            return redirect()->back()->with('failed', 'You donot have email');
        }
    }

    public function newEmail(Request $request)
    {
        Session()->put('newEmail', $request->email);

        $user = User::where('email', session()->get('email'))->get()->all();
        // $pd = PendingPool::where('email', session()->get('email'))->get();
        // dd($request->email);

        if($user != null) {
            $expires = $user[0]->expires;
            $removedPool = PendingPool::UpdateOrCreate([
                'pending_email' => $request->email,
                'expires' => $expires,
                'webhook' => true
            ]);
        } else {
            return redirect()->back()->with('failed', 'Your email is not registered');
        }

        if($removedPool)
        {
            session()->put('email', '');
            return redirect('/')->with('success', 'Email changed successfully and Session ended');
        } else {
            return redirect()->back()->with('failed', 'Error while changing email');
        }
    }

    public function renewLicens()
    {
        $pendingPool = PendingPool::where('pending_email', session()->get('email'))->get()->all();
        if($pendingPool) {
            return view('License', [
                'license' => 'you are already on pending pool',
            ]);
        } else {

            $pp = PendingPool::create([
                'pending_email' => session()->get('email'),
            ]);

            if($pp)
                return view('License', [
                    'license' => 'License is being renewed',
                ]);
            else
            return view('License', [
                'license' => 'Error while trying to renew your license. Please contact admin.',
            ]);
        }
    }

    public function back()
    {
        return view('home');
    }

    public function removeUser()
    {
        $removedPool = RemovedPool::where('removed_email', session()->get('email'))->get()->all();
        if($removedPool) {
            return view('License', [
                'license' => 'you are already on removed pool'
            ]);
        } else {

            $rp = RemovedPool::create([
                'removed_email' => session()->get('email'),
            ]);

            $user = User::where('email', session()->get('email'))->get()->all();
            if($user != null && $rp) {
                session()->put('email', '');
                return redirect('/')->with('success', 'User removed successfully and Session ended');
            } else {
                return view('License', [
                    'license' => 'Error while trying to remove your license. Please contact admin.'
                ]);
            }
        }
    }
}
