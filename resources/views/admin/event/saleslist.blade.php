@extends('admin.layouts.admin')

@section('content')

<!-- content area -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle pb-2">
                {{-- <a href="{{route('frontend.eventDetails',$data->id)}}" target="_blank" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center">{{$data->title}} </a> Event booking record --}}
            </div>
        </div>
    </div>
    <div class="row"> 
        <div class="col-lg-6 mt-2">
            <a href="{{ route('admin.event')}}" class="btn-theme bg-primary text-center">Back</a>
        </div> 
    </div>

    
    <div id="" class="mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="background-color: #fdf3ee">
                    <div class="card-header">
                        <h3> Ticket Information</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-responsive" style="width: 100%">
                            <thead>
                            <tr>
                                <th style="text-align: center">SL</th>
                                <th style="text-align: center">Category</th>
                                <th style="text-align: center">Total Quantity</th>
                                <th style="text-align: center">Sold Quantity</th>
                                <th style="text-align: center">Available Quantity</th>
                            </tr>
                            </thead>
                            
                            
                            <tbody>
                                @foreach ($tickets as $key => $ticket)
                                <tr>
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td style="text-align: center" class="fs-16 txt-primary">{{$ticket->type}}</td>
                                    <td style="text-align: center" class="fs-16 txt-primary">{{$ticket->qty}}
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary">
                                        {{$ticket->sold_qty}}
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary">
                                        {{$ticket->qty - $ticket->sold_qty}}
                                    </td>
                                    
                                </tr>
                                @endforeach

                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="contentContainer">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="background-color: #fdf3ee">
                    <div class="card-header">
                        <h3> All Data</h3>
                    </div>
                    <div class="card-body">
                        <?php
                                $tbalance = $netamount;
                            ?>
                        <table class="table table-bordered table-hover table-responsive" id="eventsales" style="width: 100%">
                            <thead>
                            <tr>
                                <th style="text-align: center">SL</th>
                                <th style="text-align: center">Date</th>
                                <th style="text-align: center">Reference Id</th>
                                <th style="text-align: center">Customer Name</th>
                                <th style="text-align: center">Customer Email</th>
                                <th style="text-align: center">Customer Phone</th>
                                <th style="text-align: center">Payment Type</th>
                                <th style="text-align: center">Note</th>
                                <th style="text-align: center">Ticket Type</th>
                                <th style="text-align: center">Gross</th>
                                <th style="text-align: center">Fee</th>
                                <th style="text-align: center">Net</th>
                                <th style="text-align: center">Balance</th>
                            </tr>
                            </thead>
                            
                            
                            <tbody>
                                @foreach ($data as $key => $sale)
                                @php
                                    $totalfee = $sale->commission + $sale->fixed_fee;
                                    $netamnt = $sale->total_amount - $totalfee;
                                @endphp
                                <tr>
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td style="text-align: center" class="fs-16 txt-primary">{{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fs-20 txt-primary fw-bold text-center">{{$sale->tran_no}}</span>
                                        </div>
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary">
                                        {{\App\Models\User::where('id',$sale->user_id)->first()->name}}
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary">
                                        {{\App\Models\User::where('id',$sale->user_id)->first()->email}}
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary text-center">
                                        {{\App\Models\User::where('id',$sale->user_id)->first()->phone}}
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary text-center">
                                        {{$sale->payment_type}}
                                    </td>

                                    <td style="text-align: center" class="fs-16 txt-primary text-center">
                                        {{$sale->note}}
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary text-center">
                                        {{$sale->ticket_type}}
                                    </td>
                                    <td style="text-align: center" class="fs-16 txt-primary text-center">
                                        £{{ number_format($sale->total_amount, 2) }}
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary text-center">
                                        £{{ number_format($totalfee, 2) }}
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary text-center">
                                        £{{ number_format($netamnt, 2) }}
                                    </td>
    
                                    <td style="text-align: center" class="fs-16 txt-primary text-center">
                                        £{{ number_format($tbalance, 2) }}
                                    </td>
                                    @php
                                        $tbalance = $tbalance - $netamnt;
                                    @endphp

                                </tr>
                                @endforeach

                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection
@section('script')

<script type="text/javascript">

    $(document).ready(function() {
        $('#eventsales').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        } );
    });
</script>

@endsection