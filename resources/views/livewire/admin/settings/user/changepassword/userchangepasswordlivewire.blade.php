<div class="col-md-4 mx-auto mt-5">
    <form wire:submit.prevent="changepassword" class="p-4 p-md-5 border rounded-3 shadow-sm" autocomplete="off">
        <div class="form-floating mb-3">
            <input wire:model="currentpassword" type="password" class="form-control @error('email') is-invalid @enderror"
                placeholder="Current Password" id="floatingcurrentpassword" autofocus>
            <label for="floatingcurrentpassword">Current Password</label>
            @error('email')
                <span class="text-danger"> <strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input wire:model="password" type="password" class="form-control" id="floatingpassword"
                placeholder="New Password">
            <label for="floatingpassword">New Password</label>
            @error('password')
                <span class="text-danger"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input wire:model="password_confirmation" type="password" class="form-control"
                id="floatingpassword_confirmation" placeholder="Confirm New Password">
            <label for="floatingpassword_confirmation">Confirm New Password</label>
            @error('password')
                <span class="text-danger"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="d-flex justify-content-center">
            <span wire:click="onclickformreset" class="btn btn-danger mx-2">Reset</span>
            <button type="submit" class="btn text-white theme_bg_color">Change Password</button>
        </div>
    </form>
</div>
