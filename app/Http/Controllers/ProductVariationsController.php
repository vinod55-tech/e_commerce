<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Size;

class ProductVariationsController extends Controller
{
    public function color_page(){
        return view('admin.color');
    }

    public function add_color(){
        return view('admin.add_color');
    }

    public function create_color(Request $request){

        $validate = $request->validate([
            'color'=>'required'
        ]);

        $color = new Color;
        $color->color = $request->color;
        $color->save();
        return response()->json(['status'=>'success','message'=>'Your data has been stored successfully.'], 200);
    }

    public function color_list(){
        $color_list = Color::get();
        $all_color_data = [];
        foreach($color_list as $colors){
            $all_color_data[] = '<tr>
            <th scope="row">'.$colors->id.'</th>
            <td>'.$colors->color.'</td>
            <td><a href="/api/edit-color/'.$colors->id.'" style="min-width: 100px!important;min-height: 50px!important;" class="btn btn-primary">Edit</a>  <a href="javascript:void(0);" style="min-width: 100px!important;min-height: 50px!important;" class="btn btn-danger" onClick="deletefunction('.$colors->id.')">Delete</a></td></tr>';
        }

        return response()->json(['satus'=>'success','message'=>'colors list fatched.','data'=>$all_color_data], 200);
    }

    public function edit_color($id){
        $color = Color::find($id);
        return view('admin.edit_color', compact('color'));
    }

    public function update_color(Request $request){
        $validate = $request->validate([
            'color'=>'required'
        ]);

        $color = Color::find($request->id);
        $color->color = $request->color;
        $color->save();
        return response()->json(['status'=>'success','message'=>'Your data has been update successfully.'], 200);
    }

    public function delete_color($id){
        $color = Color::find($id);
        $color->delete();
        return response()->json(['status'=>'success','message'=>'Your data has been deleted successfully.'], 200);
    }

    public function size_page(){
        return view('admin.size');
    }

    public function add_size(){
        return view('admin.add_size');
    }

    public function create_size(Request $request){

        $validate = $request->validate([
            'size'=>'required'
        ]);

        $color = new Size;
        $color->size = $request->size;
        $color->save();
        return response()->json(['status'=>'success','message'=>'Your data has been stored successfully.'], 200);
    }

    public function size_list(){
        $size_list = Size::get();
        $all_size_data = [];
        foreach($size_list as $sizes){
            $all_size_data[] = '<tr>
            <th scope="row">'.$sizes->id.'</th>
            <td>'.$sizes->size.'</td>
            <td><a href="/api/edit-size/'.$sizes->id.'" style="min-width: 100px!important;min-height: 50px!important;" class="btn btn-primary">Edit</a> <a href="javascript:void(0)" style="min-width: 100px!important;min-height: 50px!important;" class="btn btn-danger" onClick="deleteSize('.$sizes->id.')">Delete</td></tr>';
        }
        return response()->json(['satus'=>'success','message'=>'size list fatched.','data'=>$all_size_data], 200);
    }

    public function edit_size($id){
        $size = Size::find($id);
        return view('admin.edit_size', compact('size'));
    }

    public function update_size(Request $request){
        $validate = $request->validate([
            'size'=>'required'
        ]);

        $size = Size::find($request->id);
        $size->size = $request->size;
        $size->save();
        return response()->json(['status'=>'success','message'=>'Your data has been update successfully.'], 200);
    }

    public function delete_size($id){
        $size = Size::find($id);
        $size->delete();
        return response()->json(['status'=>'success','message'=>'Your data has been deleted successfully.'], 200);
    }
    
}
