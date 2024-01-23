  @php
      $i = 1;
  @endphp
  @foreach ($supplier as $item)
      <tr id="tr_{{ $item->id_supplier }}">
          <th><input type="checkbox" data-id="{{ $item->id_supplier }}" class="form-check-input checkbox"></th>
          <th scope="row">{{ $i++ }}</th>
          <td>{{ $item->nama }}</td>
          <td>{{ $item->email }}</td>
          <td>{{ $item->no_telepon }}</td>
          <td>{{ $item->alamat }}</td>
          <td>
              <div class="btn-group btn-sm">
                  <button onclick="show({{ $item->id_supplier }})" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i>
                  </button>
                  <button class="btn btn-danger" onclick="destroy({{ $item->id_supplier }})"><i
                          class="fa fa-trash"></i></button>
              </div>
          </td>
      </tr>
  @endforeach
