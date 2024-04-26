<!DOCTYPE html
<html>
<head>
<meta charset="UTF-8">
<title>CAM Verification - Parallel - G2O: Meridional Wind</title>
<link rel="stylesheet" type="text/css" href="../../../style_cam.css">
<script src="https://www.emc/ncep.noaa.gov/users/verification/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="functions_base.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>
<!-- Head element -->
<div class="page-top">
        <span><a style="color:#ffffff">GRID-TO-OBS: MERIDIONAL WIND</a></span>
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
		<span class="bold" style="color:#FF0000">Select Region and Level Information: </span><span class="bold">Region:</span>
                <select id="region" onchange="changeRegion(this.value);"></select>
	</div>
        <div class="element">
                <span class="bold">Level:</span>
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

var url = "https://www.emc.ncep.noaa.gov/users/verification/regional/cam/expr/det/grid2obs/images/evs.cam.MMM.vgrd_LLL.DDD.PPP_initHHHz_fFFF.RRR.png";

//====================================================================================================
//Add years & months
//====================================================================================================

var plottypes = [];
var metrics = [];
var dateranges = [];
var inithours = [];
var forecasthours = [];
var levels = [];
var regions = [];

plottypes.push({
        displayName: "Vertical Profile",
        name: "vertprof",
});

metrics.push({
        displayName: "Bias-corrected RMSE and Mean Error (Bias)",
        name: "bcrmse_me",
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
        displayName: "12Z",
        name: "12",
});

regions.push({
        displayName: "CONUS",
        name: "buk_conus",
});
regions.push({
        displayName: "Alaska",
        name: "alaska",
});
regions.push({
        displayName: "Hawaii",
        name: "hawaii",
});
regions.push({
        displayName: "Puerto Rico",
        name: "prico",
});
forecasthours.push({
	displayName: "F000",
	name: "000",
});

forecasthours.push({
	displayName: "F006",
	name: "006",
});
forecasthours.push({
	displayName: "F012",
	name: "012",
});
forecasthours.push({
	displayName: "F018",
	name: "018",
});
forecasthours.push({
	displayName: "F024",
	name: "024",
});
forecasthours.push({
	displayName: "F030",
	name: "030",
});
forecasthours.push({
	displayName: "F036",
	name: "036",
});
forecasthours.push({
	displayName: "F042",
	name: "042",
});
forecasthours.push({
	displayName: "F048",
	name: "048",
});
forecasthours.push({
	displayName: "F054",
	name: "054",
});
forecasthours.push({
	displayName: "F060",
	name: "060",
});

levels.push({
	displayName: "All",
	name: "all",
});
levels.push({
	displayName: "Lower Troposphere",
	name: "ltrop",
});
levels.push({
	displayName: "Upper Troposphere",
	name: "utrop",
});

vertprof_forecasthours = ["000", "006", "012", "018", "024", "030", "036", "042", "048", "054", "060"]
vertprof_levels = ["all", "ltrop", "utrop"]
vertprof_levels_name = ["All", "Lower Troposphere", "Upper Troposphere"]
non_vertprof_levels = ["p1000", "p925", "p850", "p700", "p500", "p300", "p250", "p200", "p100", "p50", "p20", "p10", "p5"]
non_vertprof_levels_name = ["1000 hPa", "925 hPa", "850 hPa", "700 hPa", "500 hPa", "300 hPa", "250 hPa", "200 hPa", "100 hPa", "50 hPa", "20 hPa", "10 hPa", "5 hPa"]
alaska_inithours = ["06", "18"]
alaska_inithours_name = ["06Z", "18Z"]
non_alaska_inithours = ["00", "12"]
non_alaska_inithours_name = ["00Z", "12Z"]
hawaii_forecasthours = ["000", "012", "024", "036", "048", "060"]
non_hawaii_forecasthours = ["000", "006", "012", "018", "024", "030", "036", "042", "048", "054", "060"]

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
	        plottype: "vertprof",
		metric: "bcrmse_me",
	        daterange: "last31days",
		inithour: "00",
		forecasthour: "012",
		level: "all",
		region: "buk_conus",
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

        //Change level based on passed argument, if any
        var passed_level = "";
        if(passed_level!=""){
                if(searchByName(passed_level,levels)>=0){
                        imageObj.level = passed_level;
                }
        }

	//Change region based on passed argument, if any
        var passed_region = "";
        if(passed_region!=""){
                if(searchByName(passed_region,regions)>=0){
                        imageObj.region = passed_region;
                }
	}

	//Populate forecast hour and dprog/dt arrays for this run and frame
	populateMenu('plottype');
	populateMenu('metric');
	populateMenu('daterange');
	populateMenu('inithour');
	populateMenu('forecasthour');
	populateMenu('level');
	populateMenu('region');

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
