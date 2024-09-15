<x-mail::message>
    # Introduction

    Subject : <b>{{ $query->subject }}</b>
    Mô tả : <b>{{ $query->description }}</b>

    Cảm ơn,<br>
    {{ config('app.name') }}
</x-mail::message>
