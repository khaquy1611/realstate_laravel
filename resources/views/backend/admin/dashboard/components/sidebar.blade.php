@php
    $segment = request()->segment(2);

@endphp
<div class="sidebar-header">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        ESC<span>UI</span>
    </a>
    <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<div class="sidebar-body">
    <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item {{ $segment === 'dashboard' ? 'active' : ''}}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box link-icon"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
              <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">web apps</li>
        @foreach (config('apps.sidebar.module') as $key => $val)
            @php
                $collapse = isset($val['collapse']) ? $val['collapse'] : null;
            @endphp
            <li class="nav-item nav-category">Role</li>
            <li
                class="{{ isset($val['class']) ? $val['class'] : '' }} {{ in_array($segment, $val['name']) ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse"
                    href="{{ "#$collapse" }}" role="button"
                    aria-expanded="false" aria-controls="{{ $collapse }}">
                    <i class="{{ $val['icon'] }}" data-feather="{{ $val['data-feather'] }}"></i>
                    <span class="link-title">{{ $val['title'] }}</span>
                    @if (isset($val['subModule']) && count($val['subModule']))
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    @endif
                </a>

                @if (isset($val['subModule']))
                    <div class="collapse" id="{{ $collapse }}">
                        <ul class="nav sub-menu">
                            @foreach ($val['subModule'] as $module)
                                <li class="nav-item">
                                    <a href="{{ route($module['route']) }}"
                                        class="nav-link">{{ $module['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</div>
