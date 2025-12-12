<h5>Sales</h5>
<div class="pb-4 pt-2">
    <div class="row g-3 row-cols-1 row-cols-md-2">
        <div class="col-md-2">
            <a href="{{ route('pharmacy.salesreportindex') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-cart-plus-fill" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Sales Report</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('pharmacy.salesitemreportindex') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-archive" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Sales Item Report</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('pharmacy.salesitemreturn') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-arrow-bar-right" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Sales Item Return Report</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
