<?php function mod_js(){ global $jsPath;?>
<script src="<?php echo $jsPath;?>Progressbar.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>jquery_1.7_jquery.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>validateForms.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>otherJstuff.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>flowplayer-3.2.12.min.js" type="text/javascript"></script>
<script type="text/javascript">

var myProgressBar = null ;
var timerId = null ;

function loadProgressBar() { 
    myProgressBar = new ProgressBar("my_progress_bar_1",
	{borderRadius: 0,
	width: 300,
	height: 20,
	maxValue: 100,
	labelText: "Loaded in {value,0} %",
	orientation: ProgressBar.Orientation.Horizontal,
	direction: ProgressBar.Direction.LeftToRight,
	animationStyle: ProgressBar.AnimationStyle.LeftToRight1,
	animationSpeed: 1.5,
	imageUrl: "<?php echo $jsPath;?>v_fg12.png",
	backgroundUrl: "<?php echo $jsPath;?>h_bg2.png",
	markerUrl: "<?php echo $jsPath;?>marker2.png"});
	timerId = window.setInterval(function () {if (myProgressBar.value >= myProgressBar.maxValue) {myProgressBar.setValue(100);} else {myProgressBar.setValue(myProgressBar.value + 10);}},
	200);
	
}
</script>
<?php }?>