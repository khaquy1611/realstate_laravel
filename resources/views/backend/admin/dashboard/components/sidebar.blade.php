@php
    $segment = request()->segment(1);
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
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">web apps</li>
        @foreach (config('apps.sidebar.module') as $key => $val)
            <li
                class="{{ isset($val['class']) ? $val['class'] : '' }} {{ in_array($segment, $val['name']) ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails"
                    role="button" aria-expanded="false" aria-controls="emails">
                    <i class="{{ $val['icon'] }}" data-feather="mail"></i>
                    <span class="link-title">Email</span>
                    @if (isset($val['subModule']) && count($val['subModule']))
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    @endif
                </a>

                @if (isset($val['subModule']))
                    <div class="collapse" id="emails">
                        <ul class="nav sub-menu">
                            @foreach ($val['subModule'] as $module)
                                <li class="nav-item">
                                    <a href="{{ $module['route'] }}" class="nav-link {{ in_array($segment, $val['name']) ? 'active' : '' }}">{{ $module['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach

        <li class="nav-item">
            <a href="pages/apps/calendar.html" class="nav-link">
                <i class="link-icon" data-feather="calendar"></i>
                <span class="link-title">Calendar</span>
            </a>
        </li>
        <li class="nav-item nav-category">Components</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false"
                aria-controls="uiComponents">
                <i class="link-icon" data-feather="feather"></i>
                <span class="link-title">UI Kit</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="pages/ui-components/accordion.html" class="nav-link">Accordion</a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/ui-components/alerts.html" class="nav-link">Alerts</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false"
                aria-controls="advancedUI">
                <i class="link-icon" data-feather="anchor"></i>
                <span class="link-title">Advanced UI</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="advancedUI">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="pages/advanced-ui/cropper.html" class="nav-link">Cropper</a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Owl carousel</a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/advanced-ui/sortablejs.html" class="nav-link">SortableJs</a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/advanced-ui/sweet-alert.html" class="nav-link">Sweet Alert</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Docs</li>
        <li class="nav-item">
            <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                <i class="link-icon" data-feather="hash"></i>
                <span class="link-title">Documentation</span>
            </a>
        </li>
    </ul>
</div>
