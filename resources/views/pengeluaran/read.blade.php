  @php
      $i = 1;
  @endphp
  @foreach ($pengeluaran as $item)
      <tr id="tr_{{ $item->id }}">
          <th><input type="checkbox" data-id="{{ $item->id }}" class="form-check-input checkbox"></th>
          <th scope="row">{{ $i++ }}</th>
          <td><span class="badge badge-pill bg-primary">{{ $item->supplier->nama ?? '' }}</span></td>
          <td>{{ $item->keterangan }}</td>
          <td>{{ rupiah($item->total) }}</td>
          <td>
              <div class="btn-group btn-sm">
                  <button onclick="show({{ $item->id }})" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i>
                  </button>
                  <button class="btn btn-danger" onclick="destroy({{ $item->id }})"><i
                          class="fa fa-trash"></i></button>
              </div>
          </td>
      </tr>
  @endforeach
