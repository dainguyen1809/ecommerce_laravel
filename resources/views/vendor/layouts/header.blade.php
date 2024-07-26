<div class="ts__dashboard_menu">
    <div class="tsd__dashboard_user">
        <img src="{{ asset(Auth::user()->avatar) }}" alt="img" class="img-fluid">
        <p>{{ Auth::user()->name }}</p>
    </div>
</div>
