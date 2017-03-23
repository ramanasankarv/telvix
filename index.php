<?session_start();
if(isset($_SESSION["token"])){
	if($_SESSION["token"]<0){
		header('Location: login.html');
	}
}
else{
	header('Location: login.html');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Telvix TV</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<? include('includes/header.php');?>

    <div class="page-content">
    	<div class="row">
		  	<div class="col-md-3" id="divmenu">
		  		<? include('includes/menu.php');?>
		  	</div>
		  	
		  	<div class="col-md-9">
		  	
			  	<div class="row">
			  		<div class="col-md-12 panel-warning">
			  			<div class="content-box-header panel-heading">
		  					<div class="panel-title ">Bandwidth</div>
			  			</div>
			  			<div class="content-box-large box-with-header">
			  				<div id="chartContainer" style="height: 300px; width: 100%;">
				  			</div>
						</div>
			  		</div>
			  	</div>
			  	<div class="row">
			  		<div class="col-md-4 panel-warning">
			  			<div class="content-box-header panel-heading">
		  					<div class="panel-title ">Memory</div>
			  			</div>
			  			<div class="content-box-large box-with-header">
			  				<div class="js-gauge js-gauge--1 gauge"></div>
			  			</div>
			  		</div>
					<div class="col-md-4 panel-warning">
						<div class="content-box-header panel-heading">
		  					<div class="panel-title ">Disk Usage</div>
			  			</div>
			  			<div class="content-box-large box-with-header">
			  				<div class="js-gauge js-gauge--2 gauge"></div>
			  			</div>
			  		</div>
			  		<div class="col-md-4  panel-warning">
			  			<div class="content-box-header panel-heading">
		  					<div class="panel-title ">Load</div>
			  			</div>
			  			<div class="content-box-large box-with-header">
			  				<div class="js-gauge js-gauge--3 gauge"></div>
			  			</div>
			  		</div>	  	
			  	</div>
			</div>
    	</div>
    </div>

    <footer id="divfooter">
         
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script type="text/javascript" src="js/header.js"></script>
    <script type="text/javascript" src="js/footer.js"></script>

    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
	<script type="text/javascript" src="js/kuma-gauge.jquery.js"></script>
    <script type="text/javascript">
    	
	window.onload = function () {

		// dataPoints
		var dataPoints1 = [];
		var dataPoints2 = [];
		var memory=0;	
		var diskusage=0;
		var load=0;	

		$('.js-gauge--1').kumaGauge({
			value : Math.floor((Math.random() * 99) + 1)
		});

		$('.js-gauge--2').kumaGauge({
			value : Math.floor((Math.random() * 99) + 1)
		});
		
		$('.js-gauge--3').kumaGauge({
			value : Math.floor((Math.random() * 99) + 1)
		});

		var chart = new CanvasJS.Chart("chartContainer",{
			zoomEnabled: true,
			title: {
				text: "Upload & Download Bandwidth"		
			},
			toolTip: {
				shared: true
				
			},
			legend: {
				verticalAlign: "top",
				horizontalAlign: "center",
                fontSize: 14,
				fontWeight: "bold",
				fontFamily: "calibri",
				fontColor: "dimGrey"
			},
			axisX: {
				title: "chart updates every 30 secs"
			},
			axisY:{
				prefix: '',
				includeZero: false
			}, 
			data: [{ 
				// dataSeries1
				type: "line",
				xValueType: "dateTime",
				showInLegend: true,
				name: "Upload Bandwidth",
				dataPoints: dataPoints1
			},
			{				
				// dataSeries2
				type: "line",
				xValueType: "dateTime",
				showInLegend: true,
				name: "Download Bandwidth" ,
				dataPoints: dataPoints2
			}],
          legend:{
            cursor:"pointer",
            itemclick : function(e) {
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
              }
              else {
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          }
		});



		var updateInterval = 1000 *30 *1;
		// initial value
		var yValue1 = 10; 
		var yValue2 = 10;

		//var time = new Date;
		// time.setHours(9);
		// time.setMinutes(30);
		// time.setSeconds(00);
		// time.setMilliseconds(00);
		// // starting at 9.30 am

		var updateChart = function (count) {

			$.ajax({
	        	type: "POST",
	           	url: "api.php",
	           	data: {
	        		page: 'systeminfo'
	    		},
	           	dataType: "json",
	           	success: function (msg) {
	           		console.log(msg);
	           		//console.log(msg.length);
	           		var time = new Date;
	           		for(var i=0;i<msg.length;i++){
	           			if(msg[i].search("Upload Bandwidth:")==0){
	           				var res = msg[i].replace("Upload Bandwidth: <b>", "");
	           				yValue1 = res.replace("</b> Mbps", "");
	           				
							dataPoints1.push({
								x: time.getTime(),
								y: parseFloat(yValue1.trim())
							});
							//console.log(dataPoints1);
						}else if(msg[i].search("Download Bandwidth:")==0){
	           				var res = msg[i].replace("Download Bandwidth: <b>", "");
	           				yValue2 = res.replace("</b> Mbps", "");
	           				//var time = new Date;
							dataPoints2.push({
								x: time.getTime(),
								y: parseFloat(yValue2)
							});
						}else if(msg[i].search("Total / Free Memory: <b>")==0){
							var res = msg[i].replace("Total / Free Memory: <b>", "");
	           				var temp = res.replace(" </b>GB", "");
	           				var temp1= temp.split("/");
	           				var usememory= parseFloat(temp1[0]) - parseFloat(temp1[1]);
	           				memory = parseInt((parseFloat(usememory)/parseFloat(temp1[0]))* 100);
	           				$('.js-gauge--1').kumaGauge('update',{
								value : memory
							});	
						}else if(msg[i].search("Disk Use: <b>")==0){
							var res = msg[i].replace("Disk Use: <b>", "");
	           				var temp = res.replace("%</b>", "");
	           				diskusage=	temp;
	           				$('.js-gauge--2').kumaGauge('update',{
								value : diskusage
							});
						}else if(msg[i].search("Load Average: <b>")==0){
							var res = msg[i].replace("Load Average: <b>", "");
	           				var temp = res.replace("</b>", "");
	           				load=	temp;
	           				$('.js-gauge--3').kumaGauge('update',{
								value : load
							});	
						}
	           		}
	           		// updating legend text with  updated with y Value 
					chart.options.data[0].legendText = " Upload Bandwidth " + yValue1;
					chart.options.data[1].legendText = " Download Bandwidth " + yValue2; 

					chart.render();
	           	}
	        });
			
			

			

		};

		// generates first set of dataPoints 
		updateChart(3000);	
		 
		// update chart after specified interval 
		setInterval(function(){updateChart()}, updateInterval);
	}
	</script>
	<script type="text/javascript" src="js/canvasjs.min.js"></script>

	
				
				
    
  </body>
</html>