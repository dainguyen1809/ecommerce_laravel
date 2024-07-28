<div class="col-12 d-flex">
    <div class="col-sm-6">
        @foreach (breadcrumbs() as $key => $route)
            @if ($key == count(breadcrumbs()) - 1)
                <h3>{{ is_numeric($route) ? 'ID ORDER ' . $route : ucfirst($route) }}</h3>
            @endif
        @endforeach
    </div>
    <div class="col-sm-6 d-flex justify-content-end">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light-lighten p-2">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-house me-2"></i>Home
                    </a>
                </li>
                @foreach (breadcrumbs() as $key => $route)
                    @if ($key == count(breadcrumbs()) - 1)
                        <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($route) }}</li>
                    @else
                        @php
                            $path = implode('/', array_slice(breadcrumbs(), 0, $key + 1));
                        @endphp
                        @if ($path === 'user')
                            <li class="breadcrumb-item">
                                <a href="{{ url($path . '/dashboard') }}">{{ auth()->user()->name }}</a>
                            </li>
                        @elseif ($path === 'vendor')
                            <li class="breadcrumb-item">
                                <a href="{{ url($path . '/dashboard') }}">{{ auth()->user()->name }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="#">{{ ucfirst($route) }}</a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</div>
