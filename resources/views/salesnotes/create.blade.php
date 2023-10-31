@extends('adminlte::page')

@section('title', 'Dashboard')



@section('content_header')
<h1>Sales Notes</h1>
@stop

@section('content')

<div class="container">
    <div class="card p-4">
        <div class="row">
            <div class="col-md-12">

                <form method="POST" action="{{ route('salesnotes.store') }}">
                    <h3>Note</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <h3>Customer</h3>

                            <div class="form-group">
                                <label for="customer">Customer</label>
                                <select class="form-control" id="customer">
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                                <hr>
                            </div>

                        </div>
                        <div class="col-md-6">
                            {{-- <h3>Note</h3>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div> --}}

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="items-container" class="container">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <select name="items[]" class="form-control" onchange="updatePrice(this)">
                                            @foreach($items as $item)
                                            <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{
                                                $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="number" name="quantities[]" class="form-control"
                                            placeholder="Quantity" oninput="updatePrice(this)">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="prices[]" class="form-control" placeholder="Price"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" onclick="addNewItem()">Add Item</button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>

    </div>
</div>




@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@stop

@section('js')

<script>
    function updatePrice(element) {
        const quantityInput = element;
        const priceInput = quantityInput.parentNode.nextElementSibling.querySelector('input[name="prices[]"]');
        const selectedOption = quantityInput.parentNode.previousElementSibling.querySelector('select[name="items[]"]').options[quantityInput.parentNode.previousElementSibling.querySelector('select[name="items[]"]').selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        const quantity = quantityInput.value;
        const totalPrice = price * quantity;
        priceInput.value = totalPrice.toFixed(2);
    }

    function addNewItem() {
        const itemsContainer = document.getElementById('items-container');

        const newItemHTML = `
            <div class="row">
                <div class="form-group col-md-4">
                    <select name="items[]" class="form-control" onchange="updatePrice(this)">
                        @foreach($items as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <input type="number" name="quantities[]" class="form-control" placeholder="Quantity" oninput="updatePrice(this)">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" name="prices[]" class="form-control" placeholder="Price" readonly>
                </div>
            </div>
        `;

        const newItem = document.createElement('div');
        newItem.innerHTML = newItemHTML;

        itemsContainer.appendChild(newItem);
    }
</script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    new DataTable('#example');
</script>
@stop