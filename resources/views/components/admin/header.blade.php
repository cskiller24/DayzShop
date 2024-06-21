<div class="row g-2 align-items-center">
    <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            {{ $headerPretitle ?? 'Overview' }}
        </div>
        <h2 class="page-title">
            {{ $headerTitle ?? 'Admin' }}
        </h2>
    </div>
    <!-- Page title actions -->
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            {{ $sideheader ?? null}}
        </div>
    </div>
</div>
