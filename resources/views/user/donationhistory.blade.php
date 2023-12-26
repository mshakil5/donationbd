@extends('frontend.layouts.master')

@section('content')



<section class="bleesed default">
    <div class="container">
        <div class="row">
           
            <div class="col-lg-12 mb-4 mt-5">
                <h3 class="fw-bold darkerGrotesque-bold txt-primary mb-3">Your all Donation Record</h3>
                <div class="table-responsive fs-5 shadow-sm  ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Date</th>
                                <th scope="col">Beneficiary</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Annonimous Donation</th>
                                <th scope="col">Description</th>
                                <th scope="col">Display Name</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->date}}</td>
                                <td>
                                    @if (isset($item->campaign_id))
                                        {{$item->campaign->title}}
                                    @endif

                                    @if (isset($item->charity_id))
                                        {{$item->user->name}}
                                    @endif

                                </td>
                                <td>{{$item->total_amount}}</td>
                                <td>No</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->donation_display_name}}</td>
                                <td>Confirm</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
