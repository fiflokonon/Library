<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;

/**
 * @group Suggestion Management
 *
 * APIs to manage the suggestion ressource
 */
class SuggestionController extends Controller
{
    //
    /**
     * Get Suggestions List
     */
    function getAllSuggestions()
    {
        return Suggestion::all();
    }
    /**
     * Create Suggestion
     * @queryParam message string required
     *
    */
    function createSuggestion(Request $request, $id)
    {
        $suggest = new Suggestion;
        $suggest->user_id = $id;
        $suggest->message = $request->message;
        $result = $suggest->save();
        if($result)
        {
            return $suggest;
        }
        else
        {
            return response(
                ["message" => "An error occured"]
            );
        }
    }

    /**
     * Delete Suggestion
     * @urlParam user.id required
     */
    function deleteSuggestion($id)
    {
        $suggest = Suggestion::find($id);
        $result = $suggest->delete();
        if($result)
        {
            return response(
                ['message' => "OK"]
            );
        }
        else
        {
            return response(
                ['message' => 'An error occurs']
            );
        }
    }
}
