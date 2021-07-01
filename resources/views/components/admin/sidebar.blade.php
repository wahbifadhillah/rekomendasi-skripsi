<div class="brand">
    {{$brand}}
</div>
<ul id="nav">
    <li>
        <a href="{{ route('admin.dashboard.index')}}" class="nav-btn {{(request()->is('admin/dashboard')) ? 'active' : ''}}">
            <div class="nav-icon">
                <i class="fas fa-tachometer-alt"></i>
            </div>
            <div class="nav-link">
                Dashboard
            </div>
        </a>
    </li>
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
        <ul class="collapse {{(request()->is('admin/dataset')) ? 'show' : ''}} {{(request()->is('admin/dataset/create')) ? 'show' : ''}} {{(request()->is('admin/training')) ? 'show' : ''}} {{(request()->is('admin/testing')) ? 'show' : ''}}" id="sub_data" data-parent="#nav">
            <li>
                <a href="{{ route('admin.dataset.index')}}" class="sub-nav-btn {{(request()->is('admin/dataset')) ? 'active' : ''}}{{(request()->is('admin/dataset/create')) ? 'active' : ''}}">
                    <div class="nav-link">
                        Dataset
                    </div>      
                </a>
            </li>
            <li>
                <a href="{{ route('admin.training.index')}}" class="sub-nav-btn {{(request()->is('admin/training')) ? 'active' : ''}}">
                    <div class="nav-link">
                        Data latih
                    </div>      
                </a>
            </li>
            <li>
                <a href="{{ route('admin.testing.index')}}" class="sub-nav-btn {{(request()->is('admin/testing')) ? 'active' : ''}}">
                    <div class="nav-link">
                        Data uji
                    </div>      
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{ route('admin.decisiontree.index')}}" class="nav-btn {{(request()->is('admin/decisiontree')) ? 'active' : ''}} {{(request()->is('admin/decisiontree/'.last(request()->segments())            )) ? 'active' : ''}}">
            <div class="nav-icon">
                <i class="fas fa-sitemap"></i>
            </div>
            <div class="nav-link">
                Model Pohon Keputusan
            </div>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.recommendation.create')}}" class="nav-btn {{(request()->is('admin/recommendation/create')) ? 'active' : ''}} {{(request()->is('admin/recommendation')) ? 'active' : ''}}">
            <div class="nav-icon">
                <i class="fas fa-thumbs-up"></i>
            </div>
            <div class="nav-link">
                Dapatkan Rekomendasi
            </div>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.configuration.index')}}" class="nav-btn {{(request()->is('admin/configuration')) ? 'active' : ''}}">
            <div class="nav-icon">
                <i class="fas fa-cog"></i>
            </div>
            <div class="nav-link">
                Konfigurasi
            </div>
        </a>
    </li>
</ul>