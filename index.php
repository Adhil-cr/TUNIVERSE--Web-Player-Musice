<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuniverse - Web Player: Music</title>
    <link rel="icon" type="image/png" sizes="32x32" href="Images/Logo3.png"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
    crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">

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
  
          <nav id="topNav" class="d-flex justify-content-between align-items-center px-4 py-2">
  
            <!-- Start of arrows -->
  
            <div id="arrowMenu">
              <button><svg role="img" height="24" width="24" class="Svg-ytk21e-0 gFcOie IYDlXmBmmUKHveMzIPCF"
                  viewBox="0 0 24 24">
                  <path
                    d="M15.957 2.793a1 1 0 010 1.414L8.164 12l7.793 7.793a1 1 0 11-1.414 1.414L5.336 12l9.207-9.207a1 1 0 011.414 0z">
                  </path>
                </svg></button>
              <button><svg role="img" height="24" width="24" class="Svg-ytk21e-0 gFcOie IYDlXmBmmUKHveMzIPCF"
                  viewBox="0 0 24 24">
                  <path
                    d="M8.043 2.793a1 1 0 000 1.414L15.836 12l-7.793 7.793a1 1 0 101.414 1.414L18.664 12 9.457 2.793a1 1 0 00-1.414 0z">
                  </path>
                </svg></button>
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
  
  
          <!-- Main content feed -->
          <main id="main" class="p-4">    
  
            <!-- Header Section -->
            <section id="feedHeader">
  
              <!-- start of greeting -->
              <h2 class="fw-bold" id="greeting">Welcome Back</h2>
              <!-- end of greeting -->
  
              <!-- recent playlists -->
              <ul id="playlistsRecentes" class="mb-5">
                <li>
                   <img src="assets/Evanda Enakku Custody.jpg" alt="Evanda Enakku Custody">
                   <span class="fw-semibold ms-3 me-auto">Evanda Enakku Custody</span>
                  <button type="button" class="btn me-3 play-btn" data-src="music/Evanda Enakku Custody.mp3">
                      <svg role="img" height="24" width="24" viewBox="0 0 24 24">
                        <path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z"></path>
                      </svg>
                  </button>
                </li>

                <li>
                  <img src="assets/Oru Kathilola.jpg" alt="Oru Kathilola">
                  <span class="fw-semibold ms-3 me-auto">Oru Kathilola</span>
                  <button type="button" class="btn me-3 play-btn" data-src="music/Oru Kathilola.mp3">
                      <svg role="img" height="24" width="24" viewBox="0 0 24 24">
                         <path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z"></path>
                      </svg>
                  </button>
                </li>

                <li>
                    <img src="assets/Manwa Laage.jpg" alt="Manwa Laage">
                    <span class="fw-semibold ms-3 me-auto">Manwa Laage</span>
                    <button type="button" class="btn me-3 play-btn" data-src="music/Manwa Laage.mp3">
                        <svg role="img" height="24" width="24" viewBox="0 0 24 24">
                          <path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z"></path>
                        </svg>
                    </button>
                </li>

                <li>
                  <img src="assets/Moral of the Story.jpg" alt="Moral of the Story">
                  <span class="fw-semibold ms-3 me-auto">Moral of the Story</span>
                  <button type="button" class="btn me-3 play-btn" data-src="music/Moral of the Story.mp3">
                      <svg role="img" height="24" width="24" viewBox="0 0 24 24">
                          <path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z"></path>
                      </svg>
                  </button>
                </li>

                <li>
                    <img src="assets/Ajitha Hare.jpg" alt="Ajitha Hare">
                    <span class="fw-semibold ms-3 me-auto">Ajitha Hare</span>
                    <button type="button" class="btn me-3 play-btn" data-src="music/Ajitha Hare.mp3">
                        <svg role="img" height="24" width="24" viewBox="0 0 24 24">
                            <path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z"></path>
                        </svg>
                    </button>
                </li>

                <li>
                    <img src="assets/Let Her Go x Husn.jpg" alt="Let Her Go x Husn">
                    <span class="fw-semibold ms-3 me-auto">Let Her Go x Husn</span>
                    <button type="button" class="btn me-3 play-btn" data-src="music/Let Her Go x Husn.mp3">
                        <svg role="img" height="24" width="24" viewBox="0 0 24 24">
                            <path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z"></path>
                        </svg>
                    </button>
                </li>
              </ul>
            </section>
  
  
  
            <!-- Your top mixes -->
            <section class="feedPlaylist">
              <h4 class="mb-3"><a href="#"><b>Your top mixes</b></a></h4>
              <br>
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
  
            <!--recently played-->
            <section class="feedPlaylist">
              <h4 class="mb-3"><a href="#">Recently Played</a></h4>
              <br>
              <br>
              <ul class="playlists">
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
                  <span>song titile</span>
                  <p><br>artist name</p>
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
            
          </main>
        </div>
      </div>
  
      <div id="mobiPlay">
        <button type="button" id="mobibtn"><svg role="img" height="24" width="24" viewBox="0 0 24 24">
            <path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z">
            </path>
          </svg></button>
      </div>
      <div id="footer">
        <div id="audioBar" class="p-3 d-flex justify-content-between">
  
          <div id="musicaPlay"></div>
  
          
  
          <div id="caixaCentral" class="d-flex flex-column align-items-center">
  
            <div id="caixaSetas" class="d-flex align-items-center">
              <button type="button" class="icones anterior"><svg role="img" height="16" width="16" viewBox="0 0 16 16">
                  <path
                    d="M12.7 1a.7.7 0 00-.7.7v5.15L2.05 1.107A.7.7 0 001 1.712v12.575a.7.7 0 001.05.607L12 9.149V14.3a.7.7 0 00.7.7h1.6a.7.7 0 00.7-.7V1.7a.7.7 0 00-.7-.7h-1.6z">
                  </path>
                </svg></button>
  
              <button type="button" class="btn playPause"><svg role="img" height="24" width="24" viewBox="0 0 24 24">
                  <path
                    d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z">
                  </path>
                </svg></button>
  
              <button type="button" class="icones proximo"><svg role="img" height="16" width="16" viewBox="0 0 16 16">
                  <path
                    d="M12.7 1a.7.7 0 00-.7.7v5.15L2.05 1.107A.7.7 0 001 1.712v12.575a.7.7 0 001.05.607L12 9.149V14.3a.7.7 0 00.7.7h1.6a.7.7 0 00.7-.7V1.7a.7.7 0 00-.7-.7h-1.6z">
                  </path>
                </svg></button>
  
              <button type="button" class="icones repetir"><svg onClick="enabledisable(this)" role="img" height="16"
                  width="16" viewBox="0 0 16 16">
                  <path
                    d="M0 4.75A3.75 3.75 0 013.75 1h8.5A3.75 3.75 0 0116 4.75v5a3.75 3.75 0 01-3.75 3.75H9.81l1.018 1.018a.75.75 0 11-1.06 1.06L6.939 12.75l2.829-2.828a.75.75 0 111.06 1.06L9.811 12h2.439a2.25 2.25 0 002.25-2.25v-5a2.25 2.25 0 00-2.25-2.25h-8.5A2.25 2.25 0 001.5 4.75v5A2.25 2.25 0 003.75 12H5v1.5H3.75A3.75 3.75 0 010 9.75v-5z">
                  </path>
                </svg></button>
            </div>
  
            <div id="barraDeProgresso"><small>00:00</small><input type="range"><small>00:00</small></div>
          </div>
  
  
          <div id="configAudio" class="d-flex align-items-center">
            
            <div id="volume">
              <button type="button" class="icones outrosDispositivos"><svg role="presentation" height="16" width="16"
                  aria-label="Volume médio" id="volume-icon" viewBox="0 0 16 16">
                  <path
                    d="M9.741.85a.75.75 0 01.375.65v13a.75.75 0 01-1.125.65l-6.925-4a3.642 3.642 0 01-1.33-4.967 3.639 3.639 0 011.33-1.332l6.925-4a.75.75 0 01.75 0zm-6.924 5.3a2.139 2.139 0 000 3.7l5.8 3.35V2.8l-5.8 3.35zm8.683 6.087a4.502 4.502 0 000-8.474v1.65a2.999 2.999 0 010 5.175v1.649z">
                  </path>
                </svg></button>
              <input type="range">
            </div>
            
          </div>
        </div>
      </div>
    </div>
  
  <script src="script.js" defer></script>
  <!-- Bootstrap Bundle with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>


</html>
