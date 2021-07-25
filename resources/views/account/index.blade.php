<h2>Добро пожаловать, {{ Auth::user()->name }}!</h2>
<br>
<a href="{{ route('admin.main') }}">В админку</a>
<br>
<a href="{{ route('logout') }}">Выход</a>
