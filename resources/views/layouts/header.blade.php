   <nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
            <i class="bi bi-list"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">

        <li class="nav-item dropdown">
          <a class="nav-link" data-bs-toggle="dropdown" href="#">
            <i class="bi bi-chat-text"></i>
            <span class="navbar-badge badge text-bg-danger">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <a href="#" class="dropdown-item">
              <!--begin::Message-->
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <img
                    src="{{ url('public/dist/assets/img/user1-128x128.jpg') }}"
                    alt="User Avatar"
                    class="img-size-50 rounded-circle me-3"
                  />
                </div>
                <div class="flex-grow-1">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-end fs-7 text-danger"
                      ><i class="bi bi-star-fill"></i
                    ></span>
                  </h3>
                  <p class="fs-7">Call me whenever you can...</p>
                  <p class="fs-7 text-secondary">
                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                  </p>
                </div>
              </div>
              <!--end::Message-->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!--begin::Message-->
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <img
                    src="{{ url('public/dist/assets/img/user8-128x128.jpg') }}"
                    alt="User Avatar"
                    class="img-size-50 rounded-circle me-3"
                  />
                </div>
                <div class="flex-grow-1">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-end fs-7 text-secondary">
                      <i class="bi bi-star-fill"></i>
                    </span>
                  </h3>
                  <p class="fs-7">I got your message bro</p>
                  <p class="fs-7 text-secondary">
                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                  </p>
                </div>
              </div>
              <!--end::Message-->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!--begin::Message-->
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <img
                    src="{{ url('public/dist/assets/img/user3-128x128.jpg') }}"
                    alt="User Avatar"
                    class="img-size-50 rounded-circle me-3"
                  />
                </div>
                <div class="flex-grow-1">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-end fs-7 text-warning">
                      <i class="bi bi-star-fill"></i>
                    </span>
                  </h3>
                  <p class="fs-7">The subject goes here</p>
                  <p class="fs-7 text-secondary">
                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                  </p>
                </div>
              </div>
              <!--end::Message-->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link" data-bs-toggle="dropdown" href="#">
            <i class="bi bi-bell-fill"></i>
            <span class="navbar-badge badge text-bg-warning">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="bi bi-envelope me-2"></i> 4 new messages
              <span class="float-end text-secondary fs-7">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="bi bi-people-fill me-2"></i> 8 friend requests
              <span class="float-end text-secondary fs-7">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
              <span class="float-end text-secondary fs-7">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
          </div>
        </li>

        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <img src="{{ url('public/dist/assets/img/user2-160x160.jpg') }}" class="user-image rounded-circle shadow" alt="User Image"/>
            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
          </a>
          <ul style="min-width: 250px;max-width: 250px;" class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

            <li style="min-height: 150px;padding: 2px;" class="user-header text-bg-primary">
              <img src="{{ url('public/dist/assets/img/user2-160x160.jpg') }}" class="rounded-circle shadow" alt="User Image"/>
              <p>
                {{ Auth::user()->name }}
                <small>Member since {{ Auth::user()->created_at }}</small>
              </p>
            </li>
            <li class="user-footer">
              <a href="#" class="btn btn-default btn-flat">Profile</a>
              <a href="{{ url('logout') }}" class="btn btn-default btn-flat float-end">Log out</a>
            </li>

          </ul>
        </li>
      </ul>
    </div>
  </nav>

  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <div class="sidebar-brand">
      <a href="javascript:;" class="brand-link">
        <span style="font-weight: bold !important;font-size: 25px;margin-left: 0px;" class="brand-text fw-light">School</span>
      </a>
    </div>
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

            @if(Auth::user()->user_type == 1)
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Admin</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/teacher/list') }}" class="nav-link @if(Request::segment(2) == 'teacher') active @endif">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Teacher</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/student/list') }}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Student</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/parent/list') }}" class="nav-link @if(Request::segment(2) == 'parent') active @endif">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Parent</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/class/list') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
                        <i class="nav-icon bi bi-door-closed-fill"></i>
                        <p>Class</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/subject/list') }}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                        <i class="nav-icon bi bi-door-closed-fill"></i>
                        <p>Subject</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/assign_subject/list') }}" class="nav-link @if(Request::segment(2) == 'assign_subject') active @endif">
                        <i class="nav-icon bi bi-door-closed-fill"></i>
                        <p>Assign Subject</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>My Account</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Change Password</p>
                    </a>
                </li>


            @elseif(Auth::user()->user_type == 2)
                <li class="nav-item">
                    <a href="{{ url('teacher/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('teacher/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>My Account</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('teacher/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Change Password</p>
                    </a>
                </li>


            @elseif(Auth::user()->user_type == 3)
                <li class="nav-item">
                    <a href="{{ url('student/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('student/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>My Account</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('student/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Change Password</p>
                    </a>
                </li>


            @elseif(Auth::user()->user_type == 4)
                <li class="nav-item">
                    <a href="{{ url('parent/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('parent/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>My Account</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('parent/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Change Password</p>
                    </a>
                </li>

            @endif

            <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link @if(Request::segment(2) == 'logout') active @endif">
                    <i class="nav-icon bi bi-person-fill"></i>
                    <p>Logout</p>
                </a>
            </li>

        </ul>

      </nav>
    </div>

  </aside>
