<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class DosenController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Dosen::all(),
            'message' => 'List data dosen'
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'nip' => 'required|string|max:20|unique:dosens,nip',
                'nama' => 'required|string|max:100',
                'email' => 'required|email|unique:dosens,email',
                'jurusan' => 'required|string|max:100',
                'telepon' => 'required|string|max:20',
            ]);

            $dosen = Dosen::create($validated);

            return response()->json([
                'success' => true,
                'data' => $dosen,
                'message' => 'Dosen created successfully'
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function show(string $id): JsonResponse
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $dosen
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'nip' => 'sometimes|required|string|max:20|unique:dosens,nip,' . $id,
                'nama' => 'sometimes|required|string|max:100',
                'email' => 'sometimes|required|email|unique:dosens,email,' . $id,
                'jurusan' => 'sometimes|required|string|max:100',
                'telepon' => 'sometimes|required|string|max:20',
            ]);

            $dosen->update($validated);

            return response()->json([
                'success' => true,
                'data' => $dosen,
                'message' => 'Dosen updated successfully'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen not found'
            ], 404);
        }

        $dosen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dosen deleted successfully'
        ]);
    }
}

