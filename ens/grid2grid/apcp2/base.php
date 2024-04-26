<!DOCTYPE html
<html>
<head>
<meta charset="UTF-8">
<title>RRFS Ensemble Atmospheric Verification - Parallel - G2G: Precipitation</title>
<link rel="stylesheet" type="text/css" href="../../../style_cam.css">
<script src="https://www.emc.ncep.noaa.gov/users/verification/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="functions_base.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<!-- Head element -->
<div class="page-top">
        <span><a style="color:#ffffff">RRFS Ensemble: Precipitation (Threshold mean)</a></span>
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
		<span class="bold" style="color:#FF0000">Select Region and Variable: </span><span class="bold">Region:</span>
                <select id="region" onchange="changeRegion(this.value);"></select>
	</div>
        <div class="element">
                <span class="bold">Mean products:</span>
                <select id="level" onchange="changeLevel(this.value);"></select>
        </div>
	<div class="element">
            <span class="bold"> Accumulation time:</span>
            <select id="field" onchange="changeField(this.value);"></select>
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

<!-- /Footer -->
<div class="page-footer">
        <span></div>

<script type="text/javascript">
//====================================================================================================
//User-defined years
//====================================================================================================


var url = "https://www.emc.ncep.noaa.gov/users/verification/regional/cam/expr/ens/images/precip/evs.rrfsens_LLL.MMM.TTT.DDD.PPP_valid_HHH.RRR.png";

//====================================================================================================
//Add years & months
//====================================================================================================

var plottypes = [];
var metrics = [];
var dateranges = [];
var validhours = [];
var forecasthours = [];
var wavedecomps = [];
var levels = [];
var regions = [];
var fields = [];

plottypes.push({
        displayName: "Threshold Mean",
        name: "threshmean",
});


metrics.push({
        displayName: "ETS",
        name: "ets",
});
metrics.push({
        displayName: "FBias",
        name: "fbias",
});

dateranges.push({
        displayName: "Last 31 Days",
        name: "past31days",
});
dateranges.push({
        displayName: "Last 90 Days",
        name: "past90days",
});

validhours.push({
        displayName: "00Z",
        name: "00z",
});
validhours.push({
        displayName: "03Z",
        name: "03z",
});
validhours.push({
        displayName: "06Z",
        name: "06z",
});
validhours.push({
        displayName: "09Z",
        name: "09z",
});
validhours.push({
        displayName: "12Z",
        name: "12z",
});
validhours.push({
        displayName: "15Z",
        name: "15z",
});
validhours.push({
        displayName: "18Z",
        name: "18z",
});
validhours.push({
        displayName: "21Z",
        name: "21z",
});
validhours.push({
        displayName: "All",
        name: "All",
});


regions.push({
        displayName: "CONUS",
        name: "buk_conus",
});
regions.push({
        displayName: "CONUS East",
        name: "buk_conus_east",
});
regions.push({
        displayName: "CONUS West",
        name: "buk_conus_west",
});
regions.push({
        displayName: "CONUS south",
        name: "buk_conus_south",
});
regions.push({
        displayName: "CONUS Central",
        name: "buk_conus_central",
});
regions.push({
        displayName: "Alaska",
        name: "alaska",
});


levels.push({
        displayName: "Ensemble mean",
        name: "mean",
});
levels.push({
        displayName: "Prob matched mean",
        name: "pmmn",
});
levels.push({
        displayName: "Local prob matched mean",
        name: "lpmm",
});
levels.push({
        displayName: "Averag of all means",
        name: "avrg",
});

fields.push({
        displayName: "1-hour",
        name: "apcp_01h",
});
fields.push({
        displayName: "3-hour",
        name: "apcp_03h",
});
fields.push({
        displayName: "24-hour",
        name: "apcp_24h",
});

apcp_01h_validhours = ["00z", "03z", "06z", "09z", "12z", "15z", "18z", "21z", "All"]
apcp_03h_validhours = ["00z", "03z", "06z", "09z", "12z", "15z", "18z", "21z", "All"]
apcp_24h_validhours = ["12z"]
timeseries_forecasthours = ["120", "240", "360"]
fhrmean_forecasthours = ["84"]
leaddate_forecasthours = ["84"]
threshmean_forecasthours = ["48"]
crps_wavedecomps = ["apcp", "apcp_decomp_0_3", "apcp_decomp_4_9", "apcp_decomp_10_20", "apcp_decomp_0_20"]
crps_wavedecomps_name = ["None", "Waves 0-3", "Waves 4-9", "Waves 10-20", "Waves 10-20"]
s1_wavedecomps = ["apcp"]
s1_wavedecomps_name = ["None"]
level_no_wave_decomps = ["apcp"]
level_no_wave_decomps_name = ["None"]
level_yes_wave_decomps = ["apcp", "apcp_decomp_0_3", "apcp_decomp_4_9", "apcp_decomp_10_20", "apcp_decomp_0_20"]
level_yes_wave_decomps_name = ["None", "Waves 0-3", "Waves 4-9", "Waves 10-20", "Waves 10-20"]
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
		metric: "ets",
	        daterange: "past31days",
		validhour: "00z",
		forecasthour: "48",
		wavedecomp: "apcp",
		level: "mean",
                field: "apcp_01h",
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

	//Change wave decomp based on passed argument, if any
        var passed_wavedecomp = "";
        if(passed_wavedecomp!=""){
                if(searchByName(passed_wavedecomp,wavedecomps)>=0){
                        imageObj.wavedecomp = passed_wavedecomp;
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
        //Change field based on passed argument, if any
	var passed_field = "";
	if(passed_field!=""){
	        if(searchByName(passed_field,fields)>=0){
	          imageObj.field = passed_field;
	        }
	}
	//Populate forecast hour and dprog/dt arrays for this run and frame
	populateMenu('plottype');
	populateMenu('metric');
	populateMenu('daterange');
	populateMenu('validhour');
	populateMenu('forecasthour');
	populateMenu('field');
	populateMenu('level');
	populateMenu('region');

	changePlotType("threshmean");
	changeForecastHour("48");
	changeMetric("ets");
	changeLevel("mean");
        changeField("apcp_01h");
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
