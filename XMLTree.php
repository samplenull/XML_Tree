<?php
/**
 * User: Kai
 * Date: 05.05.11
 * Time: 17:22
 * new version - DOM interface using instead of xml_parser* functions
 * ! git integration now!
 */

/**
 *  simple class for displaying xml tree with jQuery
 */
class XMLTree {

    private $stringBeforeNode;
    private $stringAfterNode;
    private $finalTree;
    private $domdoc;
    private $showAttributes;
    /**
     * @param string $xmlFilename <p>
     * source xml file for tree building
     */
    public function __construct($xmlFilename){

        $this->beforeSequence = "<ul><li>";
        $this->afterSequence = "</li></ul>";
        $this->finalTree = '';
        $this->showAttributes = true;
        $this->domdoc = new DOMDocument();
        $this->domdoc->preserveWhiteSpace = false;
        if (!$this->domdoc->load($xmlFilename))
            // TODO: ADD exception handler
            die ("DOM: cannot open xml file: " . $xmlFilename);
        $this->parseChildNodes($this->domdoc);

    }

    public function getTree(){

        return $this->finalTree;
    }




    public function setStringAfterNode($afterSequence) {
        $this->afterSequence = $afterSequence;
    }

    public function getStringAfterNode() {
        return $this->afterSequence;
    }

    public function setStringBeforeNode($beforeSequence) {
        $this->beforeSequence = $beforeSequence;
    }

    public function getStringBeforeNode() {
        return $this->beforeSequence;
    }

    public function __destruct(){
        $this->domdoc;
    }

    private function parseChildNodes(DOMNode $element)
    {
        for ($i = 0; $i < $element->childNodes->length; $i++) {
            $curNode = $element->childNodes->item($i);
            if ($curNode->nodeType == XML_TEXT_NODE)
                $this->finalTree .= ':' . $curNode->textContent;
            if ($curNode->nodeType == XML_ELEMENT_NODE) {
                $this->finalTree .= $this->beforeSequence . $curNode->nodeName;
                if ($this->showAttributes && $curNode->hasAttributes()) {
                    for ($c = 0, $attr = $curNode->attributes->item($c); $attr != NULL; $c++,
                        $attr = $curNode->attributes->item($c)) {
                        $this->finalTree .= '(' . $attr->nodeName . '=' . $attr->nodeValue . ')';
                    }
                }
                $this->parseChildNodes($curNode);
                $this->finalTree .= $this->afterSequence;
            }
        }

    }

    public function setShowAttributes($showAttributes)
    {
        $this->showAttributes = $showAttributes;
    }

    public function getShowAttributes()
    {
        return $this->showAttributes;
    }

}
