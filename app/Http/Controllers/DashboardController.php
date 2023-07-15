<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use App\Models\EmployeeExpense;
use App\Models\Employee;
use App\Models\InvoiceQuote;
use App\Models\EquipmentRental;
use App\Models\Services;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

     /**
     * @OA\Get (
     *     path="/api/dashboard",
     *      operationId="all_bills",
     *     tags={"Dashboard"},
     *     security={{ "apiAuth": {} }},
     *     summary="All dashboard",
     *     description="All dashboard",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent()
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
        $data['bills'] = count(Bills::all());
        return response()->json(["data"=>$data],200);
    }

}
