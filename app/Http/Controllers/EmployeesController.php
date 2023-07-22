<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\EmployeeExpense;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{

     /**
     * @OA\Get (
     *     path="/api/employees",
     *      operationId="all_employees",
     *     tags={"Employees"},
     *     security={{ "apiAuth": {} }},
     *     summary="All employees",
     *     description="All employees",
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
        $new_array_employees = [];
        $employees = Employees::all();
        foreach ($employees as $key) {
            $key['items'] = EmployeeExpense::where('id_employee', $key['id'])->limit(50)->orderBy('id', 'DESC')->get();
            array_push($new_array_employees, $key);
        }
        return response()->json(["data"=>$new_array_employees],200);
    }

     /**
     * @OA\Get (
     *     path="/api/employees/{id}",
     *     operationId="watch_employees",
     *     tags={"Employees"},
     *     security={{ "apiAuth": {} }},
     *     summary="See employees",
     *     description="See employees",
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
            $employee = Employees::with('expense')->find($id);
            $employee['items'] = EmployeeExpense::where('id_employee', $employee['id'])->limit(50)->orderBy('id', 'DESC')->get();
            return response()->json(["data"=>$employee],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/employees",
     *      operationId="store_employees",
     *      tags={"Employees"},
     *     security={{ "apiAuth": {} }},
     *      summary="Store employees",
     *      description="Store employees",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name"},
     *            @OA\Property(property="name", type="string", format="string", example="Name"),
     *            @OA\Property(property="address", type="string", format="string", example="Address"),
     *            @OA\Property(property="phone", type="string", format="string", example="Phone"),
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
        $employees = new Employees(request()->all());
        $employees->save();
        return response()->json(["data"=>$employees],200);
    }

    /**
     * @OA\Put(
     *      path="/api/employees/{id}",
     *      operationId="update_employees",
     *      tags={"Employees"},
     *     security={{ "apiAuth": {} }},
     *      summary="Update employees",
     *      description="Update employees",
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
     *            @OA\Property(property="address", type="string", format="string", example="Address"),
     *            @OA\Property(property="phone", type="string", format="string", example="Phone"),
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
            $employees = Employees::find($id);
            $employees->update($request->all());
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/employees/{id}",
     *      operationId="delete_employees",
     *      tags={"Employees"},
     *     security={{ "apiAuth": {} }},
     *      summary="Delete employees",
     *      description="Delete employees",
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
            $employees = Employees::destroy($id);
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

}
