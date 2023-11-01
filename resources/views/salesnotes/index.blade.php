@extends('adminlte::page')

@section('title', 'Dashboard')



@section('content_header')
<h1>Sales Notes</h1>
@stop

@section('content')

<div class="container">
    <div class="card p-4">

        <div class="row p-3">
            <a href="{{ route('salesnotes.create') }}" class="btn btn-success bts-sm">New</a>

        </div>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Customer</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales_notes as $sale_note)
                <tr>
                    <td>{{$sale_note->id}}</td>
                    <td>{{$sale_note->customer->name}}</td>
                    <td>{{$sale_note->created_at}}</td>
                    <td>
                        <a href="{{route('salesnotes.show', $sale_note->id)}}" class="btn btn-primary btn-sm">Show</a>
                        <a href="{{route('salesnotes.edit', $sale_note->id)}}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{route('salesnotes.destroy', $sale_note->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Customer</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>

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