<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use Illuminate\Http\Request;

class BillsController extends Controller
{

     /**
     * @OA\Get (
     *     path="/api/bills",
     *      operationId="all_bills",
     *     tags={"Bills"},
     *     security={{ "apiAuth": {} }},
     *     summary="All bills",
     *     description="All bills",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Process"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Cliente] #id"),
     *          )
     *      )
     * )
     */
    public function index()
    {
        $bills = Bills::all();
        return response()->json(["data"=>$bills],200);
    }

     /**
     * @OA\Get (
     *     path="/api/bills/{id}",
     *     operationId="watch_bills",
     *     tags={"Bills"},
     *     security={{ "apiAuth": {} }},
     *     summary="See abills",
     *     description="See abills",
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Process"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Cliente] #id"),
     *          )
     *      )
     * )
     */
    public function watch($id){
        try{
            $service = Bills::find($id);
            return response()->json(["data"=>$service],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/bills",
     *      operationId="store_bills",
     *      tags={"Bills"},
     *     security={{ "apiAuth": {} }},
     *      summary="Store abills",
     *      description="Store abills",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name"},
     *            @OA\Property(property="description", type="string", format="string", example="Description"),
     *            @OA\Property(property="price", type="string", format="string", example="Price"),
     *            @OA\Property(property="type", type="string", format="string", example="diary"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function register(Request $request)
    {
        $bills = new Bills(request()->all());
        $bills->save();
        return response()->json(["data"=>$bills],200);
    }

    /**
     * @OA\Put(
     *      path="/api/bills/{id}",
     *      operationId="update_bills",
     *      tags={"Bills"},
     *     security={{ "apiAuth": {} }},
     *      summary="Update abills",
     *      description="Update abills",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name"},
     *            @OA\Property(property="description", type="string", format="string", example="Description"),
     *            @OA\Property(property="price", type="string", format="string", example="Price"),
     *            @OA\Property(property="type", type="string", format="string", example="diary"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */

    public function update(Request $request, $id){
        try{
            $bills = Bills::find($id);
            $bills->update($request->all());
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/bills/{id}",
     *      operationId="delete_bills",
     *      tags={"Bills"},
     *     security={{ "apiAuth": {} }},
     *      summary="Delete abills",
     *      description="Delete abills",
     *    @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */

    public function delete($id){
        try{
            $bills = Bills::destroy($id);
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

}
