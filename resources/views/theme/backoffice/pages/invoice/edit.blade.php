@extends('theme.backoffice.layouts.admin')

@section('title','Editar factura' . $invoice->id)

@section('head')
@endsection

@section('breadcrumbs')
    <li>Editar factura {{ $invoice->id }}</li>
@endsection

@section('content')
    <div class="section">
        <p class="caption">Introduce los datos para editar la factura</p>
        <div class="divider"></div>
        <div id="basic-form" class="section">
            <div class="row">
                <div class="col s12 m8 offset-m2">
                    <div class="card-panel">
                        <h4 class="header2">Editar Factura</h4>
                        <div class="row">
                            <form class="col s12" method="POST" action="{{ route('backoffice.patient.invoices.update', [$user, $invoice]) }}">

                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="amount" type="text" name="amount" value="{{ $invoice->amount }}">
                                        <label for="amount">Monto de la factura</label>
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong style="color: red">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="status">
                                            <option value="pending"  @if($invoice->status == 'pending') selected @endif>Pendiente</option>
                                            <option value="approved" @if($invoice->status == 'approved') selected @endif>Pagado</option>
                                            <option value="rejected" @if($invoice->status == 'rejected') selected @endif>Rechazado</option>
                                            <option value="cancelled"@if($invoice->status == 'cancelled') selected @endif>Cancelado</option>
                                            <option value="refunded" @if($invoice->status == 'refunded') selected @endif>Devolución</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong style="color: red">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light right" type="submit">Actualizar
                                        <i class="material-icons right">send</i>
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
@endsection

@section('foot')
@endsection