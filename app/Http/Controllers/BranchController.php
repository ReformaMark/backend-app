<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchResources;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $branch = Branch::all();

        return response()->json($branch);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        $branch = Branch::create([
            'name' => $validated['name'],
            'location' => $validated['location'],
        ]);

        return response()->json([
            'message'=> "Branch created successfully",
            'branch' => $branch
        ], 201);
    }

    /**
     * Display the specified resource.
     */
   public function show(Branch $branch)
    {
        return new BranchResources($branch);
    }

    public function branchTotals()
    {
        $sql = "
            SELECT  
                b.id   AS branch_id,
                b.name AS branch_name,
                COUNT(s.id) AS sales_count,
                COALESCE(SUM(s.total_amount), 0) AS total_sales_amount
            FROM branches b
            LEFT JOIN sales s ON b.id = s.branch_id
            GROUP BY b.id, b.name
            ORDER BY b.name
        ";

        $branches = DB::select($sql);

        return response()->json($branches);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
