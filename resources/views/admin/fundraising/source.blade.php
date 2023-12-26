@extends('admin.layouts.admin')

@section('content')

<!-- content area -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle pb-2">
                Fundraising Source
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-lg-12 px-3 ermsg"> </div>
        <div class="col-lg-6  px-3">
            <div class="row mt-4">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="" class="align-items-center">Name</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <button class="btn-theme bg-primary" id="saveBtn" style="margin: 3px;padding: 6px;">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle pb-2">
                All Data
            </div>
        </div>
    </div>


    <div class="row pt-3">
        <div class="col-md-8">
            <div class="data-container" id="contentContainer">
                <table class="table table-theme mt-4" id="example">
                    <thead>
                        <tr>
                            <th scope="col" class="align-items-center">Name</th>
                            <th scope="col" class="align-items-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $data)
                            
                        <tr>
                            <td class="fs-20 txt-secondary fw-bold">{{$data->name}}</td>
                            <td class="fs-16 txt-secondary">
                                <div class="d-flex flex-column align-items-left">
                                    <a id="deleteBtn" rid="{{$data->id}}">
                                        <div class="fs-16 txt-primary d-flex align-items-center">
                                            <svg width="12" height="14" viewBox="0 0 12 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.05 10.375L6 8.425L7.95 10.375L9 9.325L7.05 7.375L9 5.425L7.95 4.375L6 6.325L4.05 4.375L3 5.425L4.95 7.375L3 9.325L4.05 10.375ZM2.25 13.75C1.8375 13.75 1.4845 13.6033 1.191 13.3098C0.897 13.0158 0.75 12.6625 0.75 12.25V2.5H0V1H3.75V0.25H8.25V1H12V2.5H11.25V12.25C11.25 12.6625 11.1033 13.0158 10.8098 13.3098C10.5158 13.6033 10.1625 13.75 9.75 13.75H2.25ZM9.75 2.5H2.25V12.25H9.75V2.5Z"
                                                    fill="#18988B" />
                                            </svg>
                                            <span class="ms-2">
                                                Delete
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')

<script>
    $(document).ready(function () {

        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            var url = "{{URL::to('/admin/fundraising-source')}}";
            // console.log(url);
            $("#saveBtn").click(function(){
                var form_data = new FormData();
                form_data.append("name", $("#name").val());
                
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
            });

            //Delete
            $("#contentContainer").on('click','#deleteBtn', function(){
                if(!confirm('Sure?')) return;
                codeid = $(this).attr('rid');
                info_url = url + '/'+codeid;
                $.ajax({
                    url:info_url,
                    method: "GET",
                    type: "DELETE",
                    data:{
                    },
                    success: function(d){
                        if(d.success) {
                            alert(d.message);
                            location.reload();
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });
            });
            //Delete

    });

    
</script>
@endsection