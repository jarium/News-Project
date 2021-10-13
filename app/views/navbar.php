<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">CNBF-A News</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/news">News</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
    
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/news/science">Science</a></li>
            <li><a class="dropdown-item" href="/news/health">Health</a></li>
            <li><a class="dropdown-item" href="/news/political">Political</a></li>
            <li><a class="dropdown-item" href="/news/technology">Technology</a></li>
            <li><a class="dropdown-item" href="/news/world">World</a></li>
            <li><a class="dropdown-item" href="/news/economy">Economy</a></li>
            <li><a class="dropdown-item" href="/news/sports">Sports</a></li>
            <li><a class="dropdown-item" href="/news/art">Art</a></li>
            <li><a class="dropdown-item" href="/news/education">Education</a></li>
            <li><a class="dropdown-item" href="/news/social">Social</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
     <?php if (!isset($_SESSION['username'])): ?>
          <li class="nav-item active">
            <a class="nav-link" href="/users/login">Login </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/users/register">Register </a>
            </li>
     <?php else: ?>
          <li class="nav-item active">
            <a class="nav-link" href="/news/forme"> News For Me </a>
            </li>
          <li class="nav-item active">
            <a class="nav-link" href="/users"> Account </a>
            </li>
          <li class="nav-item active">
            <a class="nav-link" href="/users/logout">Logout </a>
            </li>
          
        <?php endif ?>
      </ul>
    </ul>
    </div>
  </div>
</nav>