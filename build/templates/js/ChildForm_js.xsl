<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="text" indent="yes"
			doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" 
			doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
			
<xsl:template match="/">
/* Copyright (c) 2012 
	Andrey Mikhalevich, Katren ltd.
*/
/*	
	Description
*/
//ф
/** Requirements
 * @requires controls/ViewList.js
*/

/* constructor */
function ChildForm(){
	options = options||{};
	options.title=options.title||{};

	var js=[];
	var css=[];
	<xsl:apply-templates select="/metadata/jsScripts/jsScript"/>
	<xsl:apply-templates select="/metadata/cssScripts/cssScript"/>
	options.location=options.location||"0";
	options.menuBar=options.menuBar||"0";
	options.scrollBars=options.scrollBars||"1";
	options.center=(options.center==undefined)? true:options.center;
	options.status=options.status||"0";
	options.titleBar=options.titleBar||"0";
	options.content=content;	
	ChildForm.superclass.constructor.call(this,options);
}
extend(ChildForm,WindowForm);	
</xsl:template>

<xsl:template match="jsScript">js.push('<xsl:value-of select="@file"/>');
</xsl:template>

<xsl:template match="cssScript">css.push('<xsl:value-of select="@file"/>');
</xsl:template>

</xsl:stylesheet>