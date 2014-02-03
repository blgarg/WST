<?php if (!defined('IN_PHPBB')) exit; ?></div>



<div id="page-footer">

<div class="footer">	
<div class="footer-txt" style="width: 1357px !important;">
    	<div class="ftr-lt" > Copyright &copy; 2012 WorldSexTraveler.com. All Rights Reserved</div>
	  <div class="ftr-rt" style="float: left !important;  width: 930px !important;"><a href="http://www.worldsextraveler.com/?mod=mod_index&view=compliance">18 U.S.C. 2257 Record-Keeping Requirements Compliance Statement </a> | <a href="http://www.worldsextraveler.com/?mod=mod_index&view=termspage&s=7"> Terms</a>  | <a href="http://www.worldsextraveler.com/?mod=mod_index&view=privacypage&s=8"> Privacy</a> | <a href="http://www.worldsextraveler.com/?mod=mod_index&view=home&form=agree&s=1">Home</a></div>
    
  </div>
	<div class="copyright"><!--{ CREDIT_LINE}-->
		<?php if ($this->_rootref['TRANSLATION_INFO']) {  ?><br />{ //TRANSLATION_INFO}<?php } if ($this->_rootref['DEBUG_OUTPUT']) {  ?><br />{ //DEBUG_OUTPUT}<?php } if ($this->_rootref['U_ACP']) {  ?><br /><strong><a href="<?php echo (isset($this->_rootref['U_ACP'])) ? $this->_rootref['U_ACP'] : ''; ?>"><?php echo ((isset($this->_rootref['L_ACP'])) ? $this->_rootref['L_ACP'] : ((isset($user->lang['ACP'])) ? $user->lang['ACP'] : '{ ACP }')); ?></a></strong><?php } ?>

	</div>
</div>

<div>
	<a id="bottom" name="bottom" accesskey="z"></a>
	<?php if (! $this->_rootref['S_IS_BOT']) {  echo (isset($this->_rootref['RUN_CRON_TASK'])) ? $this->_rootref['RUN_CRON_TASK'] : ''; } ?>

</div>
</body>
</html>