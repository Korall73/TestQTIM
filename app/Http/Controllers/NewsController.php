<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class NewsController extends Controller
{
    private object $NewsRepository;

    public function __construct(NewsRepository $NewsRepository)
    {
        $this->NewsRepository = $NewsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): object
    {
        return response()->json($this->NewsRepository->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): object
    {
        return response()->json($this->NewsRepository->create($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): object
    {
        return response()->json($this->NewsRepository->show($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): object
    {
        return response()->json($this->NewsRepository->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): object
    {
        return response()->json($this->NewsRepository->delete($id));
    }
}
