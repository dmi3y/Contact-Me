<?php
// no direct access
defined('_JEXEC') or die;
JHTML::_('behavior.formvalidation');
$doc = & JFactory::getDocument();
$doc->addScript(JURI::base().'modules/mod_contactme/include/helper.js');
$doc->addStyleSheet(JURI::base().'modules/mod_contactme/include/helper.css');
//never change contactme class into the wrapping div below untill you use own javascript handling
?>
<div class="contactme<?php echo $moduleclass_sfx ?>" <?php if ($params->get('backgroundimage')): ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?>>
    <form method="post" action="<?php $uri = & JFactory::getURI(); echo $uri->toString() ?>" class="form-validate" enctype="multipart/form-data">
        <div class="contactme-row">
            <label><?php echo JText::_('MOD_CONTACTME_NAME')?>
                <input type="text" name="namefrom" class="textbox yourname" placeholder="<?php echo JText::_('MOD_CONTACTME_NAME_PLACE')?>" />
            </label>
        </div>
        <div class="contactme-row">
            <label><?php echo JText::_('MOD_CONTACTME_EMAIL')?>
                <input type="mail" name="mailfrom" class="textbox" placeholder="<?php echo JText::_('MOD_CONTACTME_EMAIL_PLACE')?>" />
            </label>
        </div>
        <div class="contactme-row">
            <label><?php echo JText::_('MOD_CONTACTME_PHONE')?>
                <input type="text" name="phonefrom" class="textbox required phonenum" placeholder="<?php echo JText::_('MOD_CONTACTME_PHONE_PLACE')?>" />
            </label>
        </div>
        <div class="contactme-row">
            <label><?php echo JText::_('MOD_CONTACTME_ATTACH')?>
                <input type="file" value="" name="attachfrom" />
            </label>
        </div>
        <div class="contactme-row">
            <label><?php echo JText::_('MOD_CONTACTME_ADD')?><br />
                <textarea type="text" name="additionaltext" class="textbox"></textarea>
            </label>
        </div>
        <div class="contactme-send">
            <input type="button" value="<?php echo JText::_('MOD_CONTACTME_SEND')?>" class="submitButton">
        </div>
        <input type="hidden" name="contactmeaction<?php echo str_replace('_:', '', $params->get('layout', 'default')) ?>" />
        <input type="hidden" name="token" value="<?php echo JUtility::getToken(); ?>" />
        <input type="hidden" name="check" value="post" />
    </form>
</div>