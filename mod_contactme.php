<?php
// no direct access
defined('_JEXEC') or die;

require_once dirname(__FILE__).DS.'include'.DS.'helper.php';
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

JHTMLBehavior::formvalidation();

$contactmeaction = JRequest::getInt('contactmeaction'.str_replace('_:', '', $params->get('layout', 'default')), null, 'POST');
echo '<div class="hdn">';			
if ($contactmeaction) {
    modcontactmeHelper::sendEmail($params);
}
echo '</div>';

require JModuleHelper::getLayoutPath('mod_contactme', $params->get('layout', 'default'));
