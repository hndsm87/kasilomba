<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        $criterias = Criteria::orderBy('category')->orderBy('order')->get();
        return view('admin.criteria', compact('criterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:all,smartphone,dslr',
            'weight' => 'required|integer|min:1|max:100',
            'order' => 'required|integer|min:1',
        ]);

        Criteria::create([
            'name' => $request->name,
            'category' => $request->category,
            'weight' => $request->weight,
            'order' => $request->order,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Criteria added successfully.');
    }

    public function update(Request $request, Criteria $criteria)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:all,smartphone,dslr',
            'weight' => 'required|integer|min:1|max:100',
            'order' => 'required|integer|min:1',
        ]);

        $criteria->update([
            'name' => $request->name,
            'category' => $request->category,
            'weight' => $request->weight,
            'order' => $request->order,
        ]);

        return redirect()->back()->with('success', 'Criteria updated successfully.');
    }

    public function destroy(Criteria $criteria)
    {
        // Don't delete if it has scores (to prevent breaking historical data)
        // Or we could soft delete it, or just delete it if the user insists.
        // We'll delete it for now but in a production app we might check relationships.
        
        if ($criteria->scores()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete criteria that already has scores. Please deactivate it instead.');
        }

        $criteria->delete();

        return redirect()->back()->with('success', 'Criteria deleted successfully.');
    }
}
