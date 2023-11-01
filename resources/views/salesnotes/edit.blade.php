@extends('adminlte::page')

@section('title', 'Dashboard')



@section('content_header')
<h1>Edit Sale note</h1>
@stop

@section('content')

<div class="container">
    <div class="card p-4">
        <div class="row">
            <div class="col-md-12">

                <form method="POST" action="{{ route('salesnotes.update',$sale_note->id) }}">
                    @method('PUT')
                    @csrf
                    <h3>Note</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <h3>Customer</h3>

                            <div class="form-group">
                                <label for="customer">Customer</label>
                                <select class="form-control" id="customer" name="customer_id"
                                    onchange="updatePrice(this)">
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" {{ $customer->id == $sale_note->customer->id ?
                                        'selected' : '' }}>{{$customer->name}}</option>
                                    @endforeach
                                </select>
                                <hr>
                                <button type="button" class="btn btn-primary" onclick="addNewItem()">Add Item</button>

                            </div>

                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="items-container" class="container">
                                @forelse ($sale_note->note->noteItems as $Nitem)

                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <label for="item_{{ $loop->index+1 }}">{{ $loop->index+1 }}</label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select name="items[]" class="form-control" onchange="updatePrice(this)">
                                            @foreach($items as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $Nitem->item_id ?
                                                'selected' : '' }}
                                                data-price="{{ $item->price }}">{{
                                                $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" name="quantities[]" class="form-control"
                                            placeholder="Quantity" min="0" value="{{ $Nitem->quantity }}"
                                            oninput="updatePrice(this)">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <div class="input-group ">
                                            <input type="text" name="prices[]" class="form-control" placeholder="Price"
                                                value="{{ $Nitem->total }}" readonly>
                                            <button type="button" class="btn btn-danger btn-remove "
                                                onclick="removeItem(this)">x</button>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                Error note items
                                @endforelse



                            </div>
                            <div id="total-container" class="form-group col-md-12">
                                <label for="total">Total:</label>
                                <input type="text" id="total" name="total" value="{{ $sale_note->note->total }}"
                                    class="form-control" readonly>
                            </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning">Save changes</button>
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
    const quantityInput = element.parentNode.nextElementSibling.querySelector('input[name="quantities[]"]');
    const priceInput = element.parentNode.nextElementSibling.nextElementSibling.querySelector('input[name="prices[]"]');
    const totalInput = document.getElementById('total');
    const selectElement = element;

    if (selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const price = parseFloat(selectedOption.getAttribute('data-price'));
        const quantity = parseInt(quantityInput.value);
        const totalPrice = price * quantity;

        priceInput.value = price.toFixed(2);
        totalInput.value = calculateTotal();
    }
}

    let numItems = 1;
    function calculateTotal() {
    let total = 0;
    const priceInputs = document.querySelectorAll('input[name="prices[]"]');
    priceInputs.forEach(priceInput => {
        const price = parseFloat(priceInput.value);
        if (!isNaN(price)) {
            total += price;
        }
    });

    return total.toFixed(2);
}
    function addNewItem() {
        const itemsContainer = document.getElementById('items-container');

        const newItemHTML = `
            <div class="row">
                <div class="form-group col-md-1">
                    <label for="item_1">${++numItems}</label>
                </div>
                <div class="form-group col-md-6">
                    <select name="items[]" class="form-control" onchange="updatePrice(this)">
                        @foreach($items as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <input type="number" name="quantities[]" min="0" value="0" class="form-control" placeholder="Quantity" oninput="updatePrice(this)">
                </div>

                <div class="form-group col-md-3">
                    <div class="input-group ">
                        <input type="text" name="prices[]" class="form-control" placeholder="Price"
                            readonly>
                        <button type="button" class="btn btn-danger btn-remove "
                            onclick="removeItem(this)">x</button>
                    </div>
                </div>
            </div>
        `;

        const newItem = document.createElement('div');
        newItem.innerHTML = newItemHTML;

        itemsContainer.appendChild(newItem);
    }
    function removeItem(button) {
        const row = button.closest('.row');
        row.remove();
        numItems--;
    }

</script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    new DataTable('#example');
</script>
@stop