<div class="row justify-content-center">
    <div class="col-md-5">
        <form wire:submit.prevent="store" class="card shadow-sm" autocomplete="off">
            <div class="card-body">
                <div class="card-title fs-5 fw-bold">General Information:</div>
                <div class="row"></div>
                <div class="form-floating mb-3">
                    <input wire:model="companyfullname" type="text"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Hospital Fullname"
                        id="floatingcompanyfullname" autofocus>
                    <label for="floatingcompanyfullname">Hospital Fullname</label>
                    @error('companyfullname')
                        <span class="text-danger"> <strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input wire:model="companyshortname" type="text" class="form-control" id="floatingcompanyshortname"
                        placeholder="Hospital Shortname">
                    <label for="floatingcompanyshortname">Hospital Shortname</label>
                    @error('companyshortname')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input wire:model="phone" type="text" class="form-control" id="floatingphone" placeholder="Phone">
                    <label for="floatingphone">Phone</label>
                    @error('phone')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input wire:model="alternate_phone" type="text" class="form-control" id="floatingalternate_phone"
                        placeholder="alternate_phone">
                    <label for="floatingalternate_phone">Alternate Phone</label>
                    @error('alternate_phone')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input wire:model="email" type="text" class="form-control" id="floatingemail" placeholder="email">
                    <label for="floatingemail">Email</label>
                    @error('email')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input wire:model="panno" type="text" class="form-control" id="floatingpanno"
                        placeholder="Pan No">
                    <label for="floatingpanno">Pan No</label>
                    @error('panno')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input wire:model="gstno" type="text" class="form-control" id="floatinggstno"
                        placeholder="GST No">
                    <label for="floatinggstno">GST No</label>
                    @error('gstno')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input wire:model="hospitalcode" type="text" class="form-control" id="floatinghospitalcode"
                        placeholder="Hospital Code">
                    <label for="floatinghospitalcode">Hospital Code</label>
                    @error('hospitalcode')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input wire:model="websitename" type="text" class="form-control" id="floatingwebsitename"
                        placeholder="Webiste">
                    <label for="floatingwebsitename">Webiste</label>
                    @error('websitename')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <textarea wire:model="address" class="form-control" placeholder="Address" id="floatingaddress"></textarea>
                    <label for="floatingaddress">Address</label>
                    @error('address')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="d-flex justify-content-center">
                    <span wire:click="onclickformreset" class="btn btn-danger mx-2">Reset</span>
                    <button type="submit" class="btn text-white theme_bg_color">Update</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <form wire:submit.prevent="uploadlogo" class="card shadow-sm mb-2" autocomplete="off">
            <div class="card-body">
                <div class="card-title fs-5 fw-bold">Logo:</div>
                <div class="text-center">
                    @if ($logo)
                        <img class="rounded shadow-sm w-50" src="{{ $logo->temporaryUrl() }}">
                    @elseif ($existinglogo)
                        <img class="rounded shadow-sm w-50" src="{{ url('storage/' . $existinglogo) }}">
                    @else
                        <img class="rounded shadow-sm w-50 mx-auto" alt="logo"
                            src="{{ asset('image/dummy/200x200.jpg') }}">
                    @endif

                    @error('logo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mx-auto mt-5">
                        <label for="logoid" class="btn btn-primary ">Change Logo</label>
                        <input type="file" wire:model="logo" id="logoid" class="d-none">
                    </div>
                    @if ($logo?->temporaryUrl())
                        <button type="submit" class="btn btn-success mt-2">Save</button>
                    @endif
                </div>
            </div>
        </form>
        <form wire:submit.prevent="uploadfavicon" class="card shadow-sm mt-2" autocomplete="off">
            <div class="card-body">
                <div class="card-title fs-5 fw-bold">Favicon:</div>
                <div class="text-center">
                    @if ($favicon)
                        <img class="rounded shadow-sm w-50" src="{{ $favicon->temporaryUrl() }}">
                    @elseif ($existingfavicon)
                        <img class="rounded shadow-sm w-50" src="{{ url('storage/' . $existingfavicon) }}">
                    @else
                        <img class="rounded shadow-sm w-50 mx-auto" alt="favicon"
                            src="{{ asset('image/dummy/200x200.jpg') }}">
                    @endif

                    @error('favicon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mx-auto mt-5">
                        <label for="faviconid" class="btn btn-primary ">Change Favicon</label>
                        <input type="file" wire:model="favicon" id="faviconid" class="d-none">
                    </div>
                    @if ($favicon?->temporaryUrl())
                        <button type="submit" class="btn btn-success mt-2">Save</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
