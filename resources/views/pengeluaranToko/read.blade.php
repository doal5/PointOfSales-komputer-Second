  @php
      $i = 1;
  @endphp
  @foreach ($pengeluaran as $item)
      <tr id="tr_{{ $item->id }}">
          <th><input type="checkbox" data-id="{{ $item->id }}" class="form-check-input checkbox"></th>
          <th scope="row">{{ $i++ }}</th>
          <td>{{ $item->keterangan }}</td>
          <td>{{ rupiah($item->total) }}</td>
          <td>{{ date('d F Y', strtotime($item->tanggal)) }}</td>
          <td>
              <div class="btn-group btn-sm">
                  <a href="{{ url('pengeluaran/' . $item->id . '/edit') }}">
                      <button class="btn btn-sm btn-primary"><i class="fa fa-pen"></i>
                      </button>
                  </a>
              </div>
          </td>
      </tr>
  @endforeach
