<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>Tuniverse - Web Player: Music</title>
    <link rel="icon" type="image/png" sizes="32x32" href="Images/Logo3.png"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
    crossorigin="anonymous">
  <link rel="stylesheet" href="./search.css">
  <link rel="icon" href="./assets/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="script.js" defer></script>
</head>


<body>

  <div id="app" class="d-flex flex-column">

    <div id="principal" class="d-flex">


        <nav id="sidebar" class="w-100 pt-4 d-flex flex-column">
  
            <!-- Start of logo -->
    
            <a href="#" class="d-flex px-4">
              <img src="Images/Logo3.png" width="40" height="40" fill="currentColor" class="bi bi-spotify"
              viewBox="0 0 16 16">
              <span class="fw-semibold ms-2" style="font-size: 1.5em;">Tuniverse</span>
            </a>
    
            <!-- End of logo -->
    
    
    
            <!-- Start of side bar-->
    
            <ul class="nav flex-column px-2 my-4">
              <li class="nav-item">
                <a href="index.php" class="nav-link ativo"><svg role="img" height="24" width="24" viewBox="0 0 24 24">
                    <path
                      d="M13.5 1.515a3 3 0 00-3 0L3 5.845a2 2 0 00-1 1.732V21a1 1 0 001 1h6a1 1 0 001-1v-6h4v6a1 1 0 001 1h6a1 1 0 001-1V7.577a2 2 0 00-1-1.732l-7.5-4.33z">
                    </path>
                  </svg> Home</a>
              </li>
              <li class="nav-item">
                <a href="search.php" class="nav-link"><svg role="img" height="24" width="24" viewBox="0 0 24 24">
                    <path
                      d="M10.533 1.279c-5.18 0-9.407 4.14-9.407 9.279s4.226 9.279 9.407 9.279c2.234 0 4.29-.77 5.907-2.058l4.353 4.353a1 1 0 101.414-1.414l-4.344-4.344a9.157 9.157 0 002.077-5.816c0-5.14-4.226-9.28-9.407-9.28zm-7.407 9.279c0-4.006 3.302-7.28 7.407-7.28s7.407 3.274 7.407 7.28-3.302 7.279-7.407 7.279-7.407-3.273-7.407-7.28z">
                    </path>
                  </svg> Search</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><svg role="img" height="24" width="24" viewBox="0 0 24 24">
                    <path
                      d="M14.5 2.134a1 1 0 011 0l6 3.464a1 1 0 01.5.866V21a1 1 0 01-1 1h-6a1 1 0 01-1-1V3a1 1 0 01.5-.866zM16 4.732V20h4V7.041l-4-2.309zM3 22a1 1 0 01-1-1V3a1 1 0 012 0v18a1 1 0 01-1 1zm6 0a1 1 0 01-1-1V3a1 1 0 012 0v18a1 1 0 01-1 1z">
                    </path>
                  </svg> Your Library</a>
              </li>
            </ul>
    
            <div id="underList">
              <button>
                <div class="plus_bttn">
                  <svg role="img" height="12" width="12" aria-hidden="true" viewBox="0 0 16 16">
                    <path
                      d="M15.25 8a.75.75 0 01-.75.75H8.75v5.75a.75.75 0 01-1.5 0V8.75H1.5a.75.75 0 010-1.5h5.75V1.5a.75.75 0 011.5 0v5.75h5.75a.75.75 0 01.75.75z">
                    </path>
                  </svg>
                </div>
                Create Playlist
              </button>
    
              <button>
                <div class="heart_bttn">
                  <svg role="img" height="12" width="12" aria-hidden="true" viewBox="0 0 16 16">
                    <path
                      d="M15.724 4.22A4.313 4.313 0 0012.192.814a4.269 4.269 0 00-3.622 1.13.837.837 0 01-1.14 0 4.272 4.272 0 00-6.21 5.855l5.916 7.05a1.128 1.128 0 001.727 0l5.916-7.05a4.228 4.228 0 00.945-3.577z">
                    </path>
                  </svg>
                </div>
                Liked Songs
              </button>
            </div>
    
            <!-- End of side bar-->
    
    
    
            <hr class="mx-4 mb-0 mt-2">
  
           
          </nav>
        
          <!-- Main Content -->
          <div id="feed" class="w-100">
    
            <!-- menu superior do conteudo -->
            <nav id="topNav" class="d-flex justify-content-between align-items-center px-4 py-2">

          <!-- Start of arrows -->

          <div id="arrowMenu">
            <a href="./index.php"><button><svg role="img" height="24" width="24" class="Svg-ytk21e-0 gFcOie IYDlXmBmmUKHveMzIPCF"
                viewBox="0 0 24 24">
                <path
                  d="M15.957 2.793a1 1 0 010 1.414L8.164 12l7.793 7.793a1 1 0 11-1.414 1.414L5.336 12l9.207-9.207a1 1 0 011.414 0z">
                </path>
              </svg></button></a>
            <button><svg role="img" height="24" width="24" class="Svg-ytk21e-0 gFcOie IYDlXmBmmUKHveMzIPCF"
                viewBox="0 0 24 24">
                <path
                  d="M8.043 2.793a1 1 0 000 1.414L15.836 12l-7.793 7.793a1 1 0 101.414 1.414L18.664 12 9.457 2.793a1 1 0 00-1.414 0z">
                </path>
              </svg></button>
              <div class="div--hun">
                <form class="form--hun"><input class="Type__TypeElement-goli3j-0 cPwEdQ QO9loc33XC50mMRUCIvf" maxlength="800" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="What do you want to listen to?" data-testid="search-input" value="" style="color: rgb(0, 0, 0);"></form>
              </div>
          </div>

          <!-- End of arrows-->
        
          <div id="btnTopNav" class="d-flex">
  
            <!-- Start of user profile -->
            <?php if (!isset($_SESSION['username'])): ?>
              <!-- Show login button if user is NOT logged in -->
              <div id="login-button" class="dropdown ms-3">
              <a href="login.html" class="btn btn-primary">

              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right me-1" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
              </svg>
              Login
              </a>
             </div>
            <?php else: ?>
                <!-- Show profile button if user IS logged in -->
                <div class="dropdown ms-3" id="user_bttn">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="imgUsuario bg-secondary">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                      </svg>
                    </div>
                    <?= htmlspecialchars($_SESSION['username']); ?>
                  </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" id="Logout" href="logout.php">Logout</a></li>
                    </ul>

             <?php endif; ?>

            
          </div>
        </nav>

        <!-- End of user profile -->

        <main id="main" class="p-4">
          <section id="feedHeader">
            <section class="feedPlaylist">
              <h4 class="mb-3"><a><b>Top Mixes</b></a></h4>
              
              <br>
              <ul class="playlists">
                <li>
                    <img src="assets/Malayalam.jpg">
                    <button type="button" class="btn me-3"><svg role="img" height="24" width="24" viewBox="0 0 24 24">
                        <path
                          d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z">
                        </path>
                      </svg></button>
                    <span>Malayalam</span>
                    <p><br>K. J. Yesudas, K. S. Chithra and more</p>
                  </li>
    
                  <li>
                    <img src="assets/Chill Hits - Malayalam.jpg">
                    <button type="button" class="btn me-3"><svg role="img" height="24" width="24" viewBox="0 0 24 24">
                        <path
                          d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z">
                        </path>
                      </svg></button>
                    <span>Chill Hits</span>
                    <p><br>Shaan Rahman,Gopi Sundar and more</p>
                  </li>
    
                  <li>
                    <img src="assets/Moody mix.jpg">
                    <button type="button" class="btn me-3"><svg role="img" height="24" width="24" viewBox="0 0 24 24">
                        <path
                          d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z">
                        </path>
                      </svg></button>
                    <span>Moody Mix</span>  
                  </li>
    
                  <li>
                    <img src="">
                    <button type="button" class="btn me-3"><svg role="img" height="24" width="24" viewBox="0 0 24 24">
                        <path
                          d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z">
                        </path>
                      </svg></button>
                    <span></span>
                    <p><br></p>
                  </li>
    
                  <li>
                    <img src="">
                    <button type="button" class="btn me-3"><svg role="img" height="24" width="24" viewBox="0 0 24 24">
                        <path
                          d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z">
                        </path>
                      </svg></button>
                    <span></span>
                    <p><br></p>
                  </li>
    
                  <li>
                    <img src="">
                    <button type="button" class="btn me-3"><svg role="img" height="24" width="24" viewBox="0 0 24 24">
                        <path
                          d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z">
                        </path>
                      </svg></button>
                    <span></span>
                    <p><br></p>
                  </li>
              </ul>
            </section>
           
          

          
         <script src="https://kit.fontawesome.com/55973b77b0.js" crossorigin="anonymous"></script>
  <script>
    function enabledisable(element) {
      console.log(element.style)
      if (element.style.fill != "rgb(29, 185, 84)") {
        element.style.setProperty('fill', '#1db954');
      } else {
        element.style.setProperty('fill', '#fff');
      }
    }
  </script>
</body>     

</html>