
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3>{{trans('contracts::custom.contracts.contract_no') . $invoice->invoice_no}} ({{digiCurrency( $invoice->amount,$invoice->currency_id )}})</h3>
</div>
<div class="modal-body">

<form class="form-horizontal" role="form" id="form_add_payment" method="post">
<div class="form-group">
    <label for="account" class="col-sm-3 control-label">{{trans('custom.invoices.account') . '*'}}</label>
    <div class="col-sm-9">
       {!! Form::select('account', $accounts, old('account'), ['class' => 'form-control select2', 'id' => 'account']) !!}
    </div>
  </div>

<div class="form-group">
    <label for="date" class="col-sm-3 control-label">{{trans('custom.invoices.date') . '*'}}</label>
    <div class="col-sm-9">
      <input type="text" class="form-control datepicker" value="{{digiTodayDate()}}" name="date" id="date">
    </div>
  </div>

<div class="form-group">
    <label for="description" class="col-sm-3 control-label">{{trans('custom.invoices.description')}}</label>
    <div class="col-sm-9">
      <textarea id="description" name="description" class="form-control">{{trans('custom.invoices.payment-for') . ' #' . $invoice->invoice_no}}</textarea>
    </div>
  </div>
  
  
<div class="form-group">
    <label for="transaction_id" class="col-sm-3 control-label">{{trans('custom.invoices.transaction_id') . '*'}}</label>
    <div class="col-sm-9">
      <input type="text" id="transaction_id" name="transaction_id" class="form-control" value="">
    </div>
  </div>

  <div class="form-group">
    <label for="amount" class="col-sm-3 control-label">{{trans('custom.invoices.amount') . '*'}}</label>
    <div class="col-sm-9">
      <input type="text" id="amount" name="amount" class="form-control amount"   data-a-sign="$ " data-a-dec="." data-a-sep=","
data-d-group="3" value="{{$invoice->amount}}">

    </div>
  </div>

  
<div class="form-group">
    <label for="cats" class="col-sm-3 control-label">{{trans('custom.invoices.category') . '*'}}</label>
    <div class="col-sm-9">
       {!! Form::select('category', $categories, old('category'), ['class' => 'form-control select2', 'id' => 'category']) !!}
    </div>
  </div>
  <div class="form-group">
    <label for="payer_name" class="col-sm-3 control-label">{{trans('custom.invoices.payer')}}</label>
    <div class="col-sm-9">
      <input type="text" id="payer_name" name="payer_name" class="form-control" value="{{$customer->first_name . ' ' . $customer->last_name}}" disabled>
    </div>
  </div>
   <div class="form-group">
    <label for="subject" class="col-sm-3 control-label">{{trans('custom.invoices.method') . '*'}}</label>
    <div class="col-sm-9">
      {!! Form::select('paymethod', $payment_gateways, old('paymethod'), ['class' => 'form-control select2', 'id' => 'paymethod']) !!}
    </div>
  </div>

<input type="hidden" id="invoice_id" name="invoice_id" value="{{$invoice->id}}">
<input type="hidden" id="action" name="action" value="{{$action}}">
<input type="hidden" id="sub" name="sub" value="{{$sub}}">
<input type="hidden" name="payer" value="{{$customer->id}}">
</form>

</div>

