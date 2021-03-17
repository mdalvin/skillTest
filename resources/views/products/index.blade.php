@extends('products.layout')
@section('content')
<div class="row">
<div class="col-lg-12" style="text-align: center">
<div >
<h2>Products List</h2>
</div>
<br/>
</div>
</div>
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-right">
<a href="javascript:void(0)" class="btn btn-success mb-2" id="new-product" data-toggle="modal">Add Product</a>
</div>
</div>
</div>
<br/>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p id="msg">{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
<tr>
<th>ID</th>
<th>Name</th>
<th>Detail</th>
<th>Price</th>
<th width="280px">Action</th>
</tr>

@foreach ($products as $product)
<tr id="product_id_{{ $product->id }}">
<td>{{ $product->id }}</td>
<td>{{ $product->name }}</td>
<td>{{ $product->detail }}</td>
<td>{{ $product->price }}</td>
<td>
<form action="{{ route('products.destroy',$product->id) }}" method="POST">
<a class="btn btn-info" id="show-product" data-toggle="modal" data-id="{{ $product->id }}" >Show</a>
<a href="javascript:void(0)" class="btn btn-success" id="edit-product" data-toggle="modal" data-id="{{ $product->id }}">Edit </a>
<meta name="csrf-token" content="{{ csrf_token() }}">
<a id="delete-product" data-id="{{ $product->id }}" class="btn btn-danger delete-user">Delete</a></td>
</form>
</td>
</tr>
@endforeach

</table>
{!! $products->links() !!}
<!-- Add and Edit product modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="productCrudModal"></h4>
</div>
<div class="modal-body">
<form name="prodForm" action="{{ route('products.store') }}" method="POST">
<input type="hidden" name="prod_id" id="prod_id" >
@csrf
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Name:</strong>
<input type="text" name="name" id="name" class="form-control" placeholder="Name" onchange="validate()" >
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Email:</strong>
<input type="text" name="detail" id="detail" class="form-control" placeholder="Detail" onchange="validate()">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Address:</strong>
<input type="text" name="price" id="price" class="form-control" placeholder="Price" onchange="validate()" onkeypress="validate()">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Submit</button>
<a href="{{ route('products.index') }}" class="btn btn-danger">Cancel</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- Show product modal -->
<div class="modal fade" id="crud-modal-show" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="productCrudModal-show"></h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-xs-2 col-sm-2 col-md-2"></div>
<div class="col-xs-10 col-sm-10 col-md-10 ">
@if(isset($product->name))

<table>
<tr><td><strong>Name:</strong></td><td>{{$product->name}}</td></tr>
<tr><td><strong>Detail:</strong></td><td>{{$product->detail}}</td></tr>
<tr><td><strong>Price:</strong></td><td>{{$product->price}}</td></tr>
<tr><td colspan="2" style="text-align: right "><a href="{{ route('products.index') }}" class="btn btn-danger">OK</a> </td></tr>
</table>
@endif
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
<script>
error=false

function validate()
{
	if(document.prodForm.name.value !='' && document.prodForm.detail.value !='' && document.prodForm.price.value !='')
	    document.prodForm.btnsave.disabled=false
	else
		document.prodForm.btnsave.disabled=true
}
</script>