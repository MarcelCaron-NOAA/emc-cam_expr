<!DOCTYPE html
<html>
<head>
<meta charset="UTF-8">
<title>RRFS Ensemble SPCoutlook Areas Verification - Parallel</title>
<link rel="stylesheet" type="text/css" href="../../../style_cam.css">
<script src="https://www.emc.ncep.noaa.gov/users/verification/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="functions_base.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<!-- Head element -->
<div class="page-top">
        <span><a style="color:#ffffff">RRFS Ensemble: CAPE over SPC Outlook Areas (Performance) </a></span>
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
		<span class="bold" style="color:#FF0000">Select Region and Variable Information: </span><span class="bold">Risk Category:</span>
                <select id="region" onchange="changeRegion(this.value);"></select>
	</div>
        <div class="element">
                <span class="bold">Day:</span>
                <select id="level" onchange="changeLevel(this.value);"></select>
        </div>
	<div class="element">
            <span class="bold"> Field:</span>
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


var url = "https://www.emc.ncep.noaa.gov/users/verification/regional/cam/expr/ens/images/spcoutlook/evs.rrfsens.MMM.TTT.DDD.PPP_valid_00z_12z.LLL_RRR.png";

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
        displayName: "Performance Diagram",
        name: "perfdiag",
});

metrics.push({
        displayName: "Performance",
        name: "ctc",
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
        displayName: "00Z, 12Z ",
        name: "12",
});

regions.push({
        displayName: "ThunderStorm",
        name: "tstm",
});
regions.push({
        displayName: "Marginal",
        name: "mrgl",
});
regions.push({
        displayName: "Slight",
        name: "slgt",
});
regions.push({
        displayName: "Enhanced",
        name: "enh",
});
regions.push({
        displayName: "Moderate",
        name: "mdt",
});
regions.push({
        displayName: "High",
        name: "high",
});

fields.push({
        displayName: "Surface CAPE",
        name: "cape_l0",
});
fields.push({
        displayName: "Mid Level CAPE",
        name: "mlcape_ml",
});

levels.push({
        displayName: "Day 1",
        name: "day1",
});
levels.push({
        displayName: "Day 2",
        name: "day2",
});
levels.push({
        displayName: "Day 3",
        name: "day3",
});


timeseries_forecasthours = ["120", "240", "360"]
fhrmean_forecasthours = ["48"]
leaddate_forecasthours = ["84"]
thresholdmean_forecasthours = ["84"]
perfdiag_forecasthours = ["48"]
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
	        plottype: "perfdiag",
		metric: "ctc",
	        daterange: "past31days",
		validhour: "12",
		forecasthour: "48",
		wavedecomp: "apcp",
		level: "day1",
                field: "cape_l0",
		region: "tstm",
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

	changePlotType("perfdiag");
	changeForecastHour("48");
	changeMetric("ctc");
	changeLevel("12");
        changeField("cape_l0");
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
