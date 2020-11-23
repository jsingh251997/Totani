<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='../../lib/main.css' rel='stylesheet' />
<script src='../../lib/main.js'></script>
<script src='../../node_modules/moment/moment.js'></script>
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<!-- JS, Popper.js, and jQuery -->

<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<?php
    session_start();
    if(isset($_POST['test']) ){
      echo("INSIDE POST ID");
      $output = array();
      $id = $_POST['test'];
      echo("<br>");
      echo($id);
      $_SESSION["id"] = $id;
    }
    if ( isset( $_POST['btn_submit'] ) ) {
      $ida = $_SESSION["id"];
      $secUpdate = $_POST['Section'];
      $probUpdate = $_POST['Problem'];
      $causUpdate = $_POST['Cause'];
      $solUpdate = $_POST['Solution'];
      $conn = mysqli_connect("localhost","root","","totani_alerts");
      $sql = "Update posts SET Section ='$secUpdate',Problem='$probUpdate',Cause='$causUpdate',
      Solution='$solUpdate' Where id = '$ida'";
      echo($sql);
      $result = $conn-> query($sql);
    }
    ?>

<script>
  var test;
  var today = moment().day();
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        right: 'daygridview',
        center: 'title',
        left: 'prev,next today'
      },
    initialView: 'timeGridDay',
    firstDay: today,
    navLinks: true, // can click day/week names to navigate views
    selectable: true,
    selectMirror: true,
    eventClick: function (info) {
        //set the values and open the modal
            $('#modalTitle').html(info.event.title);
            $('#modalBody').html(info.event.description);
            $('#calendarModal').modal();
            var eventObj = info.event;
            id = eventObj.id;
            test = id;
            console.log("ID IS "+id);
            console.log("TEST IS "+test);
            $.ajax({
              url:"web.php",
              type:"POST",
              data:{'test':test},
              success: function(response){
                console.log('raw data posted is:'+id);
              }
            });
    },
    events:'insert.php',
    });
    calendar.render();

  });
</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }

</style>
</head>
<body>
  <div id="result"></div>
  <div id='calendar'></div>

  <form method="POST" name="search" action="web.php">
        <div class="modal" id="calendarModal" style="width:35%; height:50%; top:5%; left:35%">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Section:</span>
                        </div>
                        <select name="Section" id="Sect">
                        <option selected="Section" value="PartA">PartA</option>
                        <option selected="Section" value="PartB">PartB</option>
                        <option selected="Section" value="PartC">PartC</option>
                        <option selected="Section" value="PartD">PartD</option>
                        <label Section="Solution">Solution</label>
                        </select>
                        <p id="modalBody" class="modal-Desc"></p>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Problem:</span>
                        </div>
                        <select name="Problem" id="Prob">
                        <option selected="Problem" value="Operator Error">Slow Production</option>
                        <option selected="Problem" value="Machine Breakdown">Machine Breakdown</option>
                        <label for="Problem">Problem</label>
                        </select>
                        <p id="modalBody" class="modal-Desc"></p>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Cause:</span>
                        </div>
                        <select name="Cause" id="Cau">
                        <option selected="Cause" value="JAM">JAM</option>
                        <option selected="Cause" value="Operator Error">Operator Error</option>
                        <label for="Cause">Cause</label>
                        </select>
                        <p id="modalBody" class="modal-Desc"></p>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Solution:</span>
                        </div>
                        <select name="Solution" id="Sol">
                        <option selected="Solution" value="Slow Production">Slow Production</option>
                        <option selected="Solution" value="Restart Machine">Restart Machine</option>
                        <label for="Solution">Solution</label>
                        </select>
                        <p id="modalBody" class="modal-Desc"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_submit" class="btn btn-secondary">Submit</button>
                </div>
            </div>
        </div>
      <!-- {{csrf_field()}} -->
    </form>
</body>
</html>