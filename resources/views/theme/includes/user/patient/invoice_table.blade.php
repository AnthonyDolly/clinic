<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Concepto</th>
            <th>Monto</th>
            <th>Estado</th>
            <th @if (isset($user)) colspan="2" @endif>Acción</th>
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
                @if (isset($user))
                    <td>
                        <a href="{{ route('backoffice.patient.invoices.edit', [$user, $invoice]) }}">Editar</a>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="5">Usted no tiene facturas</td>
            </tr>
        @endforelse
    </tbody>
</table>