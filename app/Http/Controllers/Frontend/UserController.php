<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {

        try {
            $validator = Validator::make($request->all(),
                [
                    'name' => 'required|max:120',
                    'phone' => 'required',
                    'address' => 'required',
                    'email' => 'required|unique:users',
                    'password' => 'required|min:3|confirmed',
                ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $inputs = [
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ];
            User::create($inputs);
            return redirect()->route('login');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function profile()
    {
        return view('frontend.profile');
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = auth()->user();
            $validator = Validator::make($request->all(),
                [
                    'name' => 'required|max:120',
                    'phone' => 'required',
                    'address' => 'required',
                    'photo' => 'image',
                ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $inputs = [
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ];
            $user->update($inputs);

            if (!empty($request->file('photo'))) {
                if (file_exists('uploads/users/'.$user->photo)){
                    unlink('uploads/users/'.$user->photo);
                }
                $newName = 'user_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->move('uploads/users', $newName);
                $user->update(['photo'=>$newName]);
            }
            return redirect()->back();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
