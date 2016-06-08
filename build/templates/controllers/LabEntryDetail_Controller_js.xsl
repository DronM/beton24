<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_js.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'LabEntryDetail'"/>
<!-- -->

<xsl:output method="text" indent="yes"
			doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" 
			doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
			
<xsl:template match="/">
	<xsl:apply-templates select="metadata/controllers/controller[@id=$CONTROLLER_ID]"/>
</xsl:template>

<xsl:template match="controller"><![CDATA[]]>/* Copyright (c) 2012 
	Andrey Mikhalevich, Katren ltd.
*/
/*	
	Description
*/
/** Requirements
 * @requires common/functions.js
 * @requires core/ControllerDb.js
*/
//ф
/* constructor */
<xsl:variable name="contr_id" select="concat(@id,'_Controller')"/>
function <xsl:value-of select="$contr_id"/>(servConnector){
	options = {};
	<xsl:if test="publicMethod[@id='get_list']/@modelId">options["listModelId"] = "<xsl:value-of select="publicMethod[@id='get_list']/@modelId"/>_Model";
	</xsl:if>
	<xsl:if test="publicMethod[@id='get_object']/@modelId">options["objModelId"] = "<xsl:value-of select="publicMethod[@id='get_object']/@modelId"/>_Model";
	</xsl:if>
	<xsl:value-of select="$contr_id"/>.superclass.constructor.call(this,"<xsl:value-of select="$contr_id"/>",servConnector,options);	
	
	//methods
	<xsl:for-each select="publicMethod">
	<xsl:choose>
	<xsl:when test="@id='insert'">this.addInsert();
	</xsl:when>
	<xsl:when test="@id='update'">this.addUpdate();
	</xsl:when>
	<xsl:when test="@id='delete'">this.addDelete();
	</xsl:when>
	<xsl:when test="@id='get_list'">this.addGetList();
	</xsl:when>
	<xsl:when test="@id='get_object'">this.addGetObject();
	</xsl:when>
	<xsl:when test="@id='complete'">this.addComplete();
	</xsl:when>	
	<xsl:otherwise>this.add_<xsl:value-of select="@id"/>();
	</xsl:otherwise>	
	</xsl:choose>
	</xsl:for-each>
}
extend(<xsl:value-of select="$contr_id"/>,ControllerDb);
<xsl:apply-templates/>
<![CDATA[]]>
LabData_Controller.prototype.addUpdate = function(){
	var pm = this.addMethodById(this.METH_UPDATE);
	pm.addParam(new Field("old_shipment_id"));
	return pm;
}

</xsl:template>

</xsl:stylesheet>