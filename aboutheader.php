<style>
  .accdent{
    color:white;
    font-size:30px; 
    font-weight:500; 
    margin-left:100px;
  }
  @media only screen and (max-width: 767px) {
    .img-lo{
      position: relative;
    left: 345px;
    }
    .accdent{
      color: white;
    font-size: 30px;
    font-weight: 500;
    margin-left: -11px;
    position: relative;
    top: -5px;
  }
  .nav-but{
    position: relative;
    bottom: 5px;
    right: 343px;
  }
  }
</style>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand img-lo" href="notification.php"><img src="https://c.animaapp.com/61CXDTV0/img/screenshot-2023-08-29-112643-2@2x.png" width="70" alt="logo"></a>
        <span class="accdent" style="">Accident SOS</span> 
    <button class="navbar-toggler nav-but" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
     
        <li class="nav-item" style='background-color:red;'>
          <a class="nav-link  <?= ($activePage == 'login') ? 'active':''; ?>"  href="login.html" aria-current="page">Login</a>
        </li>
        
       
       
      </ul>

    </div>
  </div>
</nav>
