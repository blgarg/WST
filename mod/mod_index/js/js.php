<?php global $jsPath;

?>
<script type="text/javascript">
function closWin(){
 if (confirm("Close Window?")) {
  window.open('', '_self'); //bug fix
window.close();
  }

}
</script>
<script src="<?php echo $jsPath;?>jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>load.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>validateForm.js" type="text/javascript"></script>
