<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Validation\ValidationException;

class PackageController extends Controller
{
    /**
     * Display a listing of the packages.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtain all packages with their category
        $packages = Package::with('category')
                   ->latest()
                   ->get();

        // Pass packages to the view
        return view('packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new package.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get all categories from the database
        $categories = Category::all();

        // Pass categories to the view
        return view('packages.create', compact('categories'));
    }

    /**
     * Display the specified package.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $package = Package::with(['user', 'category'])->findOrFail($id);

        return view('packages.show', compact('package'));
    }

    /**
     * Store a newly created package in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate form data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'destination' => 'required|string|max:255',
                'description' => 'required|string',
                'duration' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric|min:0',
                'location' => 'required|string|max:255',
                'includes_flights' => 'boolean',
                'includes_hotel' => 'boolean',
            ]);

            // Get authenticated user ID
            $userId = Auth::id();

            // Create the package
            $package = new Package();
            $package->user_id = $userId;
            $package->category_id = $validatedData['category_id'];
            $package->title = $validatedData['title'];
            $package->destination = $validatedData['destination'];
            $package->description = $validatedData['description'];
            $package->duration = $validatedData['duration'];
            $package->price = $validatedData['price'];
            $package->location = $validatedData['location'];
            $package->includes_flights = $request->has('includes_flights');
            $package->includes_hotel = $request->has('includes_hotel');
            $package->save();

            // Redirect with a success message
            return redirect()->route('packages.index')
                ->with('success', 'Paquete publicado correctamente!');

        } catch (ValidationException $e) {
            // Redirect back with validation errors and old input
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }
}
