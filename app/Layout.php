<?php
/**
 * RWTT v2
 *
 * Basic layout
 * Built using DOMDocument
 * Stored in the registry so it can be manipulated at any point in the
 * process
 *
 * @author PJ Fiers pjfiers@gmail.com
 * @version 0.1.0
 */
$htmlDom = new DOMDocument();
$htmlDom->formatOutput = true;
$root = $htmlDom->appendChild(
    $htmlDom->createElement('html')
);
$head = $root->appendChild(
    $htmlDom->createElement('head')
);
$body = $root->appendChild(
    $htmlDom->createElement('body')
);
$content = $body->appendChild(
    $htmlDom->createElement('div')
);
$content->setAttribute('id', 'content');
$nav = $body->appendChild(
    $htmlDom->createElement('nav')
);

$registry->htmlDom = $htmlDom;
$registry->head = $head;
$registry->content = $content;
$registry->nav = $nav;

$title = $htmlDom->createElement('title', $registry->siteName);
$head->appendChild($title);
$registry->head->title = $title;

// stylesheet
$link = $htmlDom->createElement('link');
$head->appendChild($link);
$link->setAttribute('href', 'public/css/default.css');
$link->setAttribute('rel', 'stylesheet');
$link->setAttribute('type', 'text/css');

$navigation = array(
    'Blog' => 'blog'
);

foreach ($navigation as $label => $route) {
    $ahref = $nav->appendChild(
        $htmlDom->createElement('a', $label)
    );
    $ahref->setAttribute('href', $baseUrl . $route);
}