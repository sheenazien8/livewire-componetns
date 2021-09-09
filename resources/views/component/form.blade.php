<div>
  <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)
    @foreach ($schema as $key => $row)
      @if ($row instanceof \Illuminate\View\View)
        {{ $row }}
      @else
        @include('livewirecomponents::type-form.'. $row['type'], ['name' => $key, 'row' => $row])
      @endif
    @endforeach
    @foreach ($button as $key => $btn)
      @php
        $type = $btn['type'] ?? '';
        if(isset($btn['link'])) {
          $type = 'link';
        }
      @endphp
      @if ($type == 'link')
        <a href="{{ $btn['link'] }}" class="btn btn-{{ $btn['color'] ?? 'default' }}">{{ $btn['label'] }}</a>
      @else
        <button type="{{ $type }}" class="btn btn-{{ $btn['color'] ?? 'default' }}">{{ $btn['label'] }}</button>
      @endif
    @endforeach
  </form>
</div>

