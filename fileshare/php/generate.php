<?php

function generateBanner() {
	return "<i><h1 id='banner'>Secureshare</h1></i>";
}

function generateHeader($content) {
	return ("<div id='header'>".$content."</div>");
}

function generateHeaderBanner() {
	return generateHeader(generateBanner());
}
?>