<script>
    const priceList = "{{ route('pricelist') }}";
    const priceGenerator = "{{ route('priceGenerator') }}";
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-12">
            <header class="text-light my-4">
                <h1 class="mb-4">Stocks</h1>
            </header>
        </div>

        <div class="col col-sm-6 col-md-4 col-lg-3">
            <form class="search">
                <input type="text" class="form-control m-auto text-white" name="search" placeholder="search stock">
            </form>

            <ul class="list-group stocks mx-auto text-light my-3">
                @foreach ($stock as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center text-light">
                    <span> {{$item->name}}</span>
                    <span class="text-secondary"> {{$item->abbr}}</span>
                </li>
                @endforeach
            </ul>

        </div>

        <div class="col col-sm-6 col-md-8 col-lg-9">
            <div class="header-control">
                <span class="asset-name text-secondary">
                    Market is up
                </span>
                <span class="asset-price text-primary">

                </span>
            </div>
            <div class="graph-control my-3">

                <div class="chart" id="chart_div"></div>
            </div>

        </div>
    </div>
    {{-- <form method="post" action="{{ route('priceGenerator') }}" class="my-4">
        <div class="input-field text-center center">
            <button type="submit" class="btn btn-outline-primary my-2">Geberate</button>
        </div>
    </form> --}}
</div>

@endsection