<html>
<head>
<script>
var counter = 0;
function run() {
	timer = setInterval ( function() { counter++; document.getElementById('counter').innerHTML = counter; }, 1000);
}
</script>
<style>
#counterbox { font-weight: bold; font-size: 100pt; }
</style>
</head>
<body onload="javascript: run()">
<div id="counterbox">
 <div id="counter">0</div>
</div_
</body>
</html>
