<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\StoreSetting;

class AdminController extends \Illuminate\Routing\Controller
{
    public function loginForm()
    {
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $data['email'])->first();

        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            return back()->withErrors([
                'email' => 'Email or password is incorrect.'
            ]);
        }

        $request->session()->regenerate();

        session([
            'admin_id' => $admin->id,
            'admin_name' => $admin->name,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'productsCount' => Product::count(),
            'activeProductsCount' => Product::where('is_active', true)->count(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
    
// Display all products
public function products()
{
    $products = Product::latest()->paginate(10);

    return view('admin.products.index', compact('products'));
}

// Show create form
public function createProduct()
{
    return view('admin.products.create');
}

// Save new product
public function storeProduct(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'is_active' => 'nullable|boolean',
    ]);

    $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
    $data['is_active'] = $request->boolean('is_active');

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    Product::create($data);

    return redirect()->route('admin.products')
        ->with('success', 'Product added successfully!');
}

// Show edit form
public function editProduct(Product $product)
{
    return view('admin.products.edit', compact('product'));
}

// Update product
public function updateProduct(Request $request, Product $product)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'is_active' => 'nullable|boolean',
    ]);

    $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
    $data['is_active'] = $request->boolean('is_active');

    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('admin.products')
        ->with('success', 'Product updated successfully!');
}

// Delete product
public function deleteProduct(Product $product)
{
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    $product->delete();

    return redirect()->route('admin.products')
        ->with('success', 'Product deleted successfully!');
}
public function settings()
{
    $settings = StoreSetting::firstOrCreate(
        ['id' => 1],
        [
            'store_name' => 'My Store',
            'whatsapp_number' => '212777459468',
        ]
    );

    return view('admin.settings', compact('settings'));
}

public function updateSettings(Request $request)
{
    $data = $request->validate([
        'whatsapp_number' => [
            'required',
            'regex:/^[0-9]{10,15}$/',
        ],
    ]);

    $settings = StoreSetting::firstOrCreate(['id' => 1]);
    $settings->update($data);

    return back()->with('success', 'WhatsApp number updated successfully!');
}

}
