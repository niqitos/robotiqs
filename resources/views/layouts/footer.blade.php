<footer class="container-fluid">
    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-6 small text-center text-md-left pb-2">
            @ {{ now()->year > 2019 ? '2019-' . now()->year : now()->year }}
            {{ config('app.name') }}.
            {{ __('All Rights Reserved') }}
        </div>
        <div class="col-md-6 small text-center text-md-right pb-3 pb-md-2">
            <a class="mr-3" href="{{ route('terms.service') }}">
                {{ __('Terms of Service') }}
            </a>
            <a href="{{ route('terms.privacy') }}">
                {{ __('Privacy Policy') }}
            </a>
        </div>
    </div>
</footer>