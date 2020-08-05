<?php

namespace App\Http\Controllers;

use App\Jobs\ImportProducts;
use Illuminate\Http\Request;

class LoadProductsController extends Controller
{

    public function __construct()
    {
    }

    public function index() {
        return view('load-product');
    }

    /**
     * Add process of products import
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function importProducts(Request $request) {
        try {
            $request->validate([
                'resource' => 'required|url'
            ]);
            ImportProducts::dispatch($request->resource);
            return response()->json([
                'message' => 'Process has been added'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }



    }
}
