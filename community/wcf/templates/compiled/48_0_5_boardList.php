<?php
/**
* WoltLab Community Framework
* Template: boardList
* Compiled at: Tue, 13 Aug 2013 11:10:45 +0000
* 
* DO NOT EDIT THIS FILE
*/
$this->v['tpl']['template'] = 'boardList';
?>
<?php
if (!isset($this->pluginObjects['TemplatePluginFunctionCycle'])) {
require_once(WCF_DIR.'lib/system/template/plugin/TemplatePluginFunctionCycle.class.php');
$this->pluginObjects['TemplatePluginFunctionCycle'] = new TemplatePluginFunctionCycle;
}
if (!isset($this->pluginObjects['TemplatePluginFunctionCounter'])) {
require_once(WCF_DIR.'lib/system/template/plugin/TemplatePluginFunctionCounter.class.php');
$this->pluginObjects['TemplatePluginFunctionCounter'] = new TemplatePluginFunctionCounter;
}
if (!isset($this->pluginObjects['TemplatePluginModifierShorttime'])) {
require_once(WCF_DIR.'lib/system/template/plugin/TemplatePluginModifierShorttime.class.php');
$this->pluginObjects['TemplatePluginModifierShorttime'] = new TemplatePluginModifierShorttime;
}
if (!isset($this->pluginObjects['TemplatePluginModifierEncodejs'])) {
require_once(WCF_DIR.'lib/system/template/plugin/TemplatePluginModifierEncodejs.class.php');
$this->pluginObjects['TemplatePluginModifierEncodejs'] = new TemplatePluginModifierEncodejs;
}
?><?php if (count($this->v['boards']) > 0) { ?>
	<script type="text/javascript" src="<?php echo RELATIVE_WBB_DIR; ?>js/BoardMarkAsRead.class.js"></script>
	<script type="text/javascript">
		//<![CDATA[
		var boards = new Hash();
		document.observe("dom:loaded", function() {
			new BoardMarkAsRead(boards);
		});
	//]]>
	</script>
	
	<?php echo $this->pluginObjects['TemplatePluginFunctionCycle']->execute(array('name' => 'boardlistCycle', 'values' => '1,2', 'advance' => false, 'print' => false), $this); ?>
	<ul id="boardlist">
		<?php
if (count($this->v['boards']) > 0) {
foreach ($this->v['boards'] as $this->v['child']) {
?>
			
			<?php $this->assign("depth", $this->v['child']['depth']); ?>
			<?php $this->assign("open", $this->v['child']['open']); ?>
			<?php $this->assign("hasChildren", $this->v['child']['hasChildren']); ?>
			<?php $this->assign("openParents", $this->v['child']['openParents']); ?>
			<?php $this->assign("board", $this->v['child']['board']); ?>
			<?php $this->assign("boardID", $this->v['board']->boardID); ?>
			<?php echo $this->pluginObjects['TemplatePluginFunctionCounter']->execute(array('assign' => 'boardNo', 'print' => false), $this); ?>
			<?php if ($this->v['board']->isBoard()) { ?>
				

				<li<?php if ($this->v['depth'] == 1) { ?> class="board border"<?php } ?>>
					<div class="boardlistInner container-<?php echo $this->pluginObjects['TemplatePluginFunctionCycle']->execute(array('name' => 'boardlistCycle'), $this); ?> board<?php echo $this->v['boardID']; ?>"<?php if ($this->v['board']->imageShowAsBackground) { ?><?php if ($this->v['board']->image || $this->v['newPosts'][$this->v['boardID']] && $this->v['board']->imageNew) { ?> style="background-image: url(<?php if ($this->v['newPosts'][$this->v['boardID']] && $this->v['board']->imageNew) { ?><?php echo StringUtil::encodeHTML($this->v['board']->imageNew); ?><?php } else { ?><?php echo StringUtil::encodeHTML($this->v['board']->image); ?><?php } ?>); background-repeat: <?php echo StringUtil::encodeHTML($this->v['board']->imageBackgroundRepeat); ?>"<?php } ?><?php } ?>>
						<div class="boardlistTitle<?php if (BOARD_LIST_ENABLE_LAST_POST && BOARD_LIST_ENABLE_STATS) { ?> boardlistCols-3<?php } else { ?><?php if (BOARD_LIST_ENABLE_LAST_POST || BOARD_LIST_ENABLE_STATS) { ?> boardlistCols-2<?php } ?><?php } ?>">
							<div class="containerIcon">
								<img id="boardIcon<?php echo $this->v['boardNo']; ?>" src="<?php if ($this->v['newPosts'][$this->v['boardID']] && $this->v['board']->imageNew &&  ! $this->v['board']->imageShowAsBackground) { ?><?php echo StringUtil::encodeHTML($this->v['board']->imageNew); ?><?php } elseif ($this->v['board']->image &&  ! $this->v['board']->imageShowAsBackground) { ?><?php echo StringUtil::encodeHTML($this->v['board']->image); ?><?php } else { ?><?php ob_start(); ?><?php echo $this->v['board']->getIconName(); ?><?php if ($this->v['newPosts'][$this->v['boardID']]) { ?>New<?php } ?>M.png<?php $_iconc4c0108280dd67ecb7c2693b51c1ca7698bcddbe = ob_get_contents(); ob_end_clean(); echo StyleManager::getStyle()->getIconPath($_iconc4c0108280dd67ecb7c2693b51c1ca7698bcddbe); ?><?php } ?>" alt="" <?php if ($this->v['newPosts'][$this->v['boardID']]) { ?>title="Forum durch Doppelklick als gelesen markieren" <?php } ?>/>
							</div>
							
							<div class="containerContent">
								<?php if ($this->v['depth'] > 3) { ?><h6 class="boardTitle"><?php } else { ?><h<?php echo $this->v['depth']+2; ?> class="boardTitle"><?php } ?>
									<a id="boardLink<?php echo $this->v['boardNo']; ?>" <?php if ($this->v['newPosts'][$this->v['boardID']]) { ?>class="new" <?php } ?>href="index.php?page=Board&amp;boardID=<?php echo $this->v['boardID']; ?><?php echo SID_ARG_2ND; ?>"><?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php echo StringUtil::encodeHTML($this->v['board']->title); ?><?php $_langee836c145e7a891591415d8bc31548b140952a17 = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_langee836c145e7a891591415d8bc31548b140952a17, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?><?php if (isset($this->v['unreadThreadsCount'][$this->v['boardID']])) { ?><span>&nbsp;(<?php echo StringUtil::formatNumeric($this->v['unreadThreadsCount'][$this->v['boardID']]); ?>)</span><?php } ?></a>
								<?php if ($this->v['depth'] > 3) { ?></h6><?php } else { ?></h<?php echo $this->v['depth']+2; ?>><?php } ?>
								<?php if ($this->v['newPosts'][$this->v['boardID']]) { ?>
									<script type="text/javascript">
										//<![CDATA[
										boards.set(<?php echo $this->v['boardNo']; ?>, {
											'boardNo': <?php echo $this->v['boardNo']; ?>,
											'boardID': <?php echo $this->v['boardID']; ?>,
											'icon': '<?php if ($this->v['board']->image &&  ! $this->v['board']->imageShowAsBackground) { ?><?php echo StringUtil::encodeHTML($this->v['board']->image); ?><?php } else { ?><?php ob_start(); ?><?php echo $this->v['board']->getIconName(); ?>M.png<?php $_iconfc338502d738df614df8dcb7d3cd164f534eb008 = ob_get_contents(); ob_end_clean(); echo StyleManager::getStyle()->getIconPath($_iconfc338502d738df614df8dcb7d3cd164f534eb008); ?><?php } ?>'
										});
										//]]>
									</script>
								<?php } ?>
								
								<?php if ($this->v['board']->description) { ?>
									<p class="boardlistDescription">
										<?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php if ($this->v['board']->allowDescriptionHtml) { ?><?php echo $this->v['board']->description; ?><?php } else { ?><?php echo StringUtil::encodeHTML($this->v['board']->description); ?><?php } ?><?php $_langf7f8a58f6e7c459d5c3c0cc1cdefc92bd79a2c5c = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_langf7f8a58f6e7c459d5c3c0cc1cdefc92bd79a2c5c, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?>
									</p>
								<?php } ?>
								
								<?php if (isset($this->v['subBoards'][$this->v['boardID']])) { ?>
									<div class="boardlistSubboards">
										<ul><?php
$this->v['tpl']['foreach']['subBoards']['total'] = count($this->v['subBoards'][$this->v['boardID']]);
$this->v['tpl']['foreach']['subBoards']['show'] = ($this->v['tpl']['foreach']['subBoards']['total'] > 0 ? true : false);
$this->v['tpl']['foreach']['subBoards']['iteration'] = 0;
if (count($this->v['subBoards'][$this->v['boardID']]) > 0) {
foreach ($this->v['subBoards'][$this->v['boardID']] as $this->v['subBoard']) {
$this->v['tpl']['foreach']['subBoards']['first'] = ($this->v['tpl']['foreach']['subBoards']['iteration'] == 0 ? true : false);
$this->v['tpl']['foreach']['subBoards']['last'] = (($this->v['tpl']['foreach']['subBoards']['iteration'] == $this->v['tpl']['foreach']['subBoards']['total'] - 1) ? true : false);
$this->v['tpl']['foreach']['subBoards']['iteration']++;
?><?php $this->assign("subBoardID", $this->v['subBoard']->boardID); ?><?php echo $this->pluginObjects['TemplatePluginFunctionCounter']->execute(array('assign' => 'boardNo', 'print' => false), $this); ?><li<?php if ($this->v['tpl']['foreach']['subBoards']['last']) { ?> class="last"<?php } ?>><?php if ($this->v['depth'] > 4) { ?><h6><?php } else { ?><h<?php echo $this->v['depth']+3; ?>><?php } ?><img id="boardIcon<?php echo $this->v['boardNo']; ?>" src="<?php ob_start(); ?><?php if ($this->v['subBoard']->isBoard()) { ?>board<?php if ($this->v['newPosts'][$this->v['subBoardID']]) { ?>New<?php } ?><?php } elseif ($this->v['subBoard']->isCategory()) { ?>category<?php } else { ?>boardRedirect<?php } ?>S.png<?php $_iconc0833d489a71ba2d7e60575374b5031370add08e = ob_get_contents(); ob_end_clean(); echo StyleManager::getStyle()->getIconPath($_iconc0833d489a71ba2d7e60575374b5031370add08e); ?>" alt="" <?php if ($this->v['subBoard']->isBoard() && $this->v['newPosts'][$this->v['subBoardID']]) { ?>title="Forum durch Doppelklick als gelesen markieren" <?php } ?>/>&nbsp;<a id="boardLink<?php echo $this->v['boardNo']; ?>" <?php if ($this->v['newPosts'][$this->v['subBoardID']]) { ?>class="new" <?php } ?><?php if ($this->v['subBoard']->isExternalLink()) { ?>class="externalURL" <?php } ?>href="index.php?page=Board&amp;boardID=<?php echo $this->v['subBoardID']; ?><?php echo SID_ARG_2ND; ?>"><?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php echo StringUtil::encodeHTML($this->v['subBoard']->title); ?><?php $_lang4235ad55f6dc441f598a3efac1be129e61e1279e = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_lang4235ad55f6dc441f598a3efac1be129e61e1279e, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?><?php if (isset($this->v['unreadThreadsCount'][$this->v['subBoardID']])) { ?> <span>(<?php echo StringUtil::formatNumeric($this->v['unreadThreadsCount'][$this->v['subBoardID']]); ?>)</span><?php } ?></a><?php if ($this->v['depth'] > 4) { ?></h6><?php } else { ?></h<?php echo $this->v['depth']+3; ?>><?php } ?><?php if ($this->v['newPosts'][$this->v['subBoardID']]) { ?><script type="text/javascript">
														//<![CDATA[
														boards.set(<?php echo $this->v['boardNo']; ?>, {
															'boardNo': <?php echo $this->v['boardNo']; ?>,
															'boardID': <?php echo $this->v['subBoardID']; ?>,
															'icon': '<?php ob_start(); ?><?php echo $this->v['subBoard']->getIconName(); ?>S.png<?php $_icon7ba02905b6bae4a1f114328127a88756c919f74f = ob_get_contents(); ob_end_clean(); echo StyleManager::getStyle()->getIconPath($_icon7ba02905b6bae4a1f114328127a88756c919f74f); ?>'
														});
														//]]>
													</script><?php } ?></li><?php } } ?></ul>
									</div>
								<?php } ?>
								
								<?php if (isset($this->v['boardUsersOnline'][$this->v['boardID']]['users']) || isset($this->v['boardUsersOnline'][$this->v['boardID']]['guests'])) { ?>
									<p class="boardlistUsersOnline">
										<img src="<?php echo StyleManager::getStyle()->getIconPath('usersS.png'); ?>" alt="" />
										<?php if (isset($this->v['boardUsersOnline'][$this->v['boardID']]['users'])) { ?>
											<?php
$_lengthdc519416625859d4ce830cdd4e6b8299be1be232 = count($this->v['boardUsersOnline'][$this->v['boardID']]['users']);
$_idc519416625859d4ce830cdd4e6b8299be1be232 = 0;
foreach ($this->v['boardUsersOnline'][$this->v['boardID']]['users'] as $this->v['userOnline']) { ?><a href="index.php?page=User&amp;userID=<?php echo $this->v['userOnline']['userID']; ?><?php echo SID_ARG_2ND; ?>"><?php echo $this->v['userOnline']['username']; ?></a><?php
if (++$_idc519416625859d4ce830cdd4e6b8299be1be232 < $_lengthdc519416625859d4ce830cdd4e6b8299be1be232) { echo ', '; }
} ?>
										<?php } ?>
										<?php if (isset($this->v['boardUsersOnline'][$this->v['boardID']]['guests'])) { ?>
											<?php if (isset($this->v['boardUsersOnline'][$this->v['boardID']]['users'])) { ?>und<?php } ?> <?php echo StringUtil::formatNumeric($this->v['boardUsersOnline'][$this->v['boardID']]['guests']); ?> Besucher
										<?php } ?>
									</p>
								<?php } ?>
								
								<?php if (isset($this->v['moderators'][$this->v['boardID']])) { ?>
									<p class="moderators">
										<img src="<?php echo StyleManager::getStyle()->getIconPath('moderatorS.png'); ?>" alt="" />
										<?php
$_lengthd2374b655a6095ae336659207264eba9de5e7c01 = count($this->v['moderators'][$this->v['boardID']]);
$_id2374b655a6095ae336659207264eba9de5e7c01 = 0;
foreach ($this->v['moderators'][$this->v['boardID']] as $this->v['moderator']) { ?><?php if ($this->v['moderator']->userID) { ?><a href="index.php?page=User&amp;userID=<?php echo $this->v['moderator']->userID; ?><?php echo SID_ARG_2ND; ?>"><?php echo StringUtil::encodeHTML($this->v['moderator']); ?></a><?php } else { ?><?php echo StringUtil::encodeHTML($this->v['moderator']); ?><?php } ?><?php
if (++$_id2374b655a6095ae336659207264eba9de5e7c01 < $_lengthd2374b655a6095ae336659207264eba9de5e7c01) { echo ', '; }
} ?>
									</p>
								<?php } ?>
								
								<?php if (isset($this->v['child']['additionalBoxes'])) { ?><?php echo $this->v['child']['additionalBoxes']; ?><?php } ?>
							</div>
						</div>
						
						<?php if (isset($this->v['lastPosts'][$this->v['boardID']])) { ?>
							<div class="boardlistLastPost">								
								<div class="containerIconSmall"><a href="index.php?page=Thread&amp;threadID=<?php echo $this->v['lastPosts'][$this->v['boardID']]->threadID; ?>&amp;action=firstNew<?php echo SID_ARG_2ND; ?>"><img src="<?php echo StyleManager::getStyle()->getIconPath('goToFirstNewPostS.png'); ?>" alt="" title="Zum ersten neuen Beitrag springen" /></a></div>
								<div class="containerContentSmall">
									<p>
										<span class="prefix"><strong><?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php echo StringUtil::encodeHTML($this->v['lastPosts'][$this->v['boardID']]->prefix); ?><?php $_lang66dab73b11cc2c94d419001874a89dbfbf7c5994 = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_lang66dab73b11cc2c94d419001874a89dbfbf7c5994, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?></strong></span>
										<a href="index.php?page=Thread&amp;threadID=<?php echo $this->v['lastPosts'][$this->v['boardID']]->threadID; ?>&amp;action=firstNew<?php echo SID_ARG_2ND; ?>"><?php echo StringUtil::encodeHTML($this->v['lastPosts'][$this->v['boardID']]->topic); ?></a>
									</p>
									<p>Von
										<?php if ($this->v['lastPosts'][$this->v['boardID']]->lastPosterID != 0) { ?>
											<a href="index.php?page=User&amp;userID=<?php echo $this->v['lastPosts'][$this->v['boardID']]->lastPosterID; ?><?php echo SID_ARG_2ND; ?>"><?php echo StringUtil::encodeHTML($this->v['lastPosts'][$this->v['boardID']]->lastPoster); ?></a>
										<?php } else { ?>
											<?php echo StringUtil::encodeHTML($this->v['lastPosts'][$this->v['boardID']]->lastPoster); ?>
										<?php } ?>
										<span class="light">(<?php echo $this->pluginObjects['TemplatePluginModifierShorttime']->execute(array($this->v['lastPosts'][$this->v['boardID']]->lastPostTime), $this); ?>)</span>
									</p>
								</div>
							</div>
						<?php } ?>
						
						<?php if (isset($this->v['boardStats'][$this->v['boardID']])) { ?>
							<div class="boardlistStats">
								<dl>
									<dt><?php if ($this->v['boardStats'][$this->v['boardID']]['threads'] == 1) { ?>Thema<?php } else { ?>Themen<?php } ?></dt>
									<dd><?php echo StringUtil::formatNumeric($this->v['boardStats'][$this->v['boardID']]['threads']); ?></dd>
									<dt><?php if ($this->v['boardStats'][$this->v['boardID']]['posts'] == 1) { ?>Beitrag<?php } else { ?>Beiträge<?php } ?></dt>
									<dd><?php echo StringUtil::formatNumeric($this->v['boardStats'][$this->v['boardID']]['posts']); ?></dd>
								</dl>
							</div>
						<?php } ?>
						<!--[if IE 7]><span> </span><![endif]-->
					</div>
			<?php } ?>
			
			<?php if ($this->v['board']->isCategory()) { ?>
				
				<?php echo $this->pluginObjects['TemplatePluginFunctionCycle']->execute(array('name' => 'boardlistCycle', 'advance' => false, 'print' => false, 'reset' => true), $this); ?>
				<li<?php if ($this->v['depth'] == 1) { ?> class="category border"<?php } ?>>
					<div class="containerHead boardlistInner board<?php echo $this->v['boardID']; ?>"<?php if ($this->v['board']->imageShowAsBackground) { ?><?php if ($this->v['board']->image || $this->v['newPosts'][$this->v['boardID']] && $this->v['board']->imageNew) { ?> style="background-image: url(<?php if ($this->v['newPosts'][$this->v['boardID']] && $this->v['board']->imageNew) { ?><?php echo StringUtil::encodeHTML($this->v['board']->imageNew); ?><?php } else { ?><?php echo StringUtil::encodeHTML($this->v['board']->image); ?><?php } ?>); background-repeat: <?php echo StringUtil::encodeHTML($this->v['board']->imageBackgroundRepeat); ?>"<?php } ?><?php } ?>>
						<div class="boardlistTitle">
							<div class="containerIcon">
								<?php if ($this->v['open']) { ?>
									<?php ob_start(); ?>Kategorie: &raquo;<?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php echo StringUtil::encodeHTML($this->v['board']->title); ?><?php $_langf1e8edcc3017ecb0a407a738f3e75c9ea97ba086 = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_langf1e8edcc3017ecb0a407a738f3e75c9ea97ba086, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?>&laquo; öffnen<?php
$this->v['tpl']['capture']['default'] = ob_get_contents();
ob_end_clean();
$this->assign('showCategoryTitle', $this->v['tpl']['capture']['default']);
?>
									<?php ob_start(); ?>Kategorie: &raquo;<?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php echo StringUtil::encodeHTML($this->v['board']->title); ?><?php $_lang1192ed23f8e6114b0803efe58977845a3589b29a = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_lang1192ed23f8e6114b0803efe58977845a3589b29a, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?>&laquo; schließen<?php
$this->v['tpl']['capture']['default'] = ob_get_contents();
ob_end_clean();
$this->assign('hideCategoryTitle', $this->v['tpl']['capture']['default']);
?>
									<a href="<?php echo StringUtil::encodeHTML($this->v['selfLink']); ?>&amp;closeCategory=<?php echo $this->v['boardID']; ?><?php echo SID_ARG_2ND; ?>#boardLink<?php echo $this->v['boardNo']; ?>" onclick="return !openList('category<?php echo $this->v['boardID']; ?>', { save: true, openTitle: '<?php echo $this->pluginObjects['TemplatePluginModifierEncodejs']->execute(array($this->v['showCategoryTitle']), $this); ?>', closeTitle: '<?php echo $this->pluginObjects['TemplatePluginModifierEncodejs']->execute(array($this->v['hideCategoryTitle']), $this); ?>' })"><img id="category<?php echo $this->v['boardID']; ?>Image" src="<?php echo StyleManager::getStyle()->getIconPath('minusS.png'); ?>" alt="" title="Kategorie: &raquo;<?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php echo StringUtil::encodeHTML($this->v['board']->title); ?><?php $_lang3194acc5a505a3fa54887afec39729e4a318712b = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_lang3194acc5a505a3fa54887afec39729e4a318712b, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?>&laquo; schließen" /></a>
								<?php } else { ?>
									<a href="<?php echo StringUtil::encodeHTML($this->v['selfLink']); ?>&amp;openCategory=<?php echo $this->v['boardID']; ?><?php echo SID_ARG_2ND; ?>#boardLink<?php echo $this->v['boardNo']; ?>"><img src="<?php echo StyleManager::getStyle()->getIconPath('plusS.png'); ?>" alt="" title="Kategorie: &raquo;<?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php echo StringUtil::encodeHTML($this->v['board']->title); ?><?php $_lang810b3fa80fcf35b1704a2b951f0689e23276211a = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_lang810b3fa80fcf35b1704a2b951f0689e23276211a, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?>&laquo; öffnen" /></a>
								<?php } ?>
							</div>
							<div class="containerContent">
								<?php if ($this->v['depth'] > 3) { ?><h6 class="boardTitle"><?php } else { ?><h<?php echo $this->v['depth']+2; ?> class="boardTitle"><?php } ?>
									<a id="boardLink<?php echo $this->v['boardNo']; ?>" <?php if ($this->v['newPosts'][$this->v['boardID']]) { ?>class="new" <?php } ?>href="index.php?page=Board&amp;boardID=<?php echo $this->v['boardID']; ?><?php echo SID_ARG_2ND; ?>"><?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php echo StringUtil::encodeHTML($this->v['board']->title); ?><?php $_lang363bd07f6b7381f6b44b202918152d36d46ab59e = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_lang363bd07f6b7381f6b44b202918152d36d46ab59e, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?><?php if (isset($this->v['unreadThreadsCount'][$this->v['boardID']])) { ?> (<?php echo StringUtil::formatNumeric($this->v['unreadThreadsCount'][$this->v['boardID']]); ?>)<?php } ?></a>
								<?php if ($this->v['depth'] > 3) { ?></h6><?php } else { ?></h<?php echo $this->v['depth']+2; ?>><?php } ?>
								<?php if ($this->v['board']->description) { ?>
									<p class="boardlistDescription">
										<?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php if ($this->v['board']->allowDescriptionHtml) { ?><?php echo $this->v['board']->description; ?><?php } else { ?><?php echo StringUtil::encodeHTML($this->v['board']->description); ?><?php } ?><?php $_lang1095d4b05fc12a965a978394859dc41398a60c7a = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_lang1095d4b05fc12a965a978394859dc41398a60c7a, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?>
									</p>
								<?php } ?>
								
								<?php if (isset($this->v['subBoards'][$this->v['boardID']])) { ?>
									<div class="boardlistSubboards">
										<ul><?php
$this->v['tpl']['foreach']['subBoards']['total'] = count($this->v['subBoards'][$this->v['boardID']]);
$this->v['tpl']['foreach']['subBoards']['show'] = ($this->v['tpl']['foreach']['subBoards']['total'] > 0 ? true : false);
$this->v['tpl']['foreach']['subBoards']['iteration'] = 0;
if (count($this->v['subBoards'][$this->v['boardID']]) > 0) {
foreach ($this->v['subBoards'][$this->v['boardID']] as $this->v['subBoard']) {
$this->v['tpl']['foreach']['subBoards']['first'] = ($this->v['tpl']['foreach']['subBoards']['iteration'] == 0 ? true : false);
$this->v['tpl']['foreach']['subBoards']['last'] = (($this->v['tpl']['foreach']['subBoards']['iteration'] == $this->v['tpl']['foreach']['subBoards']['total'] - 1) ? true : false);
$this->v['tpl']['foreach']['subBoards']['iteration']++;
?><?php $this->assign("subBoardID", $this->v['subBoard']->boardID); ?><?php echo $this->pluginObjects['TemplatePluginFunctionCounter']->execute(array('assign' => 'boardNo', 'print' => false), $this); ?><li<?php if ($this->v['tpl']['foreach']['subBoards']['last']) { ?> class="last"<?php } ?>><?php if ($this->v['depth'] > 4) { ?><h6><?php } else { ?><h<?php echo $this->v['depth']+3; ?>><?php } ?><img id="boardIcon<?php echo $this->v['boardNo']; ?>" src="<?php ob_start(); ?><?php if ($this->v['subBoard']->isBoard()) { ?>board<?php if ($this->v['newPosts'][$this->v['subBoardID']]) { ?>New<?php } ?><?php } elseif ($this->v['subBoard']->isCategory()) { ?>category<?php } else { ?>boardRedirect<?php } ?>S.png<?php $_icon978e8570362647cc6e92b15aec7cb3e9d8b6c78c = ob_get_contents(); ob_end_clean(); echo StyleManager::getStyle()->getIconPath($_icon978e8570362647cc6e92b15aec7cb3e9d8b6c78c); ?>" alt="" <?php if ($this->v['subBoard']->isBoard() && $this->v['newPosts'][$this->v['subBoardID']]) { ?>title="Forum durch Doppelklick als gelesen markieren" <?php } ?>/>&nbsp;<a id="boardLink<?php echo $this->v['boardNo']; ?>" <?php if ($this->v['newPosts'][$this->v['subBoardID']]) { ?>class="new" <?php } ?><?php if ($this->v['subBoard']->isExternalLink()) { ?>class="externalURL" <?php } ?>href="index.php?page=Board&amp;boardID=<?php echo $this->v['subBoardID']; ?><?php echo SID_ARG_2ND; ?>"><?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php echo StringUtil::encodeHTML($this->v['subBoard']->title); ?><?php $_lange10702c386e3ebdd51d45ef8cb8f3363e5f78bdc = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_lange10702c386e3ebdd51d45ef8cb8f3363e5f78bdc, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?><?php if (isset($this->v['unreadThreadsCount'][$this->v['subBoardID']])) { ?> <span>(<?php echo StringUtil::formatNumeric($this->v['unreadThreadsCount'][$this->v['subBoardID']]); ?>)</span><?php } ?></a><?php if ($this->v['depth'] > 4) { ?></h6><?php } else { ?></h<?php echo $this->v['depth']+3; ?>><?php } ?><?php if ($this->v['newPosts'][$this->v['subBoardID']]) { ?><script type="text/javascript">
															//<![CDATA[
															boards.set(<?php echo $this->v['boardNo']; ?>, {
																'boardNo': <?php echo $this->v['boardNo']; ?>,
																'boardID': <?php echo $this->v['subBoardID']; ?>,
																'icon': '<?php ob_start(); ?><?php echo $this->v['subBoard']->getIconName(); ?>S.png<?php $_icon187ee98678c0c8186413e88cab6f5095502d28cd = ob_get_contents(); ob_end_clean(); echo StyleManager::getStyle()->getIconPath($_icon187ee98678c0c8186413e88cab6f5095502d28cd); ?>'
															});
															//]]>
														</script><?php } ?></li><?php } } ?></ul>
									</div>
								<?php } ?>
								
								<?php if (isset($this->v['child']['additionalBoxes'])) { ?><?php echo $this->v['child']['additionalBoxes']; ?><?php } ?>
							</div>
						</div>
					</div>
			<?php } ?>
			
			<?php if ($this->v['board']->isExternalLink()) { ?>	
				
				<li<?php if ($this->v['depth'] == 1) { ?> class="link border"<?php } ?>>
					<div class="container-<?php echo $this->pluginObjects['TemplatePluginFunctionCycle']->execute(array('name' => 'boardlistCycle'), $this); ?> boardlistInner board<?php echo $this->v['boardID']; ?>"<?php if ($this->v['board']->imageShowAsBackground && $this->v['board']->image) { ?> style="background-image: url(<?php echo StringUtil::encodeHTML($this->v['board']->image); ?>); background-repeat: <?php echo StringUtil::encodeHTML($this->v['board']->imageBackgroundRepeat); ?>"<?php } ?>>
						<div class="boardlistTitle<?php if (BOARD_LIST_ENABLE_LAST_POST && BOARD_LIST_ENABLE_STATS) { ?> boardlistCols-3<?php } else { ?><?php if (BOARD_LIST_ENABLE_LAST_POST || BOARD_LIST_ENABLE_STATS) { ?> boardlistCols-2<?php } ?><?php } ?>">
							<div class="containerIcon">
								<img src="<?php if ($this->v['board']->image &&  ! $this->v['board']->imageShowAsBackground) { ?><?php echo StringUtil::encodeHTML($this->v['board']->image); ?><?php } else { ?><?php echo StyleManager::getStyle()->getIconPath('boardRedirectM.png'); ?><?php } ?>" alt="" />
							</div>
							<div class="containerContent">
								<?php if ($this->v['depth'] > 3) { ?><h6 class="boardTitle"><?php } else { ?><h<?php echo $this->v['depth']+2; ?> class="boardTitle"><?php } ?>
									<a href="index.php?page=Board&amp;boardID=<?php echo $this->v['boardID']; ?><?php echo SID_ARG_2ND; ?>" class="externalURL"><?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php echo StringUtil::encodeHTML($this->v['board']->title); ?><?php $_lange52cf64dcec61fb9d7ba10f15d49e3005799219d = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_lange52cf64dcec61fb9d7ba10f15d49e3005799219d, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?></a>
								<?php if ($this->v['depth'] > 3) { ?></h6><?php } else { ?></h<?php echo $this->v['depth']+2; ?>><?php } ?>
								
								<?php if ($this->v['board']->description) { ?>
									<p class="boardlistDescription">
										<?php $this->tagStack[] = array('lang', array()); ob_start(); ?><?php if ($this->v['board']->allowDescriptionHtml) { ?><?php echo $this->v['board']->description; ?><?php } else { ?><?php echo StringUtil::encodeHTML($this->v['board']->description); ?><?php } ?><?php $_lang5a6217fb4303a2fefffa5e27105a2559aea31fc8 = ob_get_contents(); ob_end_clean(); echo WCF::getLanguage()->getDynamicVariable($_lang5a6217fb4303a2fefffa5e27105a2559aea31fc8, $this->tagStack[count($this->tagStack) - 1][1]); array_pop($this->tagStack); ?>
									</p>
								<?php } ?>
								
								<?php if (isset($this->v['child']['additionalBoxes'])) { ?><?php echo $this->v['child']['additionalBoxes']; ?><?php } ?>
							</div>
						</div>
						
						<?php if (isset($this->v['boardStats'][$this->v['boardID']])) { ?>
							<div class="boardlistStats">
								<dl>
									<dt>Zugriffe</dt>
									<dd><?php echo StringUtil::formatNumeric($this->v['board']->getClicks()); ?></dd>
								</dl>
							</div>
						<?php } ?>
					</div>
			<?php } ?>
			
			<?php if ($this->v['hasChildren']) { ?><ul id="category<?php echo $this->v['boardID']; ?>"><?php } else { ?></li><?php } ?>
			<?php if ($this->v['openParents'] > 0) { ?><?php echo str_repeat("</ul></li>",$this->v['openParents']); ?><?php } ?>
		<?php } } ?>
	</ul>
<?php } ?>