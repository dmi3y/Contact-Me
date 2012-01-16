<!--- Fast Contact Form by Joomlabyte -->

<?php
defined('_JEXEC') or die('Restricted access');
class modcontactmeHelper
{
    function sendEmail($params)
    {
        global $mainframe;
        $jAp =& JFactory::getApplication();
        if ($_POST['check'] != JUtility::getToken()) {
                if ($_POST['check'] == 'post') {
                        $jAp->enqueueMessage(JText::_('MOD_CONTACTME_NOTSUCCESS2'),'error');
                }
                return false;
        }

        $namefrom   	= JRequest::getVar('namefrom', null, 'POST');
        $mailfrom   	= JRequest::getVar('mailfrom', null, 'POST');
        $phonefrom          = JRequest::getVar('phonefrom', null, 'POST');
        $additionaltext    	= JRequest::getVar('additionaltext', null, 'POST');

        $sendmailfrom = $jAp->getCfg('mailfrom');
        $sendnamefrom  = $jAp->getCfg('fromname');
        $sendfrom 	 = array($sendmailfrom, $sendnamefrom);
        $sendmailto   = $params->get('sendmailto', $sendmailfrom);

        $attachfrom    = JRequest::getVar('attachfrom', null, 'FILES');
        if((bool)$attachfrom['name']){
                $tmp_file_path = JPATH_BASE.DS.'tmp'.DS.JFile::makeSafe($attachfrom['name']);
                JFile::upload($attachfrom['tmp_name'], $tmp_file_path);
                //@chmod($tmp_file_path, 0777);
        }

        $mailsubject = JText::_('MOD_CONTACTME_REQUESTFROM').$jAp->getCfg('sitename');
        $body = JText::_('MOD_CONTACTME_ENTERED')."\n";
        if($namefrom)
        {
            $body .= JText::_('MOD_CONTACTME_NAME').$namefrom."\n";
        }
        if($mailfrom)
        {
            $body .= JText::_('MOD_CONTACTME_EMAIL').$mailfrom."\n";
        }
        if($phonefrom)
        {
            $body .= JText::_('MOD_CONTACTME_PHONE').$phonefrom."\n";
        }
        if($additionaltext)
        {
            $body .= JText::_('MOD_CONTACTME_ADD')."\n";
            $body .= $additionaltext . "\n\n";
        }
        $uri = & JFactory::getURI();
        $body .= JText::_('MOD_CONTACTME_FROMPAGE').$uri->toString();

        $mailer =& JFactory::getMailer();
        $mailer->setSender($sendmailfrom);
        $mailer->addReplyTo($sendmailfrom);
        $mailer->addRecipient($sendmailto);
        $mailer->setBody($body);
        $mailer->setSubject($mailsubject);
        if((bool)$attachfrom['name']){
                    $mailer->addAttachment($tmp_file_path);
        }
        if ($mailer->Send() !== true) {
            $jAp->enqueueMessage(JText::_('MOD_CONTACTME_NOTSUCCESS'),'error');
        }
        else {
            $jAp->enqueueMessage(JText::_('MOD_CONTACTME_SUCCESS'));
        }
        if((bool)$attachfrom['name']){
                JFile::delete($tmp_file_path);
        }
    }
} 
?>