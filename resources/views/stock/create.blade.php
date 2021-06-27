@extends('layouts.app')

@section('content')

<div class="container create">
    <div class="row justify-content-center">
        <div class="col-5 ">

            <form method="post" action="" class="add  my-4">
                @csrf
                <label class="text-light">Name</label>
                <input class="form-control m-auto text-white" type="text" name="title" placeholder="Name" required>


                <label class="text-light my-2">Abbrevation</label>
                <input type="text" class="form-control m-auto my-2 text-white" name="abbr" placeholder="Abbrevation" required>

                <label class="text-light my-2">Initial Price</label>
                <input type="text" class="form-control m-auto my-2 text-white" name="price" placeholder="0.00" required>

                <div class="input-field text-center center">
                    <button type="submit" class="btn btn-outline-primary my-2">Save</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection