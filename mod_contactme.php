<?php
// no direct access
defined('_JEXEC') or die;

require_once dirname(__FILE__).DS.'include'.DS.'helper.php';
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$contactmeaction = JRequest::getInt('contactmeaction'.str_replace('_:', '', $params->get('layout', 'default')), null, 'POST');
echo '<div style="display:none">';//stupid but it makes work
if ($contactmeaction) {
    modcontactmeHelper::sendEmail($params);
}
echo '</div>';

require JModuleHelper::getLayoutPath('mod_contactme', $params->get('layout', 'default'));
