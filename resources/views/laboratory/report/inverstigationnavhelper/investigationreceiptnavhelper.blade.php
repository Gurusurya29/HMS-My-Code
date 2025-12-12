<h5>Finance Report</h5>
<div class="pb-4 pt-2">
    <div class="row g-3 row-cols-1 row-cols-md-2">
        <div class="col-md-2">
            <a href="{{ route('receiptreport') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-currency-dollar" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Receipt Report </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('paymentvoucherreport') }}" class="text-decoration-none text-dark text-center">
                <div class="card shadow-sm">
                    <i class="bi bi-credit-card-2-front" style="font-size: 2.4rem;"></i>
                    <div class="card-footer">
                        <div class="fw-b">Payment Voucher Report </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
