@php
    $i = 1;
@endphp
@foreach ($ptS as $item)
    <tr>
        <td>{{ $i++ }}</td>
        <td><span class="badge bg-primary">{{ $item->produk->kode_produk }}</span> </td>
        <td>{{ $item->produk->merk }}</td>
        <td>{{ $item->produk->kategori->kategori }}</td>
        {{-- <td>{{ date('d F Y', strtotime($item->last_sold)) }}</td>
        <td>{{ rupiah(($item->produk->harga_jual - $item->produk->harga_beli) * $item->total) }}</td> --}}
        <td>{{ $item->total }}</td>
    </tr>
@endforeach
