<!DOCTYPE html
<html>
<head>
<meta charset="UTF-8">
<title>FireWx Nest Verification</title>
<link rel="stylesheet" type="text/css" href="https://www.emc.ncep.noaa.gov/users/verification/style/style_verif.css">
<script src="../../../../../style/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="functions_base.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<!-- Head element -->
<div class="page-top">
    <span><a style="color:#ffffff">FIREWXNEST GRID-TO-OBS: 2-M DEW-POINT</a></span>
</div>

<!-- Top menu -->
<div class="page-menu"><div class="table">
    <div class="element">
        <span class="bold" style="color:#FF0000">Select Plot Type and Metric: </span><span class="bold">Plot Type:</span>
        <select id="plottype" onchange="changePlotType(this.value);"></select>
	</div>
    <div class="element">
        <span class="bold">Metric:</span>
        <select id="metric" onchange="changeMetric(this.value);"></select>
    </div>
</div></div>
<!-- /Top menu -->

<!-- Middle menu -->
<div class="page-menu"><div class="table">
    <div class="element">
        <span class="bold" style="color:#FF0000">Select Date Range and Forecast: </span><span class="bold"> Date Range:</span>
        <select id="daterange" onchange="changeDateRange(this.value);"></select>
	</div>
    <div class="element">
        <span class="bold">Valid Hour:</span>
        <select id="validhour" onchange="changeValidHour(this.value);"></select>
	</div>
    <div class="element">
        <span class="bold">Forecast Hour:</span>
        <select id="forecasthour" onchange="changeForecastHour(this.value);"></select>
    </div>
</div></div>
<!-- Middle menu -->

<!-- Bottom menu -->
<div class="page-menu"><div class="table">
    <div class="element">
		<span class="bold" style="color:#FF0000">Select Region, Level, and Validation Data: </span><span class="bold">Region:</span>
        <select id="region" onchange="changeRegion(this.value);"></select>
    </div>   
    <div class="element">
        <span class="bold">Level:</span>
        <select id="level" onchange="changeLevel(this.value);"></select>
    </div> 
    <div class="element">
        <span class="bold">Validation Data:</span>
        <select id="obstype" onchange="changeObstype(this.value);"></select>
    </div>    
</div></div>
<!-- Bottom menu -->

<!-- Images -->
<div id="page-map">
<table id="tbl-map" style="margin:auto">
     <tbody>
       <tr>
        <td id ="td-map">
           <img name="map_image" src="../images/evs.nam_firewxnest.bcrmse_me.dpt_z2.last31days.vhrmean.firewx.png" style="width:100%">
        </td>
      </tr>
    </tbody>
</table>
</div>

<!-- /Footer -->
<div class="page-footer">
        <span></div>

<script type="text/javascript">
//====================================================================================================
//User-defined years
//====================================================================================================

var url1 = "https://www.emc.ncep.noaa.gov/users/verification/regional/cam/expr/firewx_nest/images/evs.nam_firewxnest.MMM.dpt_LLL.DDD.PPP.RRR.png";
var url2 = "https://www.emc.ncep.noaa.gov/users/verification/regional/cam/expr/firewx_nest/images/evs.nam_firewxnest.MMM.dpt_LLL.DDD.PPP.RRR.png";

// evs.rtofs.me.sst_z0_ghrsst.last60days.fhrmean_valid00z.natl.png

//====================================================================================================
//Add years & months
//====================================================================================================

var plottypes = [];
var metrics = [];
var levels = [];
var obstypes = [];
var dateranges = [];
var validhours = [];
var forecasthours = [];
var regions = [];





plottypes.push({
        displayName: "Valid Hour Mean",
        name: "vhrmean",
});

plottypes.push({
        displayName: "Forecast Hour Mean",
        name: "fhrmean",
});

plottypes.push({
        displayName: "Threshold Mean",
        name: "threshmean",
});


metrics.push({
        displayName: "Bias-corrected RMSE and Mean Error (Bias)",
        name: "bcrmse_me",
});

metrics.push({
        displayName: "Frequency Bias",
        name: "fbias",
});


dateranges.push({
        displayName: "Last 31 Days",
        name: "last31days",
});





validhours.push({
        displayName: "All",
        name: "all",
});




forecasthours.push({
        displayName: "00-36hr",
        name: "00-36hr",
});





regions.push({
        displayName: "Fire-wx domain",
        name: "firewx",
});




levels.push({
        displayName: "2 meters",
        name: "z2",
});







obstypes.push({
        displayName: "METARS",
        name: "truth",
});





timeseries_forecasthours = ["000", "024", "048", "072", "096", "120", "144", "168", "192"]
fhr_forecasthours = ["384"]
leaddate_forecasthours = ["240", "384"]
vhrmean_forecasthours = ["analysis"]
fhrmean_metrics = ["bcrmse_me"]
fhrmean_metrics_name = ["Bias-corrected RMSE and Mean Error (Bias)"]
vhrmean_metrics = ["bcrmse_me"]
vhrmean_metrics_name = ["Bias-corrected RMSE and Mean Error (Bias)"]
threshmean_metrics = ["fbias"]
threshmean_metrics_name = ["Frequency Bias"]
non_perfdiag_metrics = ["fbias"]
non_perfdiag_metrics_name = ["Frequency Bias"]
non_perfdiag_thresholds = ["z2"]
non_perfdiag_thresholds_name = ["2 meters"]

//====================================================================================================
//Initialize the page
//====================================================================================================

//function for keyboard controls
//document.onkeydown = keys;

//Decare object containing data about the currently displayed map
imageObj = {};

//Initialize the page
initialize();

//Initialize the page
function initialize(){
	
	//Set image object based on default years
	imageObj = {
        plottype: "vhrmean",
	metric: "bcrmse_me",
	obstype: "truth",
	level: "z2",
        daterange: "last31days",
	validhour: "all",
	forecasthour: "00-36",
	region: "firewx",        
        };


    //Change plot type based on passed argument, if any
        var passed_plottype = "";
        if(passed_plottype!=""){
                if(searchByName(passed_plottype,plottypes)>=0){
                        imageObj.plottype = passed_plottype;
                }
	}

	//Change metric based on passed argument, if any
        var passed_metric = "";
        if(passed_metric!=""){
                if(searchByName(passed_metric,metrics)>=0){
                        imageObj.metrics = passed_metric;
                }
	}

	//Change date range based on passed argument, if any
        var passed_daterange = "";
        if(passed_daterange!=""){
                if(searchByName(passed_daterange,dateranges)>=0){
                        imageObj.daterange = passed_daterange;
                }
	}

	//Change valid hour based on passed argument, if any
        var passed_validhour = "";
        if(passed_validhour!=""){
                if(searchByName(passed_validhour,validhours)>=0){
                        imageObj.validhour = passed_validhour;
                }
	}

	//Change forecast hour based on passed argument, if any
        var passed_forecasthour = "";
        if(passed_forecasthour!=""){
                if(searchByName(passed_forecasthour,forecasthours)>=0){
                        imageObj.forecasthour = passed_forecasthour;
                }
	}

	//Change region based on passed argument, if any
        var passed_region = "";
        if(passed_region!=""){
                if(searchByName(passed_region,regions)>=0){
                        imageObj.region = passed_region;
                }
        }
        
	//Change obstype based on passed argument, if any
        var passed_obstype = "";
        if(passed_obstype!=""){
                if(searchByName(passed_obstype,obstypes)>=0){
                        imageObj.obstype = passed_obstype;
                }
        }
        
	//Populate forecast hour and dprog/dt arrays for this run and frame
	populateMenu('plottype');
	populateMenu('metric');
        populateMenu('level');
    	populateMenu('obstype');
	populateMenu('daterange');
	populateMenu('validhour');
	populateMenu('forecasthour');
	populateMenu('region');

	changePlotType("vhrmean");
	changeForecastHour("analysis");
	changeMetric("bcrmse_me");
        changeObstype("truth");
    
	//Preload images and display map
	preload(imageObj);
	showImage();
	
	//Update mobile display for swiping
	updateMobile();

}

var xInit = null;                                                        
var yInit = null;                  
var xPos = null;
var yPos = null;


</script>
</body></html>
