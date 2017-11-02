<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li class="@yield('munu_act1')">
    <a href="{{route('admin_dashboard')}}">
      <i class="fa fa-dashboard"></i> <span>Request Status</span>
    </a>
  </li>
  <li class="treeview @yield('munu_act4')">
    <a href="#">
      <i class="fa fa-user-plus"></i>
      <span>Cannidate</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{route('cannidate_new.index')}}"><i class="fa fa-users"></i> List Candidate</a></li>  
      <li><a href="{{route('cannidate_new.history')}}"><i class="fa fa-history"></i> History</a></li>
    </ul>
  </li>
  <li class="@yield('munu_act3')">
    <a href="{{route('myjob.index')}}">
      <i class="fa fa-briefcase"></i>
      <span>My Job</span>
    </a>
  </li>
  <li class="treeview @yield('munu_act2')">
    <a href="#">
      <i class="fa fa-cog"></i>
      <span>Setting</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{route('admin_masterdata')}}"><i class="fa fa-folder-o"></i> MasterData</a></li>
      <li><a href="{{route('mailgroup.index')}}"><i class="fa fa-envelope"></i> Notification</a></li>
      <li><a href="{{route('authorize.index')}}"><i class="fa fa-users"></i> Authorize</a></li>
      <li><a href="{{route('approve.index')}}"><i class="fa fa-check-circle"></i> Approve</a></li>
    </ul>
  </li>
</ul>
