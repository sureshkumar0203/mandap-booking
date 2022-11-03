@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
      
      <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Manage Bookings</li>
        </ul>
        
        <!--<a href="{{ asset('administrator/add-coupon-code') }}" class="btn btn-primary pull-right" style="display:inline-block; margin:4px 8px 0 0;">Add Coupon Code</a>-->
        
      </div>
      
      <div class="page-header"></div>
      
      <div class="row">
          <div class="col-md-12 dataTable_wrapper">
              <table class="table table-striped table-bordered table-hover" id="tbl_content">
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center;"> Sl. </th>
                        <th>Customer Name</th>
                        <th>Contact No.</th>
                        <th>Booking Date</th>
                        <th>Total Booking Price</th>
                        <th>Advance</th>
                        <th>Booking Due</th>
                        <th>Booking ID</th>
                        <th>Transaction ID</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @php $sl=1; @endphp
                    @foreach ($data as $res)
                    <tr>
                        <td class="text-center" style="vertical-align:middle;">{{ $sl }} </td>
                         <td style="vertical-align:middle;">{{ $res->full_name }}</td>
                         <td style="vertical-align:middle;">{{ $res->contact_no }} </td>
                         <td style="vertical-align:middle;">
                         {{ date("jS M,Y",strtotime($res->booking_date)) }}
                         </td>
                         
                         <td style="vertical-align:middle;">
                         {{ number_format($res->total_booking_cost,2,'.','') }}
                         </td>
                         
                         <td style="vertical-align:middle;">
                         {{ number_format($res->adv_amount,2,'.','') }}
                         </td>
                         
                         <td style="vertical-align:middle;">
                         	 @if($res->due_clear_status=="Pending")
                         	 <span style="color:#F00;">{{ number_format($res->booking_due,2,'.','') }}</span>
                             @else
                             <div class="clearfix"></div>
                             <span style="color:#060;">Cleared</span>
                             @endif
                         </td>
                         <td style="vertical-align:middle;">{{ $res->booking_id }}</td>
                         <td style="vertical-align:middle;">{{ $res->transaction_id }}</td>
                         <td class="text-center" style="vertical-align:middle;">
                         <a href="booking-details/{{ $res->booking_id }}/details"><img src="{{ asset('public/images/view.png') }}" alt="Edit" /></a>
                         
                        &nbsp;
                       <!-- <a href="{{ URL::to('administrator') }}/manage-orders/{{ $res->booking_id }}/delete"  onClick="return confirm('Are you sure you want to delete this record ?')"><img src="{{ asset('public/images/delete-icon.png') }}" alt="Delete" /></a>-->
                        </td>
                    </tr>
                    @php $sl+=1; @endphp
                    @endforeach
                </tbody>
              </table>
          </div>
      </div>
      
  </div>
</div>

<script>
$(document).ready(function() {
    $('#tbl_content').DataTable({
        responsive: true,
        /* Disable initial sort */
        "aaSorting": [],
        /*Stay in same page*/
        "stateSave": true,
		"lengthMenu": [[25, 50,100, -1], [25, 50,100, "All"]],
        /* Disable sorting columns */
        'aoColumnDefs': [{'bSortable': true,'aTargets': [1]}]
    });
});
</script>


@stop