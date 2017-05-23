
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script src="jquery.js"></script>
    <script>
    $(function(){
      $("#CountryList").load("views/users/countryList.html");
    });
    </script>

    <style>
      .tooltip-inner {
        max-width: 180px;
        width: 180px;
      }
    </style>

    <title>SnapComp - Registration</title>

  </head>
  <body>
<?php isset($_SESSION["reg"]) echo $_SESSION["reg"]; ?>

    <div class="container">
      <div class="panel-title text-center">
          <h1><font face="Segoe UI" size="30px">SnapComp</font></h1>
          <p>*slogan*</p>
      </div>
      <hr>

        <p style="margin:auto; width:650px;">
          <font size="5px">
            Registration form -
          </font>
          <font color="#4f62c6" size="2px"><i><u>Note</u>: Fields marked with an asterisk (*) are required.</i></font>
        </p>
        <br>

        <form method="POST"  action="?controller=users&action=register" class="form-horizontal" style="margin:auto; width:650px;">
          <div class="form-group">
            <label class="control-label col-sm-2" for="regUsername">*Username: </label>
            <div class="col-sm-10">
              <input required="true" type="text" class="form-control" id="regUsername" placeholder="Enter username" data-toggle="tooltip" data-placement="right" title="This is your display name. It can be changed any time.">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="regAccountName">*Acc. Name: </label>
            <div class="col-sm-10">
              <input required="true" type="text" class="form-control" id="regAccountName" placeholder="Enter account name" data-toggle="tooltip" data-placement="right" title="This is your login name. It cannot be changed.">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="regPassword">*Password:</label>
            <div class="col-sm-10">
              <input required="true" type="password" class="form-control" id="regPassword" placeholder="Enter password">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="regConfirmPassword">*Confirm:</label>
            <div class="col-sm-10">
              <input required="true" type="password" class="form-control" id="regConfirmPassword" placeholder="Enter password again">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="regEmail">*Email:</label>
            <div class="col-sm-10">
              <input required="true" type="email" class="form-control" id="regEmail" placeholder="Enter email">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="regFirstName">First Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="regFirstName" placeholder="Enter first name">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="regLastName">Last Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="regLastName" placeholder="Enter last name">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="regCountry">Country:</label>
            <div id="CountryList" class="col-sm-10">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="regBirthDate">*Birth Date:</label>
            <div class="col-sm-10">
              <input required="true" style="width:160px" type="date" class="form-control" id="regBirthDate">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="regLanguage">Language:</label>
            <div class="col-sm-10">
              <label class="radio-inline"><input type="radio" name="optradio1">English</label>
              <label class="radio-inline"><input type="radio" name="optradio1">Slovenski</label>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="regGender">Gender:</label>
            <div class="col-sm-10">
              <label class="radio-inline"><input type="radio" name="optradio2">Male</label>
              <label class="radio-inline"><input type="radio" name="optradio2">Female</label>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <a href="login.php"><u>Already have an account? Click here to log in.</u></a>
            </div>
          </div>
        </form>

      </div>
    </div>
  </body>
