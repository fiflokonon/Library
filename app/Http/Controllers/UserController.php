<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * @unauthenticated
 * @group User Management
 * APIs to manage the user ressource
 */

class UserController extends Controller
{

    /**
     * Login--Authentification
     * @bodyParam user.email string  required
     * @bodyParam user.password string required
     * 
     * @response{
     *      "user": {
     *  "id": 1,
     *  "lastName": "LOKONON",
     *  "firstName": "Arnaud Fifonsi",
     *  "sexe": "M",
     *  "email": "fif@gmail.com",
     *  "tel": "67538822",
     *  "role_id": 1,
     *  "created_at": null,
     *  "updated_at": null
     *},
     *"token": "1|wG9UaQLxSKSexfYtnBXtIqu7iSa77ebZ4jLNGyCO"
     * }
     * 
     */

    function login(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if(!$user || !Hash::check($req->password, $user->password))
        {
            return response([
                'message' => ['These credentials do not match our records']
            ], 404);
        }

        $token = $user->createToken('user-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
    /**
     * Signup --Create User/ Enrol User
     * @bodyparam user.lastName string required
     * @bodyParam user.firstName string required
     * @bodyParam user.sexe string required
     * @bodyParam user.email string required
     * @bodyParam user.tel string required
     * @bodyParam user.password string required
     * 
     * 
    */
    function signup(Request $request)
    {
        $student = new User;
        $student->lastName = $request->lastName;
        $student->firstName = $request->firstName;
        $student->sexe = $request->sexe;
        $student->email = $request->email;
        $student->tel = $request->tel;
        $student->password = Hash::make($request->password);
        $result = $student->save();
        if($result)
        {
            return $student;
        }
        else
        {
            return response ([
                "message" => "An error occured"
            ]);
        }
    }

    /**
     * Get Students List
     * 
     */
    function getAllStudents()
    {
        return User::where('role_id', 1)->get();
    }

    /**
     * Get Administrators List
     * 
     */
    function getAdmins()
    {
        return User::where('role_id', 2)->get();
    }

    /**
     * Update User --Edit user
     * 
     * @urlparam id integer The ID of User
     * 
     *@bodyparam user.lastName string required
     * @bodyParam user.firstName string required
     * @bodyParam user.sexe string required
     * @bodyParam user.email string required
     * @bodyParam user.tel number required
     * @bodyParam user.password string required
     */
    function editUser(Request $request, $id)
    {
        $student = User::find($id);
        $student->matricule = $request->matricule;
        $student->lastName = $request->lastName;
        $student->firstName = $request->firstName;
        $student->email = $request->email;
        $student->tel = $request->tel;
        $student->password = Hash::make($request->password);
        $result = $student->save();
        if($result)
        {
            return $student;
        }
        else
        {
            return response(
                ["message" => "An error occurs"]
            );
        }
 
    }

    function changeRoleToAdmin($id)
    {
        $user = User::where('id', $id);
        $user->role_id = 2;
        $result = $user->save();
        if($result)
        {
            return response(
                ["message"=> "Role changed"]
            );
        }
        else
        {
            return response(
                ["message"=> "An error occurs"]
            );
        }
    }

    function deleteUser($id)
    {
        $student = User::find($id);
        $result = $student->delete();
        if($result)
        {
            return response(
                ["message"=>"Student removed successfully"]
            );
        }
        else
        {
            return response(
                ["message" => "An error occurs"]
            );
        }
    }

    /* function addUserProfilePhoto(Request $request, $id)
    {
        $student = User::find($id);
        $student->profileImg = $request->file('file')->store('apiDocs');
        $result = $student->save();
        if($result)
        {
            return $student;
        }
        else
        {
            return response(
                ["message" => "An error occurs"]
            );
        }
    }
    function deletePromoStudents($promo)
    {
        $students = User::where('promotion', $promo)->where('role', 'student')->get();
        if(sizeof($students) != 0 )
        {
            for($i=0; $i< sizeof($students); $i++)
            {
                $students[$i]->delete();
            }
        }
    }

    function getStudentsByPromo($promo)
    {
        return User::where('promotion', $promo)->where('role', 'student')->get();
    }

    function getStudentsBySpeciality($id)
    {
        return User::where('speciality_id', $id)->where('role', 'student')->get();
    }*/
}
