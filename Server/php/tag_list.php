<?php
include ("connection.php");

// Fetch Thread List
$query = "SELECT * FROM tags WHERE 1=1 ";
$query.= " ORDER BY score_day DESC LIMIT 49";

//echo $query;
$result = mysql_query($query, $connect) or die(" : ".mysql_error());

// XML Output
$writer = new XMLWriter();
$writer->openURI('php://output');
$writer->startDocument('1.0','UTF-8');
$writer->setIndent(4);

$writer->startElement('TAGLIST');
while($row=mysql_fetch_array($result))
{
	$writer->startElement('THREAD');
	$writer->writeAttribute('tag_srl', $row[tag_srl]);
	$writer->writeAttribute('name', $row[name]);
	$writer->writeAttribute('score_day', $row[score_day]);
	$writer->writeAttribute('score_week', $row[score_week]);
	$writer->writeAttribute('score_month', $row[score_month]);
	$writer->writeAttribute('score_year', $row[score_year]);
	$writer->endElement();
}
$writer->endElement();
$writer->endDocument();
$writer->flush();
?>