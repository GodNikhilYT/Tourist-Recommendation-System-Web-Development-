<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header("Location: login.html");
    exit();
}
$fullname = $_SESSION['fullname'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="icon" type="image/x-icon"
    href="https://cdn-icons-png.freepik.com/512/17418/17418859.png?uid=R62901352&ga=GA1.1.682275086.1676998538">
  <link rel="stylesheet" href="index.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>
</head>

<body>
  <!--===============Navbar================-->
<header>
  <nav>
    <!-- Mobile Sidebar -->
    <ul class="sidebar">
      <li onclick="hideSidebar()">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26">
            <path
              d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z" />
          </svg>
        </a>
      </li>
      <li><a href="#">Home</a></li>
      <li><a href="#sect-02">Destinations</a></li>
      <li><a href="#sect-03">Planning</a></li>
      <li><a href="#sect-04">Inspiration</a></li>
       <li class="hideOnMobile"> <a> Welcome, <?php echo htmlspecialchars($fullname); ?></a></li>
       <li class="hideOnMobile"><a href="index.html">Logout</a></li>
      <li id="sidebar-user-area"></li>
    </ul>

    <!-- Desktop Navigation -->
    <ul>
      <li><a href="#">TouristGuide</a></li>
      <li class="hideOnMobile"><a href="#">Home</a></li>
      <li class="hideOnMobile"><a href="#sect-02">Destinations</a></li>
      <li class="hideOnMobile"><a href="#sect-03">Planning</a></li>
      <li class="hideOnMobile"><a href="#sect-04">Inspiration</a></li>
      <li class="hideOnMobile"><a href="search.html">Search 🔍</a></li>
      <li class="hideOnMobile"> <a> Welcome, <?php echo htmlspecialchars($fullname); ?></a></li>
       <li class="hideOnMobile"><a href="index.html">Logout</a></li>
      <li class="hideOnMobile" id="desktop-user-area"></li>
      <li class="menu-button" onclick="showSidebar()">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26">
            <path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z" />
          </svg>
        </a>
      </li>
    </ul>
  </nav>
</header>

<!-- JavaScript for Login State and Fullname -->
<script>
  function updateUserNav() {
    const fullname = localStorage.getItem("fullname");
    const desktopArea = document.getElementById("desktop-user-area");
    const sidebarArea = document.getElementById("sidebar-user-area");

    if (fullname) {
      // Show fullname and logout
      const logoutBtn = `<span style="color:white; margin-right:10px;">Hello, ${fullname}</span>
                         <a href="index.html" onclick="logout()">Logout</a>`;

      desktopArea.innerHTML = logoutBtn;
      sidebarArea.innerHTML = logoutBtn;
    } else {
      // Show login/register
      desktopArea.innerHTML = `
        <a href="login.html">Log in</a>
        <a href="register.html" style="margin-left:10px;">Register</a>
      `;
      sidebarArea.innerHTML = `
        <a href="login.html">Log in</a>
        <a href="register.html" style="margin-left:10px;">Register</a>
      `;
    }
  }

  function logout() {
    localStorage.removeItem("fullname");
    window.location.href = "index.html";
  }

  window.onload = updateUserNav;
</script>

  
  <!--===============Banner================-->
  <section class="banner">
    <video autoplay muted loop id="bg-video">
      <source id="video-source"
        src="https://lonelyplanetstatic.imgix.net/marketing/best-in-travel/2025/videos/main-page/bit-landscape-1.mp4"
        type="video/mp4">
    </video>

    <script>
      // List of video URLs
      const videoList = [
        "https://lonelyplanetstatic.imgix.net/marketing/best-in-travel/2025/videos/main-page/bit-landscape-1.mp4",
        "https://lonelyplanetstatic.imgix.net/marketing/best-in-travel/2025/videos/main-page/bit-landscape-2.mp4",
        "https://lonelyplanetstatic.imgix.net/marketing/best-in-travel/2025/videos/main-page/bit-landscape-3.mp4",
        "https://lonelyplanetstatic.imgix.net/marketing/best-in-travel/2025/videos/main-page/bit-landscape-4.mp4",
        "https://lonelyplanetstatic.imgix.net/marketing/best-in-travel/2025/videos/main-page/bit-landscape-5.mp4",
        "https://lonelyplanetstatic.imgix.net/marketing/best-in-travel/2025/videos/main-page/bit-landscape-6.mp4",
        "https://lonelyplanetstatic.imgix.net/marketing/best-in-travel/2025/videos/main-page/bit-landscape-7.mp4"
      ];

      let currentIndex = 0;
      const videoElement = document.getElementById("bg-video");

      function changeVideo() {
        // Change to the next video in the list
        currentIndex = (currentIndex + 1) % videoList.length;
        videoElement.src = videoList[currentIndex];

        // Reload and play the new video
        videoElement.load();
        videoElement.play();
      }

      // Change video when the current one ends
      videoElement.addEventListener("ended", changeVideo);

      // Change video on page reload
      window.onload = function () {
        currentIndex = Math.floor(Math.random() * videoList.length); // Random video on load
        videoElement.src = videoList[currentIndex];
        videoElement.load();
        videoElement.play();
      };
    </script>


<div class="banner-text-item">
  <div class="banner-heading">
    <h3>Enjoy Your Vacation With Us</h3>
  </div>
  <!-- <form class="form" onsubmit="return false;">
    <input type="text" id="location" placeholder="Enter a city or use current location">
    <button type="button" onclick="fetchLocation()" class="book">Use Current Location</button>
    <button type="button" onclick="searchLocation()" class="book">Search</button>
  </form>

  <div id="results">
    <div id="placeholder-message">🔍 No data searched yet.</div>
  </div> -->
</div>

<script>
  function fetchLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;
        getPlaces(latitude, longitude);
      }, function(error) {
        alert("Error fetching location: " + error.message);
      });
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  }

  function getPlaces(lat, lon) {
    let placeholder = document.getElementById("placeholder-message");
    if (placeholder) placeholder.style.display = "none";

    $.get("search.php", { latitude: lat, longitude: lon }, function(response) {
      document.getElementById("results").innerHTML = response;
    });
  }

  function searchLocation() {
    let city = document.getElementById("location").value.trim();
    if (city === "") {
      alert("Please enter a location");
      return;
    }

    let placeholder = document.getElementById("placeholder-message");
    if (placeholder) placeholder.style.display = "none";

    $.get("search.php", { city: city }, function(response) {
      document.getElementById("results").innerHTML = response;
    });
  }
</script>

  </section>
  <!--************************************************** Destinations---------------------------- -->
  <!--************************************************** Destinations---------------------------- -->
<section class="gallery-sec sec-pad" id="sect-02">
  <div class="container">
    <div class="section-ajeet-title text-center">&nbsp;&nbsp;&nbsp; Featured Destinations</div>

    <div id="gf-BtnContainer" class="filter">
      <button class="gf-btn gf-btn-active" onclick="filterSelection('bollywood')">Jaipur, Rajasthan</button>
      <button class="gf-btn" onclick="filterSelection('hollywood')">Varanasi, Uttar Pradesh</button>
      <button class="gf-btn" onclick="filterSelection('tv')">Munnar, Kerala</button>
    </div>

    <div class="gallery sets">

      <!-- Jaipur Images -->
      <div class="gf-column bollywood">
        <img src="https://images.unsplash.com/photo-1602643163983-ed0babc39797?q=80&w=1530&auto=format&fit=crop" />
      </div>
      <div class="gf-column bollywood">
        <img src="https://images.unsplash.com/photo-1667849357658-16bfaec30885?q=80&w=1374&auto=format&fit=crop" />
      </div>
      <div class="gf-column bollywood">
        <img src="https://images.unsplash.com/photo-1691402446495-57586ae3e7c1?q=80&w=1374&auto=format&fit=crop" />
      </div>
      <div class="gf-column bollywood">
        <img src="https://images.unsplash.com/photo-1599661046289-e31897846e41?q=80&w=1527&auto=format&fit=crop" />
      </div>
      <div class="gf-column bollywood">
        <img src="https://images.unsplash.com/photo-1603624964019-b36d39f89964?q=80&w=1528&auto=format&fit=crop" />
      </div>

      <!-- Varanasi Images -->
      <div class="gf-column hollywood">
        <img src="https://images.unsplash.com/photo-1616787671779-eed71117a65e?q=80&w=1374&auto=format&fit=crop" />
      </div>
      <div class="gf-column hollywood">
        <img src="https://plus.unsplash.com/premium_photo-1697729634472-bb82561ef296?q=80&w=1374&auto=format&fit=crop" />
      </div>
      <div class="gf-column hollywood">
        <img src="https://images.unsplash.com/photo-1662376107358-21296a9234f1?q=80&w=1526&auto=format&fit=crop" />
      </div>

      <!-- Munnar Images -->
      <div class="gf-column tv">
        <img src="https://images.unsplash.com/photo-1717764020096-b9b1abe7fe89?q=80&w=1374&auto=format&fit=crop" />
      </div>
      <div class="gf-column tv">
        <img src="https://images.unsplash.com/photo-1684574409329-d8e82157ee85?q=80&w=1378&auto=format&fit=crop" />
      </div>

      <!-- HIDDEN IMAGES -->
      <div class="gf-column bollywood hidden-img">
        <img src="https://t3.ftcdn.net/jpg/02/56/53/38/240_F_256533834_Chxhh4CkOk6YVnvAKGPSN3jc40rSTFaV.jpg" />
      </div>
      <div class="gf-column bollywood hidden-img">
        <img src="https://t4.ftcdn.net/jpg/05/28/58/53/240_F_528585313_ePj7WnYtyl6tNO6xqspWvKvLfz8hgi12.jpg" />
      </div>
      <div class="gf-column hollywood hidden-img">
        <img src="https://t3.ftcdn.net/jpg/04/51/24/54/240_F_451245409_gw0WHhwnYS8GSX13UUvxHHEbCek0MNQR.jpg" />
      </div>
      <div class="gf-column tv hidden-img">
        <img src="https://t3.ftcdn.net/jpg/10/78/60/72/240_F_1078607255_eYNboN33k223H6YxZzq8t2fOPSCsG2nQ.jpg" />
      </div>

    </div>

    <div class="all-btn">
      <a href="#" id="showMoreImages">MORE IMAGES</a>
    </div>
  </div>

  <style>
    .hidden-img {
      display: none;
    }
  </style>

  <script>
    filterSelection("bollywood");

    function filterSelection(c) {
      var x, i;
      x = document.getElementsByClassName("gf-column");
      if (c == "all") c = "";
      for (i = 0; i < x.length; i++) {
        w3RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
      }
    }

    function w3AddClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      arr2 = name.split(" ");
      for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {
          element.className += " " + arr2[i];
        }
      }
    }

    function w3RemoveClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      arr2 = name.split(" ");
      for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
          arr1.splice(arr1.indexOf(arr2[i]), 1);
        }
      }
      element.className = arr1.join(" ");
    }

    var btnContainer = document.getElementById("gf-BtnContainer");
    var btns = btnContainer.getElementsByClassName("gf-btn");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("gf-btn-active");
        current[0].className = current[0].className.replace(" gf-btn-active", "");
        this.className += " gf-btn-active";
      });
    }

    // Click to enlarge image
    let imgs = document.querySelectorAll("img");
    let count;
    imgs.forEach((img, index) => {
      img.addEventListener("click", function (e) {
        if (e.target == this) {
          count = index;
          let openDiv = document.createElement("div");
          let imgPreview = document.createElement("img");
          let butonsSection = document.createElement("div");
          butonsSection.classList.add("butonsSection");
          let closeBtn = document.createElement("button");

          closeBtn.classList.add("closeBtn");
          closeBtn.innerText = "Close";
          closeBtn.addEventListener("click", function () {
            openDiv.remove();
          });

          imgPreview.classList.add("imgPreview");
          imgPreview.src = this.src;

          openDiv.append(imgPreview, butonsSection, closeBtn);
          openDiv.classList.add("openDiv");
          document.querySelector("body").append(openDiv);
        }
      });
    });

    // Show hidden images on "More Images" click
    document.getElementById("showMoreImages").addEventListener("click", function (e) {
      e.preventDefault();
      let hiddenImgs = document.querySelectorAll(".hidden-img");
      hiddenImgs.forEach((el) => {
        el.style.display = "block";
        el.classList.remove("hidden-img");
      });
      this.style.display = "none";
    });
  </script>
</section>
  <section class="sect-03" id="sect-03">
  <!--************************************************** Planning---------------------------- -->
  <div class="container01">
   <center> <h2>☁️ India Weather Analyzer & Tourist Suggestions</h2></center><br><br>
  <div id="status">🔍 Detecting your location and weather...</div>
<br><br><br>
  <div class="buttons">
    <button onclick="showPlaces('clear')">☀️ Clear</button>
    <button onclick="showPlaces('clouds')">🌤 Clouds</button>
    <button onclick="showPlaces('overcast')">☁️ Overcast</button>
    <button onclick="showPlaces('rain')">🌧 Rain</button>
  </div>
  <br><br><br>
  <div id="result"></div>

  <script>
    const apiKey = '80a7bcf4e65b5819546418180ae69e7b';

    const touristPlaces = {
      clear: [
        { name: 'Goa', img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/BeachFun.jpg/1280px-BeachFun.jpg' },
        { name: 'Jaipur', img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/East_facade_Hawa_Mahal_Jaipur_from_ground_level_%28July_2022%29_-_img_01.jpg/800px-East_facade_Hawa_Mahal_Jaipur_from_ground_level_%28July_2022%29_-_img_01.jpg' },
        { name: 'Rishikesh', img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Ghats_on_the_Ganges_near_Parmarth_Niketan%2C_Muni_Ki_Reti%2C_Rishikesh.jpg/800px-Ghats_on_the_Ganges_near_Parmarth_Niketan%2C_Muni_Ki_Reti%2C_Rishikesh.jpg' }
      ],
      clouds: [
        { name: 'Darjeeling', img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/DarjeelingTrainFruitshop_%282%29.jpg/250px-DarjeelingTrainFruitshop_%282%29.jpg' },
        { name: 'Manali', img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Manali_City.jpg/1024px-Manali_City.jpg' },
        { name: 'Ooty', img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/Government_Botanical_Garden_Ooty_India.jpg/1280px-Government_Botanical_Garden_Ooty_India.jpg' }
      ],
      overcast: [
        { name: 'Udaipur', img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Evening_view%2C_City_Palace%2C_Udaipur.jpg/330px-Evening_view%2C_City_Palace%2C_Udaipur.jpg' },
        { name: 'Pondicherry', img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8c/Pondicherry-Rock_beach_aerial_view.jpg/330px-Pondicherry-Rock_beach_aerial_view.jpg' },
        { name: 'Shillong', img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Mary_Help_of_Christians_Cathedral%2C_Shillong_%E2%80%93_Front_Side_%282%29.jpg/800px-Mary_Help_of_Christians_Cathedral%2C_Shillong_%E2%80%93_Front_Side_%282%29.jpg' }
      ],
      rain: [
        { name: 'National Museum, Delhi', img: 'https://delhitourism.travel/images/places-to-visit/headers/national-museum-of-india-delhi-tourism-entry-fee-timings-holidays-reviews-header.jpg' },
        { name: 'Salar Jung Museum, Hyderabad', img: 'https://upload.wikimedia.org/wikipedia/commons/a/ac/Salar_Jung_Museum%2C_Hyderabad%2C_India.jpg' },
        { name: 'Indian Museum, Kolkata', img: 'https://kolkatatourism.travel/images/places-to-visit/headers/indian-museum-kolkata-entry-fee-timings-holidays-reviews-header.jpg' }
      ]
    };

    function showPlaces(type) {
      const places = touristPlaces[type];
      document.getElementById('result').innerHTML = `
        <h3>📍 Suggested Places for "${type.charAt(0).toUpperCase() + type.slice(1)}" Weather:</h3><br><br><br>
        ${places.map(place => `
          <div class="place">
            <img src="${place.img}" alt="${place.name}" />
            <div><strong>${place.name}</strong></div>
          </div>
        `).join('')}
      `;
    }

    function autoDetectWeather(lat, lon) {
      fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`)
        .then(res => res.json())
        .then(data => {
          const desc = data.weather[0].description.toLowerCase();
          document.getElementById('status').innerText = `📍 Location: ${data.name}, Weather: ${desc}`;
          let type = 'clear';
          if (desc.includes('cloud')) type = 'clouds';
          if (desc.includes('overcast')) type = 'overcast';
          if (desc.includes('rain') || desc.includes('storm')) type = 'rain';
          showPlaces(type);
        })
        .catch(() => {
          document.getElementById('status').innerText = '⚠️ Failed to fetch weather.';
        });
    }

    // Auto-detect location
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (pos) => autoDetectWeather(pos.coords.latitude, pos.coords.longitude),
        () => {
          document.getElementById('status').innerText = '❌ Location access denied.';
        }
      );
    } else {
      document.getElementById('status').innerText = '❌ Geolocation not supported.';
    }
  </script>
</div>
  </section>
  <!-- inspiration Design section  -->
  <section class="sect-04" id="sect-04">
    <h1>Inspiration</h1>
    <div class="cards">
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
        <img
          src="https://media.istockphoto.com/id/458976705/photo/streaming-to-the-gateway-of-india.jpg?s=612x612&w=0&k=20&c=nvBMR5ME-YR-LVa2_irNvJaRi9xsl4yzQTYamAZr0rs=">
        <h2>Gateway Of India Mumbai</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="https://media.istockphoto.com/id/2150121586/photo/tourists-on-the-busy-streets-of-galle-fort-in-the-evening-time.jpg?s=612x612&w=0&k=20&c=DJs7X_o7StaQloFV4yrYg_qSrQw5FdWgNIVtXzdak1I="
          alt="cookie">
        <h2>Food Fair Experience</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="https://media.istockphoto.com/id/2019888611/photo/wild-bengal-tiger-standing-surrounded-by-safari-vehicles-gypsy-crossing-forest-track-excited.jpg?s=612x612&w=0&k=20&c=zm-wumuXUNvI8ecEs6POAhooKOEaMJedTUdkRk4veZU="
          alt="cookie">
        <h2>Ranthambore National Park </h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="https://media.istockphoto.com/id/866758116/photo/people-visiting-the-magnificent-taj-mahal-in-agra.jpg?s=612x612&w=0&k=20&c=MoVt_VS1cD6ecoPosfidzkJ1WqhoPmf_Tv-Uc_RmrDQ="
          alt="ice cream cookie">
        <h2>Taj Mahal</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="https://media.istockphoto.com/id/2170156677/photo/crowd-in-front-of-jama-masjid.jpg?s=612x612&w=0&k=20&c=6emhG0-EXpjbE-Y5K4D_q_jkcbzX1olf3ekEuQOzxpM="
          alt="christmas cookie">
        <h2>Jama Masjid</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="https://images.unsplash.com/photo-1517427677506-ade074eb1432?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
          alt="cookie lotus">
        <h2>Sri Harmandir Sahib</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="https://images.unsplash.com/photo-1529733772151-bab41484710a?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
          alt="sesame cookie">
        <h2>Hoysaleswara Temple</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="http://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Sarayu_River_night_view%2C_Ayodhya_001.jpg/1280px-Sarayu_River_night_view%2C_Ayodhya_001.jpg"
          alt="lime cookie">
        <h2>Ayodhya</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/5_Nubra_valley.jpg/1024px-5_Nubra_valley.jpg"
          alt="coco cookie">
        <h2>Nubra Valley </h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
        <img
          src="https://encrypted-tbn1.gstatic.com/licensed-image?q=tbn:ANd9GcQEDIB8goW-7CpdgUp4mCC4nmB6Q2NzHGjq8Kso8IyMo03VMoPZATY8k59tk6VqxAnYguXLHyEaUFmnm3XCJfUJfXVIFctT88ejPp_mi24"
          alt="cookie">
        <h2>Mumbai(Maharashtra)</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="https://encrypted-tbn2.gstatic.com/licensed-image?q=tbn:ANd9GcQdUyODGtvDQj2oMTfyu2L12z8J9QBrCjpTbRY8j63ycBJ3Un2QLMQ7o6lU2zMOknO5jv7XAq4sM1MzzVDjFLc-7r2wA__W0Io6OCWdbg"
          alt="cookie">
        <h2>Vidhana Soudha</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img src="https://lh5.googleusercontent.com/p/AF1QipP7T0K5o_CjbEpMdWeep_6jjKrLcnWGv5Q3g9rB=w540-h312-n-k-no"
          alt="cookie">
        <h2>Nahargarh Fort</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img src="https://lh5.googleusercontent.com/p/AF1QipMHvkB151icA3Pa0YFWpakcpCv_LplFa1gorz6j=w540-h312-n-k-no"
          alt="ice cream cookie">
        <h2>Victoria Memorial</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="https://lh3.googleusercontent.com/gps-cs-s/AB5caB98yJAcDc8i1ZHD4mZx2B4z3UZZVEYubWRikvpDyCto-LtGWkL_d_WG1wtnBjTAeG4hcpnequHHtGJPU14OC9a-yoF_1eJWZDeZdENLxhHW3ETttdaaA2sOMBoRsu_-VzjmQOvG=w540-h312-n-k-no"
          alt="christmas cookie">
        <h2>Palolem Beach</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Tawang_Gate.jpg/800px-Tawang_Gate.jpg"
          alt="cookie lotus">
        <h2>Sela Pass
        </h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="https://hblimg.mmtcdn.com/content/hubble/img/delhi/mmt/activities/m_activities_delhi_red_fort_l_341_817.jpg"
          alt="sesame cookie">
        <h2>Red Fort</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="https://hblimg.mmtcdn.com/content/hubble/img/delhi/mmt/activities/m_activities_delhi_humayun_s_tomb_l_435_653.jpg"
          alt="lime cookie">
        <h2>Humayun’s Tomb</h2>
      </div>
      <div class="card">
        <div class="like-container">
          <i class="fa-solid fa-heart"></i> <span>1034k</span>
        </div>
  
        <img
          src="https://hblimg.mmtcdn.com/content/hubble/img/vadodara/mmt/activities/m_activities_vadodara_statue_of_unity_l_405_810.jpg"
          alt="coco cookie">
        <h2>Statue Of Unity</h2>
      </div>
    </div>
  </section>
  <!-- Desgin footer -->
   <section class="">
    
   </section>
  <script src="index.js"></script>
</body>

</html>