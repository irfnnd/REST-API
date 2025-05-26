<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of Mahasiswas
     */
    public function index(): JsonResponse
    {
        $mahasiswas = Mahasiswa::all();

        return response()->json([
            'success' => true,
            'data' => $mahasiswas,
            'message' => 'Mahasiswas retrieved successfully'
        ], 200);
    }

    /**
     * Store a newly created Mahasiswa
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'nim' => 'required|string|max:15|unique:mahasiswas,nim',
                'nama' => 'required|string|max:100',
                'email' => 'required|email|max:100|unique:mahasiswas,email',
                'jurusan' => 'required|string|max:100',
                'telepon' => 'required|string|max:20',
            ]);

            $mahasiswa = Mahasiswa::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $mahasiswa,
                'message' => 'Mahasiswa created successfully'
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified Mahasiswa
     */
    public function show(string $id): JsonResponse
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mahasiswa,
            'message' => 'Mahasiswa retrieved successfully'
        ], 200);
    }

    /**
     * Update the specified Mahasiswa
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa not found'
            ], 404);
        }

        try {
            $validatedData = $request->validate([
                'nim' => 'sometimes|required|string|max:15|unique:mahasiswas,nim,' . $id,
                'nama' => 'sometimes|required|string|max:100',
                'email' => 'sometimes|required|email|max:100|unique:mahasiswas,email,' . $id,
                'jurusan' => 'sometimes|required|string|max:100',
                'telepon' => 'sometimes|required|string|max:20',
            ]);

            $mahasiswa->update($validatedData);

            return response()->json([
                'success' => true,
                'data' => $mahasiswa,
                'message' => 'Mahasiswa updated successfully'
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified Mahasiswa
     */
    public function destroy(string $id): JsonResponse
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa not found'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa deleted successfully'
        ], 200);
    }
}
