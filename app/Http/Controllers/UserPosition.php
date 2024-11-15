<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Report;
use App\Models\UserPosition as ModelUserPosition;
use Illuminate\Http\Request;
use Closure;

class UserPosition extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [];
        $data['positions'] = Position::all();
        $data['reports_to'] = Report::all();
    
        // Retrieve search and sorting parameters
        $sortOrder = $request->get('sort', 'asc');
        $search = $request->get('search', '');
    
        // Query user positions, filter by search term if provided, and sort by position_name
        $data['user_positions'] = ModelUserPosition::when($search, function ($query, $search) {
                return $query->where('position_name', 'like', '%' . $search . '%');
            })
            ->orderBy('position_name', $sortOrder)
            ->get();
    
        return view('welcome', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'position_name' => 'required|unique:user_positions,position_name|string|max:255',
        ]);

        if($data['report_id'] == null && ModelUserPosition::whereNull('report_id')->exists()) {
            return redirect()->back()
                ->withErrors(['report_id' => 'Only one blank value is allowed in the report_id column.']);
        }
        
        ModelUserPosition::create([
            'position_name' => $data['position_name'],
            'report_id' => $data['report_id'],
        ]);

        // Flash success message to the session
        session()->flash('success', 'New user position was added');

        // Redirect back to the welcome page (or another view as needed)
        return redirect()->back();
    }

    public function indexAPI(Request $request)
    {
        $data = [];

        // Retrieve search and sorting parameters
        $sortOrder = $request->get('sort', 'asc');
        $search = $request->get('search', '');

        // Query user positions, filter by search term if provided, and sort by position_name
        $data['user_positions'] = ModelUserPosition::when($search, function ($query, $search) {
                return $query->where('position_name', 'like', '%' . $search . '%');
            })
            ->orderBy('position_name', $sortOrder)
            ->get();

        // Return JSON response
        return response()->json($data);
    }

    /**
     * Create a new position.
     */
    public function createAPI(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'position_name' => 'required|unique:user_positions,position_name|string|max:255',
        ]);

        // Ensure only one record has a null report_id
        if ($data['report_id'] === null && ModelUserPosition::whereNull('report_id')->exists()) {
            return response()->json(['error' => 'Only one blank value is allowed in the report_id column.'], 400);
        }

        // Create the new position
        $userPosition = ModelUserPosition::create([
            'position_name' => $data['position_name'],
            'report_id' => $data['report_id'],
        ]);

        return response()->json(['message' => 'New user position was added', 'data' => $userPosition], 201);
    }

    /**
     * Show details of a specific position.
     */
    public function show(string $id)
    {
        $userPosition = ModelUserPosition::findOrFail($id);
        return response()->json($userPosition);
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        // Validate request data
        $request->validate([
            'position_name' => 'required|string|max:255',
        ]);

        $userPosition = ModelUserPosition::findOrFail($id);

        // Update the position
        $userPosition->update([
            'position_name' => $data['position_name'],
            'report_id' => $data['report_id'],
        ]);

        return response()->json(['message' => 'User position updated successfully', 'data' => $userPosition]);
    }

    /**
     * Remove the specified position from storage.
     */
    public function destroy(string $id)
    {
        $userPosition = ModelUserPosition::findOrFail($id);
        $userPosition->delete();

        return response()->json(['message' => 'User position deleted successfully'], 204);
    }

}
