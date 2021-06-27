@extends('layouts.app')

@section('content')


<div class="container text-white">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Asset</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stock as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->price_ratio}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection