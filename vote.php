<?php
  require_once('connection.php');

  session_start();
  
  if(empty($_SESSION['member_id'])){
    header("location:access-denied.php");
  }
?>

<?php
    
    $positions= mysqli_query($con,"SELECT * FROM tbpositions")
    or die("There are no records to display ... \n" . mysqli_error($con)); 
    $result = mysqli_query($con,"SELECT * FROM tbcandidates")
  ?>
  <?php
    
     if (isset($_POST['submit']))
     {
       
       $position = $_POST['Programming'];

       $sql1 = "SELECT * FROM tbcandidates WHERE candidate_id=$position";
        $result1 = mysqli_query($con, $sql1);
        $vote = 0;
        while($rows = mysqli_fetch_assoc($result1)) {
          $votes = $rows['candidate_cvotes'];
          $count= $votes+1;
        }

       $sql2 = "UPDATE tbcandidates SET candidate_cvotes=$count WHERE candidate_id=$position";
        mysqli_query($con, $sql2);

        echo"Added Successfully";

     }
     else{
      ?>


<!DOCTYPE html>

<html>
<head>
<title>online voting</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript" src="js/user.js">
</script>

</head>
<body id="top">

<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    <div id="logo" class="fl_left">
      <h1><a href="index.html">ONLINE VOTING</a></h1>
    </div>
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="voter.php">Home</a></li>
        <li><a class="drop" href="#">Voter Pages</a>
          <ul>
            <li><a href="vote.php">Vote</a></li>
            <li><a href="manage-profile.php">Manage my profile</a></li>
          </ul>
        </li>
        
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
</div>

<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/background1.jpg');">
  <section id="testimonials" class="hoc container clear"> 
    <h2 class="font-x3 uppercase btmspace-80 underlined"> Online <a href="#">Voting</a></h2>
    <form method="post">
    <?php while($row = $result->fetch_assoc()) {
        if($row['candidate_position'] == "Programming"){
    ?>

    <input type="radio" name="<?= $row['candidate_position'] ?>" value="<?= $row['candidate_id'] ?>"> <?= $row['candidate_name'] ?>

     <?php
  }
    }
    ?>
    <input type="submit" name="submit" style="color: black;">
  </form>
  </section>
</div>
<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <div class="one_third first">
      <h6 class="title">Address</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
         
          <p>
          Name        : Siddhartha Gautam <br>
          University  : GCES <br>
          Batch       : 2019 <br>
          Dept        : BE software <br>
          </p>
          </address>
        </li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Email</h6>
      <ul class="nospace linklist contact">
        
        <li><i class="fa fa-envelope-o"></i> siddharthagautam668@gmail.com </li>

      </ul>
    </div>

  </footer>
</div>

<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <p class="fl_left">Copyright &copy; 2017 - All Rights Reserved - <a href="#">Siddhartha Gautam</a></p>
  </div>
</div>
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->
</body>
</html>




    <?php
     }
  
?>
