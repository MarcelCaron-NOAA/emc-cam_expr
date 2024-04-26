<!DOCTYPE html
<html>
<head>
<meta charset="UTF-8">
<title>CAM Verification - Parallel - G2G: Reflectivity & Echo Top</title>
<link rel="stylesheet" type="text/css" href="../../../style_cam.css">
<script src="https://www.emc/ncep.noaa.gov/users/verification/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="functions_base.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<!-- Head element -->
<div class="page-top">
        <span><a style="color:#ffffff">GRID-TO-GRID: REFLECTIVITY AND ECHO TOP</a></span>
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
        <div class="element">
		<span class="bold">Width:</span>
                <select id="width" onchange="changeWidth(this.value);"></select>
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
		<span class="bold" style="color:#FF0000">Select Region and Variable Information: </span><span class="bold">Region:</span>
                <select id="region" onchange="changeRegion(this.value);"></select>
	</div>
        <div class="element">
		<span class="bold">Threshold:</span>
                <select id="threshold" onchange="changeThreshold(this.value);"></select>
        </div>
        <div class="element">
		<span class="bold">Variable:</span>
                <select id="level" onchange="changeLevel(this.value);"></select>
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

var url = "https://www.emc.ncep.noaa.gov/users/verification/regional/cam/expr/det/grid2grid/images/evs.cam.MMMTTTWWWLLL.DDD.PPP_initHHHzFFF.RRR.png";

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
var levels = [];
var widths = [];

plottypes.push({
        displayName: "Forecast Hour Mean",
        name: "fhrmean",
});
plottypes.push({
        displayName: "Threshold Mean",
        name: "threshmean",
});
plottypes.push({
        displayName: "Performance Diagram",
        name: "perfdiag",
});

metrics.push({
        displayName: "Critical Success Index",
        name: "csi",
});
metrics.push({
        displayName: "Frequency Bias",
        name: "fbias",
});
metrics.push({
        displayName: "Fractions Skill Score",
        name: "fss",
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
        name: "00",
});
inithours.push({
        displayName: "06Z",
        name: "06",
});
inithours.push({
        displayName: "12Z",
        name: "12",
});
inithours.push({
        displayName: "18Z",
        name: "18",
});

forecasthours.push({
        displayName: "NA",
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
        displayName: "Alaska",
        name: "alaska",
});

thresholds.push({
        displayName: "≥20",
        name: "_ge20",
});
thresholds.push({
        displayName: "≥30",
        name: "_ge30",
});
thresholds.push({
        displayName: "≥40",
        name: "_ge40",
});
thresholds.push({
        displayName: "≥50",
        name: "_ge50",
});

levels.push({
	displayName: "Composite Reflectivity",
	name: "refc_l0",
});
levels.push({
	displayName: "Echo Top",
	name: "retop_l0",
});

widths.push({
    displayName: "Width 17",
    name: "_width17.",
});

alaska_widths = ["_width27."]
alaska_widths_name = ["Width 27"]
non_alaska_widths = ["_width17."]
non_alaska_widths_name = ["Width 17"]
perfdiag_metrics = ["ctc"]
perfdiag_metrics_name = ["Probability of Detection and Success Ratio"]
non_perfdiag_metrics = ["csi", "fbias", "fss"]
non_perfdiag_metrics_name = ["Critical Success Index", "Frequency Bias", "Fractions Skill Score"]
fhrmean_thresholds = ["_ge20", "_ge30", "_ge40", "_ge50"]
fhrmean_thresholds_name = ["≥20", "≥30", "≥40", "≥50"]
non_fhrmean_thresholds = [""]
non_fhrmean_thresholds_name = ["NA"]
fhrmean_forecasthours = [""]
fhrmean_forecasthours_name = ["NA"]
non_fhrmean_forecasthours = ["_f000","_f006","_f012","_f018","_f024","_f030","_f036","_f042","_f048","_f054","_f060"]
non_fhrmean_forecasthours_name = ["F000","F006","F012","F018","F024","F030","F036","F042","F048","F054","F060"]

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
		metric: "fbias",
	    daterange: "last31days",
		inithour: "12",
		forecasthour: "",
		region: "buk_conus",
		threshold: "_ge20",
		level: "refc_l0",
        width: "_width17."
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
	
	//Change level based on passed argument, if any
        var passed_level = "";
        if(passed_level!=""){
                if(searchByName(passed_level,levels)>=0){
                        imageObj.level = passed_level;
                }
        }
	
	//Change width based on passed argument, if any
        var passed_width = "";
        if(passed_width!=""){
                if(searchByName(passed_width,widths)>=0){
                        imageObj.width = passed_width;
                }
        }
	//Populate forecast hour and dprog/dt arrays for this run and frame
	populateMenu('plottype');
	populateMenu('metric');
	populateMenu('daterange');
	populateMenu('inithour');
	populateMenu('forecasthour');
	populateMenu('region');
	populateMenu('threshold');
	populateMenu('level');
	populateMenu('width');

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
