<div class="pagetitle">
    <h1>{{ $title ?? 'Dashboard' }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Trang điều khiển</a></li>
            <li class="breadcrumb-item active">{{ $title ?? 'Dashboard' }}</li>
            <input type="hidden" value="{{ $title ?? 'Dashboard' }}" class="title">
        </ol>
    </nav>
</div>
