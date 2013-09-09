<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"  content="width=device-width,  minimum-scale=1.0, maximum-scale=1.0" />
	<title>Bytecraft Job Log</title>

  	<script src="http://joblog.bytecraft.com.au/js/jquery-1.9.1.js"></script>
  	<script src="http://joblog.bytecraft.com.au/js/ui/jquery-ui.js"></script>
  	<script src="http://joblog.bytecraft.com.au/js/ui/jquery.ui.datepicker.js"></script>
  	<script src="http://joblog.bytecraft.com.au/js/ui/jquery.ui.slider.js"></script>
  	<script src="http://joblog.bytecraft.com.au/js/ui/jquery.ui.sliderAccess.js"></script>
  	<script src="http://joblog.bytecraft.com.au/js/ui/jquery.ui.timepicker.js"></script>

	<script type="text/javascript">
		$(function() {
			$("#techId").focus();
			$("#start").datetimepicker({
							controlType: 'select',
							addSliderAccess: true,
							sliderAccessArgs: { touchonly: true,
												text: true,
												upText: 'More',
												downText: 'Less' },
							showSecond: false,
							dateFormat: "yy-mm-dd",
							timeFormat: "HH:mm:ss"
							});
							
			$("#end").datetimepicker({
							controlType: 'select',
							addSliderAccess: true,
							sliderAccessArgs: { touchonly: true,
												text: true,
												upText: 'More',
												downText: 'Less' },
							showSecond: false,
							dateFormat: "yy-mm-dd",
							timeFormat: "HH:mm:ss"
							});
		});
	</script>

	<link rel="stylesheet" href="http://joblog.bytecraft.com.au/js/ui/theme.css" />
	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	/* css for timepicker */
	.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
	.ui-timepicker-div dl { text-align: left; }
	.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
	.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
	.ui-timepicker-div td { font-size: 90%; }
	.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
	
	.ui-timepicker-rtl{ direction: rtl; }
	.ui-timepicker-rtl dl { text-align: right; }
	.ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }

	body {
		background-color: #fff;
		margin: 5px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}
	
	h2 {
		color: #444;
		background-color: transparent;
		font-size: 16px;
		font-weight: normal;
		margin: 0 0 14px 0;
	}


	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	data.table, data.td, data.tr
	{
		border-bottom: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0
	}

	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>