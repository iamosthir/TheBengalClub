<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="BengalClub Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Bengal</b>Club</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.membership-applications.index') }}" class="nav-link {{ Request::routeIs('admin.membership-applications.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Member Applications
                @php
                  $pendingApplications = \App\Models\MembershipApplication::where('status', 'pending')->count();
                @endphp
                @if($pendingApplications > 0)
                  <span class="badge badge-warning right">{{ $pendingApplications }}</span>
                @endif
              </p>
            </a>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.registered-members.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.registered-members.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Registered Members
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.registered-members.create') }}" class="nav-link {{ Request::routeIs('admin.registered-members.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.registered-members.index') }}" class="nav-link {{ Request::routeIs('admin.registered-members.index') || Request::routeIs('admin.registered-members.edit') || Request::routeIs('admin.registered-members.show') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.invitations.index') }}" class="nav-link {{ Request::routeIs('admin.invitations.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>Invite</p>
            </a>
          </li>

          <li class="nav-header">WEBSITE SETTINGS</li>

          <li class="nav-item {{ Request::routeIs('admin.site-settings.*') || Request::routeIs('admin.seo-settings.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.site-settings.*') || Request::routeIs('admin.seo-settings.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Website Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.site-settings.edit') }}" class="nav-link {{ Request::routeIs('admin.site-settings.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Site Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.seo-settings.edit') }}" class="nav-link {{ Request::routeIs('admin.seo-settings.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEO Settings</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.slideshow-banner.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.slideshow-banner.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Slide Show
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.slideshow-banner.create') }}" class="nav-link {{ Request::routeIs('admin.slideshow-banner.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.slideshow-banner.index') }}" class="nav-link {{ Request::routeIs('admin.slideshow-banner.index') || Request::routeIs('admin.slideshow-banner.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.board-directors.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.board-directors.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Board of Directors
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.board-directors.create') }}" class="nav-link {{ Request::routeIs('admin.board-directors.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.board-directors.index') }}" class="nav-link {{ Request::routeIs('admin.board-directors.index') || Request::routeIs('admin.board-directors.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.facilities.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.facilities.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Facilities
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.facilities.create') }}" class="nav-link {{ Request::routeIs('admin.facilities.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.facilities.index') }}" class="nav-link {{ Request::routeIs('admin.facilities.index') || Request::routeIs('admin.facilities.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.membership-categories.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.membership-categories.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-crown"></i>
              <p>
                Membership Categories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.membership-categories.create') }}" class="nav-link {{ Request::routeIs('admin.membership-categories.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.membership-categories.index') }}" class="nav-link {{ Request::routeIs('admin.membership-categories.index') || Request::routeIs('admin.membership-categories.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.events.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.events.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Events
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.events.create') }}" class="nav-link {{ Request::routeIs('admin.events.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.events.index') }}" class="nav-link {{ Request::routeIs('admin.events.index') || Request::routeIs('admin.events.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.archive.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.archive.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-photo-video"></i>
              <p>
                Archive
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.archive.create') }}" class="nav-link {{ Request::routeIs('admin.archive.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.archive.index') }}" class="nav-link {{ Request::routeIs('admin.archive.index') || Request::routeIs('admin.archive.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.honorary-members.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.honorary-members.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Honorary Members
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.honorary-members.create') }}" class="nav-link {{ Request::routeIs('admin.honorary-members.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.honorary-members.index') }}" class="nav-link {{ Request::routeIs('admin.honorary-members.index') || Request::routeIs('admin.honorary-members.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gallery List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.about-us.edit') }}" class="nav-link {{ Request::routeIs('admin.about-us.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>About Us</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.vision-mission.edit') }}" class="nav-link {{ Request::routeIs('admin.vision-mission.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-bullseye"></i>
              <p>Vision & Mission</p>
            </a>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.tan-samiti.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.tan-samiti.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Investment Plan
                @php $pendingTanSamiti = \App\Models\TanSamitiInstallment::paymentSubmitted()->count(); @endphp
                @if($pendingTanSamiti > 0)
                  <span class="badge badge-warning right">{{ $pendingTanSamiti }}</span>
                @endif
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.tan-samiti.create') }}" class="nav-link {{ Request::routeIs('admin.tan-samiti.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Samiti</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.tan-samiti.index') }}" class="nav-link {{ Request::routeIs('admin.tan-samiti.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Samitis</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.tan-samiti.payment-requests') }}" class="nav-link {{ Request::routeIs('admin.tan-samiti.payment-requests') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Payment Requests
                    @if($pendingTanSamiti > 0)
                      <span class="badge badge-warning right">{{ $pendingTanSamiti }}</span>
                    @endif
                  </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">MANAGEMENT</li>

          <li class="nav-item {{ Request::routeIs('admin.announcements.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.announcements.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcements
                @php
                  $liveAnnouncements = \App\Models\Announcement::activeToday()->count();
                @endphp
                @if($liveAnnouncements > 0)
                  <span class="badge badge-info right">{{ $liveAnnouncements }}</span>
                @endif
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.announcements.create') }}" class="nav-link {{ Request::routeIs('admin.announcements.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.announcements.index') }}" class="nav-link {{ Request::routeIs('admin.announcements.index') || Request::routeIs('admin.announcements.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.payment-methods.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.payment-methods.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                Payment Methods
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.payment-methods.create') }}" class="nav-link {{ Request::routeIs('admin.payment-methods.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.payment-methods.index') }}" class="nav-link {{ Request::routeIs('admin.payment-methods.index') || Request::routeIs('admin.payment-methods.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.payment-requests.index') }}" class="nav-link {{ Request::routeIs('admin.payment-requests.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Payment Requests
                @php $pendingPayments = \App\Models\MembershipInstallment::paymentSubmitted()->count(); @endphp
                @if($pendingPayments > 0)
                  <span class="badge badge-warning right">{{ $pendingPayments }}</span>
                @endif
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.payment-links.index') }}" class="nav-link {{ Request::routeIs('admin.payment-links.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-link"></i>
              <p>
                Payment Links
                @php $submittedLinks = \App\Models\PaymentLink::where('status', 'submitted')->count(); @endphp
                @if($submittedLinks > 0)
                  <span class="badge badge-warning right">{{ $submittedLinks }}</span>
                @endif
              </p>
            </a>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.products.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.products.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.products.create') }}" class="nav-link {{ Request::routeIs('admin.products.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ Request::routeIs('admin.products.index') || Request::routeIs('admin.products.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Products</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ Request::routeIs('admin.orders.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Orders
                @php $pendingOrders = \App\Models\Order::where('status', 'pending')->count(); @endphp
                @if($pendingOrders > 0)
                  <span class="badge badge-warning right">{{ $pendingOrders }}</span>
                @endif
              </p>
            </a>
          </li>

          @php
            $donationMenuOpen = Request::routeIs('admin.donations.*')
                             || Request::routeIs('admin.donation-categories.*')
                             || Request::routeIs('admin.expenses.*')
                             || Request::routeIs('admin.donation-report.*');
          @endphp
          <li class="nav-item {{ $donationMenuOpen ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $donationMenuOpen ? 'active' : '' }}">
              <i class="nav-icon fas fa-donate"></i>
              <p>
                Donations
                @php $pendingDonations = \App\Models\Donation::where('status', 'pending')->count(); @endphp
                @if($pendingDonations > 0)
                  <span class="badge badge-warning right">{{ $pendingDonations }}</span>
                @endif
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.donations.index') }}" class="nav-link {{ Request::routeIs('admin.donations.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Donations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.donation-categories.index') }}" class="nav-link {{ Request::routeIs('admin.donation-categories.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Donation Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.expenses.index') }}" class="nav-link {{ Request::routeIs('admin.expenses.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expenses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.donation-report.index') }}" class="nav-link {{ Request::routeIs('admin.donation-report.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Donation Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.inquiries.index') }}" class="nav-link {{ Request::routeIs('admin.inquiries.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Inquiries
                @php
                  $unreadInquiries = \App\Models\Inquiry::unread()->count();
                @endphp
                @if($unreadInquiries > 0)
                  <span class="badge badge-warning right">{{ $unreadInquiries }}</span>
                @endif
              </p>
            </a>
          </li>

          <li class="nav-item {{ Request::routeIs('admin.admins.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('admin.admins.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>
                Administration
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.admins.index') }}" class="nav-link {{ Request::routeIs('admin.admins.index') || Request::routeIs('admin.admins.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.admins.create') }}" class="nav-link {{ Request::routeIs('admin.admins.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Admin</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav-header">ACCOUNT</li>
          <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
