<?php

namespace App\Http\Controllers;

use App\Models\EmployeeExpense;
use Illuminate\Http\Request;

class EmployeeExpenseController extends Controller
{

     /**
     * @OA\Get (
     *     path="/api/employee_expense",
     *      operationId="all_employee_expense",
     *     tags={"EmployeeExpense"},
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
        $employee_expense = EmployeeExpense::all();
        return response()->json(["data"=>$employee_expense],200);
    }

     /**
     * @OA\Get (
     *     path="/api/employee_expense/{id}",
     *     operationId="watch_employee_expense",
     *     tags={"EmployeeExpense"},
     *     security={{ "apiAuth": {} }},
     *     summary="See employee expense",
     *     description="See employee expense",
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
            $service = EmployeeExpense::find($id);
            return response()->json(["data"=>$service],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/employee_expense",
     *      operationId="store_employee_expense",
     *      tags={"EmployeeExpense"},
     *     security={{ "apiAuth": {} }},
     *      summary="Store employee expense",
     *      description="Store employee expense",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"description"},
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
        $employee_expense = new EmployeeExpense(request()->all());
        $employee_expense->save();
        return response()->json(["data"=>$employee_expense],200);
    }

    /**
     * @OA\Put(
     *      path="/api/employee_expense/{id}",
     *      operationId="update_employee_expense",
     *      tags={"EmployeeExpense"},
     *     security={{ "apiAuth": {} }},
     *      summary="Update employee expense",
     *      description="Update employee expense",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"description"},
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
            $employee_expense = EmployeeExpense::find($id);
            $employee_expense->update($request->all());
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/employee_expense/{id}",
     *      operationId="delete_employee_expense",
     *      tags={"EmployeeExpense"},
     *     security={{ "apiAuth": {} }},
     *      summary="Delete employee expense",
     *      description="Delete employee expense",
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
            $employee_expense = EmployeeExpense::destroy($id);
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

}
