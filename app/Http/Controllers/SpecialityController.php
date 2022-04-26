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
    /**
     * Create Speciality
     * @bodyParam speciality.name string required
     *
    */
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

    /**
     * Get a speciality by Id
     */
    function getSpeciality($id)
    {
        return Speciality::where('id', $id)->get();
    }

    /**
     * Get the list of specialities
     */
    function getAllSpecialities()
    {
        return Speciality::all();
    }

    /**
     * Delete a Speciality
     */
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

    /**
     * Edit / Update a speciality
     * @queryParam entity.name required
     */
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
    /**
     * Get a specialities list by entity
     * @urlParam entity.id required
     */
    function getSpecialitiesByEntity($id)
    {
        return Speciality::where('entity_id', $id)->get();
    }
}
