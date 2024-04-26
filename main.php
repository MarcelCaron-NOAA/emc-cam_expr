<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Home</title>
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="main.css" rel="stylesheet" type="text/css" media="all" />
<link href="../../../../style/fonts.css" rel="stylesheet" type="text/css" media="all" />
<script src="https://d3js.org/d3.v4.min.js"></script>
</head>
<?php
$randomtoken = base64_encode( openssl_random_pseudo_bytes(32));
$_SESSION['csrfToken']=$randomtoken;
?>
<?php include "mainvars.php"; ?>

<body>
<div id="pageTitle">
NCEP/EMC <?php echo $type; ?> <?php echo $model; ?> Verification
</div>
<div id="pageContents">
<center>
<img src="https://www.emc.ncep.noaa.gov/users/verification/style/images/ncep_logo.gif" alt="" width="150" />
<br><br>This page displays verification statistics from the experimental <b>RRFS</b> compared with the following operational CAMs:
<br><br><b>(1) HRRR, (2) NAM Nest, (3) HiResW ARW, (4) HiResW ARW2, (5) HiResW FV3 and (6) HREF (Hi-Resolution Ensemble Forecast)  </b>
<br><br><a href="https://www.emc.ncep.noaa.gov/users/meg/rrfsv1/index.html" target="_blank">Click here</a> for additional details about the RRFSv1. 
<br><br><a href="https://www.emc.ncep.noaa.gov/users/meg/home/table.html" target="_blank">Click here</a> for additional details on each operational model's specific configuration. 
<br>
<br>
<br>
<b>Please use links on the left to navigate to verification statistics.</b> 
<br>
<br><br>Verification is done using the <a href="https://github.com/NOAA-EMC/EVS" target="_blank">EMC Verification System (EVS)</a>, which uses <a href="https://dtcenter.org/community-code/metplus" target="_blank">METplus</a>.
<br>
<br>
DISCLAIMER: This webpage is not "operational" and is not subject to 24-h monitoring by NCEP's Central Operations staff.
<br>
</center>
</div>
</body>
</html>
