@extends('admin.layouts.admin')

@section('content')


<a href="{{route('admin.fundraiserProfile',$id)}}" class="btn-theme bg-primary">Profile</a>
<a href="{{route('admin.fundraiserdonation',$id)}}" class="btn-theme bg-primary">Donation</a>
<a href="{{route('admin.fundraisertran',$id)}}" class="btn-theme bg-primary">Transaction</a>

    <hr>
<!-- content area -->


<div class="data-container">
    <div class="row">
        <div class="col-lg-12">
            
            
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
        
    </ul>
    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="alltransaction" role="tabpanel"
            aria-labelledby="alltransaction-tab">
            <div class="data-container">
                <table class="table table-theme mt-4">
                    <thead>
                        <tr> 
                            <th scope="col">Date</th>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Payment Process</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr> 
                            <td class="fs-16 txt-secondary">{{$item->date}}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fs-20 txt-secondary fw-bold">{{$item->tran_no}}</span>
                                    {{-- <span class="fs-16 txt-secondary">Online donation</span> --}}
                                </div>
                            </td>
                            <td class="fs-16 txt-secondary">
                                {{$item->name}}
                            </td>
                            <td class="fs-16 txt-secondary">
                                {{$item->amount}}
                            </td>
                            <td class="fs-16 txt-secondary">
                                {{$item->description}}
                            </td> 
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
          
        </div>
        <div class="tab-pane fade" id="moneyIn" role="tabpanel" aria-labelledby="moneyIn-tab">..moneyIn.
        </div>
        <div class="tab-pane fade" id="moneyOut" role="tabpanel" aria-labelledby="moneyOut-tab">
            <div class="data-container">
                <table class="table table-theme mt-4">
                    <thead>
                        <tr> 
                            <th scope="col">Date</th>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Payment Process</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            @if ($item->tran_type == "Out")
                            <tr> 
                                <td class="fs-16 txt-secondary">{{$item->date}}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fs-20 txt-secondary fw-bold">{{$item->tran_no}}</span>
                                        {{-- <span class="fs-16 txt-secondary">Online donation</span> --}}
                                    </div>
                                </td>
                                <td class="fs-16 txt-secondary">
                                    {{$item->name}}
                                </td>
                                <td class="fs-16 txt-secondary">
                                    {{$item->amount}}
                                </td>
                                <td class="fs-16 txt-secondary">
                                    {{$item->description}}
                                </td> 
                            </tr> 
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

        </div>
        <hr>
    </div>
</div>


@endsection
@section('script')

<script>
    $(document).ready(function () {



            

    });

    
</script>
@endsection