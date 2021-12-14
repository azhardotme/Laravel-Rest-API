<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function showUser($id = null)
    {
        if ($id == '') {
            $users = User::get();
            return response()->json(['users' => $users], 200);
        } else {
            $users = User::find($id);
            return response()->json(['users' => $users], 200);
        }
    }


    public function addUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',

            ];

            $customMessage = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email must be a valid email',
                'password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $message = 'User Created Successfully';
            return response()->json(['message' => $message], 201);
        }
    }

    public function addMultipleUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'users.*.name' => 'required',
                'users.*.email' => 'required|email|unique:users',
                'users.*.password' => 'required',

            ];

            $customMessage = [
                'users.*.name.required' => 'Name is required',
                'users.*.email.required' => 'Email is required',
                'users.*.email.email' => 'Email must be a valid email',
                'users.*.password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            foreach ($data['users'] as $addUser) {
                $user = new User();
                $user->name = $addUser['name'];
                $user->email = $addUser['email'];
                $user->password = bcrypt($addUser['password']);
                $user->save();
                $message = 'User Created Successfully';
            }
            return response()->json(['message' => $message], 201);
        }
    }

    public function updateUserDetails(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
                'password' => 'required',

            ];

            $customMessage = [
                'name.required' => 'Name is required',
                'password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = User::findOrFail($id);
            $user->name = $data['name'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $message = 'User Details updated Successfully';
            return response()->json(['message' => $message], 202);
        }
    }

    //Pacth api for update single record
    public function updateSingleRecord(Request $request, $id)
    {
        if ($request->isMethod('patch')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
            ];

            $customMessage = [
                'name.required' => 'Name is required',

            ];

            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = User::findOrFail($id);
            $user->name = $data['name'];
            $user->save();
            $message = 'User Single Record updated Successfully';
            return response()->json(['message' => $message], 202);
        }
    }

    //Delete user user with id
    public function deleteSingleUser($id)
    {
        User::findOrFail($id)->delete();
        $message = 'Single User  Deleted Successfully';
        return response()->json(['message' => $message], 200);
    }

    //Delete user with json
    public function deleteUserJson(Request $request)
    {
        if ($request->isMethod('delete')) {
            $data = $request->all();
            User::where('id', $data['id'])->delete();
            $message = 'User  Deleted Successfully';
            return response()->json(['message' => $message], 200);
        }
    }

    //Delete multiple user
    public function deleteMultipleUser($ids)
    {
        $ids = explode(',', $ids);
        User::whereIn('id', $ids)->delete();

        $message = 'User  Deleted Successfully';
        return response()->json(['message' => $message], 200);
    }


    //Delete multiple user with json
    public function deleteMultipleUserJson(Request $request)
    {
        $header = $request->header('Athorization');
        if ($header == '') {
            $message = 'Authorization is required';
            return response()->json(['message' => $message], 422);
        } else {
            if ($header == 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6ImhlbGxvIiwiaWF0IjoxNTE2MjM5MDIyfQ.flFe13lY6f1W8CHv2YFaI-yigJpocH-hAbkc8w7Tjxo') {
                if ($request->isMethod('delete')) {
                    $data = $request->all();
                    User::whereIn('id', $data['ids'])->delete();
                    $message = 'User  Deleted Successfully';
                    return response()->json(['message' => $message], 200);
                }
            } else {

                $message = 'Authorization does not Match';
                return response()->json(['message' => $message], 422);
            }
        }
    }
}
