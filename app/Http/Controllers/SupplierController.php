<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

public function index(Request $request)
{
    $suppliers = Supplier::query();

   if ($request->search) {

    $search = $request->search;

    $suppliers->where(function ($query) use ($search) {

        $query->where('name', 'like', "%{$search}%")
              ->orWhere('category', 'like', "%{$search}%")
              ->orWhere('product_service', 'like', "%{$search}%")
              ->orWhere('payment_method', 'like', "%{$search}%")
              ->orWhere('payment_terms', 'like', "%{$search}%")
              ->orWhere('primary_contact', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%");
    });
}
    $suppliers = $suppliers->paginate(5);

    return view('admin.suppliers', compact('suppliers'));
}

   public function store(Request $request)
{
    Supplier::create([

        'name' => ucwords(strtolower($request->name)),
        'category' => ucwords(strtolower($request->category)),
        'product_service' => ucwords(strtolower($request->product_service)),
        'rating' => $request->rating,

        'primary_contact' =>
        ucwords(strtolower($request->primary_contact)),

        'contact_person' =>
        ucwords(strtolower($request->primary_contact)),

        'phone' => $request->phone,

        'email' => strtolower($request->email),

        'address' =>
        ucwords(strtolower($request->address)),

        'payment_terms' =>
        ucwords(strtolower($request->payment_terms)),

        'payment_method' =>
        ucwords(strtolower($request->payment_method)),

        'status' => strtolower($request->status),

        'contract_start' => $request->contract_start,
        'contract_end' => $request->contract_end
    ]);

    return redirect()
        ->back()
        ->with('success','Supplier added successfully!');
}

   public function update(Request $request, $id)
{
    $supplier = Supplier::findOrFail($id);
$supplier->update([
'name' => ucwords(strtolower($request->name)),
'category' => ucwords(strtolower($request->category)),
'product_service' => ucwords(strtolower($request->product_service)),
'primary_contact' => ucwords(strtolower($request->primary_contact)),
'contact_person' => ucwords(strtolower($request->primary_contact)),
'email' => strtolower($request->email),
'address' => ucwords(strtolower($request->address)),
'payment_terms' => ucwords(strtolower($request->payment_terms)),
'payment_method' => ucwords(strtolower($request->payment_method)),
'status' => strtolower($request->status),
]);

    return redirect()
        ->route('suppliers')
        ->with('success','Supplier updated successfully');
}

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return redirect()->back()
            ->with('success','Supplier deleted successfully.');
    }

    
    public function statistics()
{
    $totalSuppliers = Supplier::count();

    $activeSuppliers =
    Supplier::where('status','active')->count();

    $inactiveSuppliers =
    Supplier::where('status','inactive')->count();

    $averageRating =
    Supplier::avg('rating');

    return view(
        'admin.statistical-dashboard',
        compact(
            'totalSuppliers',
            'activeSuppliers',
            'inactiveSuppliers',
            'averageRating'
        )
    );
}
}