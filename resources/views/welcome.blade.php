
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="logo-apple"></ion-icon>
                        </span>
                        <span class="title">Brand Name</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('subject.index') }}">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">ادارة المواد</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('school.index') }}">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">عرض المدارس</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('school.create') }}">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">لاضافة مدرسة</span>
                    </a>
                </li>
            
      
          @isAdmin
                <li>
                    <a href="{{ route('users.index') }}">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">أدارة المستخدمين</span>
                    </a>
                </li>
  @endisAdmin
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        @guest
              @if (Route::has('login'))
              <li class="link"><a href="{{ route('users.index') }}" class="link" id="about-page">Login</a></li>
              @endif
          @else
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
            @csrf
        </form>
              <select name="" id="" style="height: 50%; font-size:1.2rem;" onchange="event.preventDefault();
              document.getElementById('logout-form').submit();">>

                <option value="" selected disabled>{{ Auth::user()->name }}</option>
                <option value="">
                   {{ __('تسجيل الخروج') }}
               </a>

              </option>
              </select>
              
          @endguest
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">{{ \App\Models\Student::count() }} </div>
                        <div class="cardName">عدد الطلاب المستفيدين</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{ \App\Models\Teacher::count() }} </div>
                        <div class="cardName">عدد المعلمين</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{ \App\Models\School::count() }}</div>
                        <div class="cardName">عدد المدارس</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{ \App\Models\SchoolClass::count() }}</div>
                        <div class="cardName">عدد الصفوف</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Add Charts JS ================= -->
            <div class="chartsBx">
                <div class="chart"> <canvas id="chart-1"></canvas> </div>
                <div class="chart"> <canvas id="chart-2"></canvas> </div>
            </div>

            <!-- ================ Order Details List ================= -->
   
     
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ======= Charts JS ====== -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="assets/js/chartsJS.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<script>


// مخطط البيانات
const ctx1 = document.getElementById("chart-1").getContext("2d");
const myChart = new Chart(ctx1, {
  type: "polarArea",
  data: {
    labels: ["المدارس", "المعلمين", "الطلاب","الصفوف"],
    datasets: [
      {

    

        label: "# of Votes",
        data: [{{ \App\Models\School::count() }} ,{{ \App\Models\Teacher::count() }} ,{{ \App\Models\Student::count() }} ,{{ \App\Models\SchoolClass::count() }}],

        backgroundColor: [
          "rgba(54, 162, 235, 1)",
          "rgba(255, 99, 132, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(235, 156, 40, 1)",

        ],
      },
    ],
  },
  options: {
    responsive: true,
  },
});

// 



const ctx2 = document.getElementById("chart-2").getContext("2d");
const myChart2 = new Chart(ctx2, {
  type: "bar",
  data: {
    labels: ["المدارس", "المعلمين", "الطلاب","الصفوف"],
    datasets: [
      {
        label: "Earning",
        data: [{{ \App\Models\School::count() }} ,{{ \App\Models\Teacher::count() }} ,{{ \App\Models\Student::count() }} ,{{ \App\Models\SchoolClass::count() }}],
        backgroundColor: [
          "rgba(54, 162, 235, 1)",
          "rgba(255, 99, 132, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(235, 156, 40, 1)",

        ],
      },
    ],
  },
  options: {
    responsive: true,
  },
});



</script>