<?php

namespace App\Model;

class ImageStorage extends \Nette\Object {

    /** @var string */
    private $imageDirFs;

    /** @var string */
    private $imageDirWww;

    /** @var array velikost obrazku - large */
    private $sizeLarge = array('width' => IMAGE_SIZE_LARGE_WIDTH, 'height' => IMAGE_SIZE_LARGE_HEIGHT);

    /** @var array velikost obrazku - normal */
    private $sizeNormal = array('width' => IMAGE_SIZE_NORMAL_WIDTH, 'height' => IMAGE_SIZE_NORMAL_HEIGHT);

    /** @var array velikost obrazku - small */
    private $sizeSmall = array('width' => IMAGE_SIZE_SMALL_WIDTH, 'height' => IMAGE_SIZE_SMALL_HEIGHT);

    /**
     * 
     * @param string $imageDirFs cesta k obrazkum
     */
    public function __construct($imageDirFs, $imageDirWww, $imageMasterDir) {
        $this->imageDirFs = $imageDirFs . $imageMasterDir;
        $this->imageDirWww = $imageDirWww . $imageMasterDir;
    }

    /**
     * vrati filesystem cestu k obrazku
     * 
     * @param string $file nazev souboru
     * @param string $appendDir pripadny dalsi adresar, ktery chceme pripojit za $imageMasterDir z konstruktoru
     * @param string $renameIfExists zda pri tvoreni cesty otestovat, jestli soubor jiz neexistuje a pokud ano, tak zda jej prejmenovavat nebo ne
     * @return string
     */
    public function getFsPath($file, $appendDir = '/', $renameIfExists = false) {
        return $this->getPath('fs', '/', $file, $appendDir, $renameIfExists);
    }

    /**
     * vrati filesystem cestu k obrazku - velikost obrazku LARGE
     * 
     * @param string $file nazev souboru
     * @param string $appendDir pripadny dalsi adresar, ktery chceme pripojit za $imageMasterDir z konstruktoru
     * @param string $renameIfExists zda pri tvoreni cesty otestovat, jestli soubor jiz neexistuje a pokud ano, tak zda jej prejmenovavat nebo ne
     * @return string
     */
    public function getFsPathLarge($file, $appendDir = '/', $renameIfExists = false) {
        return $this->getPath('fs', '/large', $file, $appendDir, $renameIfExists);
    }

    /**
     * vrati filesystem cestu k obrazku - velikost obrazku NORMAL
     * 
     * @param string $file nazev souboru
     * @param string $appendDir pripadny dalsi adresar, ktery chceme pripojit za $imageMasterDir z konstruktoru
     * @param string $renameIfExists zda pri tvoreni cesty otestovat, jestli soubor jiz neexistuje a pokud ano, tak zda jej prejmenovavat nebo ne
     * @return string
     */
    public function getFsPathNormal($file, $appendDir = '/', $renameIfExists = false) {
        return $this->getPath('fs', '/normal', $file, $appendDir, $renameIfExists);
    }

    /**
     * vrati filesystem cestu k obrazku - velikost obrazku SMALL
     * 
     * @param string $file nazev souboru
     * @param string $appendDir pripadny dalsi adresar, ktery chceme pripojit za $imageMasterDir z konstruktoru
     * @param string $renameIfExists zda pri tvoreni cesty otestovat, jestli soubor jiz neexistuje a pokud ano, tak zda jej prejmenovavat nebo ne
     * @return string
     */
    public function getFsPathSmall($file, $appendDir = '/', $renameIfExists = false) {
        return $this->getPath('fs', '/small', $file, $appendDir, $renameIfExists);
    }

    /**
     * vrati webovou cestu k obrazku (napr. pro zobrazeni v prohlizeci)
     * 
     * @param string $file nazev souboru
     * @param string $appendDir pripadny dalsi adresar, ktery chceme pripojit za $imageMasterDir z konstruktoru
     * @return string
     */
    public function getWwwPath($file, $appendDir = '/') {
        return $this->getPath('www', '/', $file, $appendDir, false);
    }

    /**
     * vrati webovou cestu k obrazku (napr. pro zobrazeni v prohlizeci) - velikost LARGE
     * 
     * @param string $file nazev souboru
     * @param string $appendDir pripadny dalsi adresar, ktery chceme pripojit za $imageMasterDir z konstruktoru
     * @return string
     */
    public function getWwwPathLarge($file, $appendDir = '/') {
        return $this->getPath('www', '/large', $file, $appendDir, false);
    }

    /**
     * vrati webovou cestu k obrazku (napr. pro zobrazeni v prohlizeci) - velkost NORMAL
     * 
     * @param string $file nazev souboru
     * @param string $appendDir pripadny dalsi adresar, ktery chceme pripojit za $imageMasterDir z konstruktoru
     * @return string
     */
    public function getWwwPathNormal($file, $appendDir = '/') {
        return $this->getPath('www', '/normal', $file, $appendDir, false);
    }

    /**
     * vrati webovou cestu k obrazku (napr. pro zobrazeni v prohlizeci) - velikost SMALL
     * 
     * @param string $file nazev souboru
     * @param string $appendDir pripadny dalsi adresar, ktery chceme pripojit za $imageMasterDir z konstruktoru
     * @return string
     */
    public function getWwwPathSmall($file, $appendDir = '/') {
        return $this->getPath('www', '/small', $file, $appendDir, false);
    }

    /**
     * vrati velikost pro upravu obrazku - large
     * nastaveno v config.neon
     * 
     * @return array
     */
    public function getSizeLarge() {
        return $this->getSize('large', 'array');
    }

    /**
     * vrati velikost (sirku) pro upravu obrazku - large
     * nastaveno v config.neon
     * 
     * @return array
     */
    public function getSizeLargeWidth() {
        return $this->getSize('large', 'width');
    }

    /**
     * vrati velikost (vysku) pro upravu obrazku - large
     * nastaveno v config.neon
     * 
     * @return array
     */
    public function getSizeLargeHeight() {
        return $this->getSize('large', 'height');
    }

    /**
     * vrati velikost pro upravu obrazku - normal
     * nastaveno v config.neon
     * 
     * @return array
     */
    public function getSizeNormal() {
        return $this->getSize('normal', 'array');
    }

    /**
     * vrati velikost (sirku) pro upravu obrazku - normal
     * nastaveno v config.neon
     * 
     * @return array
     */
    public function getSizeNormalWidth() {
        return $this->getSize('normal', 'width');
    }

    /**
     * vrati velikost (vysku) pro upravu obrazku - normal
     * nastaveno v config.neon
     * 
     * @return array
     */
    public function getSizeNormalHeight() {
        return $this->getSize('normal', 'height');
    }

    /**
     * vrati velikost pro upravu obrazku - small
     * nastaveno v config.neon
     * 
     * @return array
     */
    public function getSizeSmall() {
        return $this->getSize('small', 'array');
    }

    /**
     * vrati velikost (sirku) pro upravu obrazku - small
     * nastaveno v config.neon
     * 
     * @return array
     */
    public function getSizeSmallWidth() {
        return $this->getSize('small', 'width');
    }

    /**
     * vrati velikost (vysku) pro upravu obrazku - small
     * nastaveno v config.neon
     * 
     * @return array
     */
    public function getSizeSmallHeight() {
        return $this->getSize('small', 'height');
    }

    //========================================================== PRIVATE =======================================================================
    /**
     * vrati cestu k obrazku podle parametru
     * 
     * @param string $pathType jaky typ cesty chceme (filesystem - fs, webovou - www)
     * @param string $pathSize jakou velikost obrazku hledame 
     * @param string $file nazev souboru
     * @param string $appendDir pripadny dalsi adresar, ktery chceme pripojit za $imageMasterDir z konstruktoru
     * @param string $renameIfExists zda pri tvoreni cesty otestovat, jestli soubor jiz neexistuje a pokud ano, tak zda jej prejmenovavat nebo ne
     * @return string
     */
    private function getPath($pathType, $pathSize, $file, $appendDir, $renameIfExists) {
        if ('fs' == $pathType) {
            #-- zjistime si cestu
            $returnPath = $this->imageDirFs . $appendDir . rtrim($pathSize, '/') . '/' . $file;

            #-- pokud chceme testovat, zda uz soubor existuje (a prepsat ho)
            if (true == $renameIfExists) {
                if (file_exists($returnPath)) {
                    rename($returnPath, $returnPath . '_' . time());
                }
            }
        } elseif ('www' == $pathType) {
            #-- zjistime si cestu
            $returnPath = $this->imageDirWww . $appendDir . rtrim($pathSize, '/') . '/' . $file;
        }

        #-- a vratime cestu
        return $returnPath;
    }

    /**
     * vrati definovane velikosti obrazku, nastaveno v config.neon
     * 
     * @param type $sizeType jakou velikost chceme (large, normal, small)
     * @param type $infoType co vratit (cele pole - array, jen sirku - width, jen vysku - height)
     * @return mixed (array, int)
     */
    private function getSize($sizeType, $infoType) {
        $return = '';

        switch ($sizeType) {
            case 'large':
                $return = (($infoType == 'array') ? $this->sizeLarge : ($infoType == 'width') ? $this->sizeLarge['width'] : $this->sizeLarge['height']);
                break;
            case 'normal':
                $return = (($infoType == 'array') ? $this->sizeNormal : ($infoType == 'width') ? $this->sizeNormal['width'] : $this->sizeNormal['height']);
                break;
            case 'small':
                $return = (($infoType == 'array') ? $this->sizeSmall : ($infoType == 'width') ? $this->sizeSmall['width'] : $this->sizeSmall['height']);
                break;
        }

        return $return;
    }

}
