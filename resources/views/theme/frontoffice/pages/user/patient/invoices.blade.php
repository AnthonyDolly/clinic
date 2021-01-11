@extends('theme.frontoffice.layouts.main')

@section('title', 'Mis Facturas')

@section('head')
@endsection

@section('nav')
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('theme.frontoffice.pages.user.includes.nav')
        {{-- Seccion principal --}}
        <div class="col s12 m8">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">@yield('title')</span>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Concepto</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->concept() }}</td>
                                    <td>{{ $invoice->amount }}</td>
                                    <td>{{ $invoice->status }}</td>
                                    <td>
                                        <a href="#modal" data-invoice="{{ $invoice->id }}" onclick="modal_invoice(this)" class="modal-trigger">
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Usted no tiene facturas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal">
        <div class="modal-content">
            <h4 id="modal_invoice_title">Información de la factura</h4>
            <p><strong>Folio: </strong><span id="modal_invoice_id"></span></p>
            <p><strong>Doctor: </strong><span id="modal_invoice_doctor"></span></p>
            <p><strong>Concepto: </strong><span id="modal_invoice_concept"></span></p>
            <p><strong>Monto: </strong><span id="modal_invoice_amount"></span></p>
        </div>
        <div class="modal-footer">
            <a href="" class="modal-close waves-effect btn-flat">Cerrar</a>
            <a href="" class="waves-effect btn-flat">Imprimir</a>
        </div>
    </div>
</div>
@endsection

@section('foot')
<script type="text/javascript">
    $('.modal').modal();

    function modal_invoice(e)
    {
        var invoice_id = $(e).data('invoice');
        $.ajax({
            url: '{{ route('ajax.invoice_info') }}',
            method: 'GET',
            data: {
                invoice_id: invoice_id
            },
            success: function(data)
            {
                $('#modal_invoice_id').html(data.invoice.id);
                $('#modal_invoice_doctor').html(data.doctor.name);
                $('#modal_invoice_concept').html(data.concept);
                $('#modal_invoice_amount').html(data.invoice.amount);
            }
        });
    }
</script>
@endsection