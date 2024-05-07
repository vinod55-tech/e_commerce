@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Edit Product</h1>
    </div>
    <div id="message">

    </div>
    <form id="update_product_form">
        <input type="hidden"  id="p_id" name="id" value="{{$product->id}}">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}" placeholder="Enter name">
        </div>
        <br>
        <div class="form-group" id="appended_field">
            <?php
            $color_arr = [];
            ?>
            
            @foreach($product->productdetails as $productdetail)
            <?php
            //color
                $encd_colors = $productdetail->color_id;
                $color_arr = json_decode($encd_colors);
            //size
                $encd_sizes = $productdetail->size_id;
                $size_arr = json_decode($encd_sizes);
            //quantity
                $encd_quantity = $productdetail->stock_quantity;
                $quantity_arr = json_decode($encd_quantity);

            //price
                $encd_price = $productdetail->price;
                $price_arr = json_decode($encd_price);

            ?>
            @foreach($color_arr as $color_key=>$color_val)
            <div class="row">
                <div class="col-1"></div>
                <div class="col-2">
                    <label for="color">Color</label>
                    <select name="color[]" id="color">
                        <option value="">Select color</option>
                        @foreach($colors as $color)
                        <option value="{{$color->id}}" {{$color_val == $color->id ? 'selected':''}}>{{$color->color}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-2">
                    <label for="size">size</label>
                    <select name="size[]" id="size">
                        <option value="">Select size</option>
                        @foreach($sizes as $size)
                        <option value="{{$size->id}}" {{$size_arr[$color_key] == $size->id ? 'selected':''}}>{{$size->size}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity[]" value="{{$quantity_arr[$color_key]}}" placeholder="Enter quantity">
                </div>
                <div class="col-2">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price[]" value="{{$price_arr[$color_key]}}" placeholder="Enter price">
                </div>
                @if($color_key == 0)
                    <div class="col-3 text-center pt-5" id="add_button"><i class="fa-solid fa-plus"></i></div>
                @else
                    <div class="col-3 text-center pt-5 remove_button"><i class="fa-solid fa-minus "></i></div>
                @endif
            </div>
            @endforeach
            @endforeach
        </div>
        <br>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{$product->description}}" placeholder="Enter description">
        </div>
        <br>
        <div class="form-group">
            <label for="image">Image</label>
            <span>  <img width="80" src="{{asset('/images/'.$product->image.'') }}"></span>
            <input type="hidden"  name="pre_image" value="{{$product->image}}">
            <input type="file" class="form-control" id="image" name="image" value="{{$product->image}}" placeholder="Enter image">
        </div>
        <br>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        $(document).ready(function(){
            $('#add_button').click(function(){
                // add variations divs
                var add_fields = '<div class="row variations"><div class="col-1"></div><div class="col-2"><label for="color">Color</label><select name="color[]" id="color"><option value="">Select Color</option>';
                <?php foreach($colors as $color): ?>
                add_fields += '<option value="<?php echo $color->id; ?>"><?php echo $color->color; ?></option>';
                <?php endforeach; ?>
                add_fields += '</select></div><div class="col-2"><label for="size">Size</label><select name="size[]" id="size"><option value="">Select Size</option>';
                <?php foreach($sizes as $size): ?>
                add_fields += '<option value="<?php echo $size->id; ?>"><?php echo $size->size; ?></option>';
                <?php endforeach; ?>
                add_fields += '</select></div><div class="col-2"><label for="quantity">Quantity</label><input type="number" class="form-control" id="quantity" name="quantity[]" placeholder="Enter quantity"></div><div class="col-2"><label for="price">Price</label><input type="number" class="form-control" id="price" name="price[]" placeholder="Enter price"></div><div class="col-3 text-center pt-5 remove_button"><i class="fa-solid fa-minus "></i></div></div>';
            $('#appended_field').append(add_fields);
            });

            // Deleting appended field
            $('#appended_field').on('click','.remove_button',function(){
                $(this).closest('.row').remove();
            });

            $('#update_product_form').on('submit', function(event){
                event.preventDefault();
                var p_id = $('#p_id').val();
                var formData = new FormData(this);

                $.ajax({
                    url:'/api/update-product/'+p_id+'',
                    type:'POST',
                    data:formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.status == "success"){
                            localStorage.setItem('product_message','<div class="alert alert-success">' + response.message + '</div>');
                            window.location.href ='/dashboard';
                        }else{
                            $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    }

                });
            });
        });
    </script>
</section>
@endsection
