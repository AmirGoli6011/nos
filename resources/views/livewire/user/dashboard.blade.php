<div>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>ویرایش مشخصات</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="avatar"
                                   class="col-md-4 col-form-label text-md-end">اواتار</label>
                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control" wire:model="avatar" name="avatar">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('اسم') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ $name }}" wire:model.debounce.1000ms="name" autocomplete="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username"
                                   class="col-md-4 col-form-label text-md-end">{{ __('نام کاربری') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text"
                                       class="form-control @error('username') is-invalid @enderror" name="username"
                                       value="{{ $username }}" wire:model.debounce.1000ms="username"
                                       autocomplete="username">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-end">{{ __('آدرس ایمیل') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ $email }}" wire:model.debounce.1000ms="email" autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-end">{{ __('رمز') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       autocomplete="new-password" wire:model.debounce.1000ms="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password-confirm"
                                   class="col-md-4 col-form-label text-md-end">{{ __('تکرار رمز') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" wire:model.debounce.1000ms="password_confirmation"
                                       autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-primary" wire:click="update">
                                    {{ __('ویرایش') }}
                                </button>
                            </div>
                        </div>
                        {!! $alert !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
