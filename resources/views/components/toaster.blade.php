@if (session()->has('success') || session()->has('warning') || session()->has('danger'))
    @php
    $alerts = [
        'success' => session('success'),
        'warning' => session('warning'),
        'danger' => session('danger'),
    ];
    @endphp

    @foreach ($alerts as $type => $message)
        @if ($message)
            <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close text-black" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
    @endforeach
@endif
