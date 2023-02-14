<div>Controller 1</div>
<?
p($CURRENT);
$this->arList = $LIB['ELEMENT']->Rows($CURRENT['BLOCK']['ID'], ['SECTION_BLOCK' => $CURRENT['SECTION_BLOCK']['ID']]);
$this->template('template.php');
// global $CURRENT;
