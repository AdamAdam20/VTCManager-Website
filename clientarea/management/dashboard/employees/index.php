<?php
//aktuelle Seite für Nav und Sidebar
$page_now = "management/dashboard";
$page_now_navbar = "management/dashboard/employees";
//Connect and Check
include '../../../../basis_files/php/get_user_data.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="/clientarea/management/img/favicon.png" type="image/x-icon">
  <link rel="apple-touch-icon" href="/clientarea/management/img/apple-icon.png">
  <title>VTCMInterface</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="/clientarea/management/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="/clientarea/management/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="/clientarea/management/css/style.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script>$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});</script>
  <script>
function delete_entry(elmnt) {
	var save_val = $(elmnt).attr("data-id");
	var res = save_val.split(",");
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
    if(xmlhttp.response=="OK"){
      document.getElementById(save_val).style.display="none";
      }
	};
	xmlhttp.open("POST", "delete_entry.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("tour_id="+res[1]+"&username="+res[0]);
}
</script>
  <style>.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(/clientarea/management/img/loader.gif) center no-repeat white;
}
.tour_url:hover {
color: #007bff;
}
</style>
<style>
	    .profilePicture {
    height: auto;
    border-radius: 50%;
	height: 30px;
	width: 30px;
	object-fit: contain;
}
	  </style>

<body class="grey lighten-3">
  <div class="se-pre-con"></div>

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <?php
    include '../../php/navbar.php';?>
    <!-- Navbar -->

    <!-- Sidebar -->
    <?php
    include '../../php/sidebar.php';?>
    <!-- Sidebar -->

  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <?php //Lade Tour Prüfungs Fenster nur wenn User Berechtigung zum Bearbeiten des Logbuches hat
  if($EditLogbook == "1") { ?>
  <div class="modal fade" id="viewemployee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold" id="TourCheckTitle">Daten werden abgerufen...</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3" style="display:none;" id="TourCheckContent">
        <div class="md-form mb-5">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#general" role="tab" aria-controls="Allgemein"
      aria-selected="true">Allgemein</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="Abrechnung"
      aria-selected="false">Abrechnung</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#truck_sec" role="tab" aria-controls="LKW"
      aria-selected="false">LKW</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="home-tab">
    <span id="departure">Name:</span><br>
    <span id="destination">Alter:</span><br>
    <span id="distance">Posten:</span><br>
    <span id="cargo">erfolgreiche Touren:</span><br>
    <span id="weight">Einnahmen durch Fahrer:</span><br>
  </div>
<div class="tab-pane fade" id="truck_sec" role="tabpanel" aria-labelledby="profile-tab">
      <img src="" id="truck_pic" class="rounded float-right" style="max-height:250px;" alt="">
    <span id="truck_name">LKW:</span><br>
    <span id="truck_performance">Motorleistung:</span><br>
    <span id="truck_engine">Motor:</span><br>
    <span id="truck_engine_manu">Motorhersteller:</span><br>
    <span id="truck_emission_standard">Emissionsstandard:</span><br>
  </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
      </div>
    </div>
  </div>
</div>
</div>
</div>
</head>
<script>
function load_employee(elmnt) {
	var save_val = $(elmnt).attr("data-id");
    //get Truck Info
    var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
    console.log(xmlhttp.response);
    var response = this.responseText;
    var myObj = JSON.parse(response);
    if(myObj != "") {
    user_count = myObj.length;
    }
    document.getElementById("truck_name").innerHTML="LKW: "+myObj[0]["manufacturer"]+" "+myObj[0]["model"];
	};
	xmlhttp.open("POST", "get_employee_info.php?manufacturer="+myObj[0]["truck_manufacturer"]+"&model="+myObj[0]["truck_model"], true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("userID="+save_val);
  document.getElementById("TourCheckContent").style.display="block";
}
</script>
<?php }?>
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!-- Heading -->
      <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="dashboard">Dashboard</a>
            <span>/</span>
            <span>Mitarbeiter</span>
          </h4>

        </div>

      </div>
      <!-- Heading -->

          <!--Card-->
          <div class="card mb-4">

            <!--Card content-->
            <div class="card-body">

              <div class="card-header text-center">
                Mitarbeiter von <?php echo $user_company_name; ?>
              </div>
              <!-- List group links -->
              <div class="list-group list-group-flush">
                <div class="vertical-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <td>Mitarbeiter</td>
                        <td>Posten</td>
                        <td>angestellt seit</td>
                        <td>erfolgreiche Touren</td>
						<td></td>
                    </tr>
                </thead>
				<tbody>
					<?php include 'load_data.php'; //Lade Aufträge?>                  
                </tbody>
            </table>
        </div>
              </div>
              <!-- List group links -->

            </div>

          </div>
          <!--/.Card-->

    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <?php
    include '../../php/footer.php';?>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="/clientarea/management/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="/clientarea/management/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="/clientarea/management/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="/clientarea/management/js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>
</body>

</html>
