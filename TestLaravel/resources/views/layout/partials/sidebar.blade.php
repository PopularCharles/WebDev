@if(Route::is(['index-one','index-three'])) 
<!-- Sidebar -->
@if(!Route::is(['index-three']))
<div class="sidebar new-header sidebar-one">
@endif
@if(Route::is(['index-three']))
<div class="sidebar side-three new-header">
@endif
@if(Route::is(['index-three']))
<div class="container">
@endif  
</div>
<!-- /Sidebar -->
@endif
<!-- Sidebar -->

@if(!Route::is(['index-one','index-two','index-three','index-four']))
<div class="sidebar" id="sidebar">
@endif
@if(Route::is(['index-two']))
<div class="sidebar sidebar-two" id="sidebar">
@endif    
    <div class="sidebar-inner slimscroll">
        @if(!Route::is(['index-four']))
        <div id="sidebar-menu" class="sidebar-menu">
            @endif
            @if(!Route::is(['index-four']))
            <ul>
                <li class="submenu-open">
                        <li class="{{ Request::is('index','index-two') ? 'active' : '' }}" >
                            <a href="{{url('/')}}"><i data-feather="grid"></i><span>Home</span></a>
                        </li>
                </li>
            
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Database</h6>
                     <ul>
                        <li class="{{ Request::is('customerlist','addcustomer') ? 'active' : '' }}"><a href="{{url('customerlist')}}"><i data-feather="user"></i><span>View Tables</span></a></li>
                        <li class="{{ Request::is('pos') ? 'active' : '' }}"><a href="{{url('pos')}}"><i data-feather="hard-drive"></i><span>Add Data</span></a></li>
                        <li class="{{ Request::is('consultationformpage') ? 'active' : '' }}"><a href="{{url('consultationformpage')}}"><i data-feather="list"></i><span>Consultation Form</span></a></li>
                    </ul> 
                </li>

            @endif 
            
        </div>
    </div>
</div>
<!-- /Sidebar -->