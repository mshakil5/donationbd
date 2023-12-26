@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')



<section class="bleesed default">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            
            <div class="para text-center mt-4">
                {!! \App\Models\EmailContent::where('title','=','paypal_success_message')->first()->description !!}

                
                <p>Your Transaction Id is : {{$tranid}}.</p>
            </div>
        </div>
    </div>
</section> 



@endsection

@section('scripts')
@endsection