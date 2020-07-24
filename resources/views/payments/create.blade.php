@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <br>
                <div class="alert alert-info"><i class="fa fa-chevron-right"></i>&nbsp;Please click on Proceed Payment to Pay online.
                </div>
                <div class="widget-box">
                    <div class="widget-body">
                        <div class="widget-main">

                            <form action="{{ route('payments.pay', [$orderId])}}" method="POST" class="form-horizontal">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label">Total Price: </label>
                                    <div class="col-sm-6">
                                        <input value="{{$grandTotal}}" type="text" class="form-control" name="amount"
                                                readonly/>
                                    </div>
                                </div>

                                <div class="clearfix form-actions ">
                                    <div class="col-md-10">
                                        <button class="btn btn-info btn-sm" id="submit" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i>Proceed Payment
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


