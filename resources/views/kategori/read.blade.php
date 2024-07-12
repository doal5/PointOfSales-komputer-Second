  @php
      $i = 1;
  @endphp
  @foreach ($kategori as $item)
      <tr id="tr_{{ $item->id }}">
          <th><input type="checkbox" data-id="{{ $item->id }}" class="form-check-input checkbox"></th>
          <th scope="row">{{ $i++ }}</th>
          <td>{{ $item->kategori }}</td>
          <td>
              <div class="btn-group btn-sm">
                  <button class="btn btn-danger" onclick="destroy({{ $item->id }})"><i
                          class="fa fa-trash"></i></button>
                  <button class="btn btn-primary" onclick="show({{ $item->id }})"><i
                          class="fa fa-pencil"></i></button>
              </div>
          </td>
      </tr>
  @endforeach
