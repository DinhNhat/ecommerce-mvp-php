<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Services\UploadFileService;
use App\Http\Services\UploadImageService;
use App\Http\Services\UploadService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    private $fileService;
    private $imageService;

    public function __construct(UploadFileService $fileService, UploadImageService $imageService)
    {
        $this->fileService = $fileService;
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select(['id', 'name', 'is_available_for_purchase', 'price_in_cents', 'image_path'])
        ->orderBy('id', 'asc')
        ->withCount('orders')
        ->get();

        return view('admin.products', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // validate and store the product
        $validated = $request->validated();

        $fileUrl = $this->fileService->store($request);

        // Retrieve a portion of the validated input data...
        $validated = $request->safe()->only(['name', 'description', 'priceInCents', 'file', 'image', 'imageSave']);
        
        $product = Product::create([
            'name' => $validated['name'], 
            'description' => $validated['description'], 
            'price_in_cents' => $validated['priceInCents'], 
            'file_path' => ($fileUrl !== false) ? $fileUrl : '', 
            'image_path' => $validated['imageSave']
        ]);
        
        return redirect()->route('admin.products');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        return view('admin.products-edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!empty($request->name) && $product->name !== $request->name) {
            $product->name = $request->name;
        }

        if (!empty($request->priceInCents) && $product->price_in_cents !== $request->priceInCents) {
            $product->price_in_cents = $request->priceInCents;
        }

        if (!empty($request->description) && $product->description !== $request->description) {
            $product->description = $request->description;
        }

        if (!empty($request->imageSave) && !empty($request->image) && $product->image_path !== $request->imageSave) {
            // delete the old image
            $deletedImgPath = public_path() . $product->image_path;
            unlink($deletedImgPath);

            // save new image path
            $this->imageService->store($request);
            $product->image_path = $request->imageSave;
        }

        if (!empty($request->file)) {
            // delete the old file
            $deletedFilePath = public_path() . $product->file_path;
            unlink($deletedFilePath);

            $fileUrl = $this->fileService->store($request);
            $product->file_path = ($fileUrl !== false) ? $fileUrl : '';
        }

        $product->save();

        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete a product by id
        $product = Product::find($id);

        $deletedImgPath = public_path() . $product->image_path;
        // check if the image path exists
        if (Storage::disk('public')->exists($product->image_path_without_storage)) {
            unlink($deletedImgPath); // delete the image from the public folder
        }
        

        $deletedFilePath = public_path() . $product->file_path;
        // check if the file path exists
        if (Storage::disk('public')->exists($product->file_path_without_storage)) {
            unlink($deletedFilePath); // delete the file from the public folder
        }
        
        $product->delete();

        return redirect()->route('admin.products');
    }

    public function toggleAvailability(Request $request, $id)
    {
        $product = Product::find($id);
        $product->is_available_for_purchase = !$product->is_available_for_purchase;
        $product->save();

        return redirect()->route('admin.products');
    }

    public function uploadImage(Request $request)
    {
        $url = $this->imageService->store($request);

        if ($url !== false) {
            return response()->json([
                'error' => false,
                'url' => $url
            ]);
        }

        return response()->json(['error' => true]);
    }
}
