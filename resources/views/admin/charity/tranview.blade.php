@extends('admin.layouts.admin')

@section('content')


<!-- content area -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle pb-2">
                Charity
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ermsg"></div>
            <div class="stsermsg"></div>
        </div>
    </div>


<div id="addThisFormContainer">
    
    
    <div class="data-container">
        <div class="row">
            <div class="col-lg-12">
                
                
                
                @php
                $user = \App\Models\User::where('id', $data->id)->first();
                $moneyIn = \App\Models\Transaction::where('charity_id', $data->id)->where('tran_type','In')->sum('amount');
                $moneyOut = \App\Models\Transaction::where('charity_id', $data->id)->where('tran_type','Out')->sum('amount');
                @endphp


                <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="alltransaction-tab" data-bs-toggle="tab"
                            data-bs-target="#alltransaction" type="button" role="tab" aria-controls="alltransaction"
                            aria-selected="true">All transaction</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="moneyIn-tab" data-bs-toggle="tab" data-bs-target="#moneyIn"
                            type="button" role="tab" aria-controls="moneyIn" aria-selected="false">Money
                            in</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="moneyOut-tab" data-bs-toggle="tab"
                            data-bs-target="#moneyOut" type="button" role="tab" aria-controls="moneyOut"
                            aria-selected="false">Money out</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pay-tab" data-bs-toggle="tab"
                            data-bs-target="#pay" type="button" role="tab" aria-controls="pay"
                            aria-selected="false">Pay</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="allreq-tab" data-bs-toggle="tab"
                            data-bs-target="#allreq" type="button" role="tab" aria-controls="pay"
                            aria-selected="false">Withdraw Request</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="alltransaction" role="tabpanel"
                        aria-labelledby="alltransaction-tab">
                        <div class="data-container">
                            <table class="table table-theme mt-4" id="example1">
                                <thead>
                                    <tr> 
                                        <th scope="col">Date</th>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Payment Process</th>
                                        {{-- <th scope="col">User</th> --}}
                                        <th scope="col">Commission</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Dr Amount</th>
                                        <th scope="col">Cr Amount</th>
                                        <th scope="col">Balance</th>
                                    </tr>
                                </thead>
                                <?php
                                    $tbalance = $totalInAmount - $totalOutAmount;
                                ?>
                                <tbody>
                                    @foreach ($transaction as $item)
                                    <tr> 
                                        <td class="fs-16 txt-secondary">{{$item->date}}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fs-20 txt-secondary fw-bold">{{$item->tran_no}}</span>
                                            </div>
                                        </td>
                                        <td class="fs-16 txt-secondary">
                                            {{$item->payment_type}}
                                        </td>
                                        <td class="fs-16 txt-secondary">
                                            {{ number_format($item->commission, 2) }}
                                        </td> 
                                        <td class="fs-16 txt-secondary">
                                            {{ number_format($item->total_amount, 2) }}
                                        </td> 
                                        <td class="fs-16 txt-secondary">
                                            @if ($item->tran_type == "In") {{ number_format($item->amount, 2) }} @endif
                                        </td> 
                                        <td class="fs-16 txt-secondary">
                                            @if ($item->tran_type == "Out") {{ number_format($item->amount, 2) }} @endif
                                        </td> 
                                        <td class="fs-16 txt-secondary">
                                            £{{ number_format($tbalance, 2) }}
                                        </td> 
                                        @php
                                        if ($item->tran_type == "In") {
                                            $tbalance = $tbalance - $item->amount;
                                        } else {
                                            $tbalance = $tbalance + $item->amount;
                                        }
                                        @endphp
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                            </div>

                    </div>
                    <div class="tab-pane fade" id="moneyIn" role="tabpanel" aria-labelledby="moneyIn-tab">
                        <div class="data-container">
                            <table class="table table-theme mt-4" id="example2">
                                <thead>
                                    <tr> 
                                        <th scope="col">Date</th>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Dr Amount</th>
                                        <th scope="col">Total Dr Amount</th>
                                    </tr>
                                </thead>
                                <?php
                                    $tDrbalance = $totalInAmount;
                                ?>
                                <tbody>
                                    @foreach ($transaction as $item)
                                    @if ($item->tran_type == "In")
                                    <tr> 
                                        <td class="fs-16 txt-secondary">{{$item->date}}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fs-20 txt-secondary fw-bold">{{$item->tran_no}}</span>
                                            </div>
                                        </td>
                                        <td class="fs-16 txt-secondary">
                                            {{$item->description}}
                                        </td>
                                        <td class="fs-16 txt-secondary">
                                            {{ number_format($item->amount, 2) }}
                                        </td>

                                        <td class="fs-16 txt-secondary">
                                            £{{ number_format($tDrbalance, 2) }}
                                        </td>
                                        
                                        @php
                                        if ($item->tran_type == "In") {
                                            $tDrbalance = $tDrbalance - $item->amount;
                                        }
                                        @endphp
                                    </tr> 
                                    @endif
                                    @endforeach
                                </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="moneyOut" role="tabpanel" aria-labelledby="moneyOut-tab">
                        <div class="data-container">
                            <table class="table table-theme mt-4" id="example3">
                                <thead>
                                    <tr> 
                                        <th scope="col">Date</th>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Cr Amount</th>
                                        <th scope="col">Total Cr Amount</th>
                                    </tr>
                                </thead>
                                <?php
                                    $tCrbalance = $totalOutAmount;
                                ?>
                                <tbody>
                                    @foreach ($transaction as $item)
                                    @if ($item->tran_type == "Out")
                                    <tr> 
                                        <td class="fs-16 txt-secondary">{{$item->date}}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fs-20 txt-secondary fw-bold">{{$item->tran_no}}</span>
                                            </div>
                                        </td>
                                        <td class="fs-16 txt-secondary">
                                            {{$item->description}}
                                        </td>
                                        <td class="fs-16 txt-secondary">
                                            {{ number_format($item->amount, 2) }}
                                        </td>

                                        <td class="fs-16 txt-secondary">
                                            £{{ number_format($tCrbalance, 2) }}
                                        </td>
                                        @php
                                        if ($item->tran_type == "Out") {
                                            $tCrbalance = $tCrbalance - $item->amount;
                                        }
                                        @endphp
                                    </tr> 
                                    @endif
                                    @endforeach
                                </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pay" role="tabpanel" aria-labelledby="pay-tab">
                        <div class="data-container">
                            <!-- content area -->
                            <div class="content">
                                <div class="row ">
                                    <div class="col-lg-6  px-3">
                                        @if(session()->has('message'))
                                            <section class="px-4">
                                                <div class="row my-3">
                                                    <div class="alert alert-success" id="successMessage">{{ session()->get('message') }}</div>
                                                </div>
                                            </section>
                                        @endif
                                        @if(session()->has('error'))
                                            <section class="px-4">
                                                <div class="row my-3">
                                                    <div class="alert alert-danger" id="errMessage">{{ session()->get('error') }}</div>
                                                </div>
                                            </section>
                                        @endif
                                        
                                        <form method="POST" action="{{ route('admin.charityPayStore') }}"  enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-5">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="pagetitle pb-2">
                                                            Pay charity
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group ">
                                                        <label for="description">Charity Title</label>
                                                        <input type="text" class="form-control" value="{{$data->name}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="amount">Amount</label>
                                                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" value="{{ $moneyIn-$moneyOut }}">
                                                        <input type="hidden" id="charity_id" name="charity_id" value="{{$user->id}}">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group ">
                                                        <label for="description">Note</label>
                                                        <input type="text" class="form-control" placeholder="Note" id="description" name="description">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group ">
                                                        <label for="source">Source</label>
                                                        <select name="source" id="source" class="form-control">
                                                            <option value="Bank">Bank</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-4">
                                                    <div class="form-group ">
                                                        <button class="btn-theme bg-primary">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6 border-left-lg px-3">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="user">
                                                    Fundraiser Information
                                                </div>
                                            </div>
                                        </div>
                                        <!-- loop start -->
                                        <div class="row mb-2">
                                            <div class="date">
                                                Total Balance
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="info">{{$user->balance}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end -->
                                        <!-- loop start -->
                                        <div class="row mb-2">
                                            <div class="date">
                                                Name
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="info">{{$user->name}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end -->

                                        <!-- loop start -->
                                        <div class="row mb-2">
                                            <div class="date">
                                            Surname
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="info">{{$user->sur_name}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end -->

                                        <!-- loop start -->
                                        <div class="row mb-2">
                                            <div class="date">
                                                Email
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="info">{{$user->email}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end -->

                                        <!-- loop start -->
                                        <div class="row mb-2">
                                            <div class="date">
                                                Phone
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="info">{{$user->phone}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end -->

                                        <!-- loop start -->
                                        <div class="row mb-2">
                                            <div class="date">
                                                Address
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="info">{{$user->house_number}} {{$user->street_name}} {{$user->town}} {{$user->postcode}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="allreq" role="tabpanel" aria-labelledby="allreq-tab">
                        <div class="data-container">
                            <!-- content area -->
                            <div class="content">
                                
                            <table class="table table-theme mt-4" id="example3">
                                <thead>
                                    <tr> 
                                        <th scope="col">Date</th>
                                        <th scope="col">Request ID</th>
                                        <th scope="col">Note</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\CharityWithdrawReq::where('user_id', $data->id)->get() as $item)
                                        <tr> 
                                            <td class="fs-16 txt-secondary">{{$item->date}}</td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fs-20 txt-secondary fw-bold">{{$item->req_no}}</span>
                                                </div>
                                            </td>
                                            <td class="fs-16 txt-secondary">
                                                {{$item->note}}
                                            </td>
                                            <td class="fs-16 txt-secondary">
                                                {{ number_format($item->amount, 2) }}
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
            <hr>
        </div>
    </div>


</div>

        
</div>


@endsection
@section('script')

<script type="text/javascript">

    $(document).ready(function() {
        $('#example1, #example2, #example3').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    });
</script>
@endsection