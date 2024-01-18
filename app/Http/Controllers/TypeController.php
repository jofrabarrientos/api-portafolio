<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Http\JsonResponse;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $types = Type::all();
        $data[] = [];
        foreach ($types as $type) {
            $data[] = [
                "id" => $type->id,
                "description" => $type->description,
                "user" => $type->user->name
            ];
        }
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $data = [
          "description" => $request->input('description'),
          "user_id" => auth()->id()
        ];
        $type = Type::create($data);
        return response()->json($type);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $type = Type::find($id);
        $data = [
            "id" => $type->id,
            "description" => $type->description,
            "user" => $type->user->name
        ];
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $type = Type::where('id', $id)
            ->update(['description' => $request->input('description')]);
        return response()->json($type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
