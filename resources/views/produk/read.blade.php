  @php
      $i = 1;
  @endphp
  @foreach ($produk as $item)
      <tr id="tr_{{ $item->id_produk }}">
          <th><input type="checkbox" data-id="{{ $item->id_produk }}" class="form-check-input checkbox"></th>
          <th scope="row">{{ $i++ }}</th>
          <td><span class="badge badge-pill bg-primary">{{ $item->kode_produk }}</span></td>
          <td>{{ $item->merk }}</td>
          <td>{{ $item->kategori->kategori ?? '' }}</td>
          <td>{{ $item->merk }}</td>
          <td>{{ rupiah($item->harga_beli, true) }}</td>
          <td>{{ rupiah($item->harga_jual, true) }}</td>
          <td>{{ $item->stok }}</td>
          <td>
              <div class="btn-group btn-sm">
                  <button onclick="show({{ $item->id_produk }})" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i>
                  </button>
                  <button class="btn btn-success" onclick="detail({{ $item->id_produk }})"><i
                          class="fa fa-eye"></i></button>
                  <button class="btn btn-danger" onclick="destroy({{ $item->id_produk }})"><i
                          class="fa fa-trash"></i></button>
              </div>
          </td>
      </tr>
  @endforeach
