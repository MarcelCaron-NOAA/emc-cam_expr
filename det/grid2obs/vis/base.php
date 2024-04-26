<!DOCTYPE html
<html>
<head>
<meta charset="UTF-8">
<title>CAM Verification - Parallel - G2O: Surface Visibility</title>
<link rel="stylesheet" type="text/css" href="../../../style_cam.css">
<script src="https://www.emc/ncep.noaa.gov/users/verification/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="functions_base.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<!-- Head element -->
<div class="page-top">
        <span><a style="color:#ffffff">GRID-TO-OBS: SURFACE VISIBILITY</a></span>
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
		<span class="bold" style="color:#FF0000">Select Region: </span><span class="bold">Region:</span>
                <select id="region" onchange="changeRegion(this.value);"></select>
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

var url = "https://www.emc.ncep.noaa.gov/users/verification/regional/cam/expr/det/grid2obs/images/evs.cam.MMM.vis_z0.DDD.PPP_initHHHz_fFFF.RRR.png";

//====================================================================================================
//Add years & months
//====================================================================================================

var plottypes = [];
var metrics = [];
var dateranges = [];
var inithours = [];
var forecasthours = [];
var regions = [];

plottypes.push({
        displayName: "Performance Diagram",
        name: "perfdiag",
});
plottypes.push({
        displayName: "Threshold Mean",
        name: "threshmean",
});

metrics.push({
        displayName: "NA",
        name: "ctc",
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
	name: "alaska"
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

perfdiag_metrics = ["ctc"]
perfdiag_metrics_name = ["NA"]
threshmean_metrics = ["csi", "fbias"]
threshmean_metrics_name = ["Critical Success Index", "Frequency Bias"]
group1_regions = ["buk_conus", "buk_conus_e", "buk_conus_w", "buk_conus_s", "buk_conus_c", "buk_apl", "buk_cpl", "buk_ds", "buk_grlk", "buk_matl", "buk_mez", "buk_ne", "buk_npl", "buk_nrk", "buk_pra", "buk_psw", "buk_se", "buk_spl", "buk_srk"]
group1_regions_name = ["CONUS", "CONUS - East", "CONUS - West", "CONUS - South", "CONUS - Central", "Appalachia", "Central Plains", "Deep South", "Great Lakes", "Mid-Atlantic", "Mezquital", "Northeast/North Atlantic", "Northern Plains", "Northern Rockies", "Prairie", "Pacific Southwest", "Southeast", "Southern Plains", "Southern Rockies"]
group2_regions = ["alaska"]
group2_regions_name = ["Alaska"]
threshmean_forecasthours = ["000", "006", "012", "018", "024", "030", "036", "042", "048", "054", "060"]
perfdiag_forecasthours = ["000", "006", "012", "018", "024", "030", "036", "042", "048", "054", "060"]
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
	        plottype: "perfdiag",
		metric: "ctc",
	        daterange: "last31days",
		inithour: "00",
		forecasthour: "012",
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
	//Populate forecast hour and dprog/dt arrays for this run and frame
	populateMenu('plottype');
	populateMenu('metric');
	populateMenu('daterange');
	populateMenu('inithour');
	populateMenu('forecasthour');
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
