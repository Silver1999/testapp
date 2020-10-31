@extends('layouts.app')

@section('content')
   @if($haspermission==1)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>This is Report Section!</h1>
            </div>
        </div>
    </div>

   @else
    <h1 style="color: red;text-align: center">You don't have access to this page</h1>
    @endif
@endsection
