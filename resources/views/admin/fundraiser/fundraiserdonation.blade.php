@extends('admin.layouts.admin')

@section('content')


<a href="{{route('admin.fundraiserProfile',$id)}}" class="btn-theme bg-primary">Profile</a>
<a href="{{route('admin.fundraiserdonation',$id)}}" class="btn-theme bg-primary">Donation</a>
<a href="{{route('admin.fundraisertran',$id)}}" class="btn-theme bg-primary">Transaction</a>
    <hr>
<!-- content area -->
{{-- <section class="bleesed default">
    <div class="container">
        <div class="row">
           
            <div class="col-lg-12 mb-4 mt-5">
                <h3 class="fw-bold darkerGrotesque-bold txt-primary mb-3">Your all Donation Record</h3>
                <div class="table-responsive fs-5 shadow-sm  ">
                    <table class="table table-striped" id="example">
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
                                <td>{{$item->campaign->title}}</td>
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
</section> --}}

<div id="contentContainer">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="background-color: #fdf3ee">
                <div class="card-header">
                    <h3> All Data</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Date</th>
                                <th scope="col">Beneficiary</th>
                                <th scope="col">Amount</th>
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
</div>


@endsection
@section('script')

<script>
    $(document).ready(function () {

        $("#addThisFormContainer").hide();
            $("#newBtn").click(function(){
                clearform();
                $("#newBtn").hide(100);
                $("#addThisFormContainer").show(300);

            });
            $("#FormCloseBtn").click(function(){
                $("#addThisFormContainer").hide(200);
                $("#newBtn").show(100);
                clearform();
            });

        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            var url = "{{URL::to('/admin/new-fundraiser-update')}}";
            // console.log(url);
            $("#updateBtn").click(function(){
                    var file_data = $('#image').prop('files')[0];
                    if(typeof file_data === 'undefined'){
                        file_data = 'null';
                    }
                    var form_data = new FormData();
                    form_data.append('image', file_data);
                    form_data.append("name", $("#name").val());
                    form_data.append("surname", $("#surname").val());
                    form_data.append("email", $("#email").val());
                    form_data.append("phone", $("#phone").val());
                    form_data.append("house_number", $("#house_number").val());
                    form_data.append("street_name", $("#street_name").val());
                    form_data.append("town", $("#town").val());
                    form_data.append("postcode", $("#postcode").val());
                    form_data.append("password", $("#password").val());
                    form_data.append("confirm_password", $("#confirm_password").val());
                    form_data.append("codeid", $("#codeid").val());
                    
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
                                pagetop();
                                $(".ermsg").html(d.message);
                                window.setTimeout(function(){location.reload()},2000)
                            }
                        },
                        error: function (d) {
                            console.log(d);
                        }
                    });
                //Update

            });

            

            

            

    });

    
</script>
@endsection