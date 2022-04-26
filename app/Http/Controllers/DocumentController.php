<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

/**
 * @group Document Management
 *
 * APIs to manage the document ressource
 */
class DocumentController extends Controller
{
    /**
     * Get all Documents
     */
    function getAllDocs()
    {
        return Document::all();
    }

    /**
     * Get a doc by his ID
     */
    function getDoc($id)
    {
        return Document::where('id', $id)->get();
    }

    /**
     * Get a specific user's document
     */
    function getDocsByStudent($id)
    {
        return Document::where('user_id', $id)->get();
    }
    /**
     * Get all inactive Docs
     */
    function getDocsInactive()
    {
        return Document::where('status', false)->get();
    }

    /**
     * Get a specific user's inactive documents
     */
    function getDocsInactiveByStudent($id)
    {
        return Document::where('user_id', $id)->where('status', false)->get();
    }

    /**
     * Get all active documents
     */
    function getActiveDocs()
    {
        return Document::where('status', true)->get();
    }

    /**
     * Get a specific user's active docs
     */
    function getActiveDocsByStudent($id)
    {
        return Document::where('user_id', $id)->where('status', true)->get();
    }

    /**
     * Search Doc by field
     */
    function getDocsByField($field)
    {
        return Document::where("field", "like", "%".$field."%")
                        ->orWhere('theme', 'like', '%'.$field.'%')->get();
    }

    /**
     * Get a specific user's documents by field
     */
    function getDocsByFieldByStudent($field, $id)
    {
        return Document::where('user_id', $id)->where("field", "like", "%".$field."%")
                        ->orWhere('theme', 'like', '%'.$field.'%')->get();
    }

    /**
     * Get all active documents by field
     */
    function getActiveDocsByField($field)
    {
        return Document::where("field", "like", "%".$field."%")->orWhere('theme', 'like', '%'.$field.'%')
                        ->where('status', true)->get();
    }
/*
    function getActiveDocsByFieldByStudent($field, $id)
    {
        return Document::where('user_id', $id)->where('status', true)
                        ->where("field", "like", "%".$field."%")
                        ->orWhere('theme', 'like', '%'.$field.'%')->get();
    }

    function getDocsInactiveByField($field)
    {
        return Document::where('status', false)->where("field", "like", "%".$field."%")
                        ->orWhere('theme', 'like', '%'.$field.'%')->get();
    }

    function getDocsInactiveByFieldByStudent($field, $id)
    {
        return Document::where('user_id', $id)->where('status', false)
                       ->where("field", "like", "%".$field."%")
                       ->orWhere("theme", "like", "%".$field."%")->get();
    }
*/


    /**
     * Create a document
     * 
     * @bodyParam document.field string required
     * @bodyParam document.speciality_id integer required
     * @bodyParam document.year integer required
     */
    function createDoc(Request $request, $id)
    {
        $document = new Document();
        $document->field = $request->field;
        $document->speciality_id = $request->speciality_id;
        $document->user_id = $id;
        $document->year = $request->year ;
        $result = $document->save();
        if($result)
        {
            return $document;
        }
        else
        {
            return response(
                ["message"=> 'An error occured']
            );
        }
    }

    /**
     * Add Document file
     * @bodyParam document.pathDoc file required
     */
    function addDocFile(Request $request, $id)
    {
       $document = Document::find($id);
       $document->pathDoc = $request->file('file')->store('apiDocs');
       $result = $document->save();
       if($result)
       {
           return $document;
       }
       else
       {
           return response(
               ['message'=>'An error occurs']
           );
       }
    }

    /**
     * Add corrected file 
     * @bodyParam caption string The image caption
     * @bodyParam document.pathCorrect file required
     */
    function addCorrectFile(Request $request, $id)
    {
       $document = Document::find($id);
       $document->pathCorrect = $request->file('file')->store('apiDocs');
       $result = $document->save();
       if($result)
       {
           return $document;
       }
       else
       {
           return response(
               ['message'=>'An error occurs']
           );
       }
    }

    /**
     * Delete a document
     */
    function deleteDoc(Request $request)
    {
        $document = Document::find($request->id);
        $result = $document->delete();
        if($result)
        {
            return response([
                'message'=>'Removed successfully'
            ]);
        }
        else
        {
            return response([
                'message'=>'An error occurs'
            ]);
        }
    }

    /**
     * Change document status(active or inactive)
     */
    function changeDocStatus($id)
    {
        $document = Document::find($id);
        if($document->status = false)
        {
            $document->status = true;
            $result = $document->save();
            if($result)
            {
                return response([
                'message'=> "Status changed"
            ]);
            }
            else
            {
                return response(
                    ['message'=>"An error occurs"]
                );
            }
        }
        else
        {
            $document->status = false;
            $result = $document->save();
            if($result)
            {
                return response([
                'message'=> "Status changed"
            ]);
            }
            else
            {
                return response(
                    ['message'=>"An error occurs"]
                );
            }
        }
    }

    /**
     * Edit or update document
     * @bodyParam document.field string required
     */
    function editDoc(Request $request, $id)
    {
        $document = Document::find($id);
        $document->field = $request->field;
        $result = $document->save();
        if($result)
        {
            return $document;
        }
        else
        {
            return response(
                ["message"=> 'An error occured']
            );
        }
    }
}
