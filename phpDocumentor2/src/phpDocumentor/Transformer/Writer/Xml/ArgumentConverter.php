<?php
declare(strict_types=1);

/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    Mike van Riel <mike.vanriel@naenius.com>
 * @copyright 2010-2018 Mike van Riel / Naenius (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Transformer\Writer\Xml;

use phpDocumentor\Descriptor\ArgumentDescriptor;
use phpDocumentor\Descriptor\DescriptorAbstract;

/**
 * Converter used to create an XML Element representing a method or function argument.
 */
class ArgumentConverter
{
    /**
     * Exports the given reflection object to the parent XML element.
     *
     * This method creates a new child element on the given parent XML element
     * and takes the properties of the Reflection argument and sets the
     * elements and attributes on the child.
     *
     * @param \DOMElement        $parent   The parent element to augment.
     * @param ArgumentDescriptor $argument The data source.
     *
     * @return \DOMElement
     */
    public function convert(\DOMElement $parent, ArgumentDescriptor $argument)
    {
        $child = new \DOMElement('argument');
        $parent->appendChild($child);

        $child->setAttribute('line', (string) $argument->getLine());
        $child->setAttribute('by_reference', var_export($argument->isByReference(), true));
        $child->appendChild(new \DOMElement('name', $argument->getName()));
        $child->appendChild(new \DOMElement('default'))
            ->appendChild(new \DOMText((string) $argument->getDefault()));

        $child->appendChild(new \DOMElement('type', (string) $argument->getType()));

        return $child;
    }
}
