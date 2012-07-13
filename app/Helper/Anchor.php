<?php
/**
 * RWTT v2
 *
 * Link helper
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */

class Rwtt_Helper_Anchor
{
    /**
     * creates a link node
     * 
     * @param array options associative array of attributes
     * @return DOMElement
     */
    public static function create($content, $options) {
        $valid = array('href', 'name', 'rel', 'rev', 'urn', 'title', 'methods');
        $registry = Rwtt_Registry::getInstance();
        $htmlDom = $registry->htmlDom;
        $linkNode = $htmlDom->createElement('a');
        if (count($options) === 0) {
            trigger_error(
                'Anchor must have atleast one option',
                E_USER_NOTICE
            );
        }
        foreach ($options as $attrib => $val) {
            if (in_array($attrib, $valid)) {
                $linkNode->setAttribute($attrib, $val);
            } else {
                trigger_error(
                    $attrib . ' is not a valid attribute of an Anchor',
                    E_USER_NOTICE
                );
            }
        }
        // if is node
        if (!is_string($content) && get_class($content) == 'DOMElement') {
            $linkNode->appendChild($content);
        } else {
            $linkNode->appendChild($htmlDom->createTextNode($content));
        }
        
        return $linkNode;
    }
}