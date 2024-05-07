<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productdetail;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{
    public function product_page(){
        return view('admin.dashboard');
    }

    public function add_product(){
        $colors = Color::get();
        $sizes = Size::get();
        return view('admin.add_product', compact('colors','sizes'));
    }

    public function create_product(Request $request){

        $validate = Validator::make($request->all(),[
            'name'=>'required',
            'color'=>'required',
            'size'=>'required',
            'quantity'=>'required',
            'price'=>'required'
        ]);

        if($validate->fails()) {
            return response()->json(['status'=>'errors','message'=>$validate->errors()]);
        }else{
            if($request->hasFile('image')){
                $file = $request->file('image');
                $file_name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $location = public_path('images/');
                $file->move($location, $file_name);
            }else{
                $file_name = '';
            }
    
            if(isset($request->color)){
                $colors = json_encode($request->color);
            }
            if(isset($request->size)){
                $size = json_encode($request->size);
            }
            if(isset($request->quantity)){
                $quantity = json_encode($request->quantity);
            }
            if(isset($request->price)){
                $price = json_encode($request->price);
            }
    
    
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->image = $file_name;
            $product->save();
    
            $product_details = new Productdetail;
            $product_details->product_id = $product->id;
            $product_details->color_id = $colors;
            $product_details->size_id = $size;
            $product_details->stock_quantity = $quantity;
            $product_details->price = $price;
            $product_details->save();
    
            return response()->json(['status'=>'success','message'=>'Your product has been stored successfully.'], 200);
        }

        
    }

    public function products_list(){

        // colors dropdown
        $all_colors = Color::get();
        $colors = [];
        foreach($all_colors as $color){
            $colors[] = '<option value="'.$color->id.'">'.$color->color.'</option>';
        }

        // sizes dropdown
        $all_sizes = Size::get();
        $sizes = [];
        foreach($all_sizes as $size){
            $sizes[] = '<option value="'.$size->id.'">'.$size->size.'</option>';
        }
       
        // Products listing and searching
        // $products = Product::with('productDetails.color', 'productDetails.size')->get();
        if(isset($_GET['product_name'])){
            $products = Product::where('name', 'like', '%'.$_GET['product_name'].'%')->get();
        }else{
            $products = Product::get();
        }
        
        $product_list = [];
        $i = 1;
        foreach($products as $product){
            foreach($product->productDetails as $detail){
                $color_details = json_decode($detail->color_id);
                $color_name = Color::where('id',$color_details[0])->select('color')->first();
                $size_details = json_decode($detail->size_id);
                $size_length = Size::where('id',$size_details[0])->select('size')->first();
                $quantity_details = json_decode($detail->stock_quantity);
                $price_details = json_decode($detail->price);

                $product_list[] = '<tr>
                <th scope="row">'.$i.'</th>
                <td>'.$product->name.'</td>
                <td>Image</td>
                <td>'.$product->description.'</td>
                <td>'.$color_name->color.'</td>
                <td>'.$size_length->size.'</td>
                <td>'.$quantity_details[0].'</td>
                <td>'.$price_details[0].'</td>
                <td><a href="/edit-product/'.$product->id.'">Edit</a>&nbsp;&nbsp; <a href="javascript:void(0);" onclick="deleteProduct('.$product->id.')">Delete</a></td>
                </tr>';
                $i++;     
            }
        }
    
        // dd($product_list);
        return response()->json(['satus'=>'success','message'=>'product list fatched.','products'=>$product_list,'colors'=>$colors,'sizes'=>$sizes], 200);
    }

    public function color_filter(Request $request){

        // sizes dropdown
        $all_sizes = Size::get();
        $sizes = [];
        foreach($all_sizes as $size){
            $sizes[] = '<option value="'.$size->id.'">'.$size->size.'</option>';
        }
    
        $products = Product::get();
        
        $product_list = [];
        $i = 1;
        // color filter
        foreach($products as $product){
            foreach($product->productDetails as $detail){
                $color_details = json_decode($detail->color_id);
                if(isset($_GET['colors'])){
                    $search_color = $_GET['colors'];
                    if(in_array($search_color,$color_details)){
                        $color_name = Color::where('id',$search_color)->select('color')->first();
                    $key = array_search($search_color, $color_details);
                        $size_details = json_decode($detail->size_id);
                        $size_length = Size::where('id',$size_details[$key])->select('size')->first();
                        $quantity_details = json_decode($detail->stock_quantity);
                        $price_details = json_decode($detail->price);

                        $product_list[] = '<tr>
                        <th scope="row">'.$i.'</th>
                        <td>'.$product->name.'</td>
                        <td>Image</td>
                        <td>'.$product->description.'</td>
                        <td>'.$color_name->color.'</td>
                        <td>'.$size_length->size.'</td>
                        <td>'.$quantity_details[$key].'</td>
                        <td>'.$price_details[$key].'</td>
                        <td><a href="/edit-product/'.$product->id.'">Edit</a>&nbsp;&nbsp; <a href="javascript:void(0);" onclick="deleteProduct('.$product->id.')">Delete</a></td>
                        </tr>';     
                    }else{
                        $product_list[] ='';
                    }

                }
                $i++;
            }
        }
        return response()->json(['satus'=>'success','message'=>'product list fatched.','products'=>$product_list,'sizes'=>$sizes], 200);


    }

    public function size_filter(Request $request){
    
        // colors dropdown
        $all_colors = Color::get();
        $colors = [];
        foreach($all_colors as $color){
            $colors[] = '<option value="'.$color->id.'">'.$color->color.'</option>';
        }

        $products = Product::get();
        
        $product_list = [];
        $i = 1;
        // size filter
        foreach($products as $product){
            foreach($product->productDetails as $detail){
                $size_details = json_decode($detail->size_id);
                if(isset($_GET['size'])){
                    $search_size = $_GET['size'];
                    if(in_array($search_size,$size_details)){
                        $size_length = Size::where('id',$search_size)->select('size')->first();
                      $key = array_search($search_size, $size_details);
                        $color_details = json_decode($detail->color_id);
                        $color_name = Color::where('id',$color_details[$key])->select('color')->first();
                        $quantity_details = json_decode($detail->stock_quantity);
                        $price_details = json_decode($detail->price);

                        $p_qty[] = $quantity_details[$key];
                        $_p_price[] = $price_details[$key];

                        $product_list[] = '<tr>
                        <th scope="row">'.$i.'</th>
                        <td>'.$product->name.'</td>
                        <td>Image</td>
                        <td>'.$product->description.'</td>
                        <td>'.$color_name->color.'</td>
                        <td>'.$size_length->size.'</td>
                        <td>'.$quantity_details[$key].'</td>
                        <td>'.$price_details[$key].'</td>
                        <td><a href="/edit-product/'.$product->id.'">Edit</a>&nbsp;&nbsp; <a href="javascript:void(0);" onclick="deleteProduct('.$product->id.')">Delete</a></td>
                        </tr>';     
                    }else{
                        $product_list[] ='';
                    }

                }
                $i++;
            }
        }
        return response()->json(['satus'=>'success','message'=>'product list fatched.','products'=>$product_list,'colors'=>$colors], 200);
    }

    public function edit_product($id){
        
        $product = Product::find($id);
        $colors = Color::get();
        $sizes = Size::get();
        // $productdetails = $products->productdetails;
        // dd($productdetails);
        return view('admin.edit_product', compact('product','colors','sizes'));
    }

    public function update_product(Request $request, $id){

        $validate = Validator::make($request->all(),[
            'name'=>'required',
            'color'=>'required',
            'size'=>'required',
            'quantity'=>'required',
            'price'=>'required'
        ]);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        }

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $location = public_path('images/');
            $file->move($location, $file_name);
        }else{
            $file_name = $request->pre_image;
        }

        if(isset($request->color)){
            $colors = json_encode($request->color);
        }
        if(isset($request->size)){
            $size = json_encode($request->size);
        }
        if(isset($request->quantity)){
            $quantity = json_encode($request->quantity);
        }
        if(isset($request->price)){
            $price = json_encode($request->price);
        }


        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $file_name;
        $product->save();

        $product_details = Productdetail::find($product->id);
        $product_details->product_id = $product->id;
        $product_details->color_id = $colors;
        $product_details->size_id = $size;
        $product_details->stock_quantity = $quantity;
        $product_details->price = $price;
        $product_details->save();

        return response()->json(['status'=>'success','message'=>'Your product has been updated successfully.'], 200);
    }

    public function deleteproduct($id){
        $product = Product::find($id);
        $product->delete();
        return response()->json(['status'=>'success','message'=>'Your product has been deleted successfully.'], 200);
    }
}
