<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;
/**
 * @group Entity Management
 *
 * APIs to manage the entity ressource
 */
class EntityController extends Controller
{
    //
    /**
     * Get all entities
     * 
     */
    public function getEntities()
    {
        return Entity::all();
    }
    /**
     * Get an entity by his ID
     * @urlParam id integer The ID of entity
     */
    public function getEntity($id)
    {
        return Entity::where('id', $id)->get();
    }

    /**
     * Create an entity
     * @authentificated
     * 
     * @query Entity object required
     * Entity object details
     * @queryParam entity.name string required
     */
    public function createEntity(Request $request)
    {
        $entity = new Entity;
        $entity->name = $request->name;
        $result = $entity->save();
        if($result)
        {
            return $entity;
        }
        else
        {
            return response([
                "message" => "An error occurs"
            ]);
        }
    }
    /**
     * 
     */
    public function editEntity(Request $request, $id)
    {
        $entity = Entity::find($id);
        $entity->name = $request->name;
        $result = $entity->save();
        if($result)
        {
            return $entity;
        }
        else
        {
            return response(
                ['message'=>'An error occurs']
            );
        }
    }
    public function deleteEntity($id)
    {
        $entity = Entity::find($id);
        $result = $entity->delete();
        if($result)
        {
            return response(
                ["message" => "OK"]
            );
        }
        else
        {
            return response(
                ["message" => "An error occurs"]
            );
        }
    }


}
