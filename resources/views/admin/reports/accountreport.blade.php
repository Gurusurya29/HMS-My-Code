<h5>Finance Report</h5>
<div class="pb-4 pt-2">
    <div class="row g-3 row-cols-1 row-cols-md-2">
        @can('Receipt-report')
            <div class="col-md-2">
                <a href="{{ route('adminreceiptreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-receipt-cutoff" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Receipt Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Paymentvoucher-report')
            <div class="col-md-2">
                <a href="{{ route('adminpaymentvoucherreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-credit-card-2-front" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Payment Voucher Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Billdiscount-report')
            <div class="col-md-2">
                <a href="{{ route('adminbilldiscountreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-arrows-expand" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Bill Discount/Cancel Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Hospital Ledger-report')
            <div class="col-md-2">
                <a href="{{ route('hospitalstatementreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-file-earmark-ruled" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Hospital Ledger Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Patient Ledger-report')
            <div class="col-md-2">
                <a href="{{ route('patientstatementreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-person-video2" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Patient Ledger Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Employee Ledger-report')
            <div class="col-md-2">
                <a href="{{ route('employeestatementreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-collection" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Employee Ledger Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('Supplier Ledger-report')
            <div class="col-md-2">
                <a href="{{ route('supplierstatementreport') }}" class="text-decoration-none text-dark text-center">
                    <div class="card shadow-sm">
                        <i class="bi bi-file-earmark-medical" style="font-size: 2.4rem;"></i>
                        <div class="card-footer">
                            <div class="fw-b">Supplier Ledger Report </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
    </div>
</div>
