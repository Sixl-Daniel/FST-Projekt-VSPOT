@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Default Box Example</h3>
                        <div class="box-tools pull-right">
                            <span class="label label-primary">Label</span>
                        </div>
                    </div>
                    <div class="box-body">The body of the box</div>
                    <div class="box-footer">The footer of the box</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Default Box Example</h3>
                        <div class="box-tools pull-right">
                            <span class="label label-primary">Label</span>
                        </div>
                    </div>
                    <div class="box-body">The body of the box</div>
                    <div class="box-footer">The footer of the box</div>
                </div>
            </div>
        </div>
@stop
