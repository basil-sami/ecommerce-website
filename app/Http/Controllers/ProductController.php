<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Company;
use App\Models\Category; // Import Category model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Import Auth facade for authentication
use App\Http\Controllers\OrderController; // Import OrderController if need


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $products = Product::withCount(['views' => function ($query) {
            $query->where('user_id', auth()->id());
        }])
        ->orderByDesc('views_count')
        ->take(10)
        ->get();


        return view('products.index', compact('products'));
    }

    public function create()
    {
        $companies = Company::all();
        $categories = Category::all(); // Fetch all categories
        return view('products.create', compact('companies', 'categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'category_id' => 'nullable|exists:categories,id', // Validate category_id
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('products.create')
                             ->withErrors($validator)
                             ->withInput();
        }
    
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $data['image_path'] = $imagePath;
        }
    
        Product::create($data);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    
    public function show($id)
    {
        $product = Product::findOrFail($id);
    
        // Track product view
        if (Auth::check()) {
            $user = Auth::user();
            $category_id = $product->category ? $product->category->id : null;
            $product->increment('views'); // Increment views counter
    
            // Add a new entry for each view
            $user->productViews()->attach($product->id, [
                'category_id' => $category_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    
        return view('products.show', compact('product'));
    }
    


    public function edit(Product $product)
    {
        $companies = Company::all();
        $categories = Category::all(); // Fetch all categories
        return view('products.edit', compact('product', 'companies', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'category_id' => 'nullable|exists:categories,id', // Validate category_id
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('products.edit', $product)
                             ->withErrors($validator)
                             ->withInput();
        }
    
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $imagePath = $request->file('image')->store('product_images', 'public');
            $data['image_path'] = $imagePath;
        }
    
        $product->update($data);
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    
    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
    
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function confirmation (Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1|max:' . $product->quantity,
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('products.show', $product->id)
                             ->withErrors($validator)
                             ->withInput();
        }
    
        $quantity = $request->input('quantity');
        $totalAmount = $product->price * $quantity;
        $userId = Auth::id();
        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('products.index')->with('error', 'User not found.');
        }
    
        // Create a new Order
       
    
        // Update the product stock
        
    
        // Save purchase data to session
        session()->put('purchase_data', [
                       'product_id' => $product->id,
            'quantity' => $quantity,
            'total_amount' => $totalAmount,
        ]);
        return view('products.confirmation', compact('product'));
    }
    public function purchase(Product $product)
{
    // Retrieve purchase data from session
    $purchaseData = session()->get('purchase_data');

    if (!$purchaseData) {
        return redirect()->route('products.index')->with('error', 'Purchase data not found.');
    }

    $quantity =   (int)$purchaseData['quantity'];
$userId = Auth::id();
$totalAmount = (int) $purchaseData['total_amount'];



      
        $product->decrement('quantity', $quantity);

        $orderController = new OrderController();
        $order = $orderController->save($userId, $product->id, $quantity, $totalAmount, 'pending');
    
        // Create a new Order Item
        $orderItemController = new OrderItemController();
        $orderItemController->save($userId, $product->id, $quantity, $product->price, 'pending');
        $order->status = 'confirmed';

        // Update the Order status to confirmed
        #$order = OrderController::find($purchaseData['order_id']);
        #if (!$order) {
           # throw new \Exception('Order not found.');
        #}
       
        $order->save();

        // Update associated OrderItems if necessary
        #$orderItems = OrderItemController::where('order_id', $order->id)->get();
        #foreach ($orderItems as $orderItem) {
            // Optionally update OrderItem status or other details
            // $orderItem->status = 'confirmed';
            // $orderItem->save();
       # }

        

        // Clear the session data after successful update
        session()->forget('purchase_data');

        return redirect()->route('products.index')->with('success', 'Order confirmed successfully.');
    
}
public function search(Request $request)
{
    $query = $request->get('query');
    $minPrice = $request->get('min_price');
    $maxPrice = $request->get('max_price');

    // Query products
    $products = Product::query();

    // Apply search query if provided
    if ($query) {
        $products->where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%$query%")
                         ->orWhere('description', 'like', "%$query%");
        });
    }

    // Apply price range filtering
   # if ($minPrice && $maxPrice) {
#    } elseif ($minPrice) {
 #       $products->where('price', '>=', $minPrice);
  #  } elseif ($maxPrice) {
  #      $products->where('price', '<=', $maxPrice);
  #  }

    // Retrieve filtered products
    $filteredProducts = $products->get();

    // Separate products within and outside the price range
    $productsWithinRange = $filteredProducts->whereBetween('price', [$minPrice, $maxPrice])->values();
    $productsOutsideRange = $filteredProducts->whereNotBetween('price', [$minPrice, $maxPrice])->values();

    return view('products.search', compact('productsWithinRange', 'productsOutsideRange', 'query', 'minPrice', 'maxPrice'));
}



}
