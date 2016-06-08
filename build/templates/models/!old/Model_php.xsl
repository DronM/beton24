<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="text" indent="yes"
			doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" 
			doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
			
<xsl:template match="model"><![CDATA[<?php]]>
require_once(FRAME_WORK_PATH.'basic_classes/<xsl:value-of select="@parent"/>.php');
<xsl:if test="field[@dataType='Int']">require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
</xsl:if>
<xsl:if test="field[@dataType='String']">require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
</xsl:if>
<xsl:if test="field[@dataType='Text']">require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
</xsl:if>
<xsl:if test="field[@dataType='Float']">require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
</xsl:if>
<xsl:if test="defaultOrder">require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');
</xsl:if>
class <xsl:value-of select="@id"/>_Model extends <xsl:value-of select="@parent"/>{
	public function __construct($dbLink){
		parent::__construct($dbLink);
		$this->setDbName("public");
		$this->setTableName("<xsl:value-of select="@dataTable"/>");
		<xsl:apply-templates select="field"/>		
		<xsl:apply-templates select="defaultOrder"/>
		<xsl:if test="sql">
		$this->setSelectQueryText("<xsl:value-of select="sql"/>");
		</xsl:if>				
	}
}
<![CDATA[?>]]>
</xsl:template>

<xsl:template match="model/field">
		$f_<xsl:value-of select="@id"/>=new FieldSQl<xsl:value-of select="@dataType"/>($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"<xsl:value-of select="@id"/>"
		,array(
		<xsl:if test="@required">'required'=><xsl:value-of select="@required"/></xsl:if>
		<xsl:if test="@primaryKey">
			<xsl:if test="@required">,</xsl:if>
			'primaryKey'=><xsl:value-of select="@primaryKey"/>
		</xsl:if>		
		<xsl:if test="@autoInc">
			<xsl:if test="@required or @primaryKey">,</xsl:if>
			'autoInc'=><xsl:value-of select="@autoInc"/>
		</xsl:if>		
		<xsl:if test="@alias">
			<xsl:if test="@required or @primaryKey or @autoInc">,</xsl:if>
			'alias'=>"<xsl:value-of select="@alias"/>"
		</xsl:if>		
		<xsl:if test="@length">
			<xsl:if test="@required or @primaryKey or @autoInc or @alias">,</xsl:if>
			'length'=><xsl:value-of select="@length"/>
		</xsl:if>
		<xsl:if test="@readOnly">
			<xsl:if test="@required or @primaryKey or @autoInc or @alias or @length">,</xsl:if>
			'readOnly'=><xsl:value-of select="@readOnly"/>
		</xsl:if>
		<xsl:if test="@minLength">
			<xsl:if test="@required or @primaryKey or @autoInc or @alias or @readOnly">,</xsl:if>
			'minLength'=><xsl:value-of select="@minLength"/>
		</xsl:if>
		<xsl:if test="@fieldType">
			<xsl:if test="@required or @primaryKey or @autoInc or @alias or @readOnly or @minLength">,</xsl:if>
			'fieldType'=><xsl:value-of select="@fieldType"/>
		</xsl:if>
		<xsl:if test="@defaultValue">
			<xsl:if test="@required or @primaryKey or @autoInc or @alias or @readOnly or @minLength or @fieldType">,</xsl:if>
			'defaultValue'=>"<xsl:value-of select="@defaultValue"/>"
		</xsl:if>
		<xsl:if test="@id">
			<xsl:if test="@required or @primaryKey or @autoInc or @alias or @readOnly or @minLength or @fieldType or @fieldType">,</xsl:if>
			'id'=>"<xsl:value-of select="@id"/>"
		</xsl:if>
		<xsl:if test="@lookUpDbName">
			<xsl:if test="@required or @primaryKey or @autoInc or @alias or @readOnly or @minLength or @fieldType or @fieldType or @id">,</xsl:if>
			'lookUpDbName'=>"<xsl:value-of select="@lookUpDbName"/>"
		</xsl:if>
		<xsl:if test="@lookUpTableName">
			<xsl:if test="@required or @primaryKey or @autoInc or @alias or @readOnly or @minLength or @fieldType or @fieldType or @id or @lookUpDbName">,</xsl:if>
			'lookUpTableName'=>"<xsl:value-of select="@lookUpTableName"/>"
		</xsl:if>
		<xsl:if test="@lookUpModel">
			<xsl:if test="@required or @primaryKey or @autoInc or @alias or @readOnly or @minLength or @fieldType or @fieldType or @id or @lookUpDbName or @lookUpTableName">,</xsl:if>
			'lookUpModel'=>"<xsl:value-of select="@lookUpModel"/>"
		</xsl:if>		
		<xsl:if test="@lookUpResField">
			<xsl:if test="@required or @primaryKey or @autoInc or @alias or @readOnly or @minLength or @fieldType or @fieldType or @id or @lookUpDbName or @lookUpTableName or @lookUpModel">,</xsl:if>
			'lookUpResField'=>"<xsl:value-of select="@lookUpResField"/>"
		</xsl:if>		
		
		<xsl:if test="lookUpKey">
			<xsl:if test="@required or @primaryKey or @autoInc or @alias or @readOnly or @minLength or @fieldType or @fieldType or @id or @lookUpDbName or @lookUpTableName or @lookUpModel or @lookUpResField">,</xsl:if>
			'lookUpKeys'=>array(<xsl:for-each select="lookUpKey">
			'key'=>'<xsl:value-of select="@key"/>',
			'lookUpKey'=>'<xsl:value-of select="@lookUpKey"/>'
			<xsl:if test="not(position() = last())">
				<xsl:value-of select="','"/>
			</xsl:if>
			</xsl:for-each>)
		</xsl:if>
		
		));
		$this->addField($f_<xsl:value-of select="@id"/>);
</xsl:template>

<xsl:template match="defaultOrder">
		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		<xsl:apply-templates select="field"/>
</xsl:template>
<xsl:template match="defaultOrder/field">
		$order->addField($f_<xsl:value-of select="@id"/>);
</xsl:template>

</xsl:stylesheet>