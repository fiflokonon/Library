<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speciality;

/**
 * @group Speciality Management
 *
 * APIs to manage the speciality ressource
 */
class SpecialityController extends Controller
{
    //
    function createSpeciality(Request $request)
    {
        $spec = new Speciality;
        $spec->name = $request->name;
        $spec->entity_id = $request->entity_id;
        $result = $spec->save();
        if($result)
        {
            return $spec;
        }
        else
        {
            return response(
                ['message'=>'An error occurs']
            );
        }
    }

    function getSpeciality($id)
    {
        return Speciality::where('id', $id)->get();
    }

    function getAllSpecialities()
    {
        return Speciality::all();
    }

    function deleteSpeciality($id)
    {
        $spec = Speciality::find($id);
        $result = $spec->delete();
        if($result)
        {
            return response(
                ['message'=>'speciality deleted']
            );
        }
        else
        {
            return response(
                ['message'=>'An error occurs']
            );
        }
    }

    function editSpeciality(Request $request, $id)
    {
        $spec = Speciality::find($id);
        $spec->name = $request->name;
        $spec->entity_id = $request->entity_id;
        $result = $spec->save();
        if($result)
        {
            return $spec;
        }
        else
        {
            return response(
                ['message'=>'An error occurs']
            );
        }
    }

    function getSpecialitiesByEntity($id)
    {
        return Speciality::where('entity_id', $id)->get();
    }
}
