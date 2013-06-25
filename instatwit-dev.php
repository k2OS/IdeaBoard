<!DOCTYPE HTML>
<html>
<head>
<style>
body	{
	margin: 0px;
}

#pictureframe {
	padding: 0px;
	margin: 0px auto;
	border: none;
	width: 918px;
	height: 612px;
}

#wrapper {
        margin: 0 auto;
        display: table;
        border: none;
	margin-top: 0px;
	text-align: left;
	float:left;
}
#box {
        margin: 0 auto;
	margin-top: 40px;
        display: table;

}


#twitterframe {
	float: left;
	width: 400px;
	text-align: left;
}
#headline {
	font-weight: bold;
}
.super {
	float: left;
	margin: 0px;
	width: 306px;
	height: 306px;

}
.container {
	width: 306px;
	height: 306px;
	margin: 0px auto;
	display: table-cell;
	vertical-align: middle;
}
</style>

<script type="text/javascript" src="instafeed.min.js"></script>
<script>
var url,id;
var numPics = 0;
var id;
var maxImages = 6;
var currentIndex = 0; // which picture are we updating next?
inStore = new Array();

// make maxImages img-nodes
function mkImages(maxImages) {
 for (numPics=0; numPics < maxImages;numPics++) {
   var parent = document.getElementById('showcase');

   var superdiv = document.createElement('div');
   superdiv.setAttribute('class','super');

   var newdiv = document.createElement('div');
   newdiv.setAttribute('class','container');
   newdiv.setAttribute('style','vertical-align: middle;');

   var newimg = document.createElement('img');
   var imgIdName = 'img'+numPics;

   newimg.setAttribute('id',imgIdName);
   newimg.setAttribute('src','');
   newimg.setAttribute('width',306);
   newimg.setAttribute('height',306);
   newimg.setAttribute('style','opacity: 1');

   newdiv.appendChild(newimg);
   superdiv.appendChild(newdiv);
   parent.appendChild(superdiv);
 }
  var newdiv = document.createElement('div');
  newdiv.setAttribute('style','clear:both;');
  parent.appendChild(newdiv);


}


// flips images out and back in
function animateOut(t,n) {
        var target = t;
        maxh = 306;
        maxw = 306;
        minh = 0;
        var b = t;
        var h = t.style.height;
        h = h.replace('px','');
	if (!h) { h = 1; }
        var direction = 0;
        var timer = setInterval(
                function() {
                        if (h > minh && !direction) {
                                h = parseInt(h * 0.8); b.style.height = h+'px';
                        } else if (h == 0) {
                                b.src=n; direction == 1;
                                clearInterval(timer);
                                var t2 = setTimeout(
                                                function() {
                                                        var timer2 = setInterval(
                                                                function() {
                                                                        if (h < maxh) { h = h + 2; b.style.height = parseInt(h)+'px'; }
                                                                        else if (h == maxh) { clearInterval(timer2); }
                                                                        }, 1
                                                                );
                                                },1000
                                );
                        }
                }, 30
        );
}

</script>
</head>
<body onLoad="javascript:mkImages(maxImages);">
<div style="width:95%;margin: 0 auto; border: none; padding: 0px; text-align: center;">
<div id="box">
 <div id="wrapper"> <!-- instagram -->
   <div id="headline">#RFMakerspace / Instagram</div>
   <div id="instafeed" style="display:none"></div>
   <div id="debug" style="display:none"></div>
   <div id="pictureframe">
   <div style="clear:both"></div>
    <div id="showcase"  style="margin: 0px auto; border: none;"></div>
    <div style="clear:both"></div>
   </div>
 </div>
 <div id="twitterframe"> <!-- twitter -->
   <div id="headline">#RFMakerspace / Twitter</div>

  <a data-chrome="noborders noscrollbar nofooter noheader" class="twitter-timeline" data-dnt="true" href="https://twitter.com/search?q=%23rfmakerspace" data-widget-id="323559529474293760">Tweets about "#rfmakerspace"</a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 </div>
 <div style="clear:both"></div>
</div>
</div>
<script type="text/javascript">
function setMotion(s) {
	var parent = document.getElementById('showcase');
	var n = s.split("|");
	n.pop();
	var debug = '';
	var newImages = 0;
	console.log(n.length-1 + ' items fetched');
	for (i=n.length-1;i>=0;i--) { // sort with oldest first
		debug = debug + '<br>' + n[i];
		if (inStore.indexOf(n[i]) == -1) {
			// add image to showcase on currentIndex
			// make some fancy in/out-animation when replacing image
			animateOut(parent.childNodes[currentIndex].childNodes[0].childNodes[0],n[i]);
//			parent.childNodes[currentIndex].src=n[i];
			currentIndex++;
			if (currentIndex > maxImages-1) { currentIndex = 0; }
			inStore.unshift(n[i]); // add the url at the beginning of inStore
			if (inStore.length > maxImages) { inStore.pop(); }
			newImages++;
		}
//else { console.log('not new');}
	}
	console.log(newImages + ' images added');
	document.getElementById('debug').innerHTML = debug + 'inStore: ' + inStore.length;
}
var options = {
        get: 'tagged',
        tagName: 'rfmakerspace',
	sortBy: 'most-recent',
	links: 'false',
	limit: '6',
	resolution: 'low_resolution',
        clientId: '48e3a611d4484383bb87ca5c528c7cef',
	template: '{{image}}|',
	target: 'instafeed',
	after: function() { setMotion(document.getElementById('instafeed').innerHTML); },
    }
    var feed = new Instafeed(options);
    setTimeout(function() { feed.run(); },200);
    var interval = setInterval(function() { feed.run(); }, 4000);

</script>
</body>
</html>
