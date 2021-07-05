@extends('templates.admin.master')
@section('title', 'Model Pohon Keputusan')
@section('sidebar')
@endsection
@section('content_title')
    @parent
    Model Pohon Keputusan
@endsection
@section('content_body')
    @parent
    @php($route_prefix = NULL)
    @if (auth()->user()->role == 1)
        @php($route_prefix = 'admin')
    @else
        @php($route_prefix = 'kjfd')
    @endif
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link {{(\Request::is('*/decisiontree') ? 'active disabled' : '')}}" href="{{ route($route_prefix.'.decisiontree.index')}}">Model Aktif</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{(\Request::is('*/decisiontree/*') ? 'active disabled' : 'disabled')}}">Lihat Model</a>
                </li>
            </ul>
        </div>
    </div>
    @yield('decisiontree')
@endsection
@section('tree_script')
    @if ($selected_tree)    
        <script>
            var tree_graph = '<?php echo $selected_tree->tree_graph ?>';
            var viz = new Viz();
            // p = document.getElementById('tree_view');
            viz.renderSVGElement(tree_graph)
            .then(function(element) {
                t = document.getElementById('tree_view').appendChild(element);
                t.id = 'tree'
                tree = t
            })
            .catch(error => {
                // Create a new Viz instance (@see Caveats page for more info)
                viz = new Viz();
                
                // Possibly display the error
                console.error(error);
            });

            const position = { x: 0, y: 0 }

            const interactable = interact('#tree')
            interactable.draggable({
                snap: {
                    targets: [
                        interact.createSnapGrid({ x: 500, y: 1 })
                    ]
                },
                listeners: {
                    move (event) {
                        position.x += event.dx
                        position.y += event.dy
                        
                        event.target.style.transform =
                        `translate(${position.x}px, ${position.y}px)`
                    },
                },
                
            })

        </script>
    @endif
@endsection