@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>All Products</h1>
        <a href="{{route('add_product')}}" class="btn btn-primary btn-lg float-right" type="submit">Add</a>
    </div>
    <div class="upper-wrapper">
        <div class="search-wrapper">
            <form>
                <div class="form-group">
                    <input type="search" name="p_name" id="p_name" placeholder="Search Product">
                    <i class="las la-search"></i>
                </div>
                <div class="form-group">
                <ul>
                    <li>
                        <select name="search_color" id="search_color">
                        <option value="">search color</option>
                        </select>
                    </li>
                    <li>
                        <select name="search_size" id="search_size">
                        <option value="">search size</option>
                        </select>
                    </li>
                </ul>
            </div>
            </form>
        </div>
        
    </div>
    <div id="message">

    </div>
    <div class="table-detail">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Color</th>
                    <th scope="col">Size</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="products_list">
               <!-- appended products -->
            </tbody>
        </table>
    </div>
</section>
<script>
        $(document).ready(function(){
            // Show message
            var conf_message = localStorage.getItem('product_message');
            $('#message').html(conf_message);
                // remove message
                $('#message').click(function(){
                    localStorage.removeItem('product_message');
                    $('#message').empty();
                });

                // geting data
                $.ajax({
                    url:'/api/product-list',
                    type:'GET',
                    success: function(response){
                        $('#products_list').append(response.products);
                        $('#search_color').append(response.colors);
                        $('#search_size').append(response.sizes);
                    }
                });

                // search products
                $('#p_name').on('keyup', function(){
                    var search_product =$('#p_name').val();
                    
                    $.ajax({
                        url:'/api/product-list?product_name='+search_product+'',
                        type:'GET',
                        success: function(response){
                            $('#products_list').html(response.products);
                            $('#search_color').html(response.colors);
                            $('#search_size').html(response.sizes);
                        }
                    });
                });

                // filter color
                $('#search_color').change(function(){
                    var search_color = $('#search_color').val();
                    
                    $.ajax({
                        url:'/api/color-filter?colors='+search_color+'',
                        type:'GET',
                        success: function(response){
                            $('#products_list').html(response.products);
                            $('#search_size').html(response.sizes);
                        }
                    });
                });

                // filter size
                $('#search_size').change(function(){
                    var search_size = $('#search_size').val();
                    
                    $.ajax({
                        url:'/api/size-filter?size='+search_size+'',
                        type:'GET',
                        success: function(response){
                            $('#products_list').html(response.products);
                            $('#search_color').html(response.colors);
                        }
                    });
                });
        });

        // delete product
        function deleteProduct(id){
            alert(id);
            $.ajax({
                    url:'/api/delete-product/'+id+'',
                    type:'GET',
                    success: function(response){
                        if(response.status === "success"){
                            $('#all_colors').load();
                            $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                        }else{
                            $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    }
                });
        }
</script>
@endsection
