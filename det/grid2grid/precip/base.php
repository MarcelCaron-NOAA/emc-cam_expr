<!DOCTYPE html
<html>
<head>
<meta charset="UTF-8">
<title>CAM Verification - Parallel - G2G: Precipitation</title>
<link rel="stylesheet" type="text/css" href="../../../style_cam.css">
<script src="https://www.emc/ncep.noaa.gov/users/verification/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="functions_base.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<!-- Head element -->
<div class="page-top">
        <span><a style="color:#ffffff">GRID-TO-GRID: PRECIPITATION</a></span>
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
		<span class="bold" style="color:#FF0000">Select Region and Variable Information: </span><span class="bold">Region:</span>
                <select id="region" onchange="changeRegion(this.value);"></select>
	</div>
        <div class="element">
		<span class="bold">Threshold:</span>
                <select id="threshold" onchange="changeThreshold(this.value);"></select>
        </div>
        <div class="element">
		<span class="bold">Accumulation Time:</span>
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

var url = "https://www.emc.ncep.noaa.gov/users/verification/regional/cam/expr/det/grid2grid/images/evs.cam.MMMTTTapcp_LLL.DDD.PPP_initHHHz_FFF.RRR.png";

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

plottypes.push({
        displayName: "Threshold Mean",
        name: "threshmean",
});
plottypes.push({
        displayName: "Performance Diagram",
        name: "perfdiag",
});

metrics.push({
        displayName: "Equitable Threat Score",
        name: "ets",
});
metrics.push({
        displayName: "Frequency Bias",
        name: "fbias",
});
metrics.push({
        displayName: "Fraction Skill Score - Width 1",
        name: "fss_width1",
});
metrics.push({
        displayName: "Fraction Skill Score - Width 5",
        name: "fss_width5",
});
metrics.push({
        displayName: "Fraction Skill Score - Width 9",
        name: "fss_width9",
});
metrics.push({
        displayName: "Fraction Skill Score - Width 21",
        name: "fss_width21",
});
metrics.push({
        displayName: "Fraction Skill Score - Width 31",
        name: "fss_width31",
});
metrics.push({
        displayName: "Fraction Skill Score - Width 63",
        name: "fss_width63",
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
        displayName: "F024",
        name: "f024",
});
forecasthours.push({
        displayName: "F030",
        name: "f030",
});
forecasthours.push({
        displayName: "F036",
        name: "f036",
});
forecasthours.push({
        displayName: "F042",
        name: "f042",
});
forecasthours.push({
        displayName: "F048",
        name: "f048",
});
forecasthours.push({
        displayName: "F054",
        name: "f054",
});
forecasthours.push({
        displayName: "F060",
        name: "f060",
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

thresholds.push({
        displayName: "NA",
        name: ".",
});

levels.push({
	displayName: "1-hour",
	name: "a01",
});
levels.push({
	displayName: "3-hour",
	name: "a03",
});
levels.push({
	displayName: "24-hour",
	name: "a24",
});

accum01_forecasthours = ["f001-f024"]
accum03_forecasthours = ["f024-f048", "f036-f060"]
accum24_forecasthours = ["f024", "f030", "f036", "f042", "f048", "f054", "f060"]
accum01_inithours = ["00", "12"]
accum03_inithours = ["00", "12"]
accum24_inithours = ["00", "06", "12", "18"]
perfdiag_metrics = ["ctc"]
perfdiag_metrics_name = ["Probability of Detection and Success Ratio"]
non_perfdiag_metrics = ["ets", "fbias", "fss_width1", "fss_width5", "fss_width9", "fss_width21", "fss_width31", "fss_width63"]
non_perfdiag_metrics_name = ["Equitable Threat Score", "Frequency Bias", "Fraction Skill Score - Width 1", "Fraction Skill Score - Width 5", "Fraction Skill Score - Width 9", "Fraction Skill Score - Width 21", "Fraction Skill Score - Width 31", "Fraction Skill Score - Width 63"]
initgroup1_regions_name = ["CONUS", "CONUS - East", "CONUS - West", "CONUS - South", "CONUS - Central", "Alaska"]
initgroup1_regions = ["buk_conus", "buk_conus_e", "buk_conus_w", "buk_conus_s", "buk_conus_c", "alaska"]
initgroup2_regions_name = ["Alaska"]
initgroup2_regions = ["alaska"]
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
	    plottype: "threshmean",
		metric: "fbias",
	    daterange: "last31days",
		inithour: "12",
		forecasthour: "f024",
		region: "buk_conus",
		threshold: ".",
		level: "a24",
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
	//Populate forecast hour and dprog/dt arrays for this run and frame
	populateMenu('plottype');
	populateMenu('metric');
	populateMenu('daterange');
	populateMenu('inithour');
	populateMenu('forecasthour');
	populateMenu('region');
	populateMenu('threshold');
	populateMenu('level');

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
