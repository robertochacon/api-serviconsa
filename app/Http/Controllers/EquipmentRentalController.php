<?php

namespace App\Http\Controllers;

use App\Models\EquipmentRental;
use Illuminate\Http\Request;

class EquipmentRentalController extends Controller
{

     /**
     * @OA\Get (
     *     path="/api/equipment_rental",
     *      operationId="all_equipment_rental",
     *     tags={"EquipmentRental"},
     *     security={{ "apiAuth": {} }},
     *     summary="All equipment rental",
     *     description="All equipment rental",
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
        $equipment_rental = EquipmentRental::all();
        return response()->json(["data"=>$equipment_rental],200);
    }

     /**
     * @OA\Get (
     *     path="/api/equipment_rental/{id}",
     *     operationId="watch_equipment_rental",
     *     tags={"EquipmentRental"},
     *     security={{ "apiAuth": {} }},
     *     summary="See equipment rental",
     *     description="See equipment rental",
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
            $supplier = EquipmentRental::find($id);
            return response()->json(["data"=>$supplier],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/equipment_rental",
     *      operationId="store_equipment_rental",
     *      tags={"EquipmentRental"},
     *     security={{ "apiAuth": {} }},
     *      summary="Store equipment rental",
     *      description="Store equipment rental",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name"},
     *            @OA\Property(property="name", type="string", format="string", example="Name"),
     *            @OA\Property(property="price", type="string", format="string", example="price"),
     *            @OA\Property(property="provider", type="string", format="string", example="provider"),
     *            @OA\Property(property="phone", type="string", format="string", example="phone"),
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
        $equipment_rental = new EquipmentRental(request()->all());
        $equipment_rental->save();
        return response()->json(["data"=>$equipment_rental],200);
    }

    /**
     * @OA\Put(
     *      path="/api/equipment_rental/{id}",
     *      operationId="update_equipment_rental",
     *      tags={"EquipmentRental"},
     *     security={{ "apiAuth": {} }},
     *      summary="Update equipment rental",
     *      description="Update equipment rental",
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
     *            @OA\Property(property="name", type="string", format="string", example="Name"),
     *            @OA\Property(property="price", type="string", format="string", example="price"),
     *            @OA\Property(property="provider", type="string", format="string", example="provider"),
     *            @OA\Property(property="phone", type="string", format="string", example="phone"),
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
            $equipment_rental = EquipmentRental::find($id);
            $equipment_rental->update($request->all());
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/equipment_rental/{id}",
     *      operationId="delete_equipment_rental",
     *      tags={"EquipmentRental"},
     *     security={{ "apiAuth": {} }},
     *      summary="Delete equipment rental",
     *      description="Delete equipment rental",
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
            $equipment_rental = EquipmentRental::destroy($id);
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

}
