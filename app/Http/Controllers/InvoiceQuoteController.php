<?php

namespace App\Http\Controllers;

use App\Models\InvoiceQuote;
use App\Models\RecordsServices;
use Illuminate\Http\Request;

class InvoiceQuoteController extends Controller
{

     /**
     * @OA\Get (
     *     path="/api/invoice_quote",
     *      operationId="all_invoice_quote",
     *     tags={"InvoiceQuote"},
     *     security={{ "apiAuth": {} }},
     *     summary="All invoice_quote",
     *     description="All invoice_quote",
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
        $new_array_invoice_quote = [];
        $invoice_quote = InvoiceQuote::all();
        foreach ($invoice_quote as $key) {
            $key['items'] = RecordsServices::where('id_invoice_quote', $key['id'])->get();
            array_push($new_array_invoice_quote, $key);
        }
        return response()->json(["data"=>$new_array_invoice_quote],200);
    }

     /**
     * @OA\Get (
     *     path="/api/invoice_quote/{id}",
     *     operationId="watch_invoice_quote",
     *     tags={"InvoiceQuote"},
     *     security={{ "apiAuth": {} }},
     *     summary="See ainvoice_quote",
     *     description="See ainvoice_quote",
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
            $service = InvoiceQuote::find($id);
            $service['items'] = RecordsServices::where('id_invoice_quote', $service['id'])->get();
            return response()->json(["data"=>$service],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/invoice_quote",
     *      operationId="store_invoice_quote",
     *      tags={"InvoiceQuote"},
     *     security={{ "apiAuth": {} }},
     *      summary="Store ainvoice_quote",
     *      description="Store ainvoice_quote",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"attended"},
     *            @OA\Property(property="client", type="string", format="string", example="client"),
     *            @OA\Property(property="attended", type="string", format="string", example="attended"),
     *            @OA\Property(property="taxes", type="string", format="string", example="taxes"),
     *            @OA\Property(property="discount", type="number", format="number", example="0"),
     *            @OA\Property(property="total", type="number", format="number", example="100"),
     *            @OA\Property(property="observation", type="string", format="string", example="observation"),
     *            @OA\Property(property="terms", type="string", format="string", example="terms"),
     *            @OA\Property(property="type", type="string", format="string", example="quote"),
     *            @OA\Property(property="items", type="string", format="array", example={{"name":"name","description":"description","price":100,"amount":1,"total":100}}),
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
        $invoice_quote = new InvoiceQuote($request->except(['items']));
        $invoice_quote->save();

        $items = json_decode($request->items);
        
        if (is_array($items)) {
            foreach ($items as $item) {
                $item->id_invoice_quote = $invoice_quote->id;
                unset($item->id);
                $recordService = new RecordsServices((array)$item);
                $recordService->save();
            }
        }

        return response()->json(["data"=>$invoice_quote],200);
    }

    /**
     * @OA\Post(
     *      path="/api/invoice_quote/{id}",
     *      operationId="update_invoice_quote",
     *      tags={"InvoiceQuote"},
     *     security={{ "apiAuth": {} }},
     *      summary="Update ainvoice_quote",
     *      description="Update ainvoice_quote",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"attended"},
     *            @OA\Property(property="client", type="string", format="string", example="client"),
     *            @OA\Property(property="attended", type="string", format="string", example="attended"),
     *            @OA\Property(property="taxes", type="string", format="string", example="taxes"),
     *            @OA\Property(property="discount", type="number", format="number", example="0"),
     *            @OA\Property(property="total", type="number", format="number", example="100"),
     *            @OA\Property(property="observation", type="string", format="string", example="observation"),
     *            @OA\Property(property="terms", type="string", format="string", example="terms"),
     *            @OA\Property(property="type", type="string", format="string", example="quote"),
     *            @OA\Property(property="status", type="string", format="string", example="status"),
     *            @OA\Property(property="items", type="string", format="array", example={{"name":"name","description":"description","price":100,"amount":1,"total":100}}),
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
            $invoice_quote = InvoiceQuote::where('id',$id)->first();
            $invoice_quote->update($request->all());
            return response()->json(["data"=>$request->type],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/invoice_quote/{id}",
     *      operationId="delete_invoice_quote",
     *      tags={"InvoiceQuote"},
     *     security={{ "apiAuth": {} }},
     *      summary="Delete ainvoice_quote",
     *      description="Delete ainvoice_quote",
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
            $invoice_quote = InvoiceQuote::destroy($id);
            return response()->json(["data"=>"ok"],200);
        }catch (Exception $e) {
            return response()->json(["data"=>"fail"],200);
        }
    }

}
