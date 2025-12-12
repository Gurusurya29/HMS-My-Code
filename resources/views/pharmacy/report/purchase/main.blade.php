<h5>Purchase</h5>
<div class="pb-4 pt-2">
    <div class="row g-3 row-cols-1 row-cols-md-2">
        <div class="col-md-2">
            <a href="{{ route('pharmacy.purchasereportindex') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-truck" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Purchase Report</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('pharmacy.purchaseentryindex') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-box-seam" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Purchase Entry Items Report</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('pharmacy.purchaseitemreturn') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-arrow-bar-right" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Purchase Item Return Report</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
