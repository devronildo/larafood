<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $product, $category;


    public function __construct(product $product, Category $category){
        $this->product = $product;
        $this->category = $category;
    }

    public function categories($idProduct){

         if(!$product = $this->product->find($idProduct)){
               return redirect()->back();

               $this->middleware(['can:products']);
         }

         $categories = $product->categories()->paginate();

         return view('admin.pages.products.categories.categories',
          compact('product', 'categories'));
    }

    public function products($idCategory){


         if(!$category = $this->category->find($idCategory)){
               return redirect()->back();
         }

         $products = $category->products()->paginate();

         return view('admin.pages.categories.products.products',
          compact('category', 'products'));
    }

    public function categoriesAvailable(Request $request, $idproduct){

        if(!$product = $this->product->find($idproduct)){
              return redirect()->back();
        }

        $filters = $request->except('_token');



        $categories = $product->categoriesAvailable($request->filter);


      return view('admin.pages.products.categories.available',
          compact('product', 'categories', 'filters'));

    }

    public function attachCategoriesproduct(Request $request, $idProduct){

        if(!$product = $this->product->find($idProduct)){
              return redirect()->back();
        }

        if(!$request->categories || count($request->categories) === 0){
            return redirect()
                   ->back()
                   ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        $product->categories()->attach($request->categories);

        return redirect()->route('products.categories', $product->id);
    }

    public function detachCategoryproduct($idProduct, $idCategory){
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if(!$product || !$category){
            return redirect()->back();
        }

        $product->categories()->detach($category);

        return redirect()->route('products.categories', $product->id);
    }
}
