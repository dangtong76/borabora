<?php

namespace App\Http\Controllers\Auth\Member;


use App\Member;
use Auth;
use App\Gender;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    const REGEX_PHONE_NUMBER = '/[0-9]{3,4}-[0-9]{3,4}-[0-9]{4}/';

    protected $redirectTo = '/members';

    public function __construct()
    {
        $this->middleware('guest:members');
    }

    public function showRegistrationForm()
    {
        return view('auth.members.register');
    }

    protected function guard()
    {
        return Auth::guard('members');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:members',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return Member::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}