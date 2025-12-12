<div class="header_container" style="border-bottom: 1px solid rgb(173, 170, 170);">
    <div style="text-align:center;">
        <img style="width:55%;" alt="logo" src="{{ asset('image/eeswari_logo/eeswari_logo.png') }}">
    </div>
    <div
        style="text-align:center;border-left: 1px solid rgb(173, 170, 170);border-right: 1px solid rgb(173, 170, 170);">
        <h3 style="font-weight: bold;">EESWARI NURSING HOME</h3>
        <div style="font-size:13px;">
            B 34, 11th Cross, Thillai Nagar, Trichy- 18.
        </div>
        <div style="font-size:13px;">
            Phone: 043 - 2742939, 2740531.
        </div>
    </div>
    <div>
        <div style="font-size:13px;">
            P.O NO: {{ $purchaseorder->uniqid }}
        </div>
        <div style="font-size:14px;">
            PO DATE: {{ $purchaseorder->created_at->format('d/m/Y') }}
        </div>
    </div>
</div>