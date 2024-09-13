<?php

if (!function_exists('generateBreadcrumbs')) {
    function generateBreadcrumbs($breadcrumbs = [])
    {
        return view('partials.breadcrumbs', compact('breadcrumbs'))->render();
    }
}