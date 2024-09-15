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
        <li class="nav-item nav-category">web apps</li>
        @foreach (config('apps.sidebar.module') as $key => $val)
            @php
                $collapse = isset($val['collapse']) ? $val['collapse'] : null;
            @endphp
            <li class="nav-item nav-category">{{ $val['placeholderTitle'] }}</li>
            <li
                class="{{ isset($val['class']) ? $val['class'] : '' }} {{ in_array($segment, $val['name']) ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse"
                    href="{{ !isset($val['subModule']) ? route($val['route']) : "#$collapse" }}" role="button"
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
