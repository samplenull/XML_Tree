<?php
/**
 * User: Kai
 * Date: 05.05.11
 * Time: 17:22
 * new version - DOM interface using instead of xml_parser* functions
 * ! git integration now!
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

    /**
     * @return string
     */
    public function getTree(){

        return $this->finalTree;
    }


    /**
     * @param $afterSequence
     */
    public function setStringAfterNode($afterSequence) {
        $this->afterSequence = $afterSequence;
    }

    /**
     * @return string
     */
    public function getStringAfterNode() {
        return $this->afterSequence;
    }

    /**
     * @param $beforeSequence
     */
    public function setStringBeforeNode($beforeSequence) {
        $this->beforeSequence = $beforeSequence;
    }

    /**
     * @return string
     */
    public function getStringBeforeNode() {
        return $this->beforeSequence;
    }

    /**
     *
     */
    public function __destruct(){
        $this->domdoc;
    }

    /**
     * @param \DOMNode $element
     */
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

    /**
     * @param $showAttributes
     */
    public function setShowAttributes($showAttributes)
    {
        $this->showAttributes = $showAttributes;
    }

    /**
     * @return bool
     */
    public function getShowAttributes()
    {
        return $this->showAttributes;
    }

}
