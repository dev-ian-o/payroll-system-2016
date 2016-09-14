<?php 
    use Illuminate\Support\Str; 
?>
@if(Auth::check())
    <?php $id = Auth::user()->user_group_id; ?>
    <?php $group_name = DB::table('user_groups')->where('id',$id)->pluck('groupname')[0]; ?>
    <?php //dd(Auth::user()->username); ?>
@endif
    
<div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
            <li class="xn-logo">
                <a href="/admin">E-Iicket</a>
                <a href="#" class="x-navigation-control"></a>
            </li>
            <li class="xn-profile">
                <a href="#" class="profile-mini">
                    <img src="{{ URL::to('admin-assets/assets/images/users/avatar.jpg') }}" alt=""/>
                </a>
                <div class="profile">
                    <div class="profile-image">
                        <img src="{{ URL::to('admin-assets/assets/images/users/avatar.jpg') }}" alt=""/>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name">{{ Auth::user()->username }}</div>
                        <div class="profile-data-title">{{ Str::upper($group_name) }}</div>
                    </div>
                </div>                                                                        
            </li>
            <li class="xn-title">Navigation</li>
            <li title="Dashboard" class="@if(Request::url() === url('admin') || Request::url() === url('admin/dashboard') || Request::url() === url('admin/index') )) active @endif">
                <a href="{{ url('admin/dashboard')}}"><span class="fa fa-desktop"></span> <span class="xn-text" >Dashboard</span></a>                        
            </li>
            <li title="Users" class="@if(Request::url() === url('admin/users'))active @endif">
                <a href="{{ url('admin/users')}}"><span class="fa fa-user"></span> <span class="xn-text">Users</span></a>                        
            </li> 
            <li title="Payroll" class="@if(Request::url() === url('admin/payroll'))active @endif">
                <a href="{{url('admin/payroll')}}"><span class="fa fa-calendar"></span> <span class="xn-text">Payroll</span></a>                        
            </li>                                  
            <li title="Announcements" class="@if(Request::url() === url('admin/announcements'))active @endif">
                <a href="{{ url('admin/announcements')}}"><span class="fa fa-bell-o"></span> <span class="xn-text">Announcements</span></a>
            </li>            
            <li title="Employees" class="@if(Request::url() === url('admin/employees'))active @endif">
                <a href="{{ url('admin/employees')}}"><span class="fa fa-group"></span> <span class="xn-text">Employees</span></a>
            </li>            
            <li title="Timesheet" class="@if(Request::url() === url('admin/timesheet'))active @endif">
                <a href="{{ url('admin/timesheet')}}"><span class="fa fa-clock-o"></span> <span class="xn-text">Timesheet</span></a>
            </li>
            <li title="Holidays" class="@if(Request::url() === url('admin/holidays'))active @endif">
                <a href="{{ url('admin/holidays')}}"><span class="fa fa-calendar"></span> <span class="xn-text">Holidays</span></a>                        
            </li>
            <li title="Leaves" class="@if(Request::url() === url('admin/leaves'))active @endif">
                <a href="{{ url('admin/leaves')}}"><span class="fa fa-calendar"></span> <span class="xn-text">Leaves</span></a>                        
            </li>           
            <li title="Settings" class="@if(Request::url() === url('admin/settings'))active @endif">
                <a href="{{ url('admin/settings')}}"><span class="fa fa-gear"></span> <span class="xn-text">Settings</span></a>
            </li> 
        </ul>
        <!-- END X-NAVIGATION -->
    </div>

