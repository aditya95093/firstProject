<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'gender' => 'required|in:male,female,other',
                'mobile' => 'required|digits:10',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => $validator->messages()
                ], 422);
            }

            $user = new User;
            $user->name = $request->name;
            $user->gender = $request->gender;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();


            $token = $user->createToken('AuthToken')->plainTextToken;

            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user,
                'token' => $token
            ], 201);
        } catch (ValidationException $e) {

            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('AuthToken')->plainTextToken;
            $success['name'] = $user->name;

            return response()->json([
                'success' => true,
                'data' => $success,
                'message' => 'User logged in successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            Auth::logout();

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        $users = User::all();
        $data = [
            'status' => 200,
            'users' => $users
        ];

        return response()->json($data, 200);
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'mobile' => 'required|digits:10',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages()
            ];
            return response()->json($data, 422);
        } else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->gender = $request->gender;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $data = [
                'status' => 200,
                'message' => 'Data updated successfully'
            ];

            return response()->json($data, 200);
        }

    }
    public function delete($id)
    {

        $user = User::find($id);
        $user->delete();

        $data = [
            'status' => 200,
            'message' => "Data deleted successfully"
        ];

        return response()->json($data, 200);
    }

}
