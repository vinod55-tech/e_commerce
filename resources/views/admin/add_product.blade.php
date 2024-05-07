@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Add Product</h1>
    </div>
    <div id="message">

    </div>
    <form id="product_form">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        </div>
        <br>
        <div class="form-group" id="appended_field">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-2">
                    <label for="color">Color</label>
                    <select name="color[]" id="color">
                        <option value="">Select Color</option>
                        @foreach($colors as $color)
                        <option value="{{$color->id}}">{{$color->color}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <label for="size">size</label>
                    <select name="size[]" id="size">
                        <option value="">Select size</option>
                        @foreach($sizes as $size)
                        <option value="{{$size->id}}">{{$size->size}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity[]" placeholder="Enter quantity">
                </div>
                <div class="col-2">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price[]" placeholder="Enter price">
                </div>
                <div class="col-3 text-center pt-5" id="add_button"><i class="fa-solid fa-plus"></i></div>
            </div> 
        </div>
        <br>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
        </div>
        <br>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="Enter image">
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

            $('#product_form').on('submit', function(event){
                event.preventDefault();
                var color = $('#color').val();
                var size = $('#size').val();
                var quantity = $('#quantity').val();
                var price = $('#price').val();
                if(color.lenght > 0 || size.length > 0 || quantity > 0 || price.length > 0){
                    var formData = new FormData(this);
                    $.ajax({
                        url:'/api/create-product',
                        type:'POST',
                        data:formData,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            if(response.status == "success"){
                                localStorage.setItem('product_message','<div class="alert alert-success">' + response.message + '</div>');
                                window.location.href ='/dashboard';
                            }else{
                                alert('????')
                                $.each(response.message, function(key, value) {
                                    $('#message').html('<div class="alert alert-danger">' +value + '</div>');
                                });
                            }
                            
                        }

                    });
                }else{
                    $('#message').html('<div class="alert alert-danger">Please fill all fields.</div>');
                }
            });
        });
    </script>
</section>
@endsection
