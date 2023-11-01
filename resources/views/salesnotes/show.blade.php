@extends('adminlte::page')

@section('title', 'Dashboard')



@section('content_header')
<h1>Sales Notes</h1>
@stop

@section('content')

<div class="container">
    <div class="card p-4">

        <div class="row pb-3">
            <div class="col-md-4">
                <label for="customer_name">Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control"
                    value="{{$sale_note->customer->name}}" disabled>
            </div>
            <div class="col-md-4">
                <label for="customer_email">Email</label>
                <input type="text" name="customer_email" id="customer_email" class="form-control"
                    value="{{$sale_note->customer->email}}" disabled>
            </div>
            <div class="col-md-4">
                <label for="customer_aaddress">Address</label>
                <input type="text" name="customer_aaddress" id="customer_aaddress" class="form-control"
                    value="{{$sale_note->customer->address}}" disabled>
            </div>
            <div class="col-md-4">
                <label for="note_date">Date</label>
                <input type="text" name="note_date" id="note_date" class="form-control"
                    value="{{$sale_note->note->date}}" disabled>
            </div>
            <div class="col-md-4">
                <label for="note_total">Total</label>
                <input type="text" name="note_total" id="note_total" class="form-control"
                    value="{{$sale_note->note->total}}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Sku</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sale_note->note->noteItems as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->item->name}}</td>
                            <td>{{$item->item->sku}}</td>
                            <td>{{$item->item->price}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->total}}</td>
                            @empty
                            No items

                            @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Sku</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>

    </div>
</div>




@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    new DataTable('#example');
</script>
@stop