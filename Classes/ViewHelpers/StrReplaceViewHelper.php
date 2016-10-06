<?php
/**
 * Copyright notice
 * (c) 2016 Oliver Thiele <mailYYYY@oliver-thiele.de>, Web Development Oliver Theiele
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * This copyright notice MUST APPEAR in all copies of the script!
 */

namespace LeonhardBolschakow\LbOsm\ViewHelpers;

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
 * Class StrReplaceViewHelper
 *
 * @package LeonhardBolschakow\LbOsm\ViewHelpers
 */
class StrReplaceViewHelper extends AbstractViewHelper implements CompilableInterface
{

    /**
     * @param string $value string to format
     * @return string the altered string.
     */
    public function render($value = null)
    {
        return static::renderStatic(
            array(
                'value' => $value
            ),
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param \TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
     * @return string
     */
    static public function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $value = $arguments['value'];
        if ($value === null) {
            $value = $renderChildrenClosure();
        }

        $htmlTerminal = '<div id="window" class="terminal-window">
    <div id="toolbar">
        <div class="top">
            <div id="title">
                ' . $_SERVER['SERVER_NAME'] . '
            </div>
        </div>
    </div>
    <div id="body">
        <p>Last login: Thu May 24 12:18:16 on ttys006 <br />
			Olivers-MBP:~ thiele$  </p>
    ';

        $search = [
            '<b>',
            '</b>',
            '®',
            '(R)',
            '(c)',
            '[&gt;]',
            '[hr]',
            '[terminal]<br />',
            '[terminal]',
            '[/terminal]',
            '[lorem]',
            '[lorem2]',
            '[lorem-short]'
        ];
        $replace = [
            '<strong>',
            '</strong>',
            '<sup>®</sup>',
            '<sup>®</sup>',
            '<sup>©</sup>',
            '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
            '<hr />',
            $htmlTerminal,
            $htmlTerminal,
            '        <div class="cursor"></div>
    </div>
</div>',
            '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>',
            '<p>Lorem ipsum dolor sit amet, <em>consetetur sadipscing</em> elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
<blockquote>Stet clita kasd gubergren, no sea <strong>takimata sanctus</strong> est Lorem ipsum dolor sit amet.</blockquote>
<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>',
            '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>'
        ];
        $html = str_replace($search, $replace, $value);

        $pattern = '/\[btn.{0,1}(primary|default)?\]<a (href=".*")>(.*)<\/a>\[\/btn\]/U';
        $replacement = '<a ${2} class="btn btn-$1">${3}</a>';
        return preg_replace($pattern, $replacement, $html, 5, $count);
    }
}
