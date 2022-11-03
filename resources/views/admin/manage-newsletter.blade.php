@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<script>
function checkAll() {
	if($('#chkall').is(':checked')){
		$('.chkbox').each(function(){
			$(this).prop('checked',true);
		});
	}else{
		$('.chkbox').each(function(){
			$(this).prop('checked',false);
		});
	}
}
</script>
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Newsletter </li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-user"></i>Newsletter</h4> </div>
                    <div class="widget-content">
                        <div class="col-xs-12 col-sm-12">
                          <div style="height:20px;">
                            @if (Session::has('success'))
                                <span style="color:#090;">Newsletter has been send successfully.</span>
                            @endif
                            
                            @if (Session::has('blank'))
                                <span style="color:#F00;">Please enter all * marked controls values.</span>
                            @endif
                          </div>
                        
                           {{ Form::open(array('url' => 'manage-newsletter', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_newsletter', 'id' => 'frm_newsletter','files'=>true, 'autocomplete' => 'off')) }}  
                      
                      
                      <div class="form-group col-xs-12 col-xs-12">
                          <div align="left" style="max-height:200px; overflow:auto; overflow-x:hidden; width:100%;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border: solid 1px #F8F8F8;">
                              <tr class="headings" bgcolor="#F8F8F8" style="color:#38A1D6">
                                <td width="6%" align="center"  height="35"><input type="checkbox" name="chkall" id="chkall" value="all" onclick="checkAll();"></td>
                                <td width="82%" height="35" class="text1"><strong>All subscribed email address *</strong></td>
                                <td width="12%" align="center" valign="middle" class="text1"><strong>Action</strong></td>
                              </tr>
                              @php  $sl=1; $count=0; @endphp
                              @foreach ($data as $res)
                              <tr>
                                <td align="center" class="content" height="25">
                                <input type="checkbox" class="chkbox" name="to_email[]" value="{{ $res->nl_email }}"></td>
                                <td class="dtext2">&nbsp;{{ $res->nl_email }}</td>
                                <td align="center" valign="middle" class="dtext2">&nbsp;
                                <a href="{{ URL::to('administrator') }}/manage-newsletter/{{ $res->id }}/delete" onClick="return confirm('Are you sure you want to delete this record ?')"><img src="{{ asset('public/images/delete-icon.png')}}" alt="Delete" title="Delete" /></a>
                                </td>
                              </tr>
                              
                              <tr>
                                  <td colspan="3" height="1" bgcolor="#999999"></td>
                              </tr>
                              @php ($count=$count+1)
                              @endforeach
                            </table>
          </div>
                      </div>
                      
                      
                      <div class="form-group col-xs-12 col-sm-12">
                          <label>Subject *</label>
                           {!! Form::text('subject','Newsletter :: SR Valley',array('id' => 'subject','required', 'class'=>'form-control','placeholder'=>'')) !!}
                      </div>
                      
                      <div class="form-group col-md-12">
                        <label>Message*: <span style="color:#F00;">(Note : Don't Change the variables inside " % % " tags.These variables are used in the e- mail sending process.)</span></label>
                        
                         {!! Form::textarea('contents',$template_det[0]->contents, array('id' => 'contents','required', 'class'=>'ckeditor','placeholder'=>'')) !!}
                         <script type="text/javascript">						 
						  CKEDITOR.replace( 'contents', {
								filebrowserUploadUrl: '{{ url("public/ckeditor/filemanager/connectors/php/upload.php")}}'
							});
						  </script>
                         
                         
                         
                      </div>
                      <div class="clearfix"></div>
                      
                      
                      <div class="form-group col-md-12">
                      	{{ Form::submit('Send Mail', array('class' => 'btn btn-sm btn-success pull-left')) }}
                        
                        &nbsp;&nbsp;
                        
                       <!-- <a href="{{ URL::to('administrator/dashboard') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a>-->
                        
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