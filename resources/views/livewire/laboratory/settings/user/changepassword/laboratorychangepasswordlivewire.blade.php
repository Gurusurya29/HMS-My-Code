<div class="col-md-4 mx-auto mt-5">
    <form wire:submit.prevent="changepassword" class="p-4 p-md-5 border rounded-3 shadow-sm" autocomplete="off">
        <div class="form-floating mb-3">
            <input wire:model.debounce.150ms="currentpassword" type="password"
                class="form-control @error('email') is-invalid @enderror" placeholder="Current Password"
                id="floatingcurrentpassword" autofocus>
            <label for="floatingcurrentpassword">Current Password</label>
            @error('email')
                <span class="text-danger"> <strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input wire:model.debounce.150ms="password" type="password" class="form-control" id="floatingpassword"
                placeholder="New Password">
            <label for="floatingpassword">New Password</label>
            @error('password')
                <span class="text-danger"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input wire:model.debounce.150ms="password_confirmation" type="password" class="form-control"
                id="floatingpassword_confirmation" placeholder="Confirm New Password">
            <label for="floatingpassword_confirmation">Confirm New Password</label>
            @error('password')
                <span class="text-danger"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="d-flex justify-content-center">
            <span wire:click="onclickformreset" class="btn btn-danger mx-2">Reset</span>
            <div wire:loading wire:target="changepassword">
                <button class="btn btn-primary" type="button" disabled>
                    <span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
            <button wire:loading.remove type="submit" wire:target="changepassword"
                class="btn text-white theme_bg_color">Change
                Password</button>
        </div>
    </form>
</div>
