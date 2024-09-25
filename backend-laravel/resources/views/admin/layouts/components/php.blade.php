@php
    if ($errors->any()) {
        foreach ($errors->all() as $error) {
            toastr()->warning($error);
        }
    }
@endphp
