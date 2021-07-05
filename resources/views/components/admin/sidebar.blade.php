<div class="userdata">
    <span class="username">{{Auth::user()->name}}</span>
    <small>{{Auth::user()->field}}</small>
</div>
@php($route_prefix = NULL)
@if (auth()->user()->role == 'kaprodi')
    @php($route_prefix = 'admin')
@else
    @php($route_prefix = 'kjfd')
@endif
<ul id="nav">
    <li>
        <a href="{{ route($route_prefix.'.dashboard.index')}}" class="nav-btn {{(\Request::is('*/dashboard')) ? 'active' : ''}}">
            <div class="nav-icon">
                <i class="fas fa-tachometer-alt"></i>
            </div>
            <div class="nav-link">
                Dashboard
            </div>
        </a>
    </li>
    @if (auth()->user()->role == 'kaprodi')
    <li>
        <a href="#sub_data" data-toggle="collapse" data-target="#sub_data" aria-expanded="false" class="nav-btn">
            <div class="nav-icon">
                <i class="fas fa-table"></i>
            </div>
            <div class="nav-link">
                Data
            </div>
        </a>
        {{-- active with class show --}}
        {{-- <ul class="collapse {{(request()->is('admin/dataset')) ? 'active' : ''}} {{(request()->is('admin/training')) ? 'active' : ''}} {{(request()->is('admin/testing')) ? 'active' : ''}}" id="sub_data" data-parent="#nav"> --}}
        <ul class="collapse {{(\Request::is('*/dataset')) ? 'show' : ''}} {{(\Request::is('*/dataset/create')) ? 'show' : ''}} {{(\Request::is('*/training')) ? 'show' : ''}} {{(\Request::is('*/testing')) ? 'show' : ''}}" id="sub_data" data-parent="#nav">
            <li>
                <a href="{{ route('admin.dataset.index')}}" class="sub-nav-btn {{(\Request::is('*/dataset')) ? 'active' : ''}}{{(\Request::is('*/dataset/create')) ? 'active' : ''}}">
                    <div class="nav-link">
                        Dataset
                    </div>      
                </a>
            </li>
            <li>
                <a href="{{ route('admin.training.index')}}" class="sub-nav-btn {{(\Request::is('*/training')) ? 'active' : ''}}">
                    <div class="nav-link">
                        Data latih
                    </div>      
                </a>
            </li>
            <li>
                <a href="{{ route('admin.testing.index')}}" class="sub-nav-btn {{(\Request::is('*/testing')) ? 'active' : ''}}">
                    <div class="nav-link">
                        Data uji
                    </div>      
                </a>
            </li>
        </ul>
    </li>
    @endif
    <li>
        <a href="{{ route($route_prefix.'.decisiontree.index')}}" class="nav-btn {{(\Request::is('*/decisiontree')) ? 'active' : ''}} {{(\Request::is('*/decisiontree/*')) ? 'active' : ''}}">
            <div class="nav-icon">
                <i class="fas fa-sitemap"></i>
            </div>
            <div class="nav-link">
                Model Pohon Keputusan
            </div>
        </a>
    </li>
    <li>
        <a href="{{ route($route_prefix.'.recommendation.create')}}" class="nav-btn {{(\Request::is('*/recommendation/create')) ? 'active' : ''}} {{(\Request::is('*/recommendation')) ? 'active' : ''}} {{(\Request::is('*/recommendation/*')) ? 'active' : ''}}">
            <div class="nav-icon">
                <i class="fas fa-thumbs-up"></i>
            </div>
            <div class="nav-link">
                Dapatkan Rekomendasi
            </div>
        </a>
    </li>
    @if (auth()->user()->role == 'kaprodi')
    <li>
        <a href="{{ route('admin.configuration.index')}}" class="nav-btn {{(\Request::is('*/configuration')) ? 'active' : ''}}">
            <div class="nav-icon">
                <i class="fas fa-cog"></i>
            </div>
            <div class="nav-link">
                Konfigurasi
            </div>
        </a>
    </li>
    @endif
</ul>