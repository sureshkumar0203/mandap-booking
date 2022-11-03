@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
      
      <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
        </ul>
      </div>
      
      <div class="page-header">
        <div class="page-title">
            <h3>Dashboard</h3> <span>Welcome to dashboard,</span>
        </div>
      </div>
      
  </div>
</div>
@stop