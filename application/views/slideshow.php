<style type="text/css">

/*Make sure your page contains a valid doctype at the top*/
#simplegallery1{ //CSS for Simple Gallery Example 1
position: relative; /*keep this intact*/
visibility: hidden; /*keep this intact*/
border: 3px solid #002337;
}

#simplegallery1 .gallerydesctext{ //CSS for description DIV of Example 1 (if defined)
text-align: left;
padding: 2px 5px;
}

</style>

<script type="text/javascript" src="<?=base_url()?>js/simplegallery.js">

/***********************************************
* Simple Controls Gallery- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>

<script type="text/javascript">

var mygallery=new simpleGallery({
	wrapperid: "simplegallery1", //ID of main gallery container,
	dimensions: [940, 250], //width/height of gallery in pixels. Should reflect dimensions of the images exactly
	imagearray: [
		["http://i26.tinypic.com/11l7ls0.jpg", "http://en.wikipedia.org/wiki/Swimming_pool", "_new", "There's nothing like a nice swim in the Summer."],
		["http://i29.tinypic.com/xp3hns.jpg", "http://en.wikipedia.org/wiki/Cave", "", ""],
		["http://i30.tinypic.com/531q3n.jpg", "", "", "Eat your fruits, it's good for you!"],
		["http://i31.tinypic.com/119w28m.jpg", "", "", ""]
	],
	autoplay: [true, 1500, 2], //[auto_play_boolean, delay_btw_slide_millisec, cycles_before_stopping_int]
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 500, //transition duration (milliseconds)
	oninit:function(){ //event that fires when gallery has initialized/ ready to run
		//Keyword "this": references current gallery instance (ie: try this.navigate("play/pause"))
	},
	onslide:function(curslide, i){ //event that fires after each slide is shown
		//Keyword "this": references current gallery instance
		//curslide: returns DOM reference to current slide's DIV (ie: try alert(curslide.innerHTML)
		//i: integer reflecting current image within collection being shown (0=1st image, 1=2nd etc)
	}
})


</script>

<div id="simplegallery1"></div>