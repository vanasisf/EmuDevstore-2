<?php
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * Checks the download permission for forum post attachments.
 * 
 * @author 	Marcel Werk
 * @copyright	2001-2009 WoltLab GmbH
 * @license	WoltLab Burning Board License <http://www.woltlab.com/products/burning_board/license.php>
 * @package	com.woltlab.wbb
 * @subpackage	system.event.listener
 * @category 	Burning Board
 */
class AttachmentCheckPostPermissionListener implements EventListener {
	/**
	 * @see EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		$attachment = $eventObj->attachment;
		
		if ($attachment['containerID'] && $attachment['containerType'] == 'post') {
			// get thread
			require_once(WBB_DIR.'lib/data/thread/Thread.class.php');
			$thread = new Thread(null, null, $attachment['containerID']);
			
			// check read permission
			$thread->enter();
			
			// get board
			require_once(WBB_DIR.'lib/data/board/Board.class.php');
			$board = Board::getBoard($thread->boardID);
			
			// check download permission
			if (!$board->getPermission('canDownloadAttachment') && (!$eventObj->thumbnail || !$board->getPermission('canViewAttachmentPreview'))) {
				throw new PermissionDeniedException();
			}
		}
	}
}
?>