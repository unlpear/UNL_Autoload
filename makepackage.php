<?php
/**
 * Make package file for the UNL_Autoload package.
 * 
 * @package UNL_Autoload
 * @author Brett Bieber
 */

ini_set('display_errors',true);

/**
 * Require the PEAR_PackageFileManager2 classes, and other
 * necessary classes for package.xml file creation.
 */
require_once 'PEAR/PackageFileManager2.php';
require_once 'PEAR/PackageFileManager/File.php';
require_once 'PEAR/Task/Postinstallscript/rw.php';
require_once 'PEAR/Config.php';
require_once 'PEAR/Frontend.php';

/**
 * @var PEAR_PackageFileManager
 */
PEAR::setErrorHandling(PEAR_ERROR_DIE);
chdir(dirname(__FILE__));
$pfm = PEAR_PackageFileManager2::importOptions('package.xml', array(
//$pfm = new PEAR_PackageFileManager2();
//$pfm->setOptions(array(
    'packagedirectory' => dirname(__FILE__),
    'baseinstalldir' => '/',
    'filelistgenerator' => 'svn',
    'ignore' => array(  'package.xml',
                        '.project',
                        '*.tgz',
                        'makepackage.php',
                        '.cache'),
    'simpleoutput' => true,
    'roles'=>array('php'=>'php' ),
    'exceptions'=>array()
));
$pfm->setPackage('UNL_Autoload');
$pfm->setPackageType('php'); // this is a PEAR-style php script package
$pfm->setSummary('An autoloader implementation for UNL PEAR packages');
$pfm->setDescription('This package provides an autoloader for classes beginning
 with UNL_ and is mainly used for autoloading package files from http://pear.unl.edu/.');
$pfm->setChannel('pear.unl.edu');
$pfm->setAPIStability('alpha');
$pfm->setReleaseStability('alpha');
$pfm->setAPIVersion('0.5.0');
$pfm->setReleaseVersion('0.5.0');
$pfm->setNotes('
* First release.');

//$pfm->addMaintainer('lead','saltybeagle','Brett Bieber','brett.bieber@gmail.com');
$pfm->setLicense('BSD License', 'http://www1.unl.edu/wdn/wiki/Software_License');
$pfm->clearDeps();
$pfm->setPhpDep('5.2.0');
$pfm->setPearinstallerDep('1.4.3');

$pfm->generateContents();
if (isset($_SERVER['argv']) && $_SERVER['argv'][1] == 'make') {
    $pfm->writePackageFile();
} else {
    $pfm->debugPackageFile();
}
