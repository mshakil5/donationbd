@extends('frontend.layouts.master')
@section('title')
- Transaction Report
@endsection
@section('content')


<section class="bleesed default">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="fw-bold darkerGrotesque-bold txt-primary mb-3"> Your All Transactions</h2>
            </div>
            <div class="col-lg-6 d-flex align-items-center justify-content-end fs-5">

                <form action="" class="d-flex">
                    <div class="me-2">
                        <label for="">From</label>
                        <input type="date" class="form-control fs-5" style="height: 46px;" placeholder="Search">

                    </div>
                    <div class="d-flex align-items-end">
                        <div  class="me-2">
                            <label for="">To</label>
                            <input type="date" class="form-control fs-5" style="height: 46px;" placeholder="Search">
                        </div>
                        <button class="btn btn-theme bg-primary m-0" style="height:46px;">
                            <iconify-icon
                                icon="material-symbols:search-sharp"></iconify-icon>
                            </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-12">
                <ul class="nav nav-tabs mt-4 justify-content-start fs-5" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="transaction-tab" data-bs-toggle="tab"
                            data-bs-target="#transaction" type="button" role="tab" aria-controls="transaction"
                            aria-selected="true">All transaction</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="moneyIn-tab" data-bs-toggle="tab" data-bs-target="#moneyIn"
                            type="button" role="tab" aria-controls="moneyIn" aria-selected="false">Money
                            in</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="moneyOut-tab" data-bs-toggle="tab" data-bs-target="#moneyOut" type="button" role="tab" aria-controls="moneyOut" aria-selected="false">Money out</button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="moneyRequest-tab" data-bs-toggle="tab" data-bs-target="#moneyRequest" type="button" role="tab" aria-controls="moneyRequest" aria-selected="false">Money Request</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="allWithdrawRequest-tab" data-bs-toggle="tab" data-bs-target="#allWithdrawRequest" type="button" role="tab" aria-controls="allWithdrawRequest" aria-selected="false">Money Request</button>
                    </li>

                </ul>
                <div class="tab-content fs-5" id="myTabContent">
                    <div class="tab-pane fade active show" id="transaction" role="tabpanel"
                        aria-labelledby="transaction-tab">
                        <div class="table-responsive shadow-sm px-4">
                            <table class="table table-theme mt-4 table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Dr Amount</th>
                                        <th scope="col">Cr Amount</th>
                                        <th scope="col">Balance</th>
                                    </tr>
                                </thead>

                                <?php
                                    $tbalance = $totalInAmount - $totalOutAmount;
                                ?>

                                <tbody>
                                    @foreach ($data as $item)
                                    <tr> 
                                        <td class="fs-16 txt-secondary">{{$item->date}}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fs-20 txt-secondary fw-bold">{{$item->tran_no}}</span>
                                            </div>
                                        </td>
                                        <td class="fs-16 txt-secondary">
                                            {{-- {{$item->payment_type}} --}}
                                            {{$item->description}}
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
                            <table class="table table-theme mt-4" id="Drexample">
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
                                    @foreach ($data as $item)
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
                            <table class="table table-theme mt-4" id="Crexample">
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
                                    @foreach ($data as $item)
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

                    
                    <div class="tab-pane fade" id="moneyRequest" role="tabpanel" aria-labelledby="moneyRequest-tab">
                        <div class="data-container">
                            
                            <div class="title text-center txt-secondary">Withdraw Request</div>

                            @if(session()->has('message'))
                            <p class="alert alert-success"> {{ session()->get('message') }}</p>
                            @endif
            
                            <div class="ermsg"></div>
                             
                            <div class="form-custom">
                                @csrf
            
                                <div class="row">
                                    <div class="col-md-6 text-start">
                                        <div>
                                            <label for="charity_name" class="fs-5 fw-bold ">Event name</label>
                                            <input type="text" class="form-control modal-form" name="charity_name" id="charity_name" placeholder="Event name" value="{{Auth::user()->name}}" /> 
                                        </div>
            
                                        <div>
                                            <label for="amount" class="fs-5 fw-bold ">Amount</label>
                                            <input type="number" class="form-control modal-form" name="amount" id="amount" placeholder="Amount" value="{{Auth::user()->balance}}" /> 
                                        </div>
            
                                        <div>
                                            <label for="amount" class="fs-5 fw-bold ">Note</label>
                                            <textarea name="note" id="note" cols="30" rows="5" class="form-control modal-form"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
            
                                        <div>
                                            <label for="bank_name" class="fs-5 fw-bold ">Bank name</label>
                                            <input type="text" class="form-control modal-form" name="bank_name" id="bank_name" value="{{Auth::user()->bank_name}}" placeholder="Bank name" /> 
                                        </div>
            
                                        <div>
                                            <label for="bank_account_name" class="fs-5 fw-bold ">Bank A/C name</label>
                                            <input type="text" class="form-control modal-form" name="bank_account_name" id="bank_account_name" value="{{Auth::user()->account_name}}" placeholder="Bank A/C name" /> 
                                        </div>
            
                                        <div>
                                            <label for="bank_account_number" class="fs-5 fw-bold ">Bank A/C number</label>
                                            <input type="text" class="form-control modal-form" name="bank_account_number" id="bank_account_number" value="{{Auth::user()->account_number}}" placeholder="Bank A/C number" /> 
                                        </div>
            
                                        <div>
                                            <label for="bank_account_sort_code" class="fs-5 fw-bold ">Bank A/C sort code</label>
                                            <input type="text" class="form-control modal-form" name="bank_account_sort_code" id="bank_account_sort_code" placeholder="Bank A/C sort code" value="{{Auth::user()->account_sortcode}}" /> 
                                        </div>
            
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="submit" name="submit" id="addBtn" class="btn-theme bg-primary text-center mx-0" value="Submit" />
                                </div>
                                
                            </div>


                        </div>
                    </div>

                    <div class="tab-pane fade" id="allWithdrawRequest" role="tabpanel" aria-labelledby="allWithdrawRequest-tab">
                        <div class="data-container">
                            
                            
                            
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
                                    @foreach (\App\Models\CharityWithdrawReq::where('user_id', Auth::user()->id)->get() as $item)
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
    </div>
</section>



@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#example, #Drexample, #Crexample').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script> 


<script>
    
    $(document).ready(function () { 
        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //
        var url = "{{URL::to('/charity/withdraw-request')}}";
        // console.log(url);
    
        $("#addBtn").click(function(){
            // event create 
                var form_data = new FormData();
                form_data.append("charity_name", $("#charity_name").val());
                form_data.append("event_id", $("#event_id").val());
                form_data.append("bank_name", $("#bank_name").val());
                form_data.append("bank_account_name", $("#bank_account_name").val());
                form_data.append("amount", $("#amount").val());
                form_data.append("bank_account_number", $("#bank_account_number").val());
                form_data.append("bank_account_sort_code", $("#bank_account_sort_code").val());
                form_data.append("note", $("#note").val());
                
                
                $.ajax({
                    url: url,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data:form_data,
                    success: function (d) {
                        if (d.status == 303) {
                            $(".ermsg").html(d.message);
                        }else if(d.status == 300){
                            $(".ermsg").html(d.message);
                            window.setTimeout(function(){location.reload()},2000);
                        }
                    },
                    error: function (d) {
                        console.log(d);
                    }
                });
            // event create 
        });
    
    });
    </script>
@endsection