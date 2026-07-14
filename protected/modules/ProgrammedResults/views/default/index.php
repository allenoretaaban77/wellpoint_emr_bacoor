<?php
$this->breadcrumbs=array(
    $this->module->id,
);
?>
<h1>Programmed Results</h1>

<span>Select from Available Programmed Results</span><br/>

<style>
.results li{
    padding:5px;
}
</style>

<div>
    <ul class="results">
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagResBloodchemsi/admin',array()) ?>" >Blood Chemistry Result (SI)</a>
        </li>
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagResBloodchem/admin',array()) ?>" >Blood Chemistry Result (Conventional)</a>
        </li>
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagUrinalysis/admin',array()) ?>" >Urinalysis</a>
        </li>
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagFecalysis/admin',array()) ?>" >Fecalysis</a>
        </li>
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagHematology/admin',array()) ?>" >Hematology</a>
        </li>
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagRapidtest/admin',array()) ?>" >Rapid COVID-19 Test</a>
        </li>
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagRapidantigentest/admin',array()) ?>" >Rapid Antigen Test (SWAB)</a>
        </li>   
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagRapidantigentestsaliva/admin',array()) ?>" >Rapid Antigen Test (SALIVA)</a>
        </li>  
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagHiv/admin',array()) ?>" >HIV Antibodies</a>
        </li>       
    </ul>
</div>