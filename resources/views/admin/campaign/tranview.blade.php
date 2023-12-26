@extends('admin.layouts.admin')

@section('content')


<!-- content area -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle pb-2">
                Campaign
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
                
                
                @include('admin.campaign.alltranview')


                

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