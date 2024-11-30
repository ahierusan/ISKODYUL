<nav class="menu-group">
  <a href="/{{$user->role}}-dashboard">DASHBOARD</a>
  @if (strtolower($user->role) === 'student')
    <a href="/appointment" class="appointment">APPOINTMENT</a>
  @endif
  <a href="about.html">ABOUT</a>
  <a href="/logout" class="logout-fs">LOGOUT</a>
</nav>