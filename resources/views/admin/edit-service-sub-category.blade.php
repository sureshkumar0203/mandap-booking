@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<script>
function hidePriceFiled(spv){
	if(spv==1){
		$('#sp').hide();
		$('#service_price').val('');
	}else{
		$('#sp').show();
		$('#service_price').attr('required','required');
	}
}

$(function(){
	if($('#cat_id').val()==1){
		$('#cat_id').prop('disabled', true);
	}else{
		$('#cat_id').prop('disabled', false);
	}
});
</script>
<?php
$path = Request::path('');
$path = explode("/", $path);
$ID = $path[2];
?>   
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Edit Service Sub Category</li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-pencil-square-o"></i> Edit Service Sub Category</h4> </div>
                <div class="widget-content">
                    <div class="col-xs-12 col-sm-12">
                      <div style="height:20px;">
                        @if (Session::has('success'))
                            <span style="color:#090;">Records has been saved successfully.</span>
                        @endif
                        
                        @if (Session::has('blank'))
                            <span style="color:#F00;">Please enter all * marked controls values.</span>
                        @endif
                        
                         @if (Session::has('exist'))
                            <span style="color:#F00;">This sub category name already exist.</span>
                        @endif
                       
                      </div>
                    
                      {{ Form::open(array('url' => 'update-service-sub-category', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_sub_category', 'id' => 'frm_sub_category','files'=>true, 'autocomplete' => 'off')) }}  
                      
                      
                      {!! Form::hidden('reference_id',$ID, array('id' => 'reference_id','required', 'class'=>'','placeholder'=>'')) !!}
                      
                      <div class="form-group col-md-8">
                      <label>Select Service Category*:</label> 
                      {!! Form::select('cat_id',$cat_det,$data[0]->cat_id,array('id' => 'cat_id','required','class'=>'form-control','default' => '','onchange' => 'hidePriceFiled(this.value)')) !!}
                      </div>
                     
                         
                     <div class="form-group col-md-8">
                      <label>Service Sub Category Name*:</label> 
                     {!! Form::text('sub_cat_name',$data[0]->sub_cat_name,array('id' => 'sub_cat_name','required','class'=>'form-control','placeholder'=>'')) !!}
                     </div>
                     
                    
                       @if(($data[0]->sub_cat_id==1 && $data[0]->cat_id==1) || ($data[0]->cat_id != 1))
                       <div class="form-group col-md-8" id="sp">
                        <label>Service Price*:</label>
                         {!! Form::text('service_price',$data[0]->service_price, array('id' => 'service_price','maxlength' => 10,'class'=>'form-control','placeholder'=>'','autocomplete' => 'off','onKeyUp' => 'validatePrice(this)')) !!}
                       </div>
                       @endif
                       
                      
                      <div class="clearfix"></div>
                        
                        
                      
                        
                      <div class="clearfix"></div>
                      
                      <div class="form-group col-md-12">
                      	{{ Form::submit('Update', array('class' => 'btn btn-sm btn-success pull-left')) }}
                        
                        &nbsp;&nbsp;
                        
                        <a href="{{ URL::to('administrator/manage-service-sub-category') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a>
                        
                      </div>
                              
                      {{ Form::close() }}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@stop