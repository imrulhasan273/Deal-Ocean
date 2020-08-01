<div class="sidebar" data-color="purple" data-background-color="black" data-image="{{asset('assets/img/sidebar-2.jpg')}}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="" class="simple-text logo-normal">
            <h4>{{ Auth::user()->name }}</h4>
        </a>
    </div>

    @php
        $roles = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
        $role = $roles[0];
    @endphp

    <div class="sidebar-wrapper">
      <ul class="nav">
        @if($active=='index')
        <li class="active ">
        @else
        <li>
        @endif
          <a class="nav-link" href="{{route('dashboard.index')}}">
            <i class="material-icons">dashboard</i>
            <p>Dashboard</p>
          </a>
        </li>
        @if($active=='profile')
        <li class="active ">
        @else
        <li>
        @endif
          <a class="nav-link" href="{{route('dashboard.profile')}}">
            <i class="material-icons">person</i>
            <p>User Profile</p>
          </a>
        </li>
        @if($active=='shops')
        <li class="active ">
        @else
        <li>
        @endif
          <a class="nav-link" href="{{route('dashboard.shops')}}">
            <i class="material-icons">content_paste</i>
            <p>Shop</p>
          </a>
        </li>

        @if($active=='products')
        <li class="active ">
        @else
        <li>
        @endif
          <a class="nav-link" href="{{route('dashboard.products')}}">
            <i class="material-icons">content_paste</i>
            <p>Product</p>
          </a>
        </li>

        @if ($role == 'admin' || $role == 'super_admin')
            @if($active=='coupons')
            <li class="active ">
            @else
            <li>
            @endif
            <a class="nav-link" href="{{route('dashboard.coupons')}}">
                <i class="material-icons">content_paste</i>
                <p>Coupon</p>
            </a>
            </li>
        @endif

        @if($active=='orders')
        <li class="active ">
        @else
        <li>
        @endif
          <a class="nav-link" href="{{route('dashboard.orders')}}">
            <i class="material-icons">content_paste</i>
            <p>Order</p>
          </a>
        </li>



        @if($active=='typography')
        <li class="active ">
        @else
        <li>
        @endif
          <a class="nav-link" href="{{route('dashboard.typography')}}">
            <i class="material-icons">library_books</i>
            <p>Typography</p>
          </a>
        </li>
        @if($active=='icons')
        <li class="active ">
        @else
        <li>
        @endif
          <a class="nav-link" href="{{route('dashboard.icons')}}">
            <i class="material-icons">bubble_chart</i>
            <p>Icons</p>
          </a>
        </li>
        @if($active=='map')
        <li class="active ">
        @else
        <li>
        @endif
          <a class="nav-link" href="{{route('dashboard.map')}}">
            <i class="material-icons">location_ons</i>
            <p>Maps</p>
          </a>
        </li>
        @if($active=='notification')
        <li class="active ">
        @else
        <li>
        @endif
          <a class="nav-link" href="{{route('dashboard.notification')}}">
            <i class="material-icons">notifications</i>
            <p>Notifications</p>
          </a>
        </li>

      </ul>
    </div>
  </div>
