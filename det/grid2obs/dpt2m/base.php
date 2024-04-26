<!DOCTYPE html
<html>
<head>
<meta charset="UTF-8">
<title>CAM Verification - Parallel - G2O: 2-meter Dewpoint</title>
<link rel="stylesheet" type="text/css" href="../../../style_cam.css">
<script src="https://www.emc/ncep.noaa.gov/users/verification/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="functions_base.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>
<!-- Head element -->
<div class="page-top">
        <span><a style="color:#ffffff">GRID-TO-OBS: 2-METER DEWPOINT</a></span>
</div>
<!-- Head element -->

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
                <span class="bold">Init Hour:</span>
                <select id="inithour" onchange="changeInitHour(this.value);"></select>
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
		<span class="bold" style="color:#FF0000">Select Region and Threshold Information: </span><span class="bold">Region:</span>
                <select id="region" onchange="changeRegion(this.value);"></select>
	</div>
        <div class="element">
		<span class="bold">Threshold:</span>
                <select id="threshold" onchange="changeThreshold(this.value);"></select>
        </div>
</div></div>
<!-- Bottom menu -->

<!-- Images -->
<div id="page-map">
<table id="tbl-map" style="margin:auto">
	<tbody>
       	 <tr>
          <td id ="td-map">
           <img name="map_image" src="../latest/model_latest.gif" style="width:100%">
          </td>
      	 </tr>
    	</tbody>
</table>
</div>
<!-- Images -->

<!-- /Footer -->
<div class="page-footer">
	<span>
</div>
<!-- /Footer -->

<script type="text/javascript">
//====================================================================================================
//User-defined years
//====================================================================================================

var url = "https://www.emc.ncep.noaa.gov/users/verification/regional/cam/expr/det/grid2obs/images/evs.cam.MMMTTTdpt_z2.DDD.PPPHHHFFF.RRR.png";

//====================================================================================================
//Add years & months
//====================================================================================================

var plottypes = [];
var metrics = [];
var dateranges = [];
var inithours = [];
var forecasthours = [];
var regions = [];
var thresholds = [];

plottypes.push({
        displayName: "Forecast Hour Mean",
        name: "fhrmean",
});
plottypes.push({
        displayName: "Valid Hour Mean",
        name: "vhrmean",
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
dateranges.push({
        displayName: "Last 90 Days",
        name: "last90days",
});

inithours.push({
        displayName: "00Z",
        name: "_init00z",
});
inithours.push({
        displayName: "06Z",
        name: "_init06z",
});
inithours.push({
        displayName: "12Z",
        name: "_init12z",
});
inithours.push({
        displayName: "18Z",
        name: "_init18z",
});

forecasthours.push({
	displayName: "All",
	name: "",
});

regions.push({
        displayName: "CONUS",
        name: "buk_conus",
});
regions.push({
        displayName: "CONUS - East",
        name: "buk_conus_e",
});
regions.push({
        displayName: "CONUS - West",
        name: "buk_conus_w",
});
regions.push({
        displayName: "CONUS - South",
        name: "buk_conus_s",
});
regions.push({
        displayName: "CONUS - Central",
        name: "buk_conus_c",
});
regions.push({
        displayName: "Appalachia",
        name: "buk_apl",
});
regions.push({
        displayName: "Central Plains",
        name: "buk_cpl",
});
regions.push({
        displayName: "Deep South",
        name: "buk_ds",
});
regions.push({
        displayName: "Great Lakes",
        name: "buk_grlk",
});
regions.push({
        displayName: "Mid-Atlantic",
        name: "buk_matl",
});
regions.push({
        displayName: "Mezquital",
        name: "buk_mez",
});
regions.push({
        displayName: "Northeast/North Atlantic",
        name: "buk_ne",
});
regions.push({
        displayName: "Northern Plains",
        name: "buk_npl",
});
regions.push({
        displayName: "Northern Rockies",
        name: "buk_nrk",
});
regions.push({
        displayName: "Prairie",
        name: "buk_pra",
});
regions.push({
        displayName: "Pacific Southwest",
        name: "buk_psw",
});
regions.push({
        displayName: "Southeast",
        name: "buk_se",
});
regions.push({
        displayName: "Southern Plains",
        name: "buk_spl",
});
regions.push({
        displayName: "Southern Rockies",
        name: "buk_srk",
});

thresholds.push({
        displayName: "NA",
        name: ".",
});
thresholds.push({
        displayName: "≥ 40 F",
        name: "_obsge40.",
});
thresholds.push({
        displayName: "≥ 50 F",
        name: "_obsge50.",
});
thresholds.push({
        displayName: "≥ 60 F",
        name: "_obsge60.",
});
thresholds.push({
        displayName: "≥ 70 F",
        name: "_obsge70.",
});

fhrmean_metrics = ["bcrmse_me"]
fhrmean_metrics_name = ["Bias-corrected RMSE and Mean Error (Bias)"]
vhrmean_metrics = ["bcrmse_me"]
vhrmean_metrics_name = ["Bias-corrected RMSE and Mean Error (Bias)"]
threshmean_metrics = ["fbias"]
threshmean_metrics_name = ["Frequency Bias"]
vhrmean_inithours = [""]
vhrmean_inithours_name = ["All"]
non_vhrmean_inithours = ["_init00z", "_init06z", "_init12z", "_init18z"]
non_vhrmean_inithours_name = ["00Z", "06Z", "12Z", "18Z"]
vhrmean_regions = ["buk_conus", "buk_conus_e", "buk_conus_w", "buk_conus_s", "buk_conus_c", "alaska", "buk_apl", "buk_cpl", "buk_ds", "buk_grlk", "buk_matl", "buk_mez", "buk_ne", "buk_npl", "buk_nrk", "buk_pra", "buk_psw", "buk_se", "buk_spl", "buk_srk"]
vhrmean_regions_name = ["CONUS", "CONUS - East", "CONUS - West", "CONUS - South", "CONUS - Central", "Alaska", "Appalachia", "Central Plains", "Deep South", "Great Lakes", "Mid-Atlantic", "Mezquital", "Northeast/North Atlantic", "Northern Plains", "Northern Rockies", "Prairie", "Pacific Southwest", "Southeast", "Southern Plains", "Southern Rockies"]
group1_regions = ["buk_conus", "buk_conus_e", "buk_conus_w", "buk_conus_s", "buk_conus_c", "buk_apl", "buk_cpl", "buk_ds", "buk_grlk", "buk_matl", "buk_mez", "buk_ne", "buk_npl", "buk_nrk", "buk_pra", "buk_psw", "buk_se", "buk_spl", "buk_srk"]
group1_regions_name = ["CONUS", "CONUS - East", "CONUS - West", "CONUS - South", "CONUS - Central", "Appalachia", "Central Plains", "Deep South", "Great Lakes", "Mid-Atlantic", "Mezquital", "Northeast/North Atlantic", "Northern Plains", "Northern Rockies", "Prairie", "Pacific Southwest", "Southeast", "Southern Plains", "Southern Rockies"]
group2_regions = ["alaska"]
group2_regions_name = ["Alaska"]
fhrmean_forecasthours = [""]
vhrmean_forecasthours = [""]
threshmean_forecasthours = ["000", "006", "012", "018", "024", "030", "036", "042", "048", "054", "060"]
fbias_thresholds = ["_obsge40.", "_obsge50.", "_obsge60.", "_obsge70."]
fbias_thresholds_name = ["≥ 40 F", "≥ 50 F", "≥ 60 F", "≥ 70 F"]
all_thresholds = ["."]
all_thresholds_name = ["All"]
other_thresholds = [".", "_obsge40.", "_obsge50.", "_obsge60.", "_obsge70."]
other_thresholds_name = ["NA", "≥ 40 F", "≥ 50 F", "≥ 60 F", "≥ 70 F"]

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
	        plottype: "fhrmean",
		metric: "bcrmse_me",
	        daterange: "last31days",
		inithour: "_init00z",
		forecasthour: "",
		region: "buk_conus",
		threshold: ".",
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
                        imageObj.metric = passed_metric;
                }
	}

	//Change date range based on passed argument, if any
        var passed_daterange = "";
        if(passed_daterange!=""){
                if(searchByName(passed_daterange,dateranges)>=0){
                        imageObj.daterange = passed_daterange;
                }
	}

	//Change init hour based on passed argument, if any
        var passed_inithour = "";
        if(passed_inithour!=""){
                if(searchByName(passed_inithour,inithours)>=0){
                        imageObj.inithour = passed_inithour;
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

	//Change threshold based on passed argument, if any
        var passed_threshold = "";
        if(passed_threshold!=""){
                if(searchByName(passed_threshold,thresholds)>=0){
                        imageObj.threshold = passed_threshold;
                }
	}

	//Populate forecast hour and dprog/dt arrays for this run and frame
	populateMenu('plottype');
	populateMenu('forecasthour');
	populateMenu('inithour');
	populateMenu('metric');
	populateMenu('daterange');
	populateMenu('region');
	populateMenu('threshold');

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
