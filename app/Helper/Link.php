<?php
/**
 * RWTT v2
 *
 * Link helper
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */

class Rwtt_Helper_Link
{
    /**
     * creates a link node
     * 
     * @param string $href the url
     * @param string $rel  the reltype (stylesheet)
     * @param String $type the type (text/css)
     * @return DOMElement
     */
    public static function create($href, $rel, $type) {        
        $registry = Rwtt_Registry::getInstance();
        $htmlDom = $registry->htmlDom;
        $linkNode = $htmlDom->createElement('link');
        $linkNode->setAttribute('href', $href);
        $linkNode->setAttribute('rel', $rel);
        $linkNode->setAttribute('type', $type);
        
        return $linkNode;
    }
}