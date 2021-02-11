    <div class="sidebar" data-color="red">
      <div class="logo">
        <a href="{{ route('home') }}" class="simple-text logo-mini">
          {{ __('TV') }}
        </a>
        <a href="{{ route('home') }}" class="simple-text logo-normal">
          {{ __('Tasks App') }}
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="{{ route('home') }}">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>{{ __('Tasks') }}</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>