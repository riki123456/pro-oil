<?php

namespace App\Modules\Front\Presenters;

use App\Modules\Base\Presenters;

/**
 * Description of Cron
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
class CronPresenter extends Presenters\BasePresenter {

    /** @var \App\Model\ImageStorage @inject */
    public $imageStorage;

    /** @var \Nette\Mail\IMailer @inject */
    public $mailer;

    /**
     * kontroluje, zda mame pro polozky obrazky. O vysledku posila take mail.
     * Vraci tyto stavy:
     * 1. existuje - je definovan v db a existuje na disku
     * 2. neni vyplnen v db - info uzivateli, ze by mel doplnit
     * 3. je vyplnen v db, ale neni na disku - error uzivateli, ze MUSI doplnit
     * 
     * @param bool $manuallyCall zda volam skript manualne (pak i vykresluju view)
     */
    public function actionTestImages($manuallyCall) {
        // informace o poctu - dle vysledku
        $images_ok = 0;
        $images_warning = 0;
        $images_err = 0;

        #-- pole pro vypsani error obrazku
        $images_err_array = array();

        #-- a jedeme
        foreach ($this->repository->findAll('polozka')->fetchAll() as $p) {
            #-- v db neni nastaveno, dam info
            if ('' == $p->img) {
                $images_warning++;
            } else {
                #-- je vyplnen a neexistuje - error
                if (false == file_exists($this->imageStorage->getFsPath($p->img, '/items'))) {
                    $images_err++;
                    array_push($images_err_array, "ID polozky: $p->id, NAZEV: $p->nazev, OBRAZEK: $p->img");
                }
                #-- vse ok
                else {
                    $images_ok++;
                }
            }
        }

        #-- ulozime pripadny error do souboru (a poslem info mailem)
        if (!empty($images_err_array)) {
            #-- ulozime
            $filename = $this->getPresenter()->context->getParameters()['tempDir'] . '/images-control-' . date('Y-m-d') . '.err';
            $f = fopen($filename, 'w');
            foreach ($images_err_array as $i) {
                fwrite($f, $i . "\n");
            }
            fclose($f);

            #-- poslem
            $mail = new \Nette\Mail\Message();
            $mail->setFrom(MAIL_NOREPLY);
            //$mail->addTo(MAIL_PRODEJCE);
            $mail->addTo(MAIL_ESHOP);
            $mail->addBcc(MAIL_ADMIN);
            $mail->setSubject('CRON - kontrola obrázků u položek');

            $msg = '<p>V databázi byly nalezeny odkazy na neexistující obrázky!</p><p>Je třeba urgentně napravit</p>';
            $msg.= '<br/><br/>';
            $msg.= '<p>Detailnější informace jsou zaslány v příloze.</p>';
            $mail->setHtmlBody($msg);
            $mail->addAttachment($filename);

            try {
                $this->mailer->send($mail);
            } catch (\Exception $e) {
                trigger_error($e->getMessage(), E_USER_WARNING);
            }
        }

        #-- message
        $msg = 'Kontrola obrázků skončila. V rámci úlohy bylo zjištěno:<br/>';
        $msg.= 'Existujících (a správně v databázi nastavených) obrázků: ' . $images_ok . '<br/>';
        $msg.= 'V databázi nenastavených (bylo by lepší doplnit - kvůli zbozi.cz, heureka.cz apod.): ' . $images_warning . '<br/>';
        $msg.= 'Neexistujících (máme nastaveno v db, ale obrázek neexistuje!): ' . $images_err . '. Seznam lze nalezt zde: ' . $filename . '<br/>';

        #-- vzdy ulozime do db
        $this->saveCronActionToDb($msg, $manuallyCall);

        #-- vysledna akce -> dle toho, zda generujem manualne nebo cronem
        $this->returnAction($msg, FLASH_OK, $manuallyCall);
    }

    /**
     * obsluhuje generovani ruznych velikosti obrazku + pridava "watermark"
     * 
     * @param bool $manuallyCall zda volam skript manualne (pak i vykresluju view)
     */
    public function actionResizeImages($manuallyCall) {
        #-- projdeme adresar s obrazky a ty, ktere nemaji udelane resize, tak upravime
        $counter_large = 0;
        $counter_normal = 0;
        $counter_small = 0;
        $files = scandir($this->imageStorage->getFsPath('', '/items'));

        #-- pro vsechny file
        foreach ($files as $f) {
            $file = $this->imageStorage->getFsPath($f, '/items');

            if (is_file($file)) {
                #-- muzeme mit stare obrazky, ktere uz jsem prepsal
                #-- pozname je tak, ze za priponou maji "_[0-9]+"
                #-- ty zpracovavat nechceme
                if (preg_match('/^.*_[0-9]+$/', $file)) {
                    continue;
                }

                #-- large
                if (false == file_exists($this->imageStorage->getFsPathLarge($f, '/items'))) {
                    $watermark = \Nette\Utils\Image::fromFile($this->imageStorage->getFsPath('watermark.png', '/layout'));
                    $cropImage = \Nette\Utils\Image::fromFile($file);
                    $cropImage->resize($this->imageStorage->getSizeLargeWidth(), $this->imageStorage->getSizeLargeHeight(), \Nette\Utils\Image::ENLARGE);

                    #-- zjistime si velikost obrazku a pripadne prizpusobime watermark
                    $width = ($cropImage->width * 0.8);
                    if ($width < 1600) {
                        $watermark->resize($width, NULL);
                    }

                    $cropImage->place($watermark, '50%', '50%');
                    $cropImage->saveAlpha(true);
                    $cropImage->save($this->imageStorage->getFsPathLarge($f, '/items', true));

                    #-- zvysime counter
                    $counter_large++;
                }

                #-- normal
                if (false == file_exists($this->imageStorage->getFsPathNormal($f, '/items'))) {
                    $watermark = \Nette\Utils\Image::fromFile($this->imageStorage->getFsPath('watermark.png', '/layout'));
                    $cropImage = \Nette\Utils\Image::fromFile($file);
                    $cropImage->resize($this->imageStorage->getSizeNormalWidth(), $this->imageStorage->getSizeNormalHeight(), \Nette\Utils\Image::ENLARGE);

                    #-- zjistime si velikost obrazku a pripadne prizpusobime watermark
                    $width = ($cropImage->width * 0.8);
                    if ($width < 1600) {
                        $watermark->resize($width, NULL);
                    }

                    $cropImage->place($watermark, '50%', '50%');
                    $cropImage->saveAlpha(true);
                    $cropImage->save($this->imageStorage->getFsPathNormal($f, '/items', true));

                    #-- zvysime counter
                    $counter_normal++;
                }

                #-- small
                if (false == file_exists($this->imageStorage->getFsPathSmall($f, '/items'))) {
                    $watermark = \Nette\Utils\Image::fromFile($this->imageStorage->getFsPath('watermark.png', '/layout'));
                    $cropImage = \Nette\Utils\Image::fromFile($file);
                    $cropImage->resize($this->imageStorage->getSizeSmallWidth(), $this->imageStorage->getSizeSmallHeight(), \Nette\Utils\Image::ENLARGE);

                    #-- zjistime si velikost obrazku a pripadne prizpusobime watermark
                    $width = ($cropImage->width * 0.8);
                    if ($width < 1600) {
                        $watermark->resize($width, NULL);
                    }

                    $cropImage->place($watermark, '50%', '50%');
                    $cropImage->saveAlpha(true);
                    $cropImage->save($this->imageStorage->getFsPathSmall($f, '/items', true));

                    #-- zvysime counter
                    $counter_small++;
                }
            }
        }

        #-- message
        $msg = 'Generování obrázků skončilo. V rámci úlohy bylo vygenerováno:<br/>';
        $msg.= 'Velkých obrázků: ' . $counter_large . '<br/>';
        $msg.= 'Středních obrázků: ' . $counter_normal . '<br/>';
        $msg.= 'Malých obrázků: ' . $counter_small . '<br/>';

        #-- vzdy ulozime do db
        $this->saveCronActionToDb($msg, $manuallyCall);

        #-- vysledna akce -> dle toho, zda generujem manualne nebo cronem
        $this->returnAction($msg, FLASH_OK, $manuallyCall);
    }

    /**
     * obsluhuje generovani sitemap.xml
     * - 1. vygenerujeme homepage + seznam stranek (rkw_page)
     * - 2. vygenerujeme seznam kategorii (rkw_katagorie)
     * - 3. vygenerujeme seznam vyrobcu (musi byt kategorie/vyrobce - rkw_kategorie, rkw_vyrobce)
     * - 4. vygenerujeme odkazy primo na vyrobky (musi byt kategorie/vyrobce/polozka - rkw_kategorie, rkw_vyrobce, rkw_polozka)
     * 
     * @param type $manuallyCall
     */
    public function actionGenerateSitemapXml($manuallyCall) {
        // feed = zbozi.cz
        $sitemap_file_fs = ROOT_FS_WWW . '/sitemap.xml';
        $sitemap_file_www = ROOT_WEB_WWW . '/sitemap.xml';

        // zaciname
        $counter = 0;
        $xml = $this->printXmlRow('<?xml version="1.0" encoding="UTF-8"?>');

        $urlset = '<urlset  ';
        $urlset.= 'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ';
        $urlset.= 'xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" ';
        $urlset.= '>';
        $xml.= $this->printXmlRow($urlset);

        // homepage
        $xml.= $this->printXmlRow('<url>', 1);
        $xml.= $this->printXmlRow('<loc>' . $this->getHttpRequest()->getUrl()->hostUrl . '</loc>', 2);
        $xml.= $this->printXmlRow('<changefreq>daily</changefreq>', 2);
        $xml.= $this->printXmlRow('</url>', 1);
        $counter++;

        // stranky
        foreach ($this->repository->findAll('pages')->fetchAll() as $row) {
            $xml.= $this->printXmlRow('<url>', 1);
            $xml.= $this->printXmlRow('<loc>' . $this->link('//Default:page', array($row['alias'])) . '</loc>', 2);
            $xml.= $this->printXmlRow('<changefreq>daily</changefreq>', 2);
            $xml.= $this->printXmlRow('</url>', 1);

            $counter++;
        }

        // kategorie
        // kategorie/vyrobce
        // kategorie/vyrobce/polozka
        // - projdeme polozky a do pole si budeme schovavat i patricne kategorie a kategorie/vyrobce
        //   takhle omezime prazdne kategorie a vyrobce ;) ...
        $kategorie = array(); // jen id kategorii, pro odkazy to staci
        $kategorie_xml = '';
        $vyrobci = array(); // array($kat_id#$vyr_id), pro odkaz na vyrobce potrebujeme i kategorii
        $vyrobci_xml = '';
        foreach ($this->repository->findAll('polozka')->fetchAll() as $row) {
            if (!in_array($row->kategorie_id, $kategorie)) {
                array_push($kategorie, $row->kategorie_id);
                $klink = htmlspecialchars($this->link('//Default:items', array($row->kategorie->alias)));

                $kategorie_xml.= $this->printXmlRow('<url>', 1);
                $kategorie_xml.= $this->printXmlRow('<loc>' . $klink . '</loc>', 2);
                $kategorie_xml.= $this->printXmlRow('<changefreq>daily</changefreq>', 2);
                $kategorie_xml.= $this->printXmlRow('</url>', 1);

                $counter++;
            }

            if (!in_array($row->kategorie_id . '#' . $row->vyrobce_id, $vyrobci)) {
                array_push($vyrobci, $row->kategorie_id . '#' . $row->vyrobce_id);
                $vlink = htmlspecialchars($this->link('//Default:items', array($row->kategorie->alias, $row->vyrobce->alias)));

                $vyrobci_xml.= $this->printXmlRow('<url>', 1);
                $vyrobci_xml.= $this->printXmlRow('<loc>' . $vlink . '</loc>', 2);
                $vyrobci_xml.= $this->printXmlRow('<changefreq>daily</changefreq>', 2);
                $vyrobci_xml.= $this->printXmlRow('</url>', 1);

                $counter++;
            }

            $plink = htmlspecialchars($this->link('//Default:itemDetail', array($row->kategorie->alias, $row->vyrobce->alias, $row->alias)));
            $xml.= $this->printXmlRow('<url>', 1);
            $xml.= $this->printXmlRow('<loc>' . $plink . '</loc>', 2);
            $xml.= $this->printXmlRow('<changefreq>daily</changefreq>', 2);

            if ('' != $row->img) {
                $img = htmlspecialchars($this->getHttpRequest()->getUrl()->hostUrl . $this->imageStorage->getWwwPath($row->img, '/items'));

                $xml.= $this->printXmlRow('<image:image>', 3);
                $xml.= $this->printXmlRow('<image:loc>' . $img . '</image:loc>', 4);
                $xml.= $this->printXmlRow('</image:image>', 3);
            }
            $xml.= $this->printXmlRow('</url>', 1);

            $counter++;
        }

        $xml.= $kategorie_xml;
        $xml.= $vyrobci_xml;
        $xml.= '</urlset>';

        $f = fopen($sitemap_file_fs, 'w');
        fwrite($f, $xml);
        fclose($f);

        #-- message
        $msg = 'XML pro sitemapz bylo vygenerováno v pořádku. Zpracováno bylo ' . $counter . ' adres.<br/>';
        $msg.= 'Soubor lze nalézt <a href="' . $sitemap_file_www . '">zde</a> (pro poskytovatele je cesta mírně upravená - směrování zařizuje .htaccess).';

        #-- vzdy ulozime do db
        $this->saveCronActionToDb($msg, $manuallyCall);
        #-- vysledna akce -> dle toho, zda generujem manualne nebo cronem
        $this->returnAction($msg, FLASH_OK, $manuallyCall);
    }

    /**
     * obsluhuje generovani XML pro zbozi.cz
     * 
     * @param bool $manuallyCall zda volam skript manualne (pak i vykresluju view)
     * @param bool $oldFormat zda chci generovat dle stareho formatu - dnes, tj. 2015-01-26 se jeste pouziva, ale chteji jej opustit, default false
     */
    public function actionGenerateZboziXml($manuallyCall, $oldFormat = false) {
        // feed = zbozi.cz
        $zbozi_file_fs = ROOT_FS_WWW . '/zbozi.xml';
        $zbozi_file_www = ROOT_WEB_WWW . '/zbozi.xml';

        $zbozi = $this->printXmlRow("<?xml version=\"1.0\" encoding=\"utf-8\"?>");
        if (false == $oldFormat) {
            $zbozi.= $this->printXmlRow("<SHOP xmlns=\"http://www.zbozi.cz/ns/offer/1.0\">");
        } else {
            $zbozi.= $this->printXmlRow("<SHOP>");
        }

        #-- counter, pro zjisteni poctu zpracovanych polozek
        $counter = 0;

        #-- polozky z db
        $url = $this->getHttpRequest()->getUrl();
        $pol = $this->repository->findAll('polozka')->order('nazev')->fetchAll();
        foreach ($pol as $p) {
            $_dostupnost = preg_replace('/[^0-9]+/', '', $p->dostupnost->nazev);
            $_product_name = htmlspecialchars($p->nazev . ' ' . $p->baleni_pocet . $p->baleni_mj . ' ' . $p->vyrobce->nazev);
            $_description = ($p->popis_kratky == '') ? htmlspecialchars($p->popis_dlouhy) : htmlspecialchars($p->popis_kratky);
            $_url = htmlspecialchars($this->link("//Default:itemDetail", array($p->kategorie->alias, $p->vyrobce->alias, $p->alias)));
            $_url_image = htmlspecialchars($url->hostUrl . $this->imageStorage->getWwwPath($p->img, '/items'));

            $zbozi .= $this->printXmlRow("<SHOPITEM>");

            if (false == $oldFormat) {
                //$zbozi .= $this->printXmlRow("<PRODUCTNAME>" . $_product_name . '</PRODUCTNAME>');
                $zbozi .= $this->printXmlRow("<PRODUCT>" . $_product_name . '</PRODUCT>');
                $zbozi .= $this->printXmlRow("<PRODUCTNAME>" . $_product_name . '</PRODUCTNAME>');
                $zbozi .= $this->printXmlRow('<DESCRIPTION>' . $_description . '</DESCRIPTION>');
                //$zbozi .= $this->printXmlRow('<DESCRIPTION>' . htmlspecialchars($p->popis_kratky) . '</DESCRIPTION>');
                $zbozi .= $this->printXmlRow('<URL>' . $_url . '</URL>');
                $zbozi .= $this->printXmlRow('<PRICE_VAT>' . ceil($p->cena_bez_dph * DPH) . '</PRICE_VAT>');
                $zbozi .= $this->printXmlRow('<DELIVERY_DATE>' . intval($_dostupnost) . '</DELIVERY_DATE>');
                $zbozi .= $this->printXmlRow('<ITEM_ID>' . $p->id . '</ITEM_ID>');

                if ($p->img != '') {
                    $zbozi .= $this->printXmlRow('<IMGURL>' . $_url_image . '</IMGURL>');
                }

                $zbozi .= $this->printXmlRow('<MANUFACTURER>' . $p->vyrobce->nazev . '</MANUFACTURER>');
                //$zbozi .= $this->printXmlRow('<CATEGORYTEXT>' . $p->kategorie->nazev . '</CATEGORYTEXT>');
                throw new \Nette\NotImplementedException('Tento format neni implementovat. Zbozi na seznamu jej zatim nepouziva ... naposled psali tady. Obcas zkontroluj ...');
            } else {
                //$zbozi .= $this->printXmlRow("<PRODUCTNAME>" . htmlspecialchars($p->nazev . ' ' . $p->baleni_pocet . $p->baleni_mj) . '</PRODUCTNAME>');
                $zbozi .= $this->printXmlRow("<PRODUCT>" . $_product_name . '</PRODUCT>');
                $zbozi .= $this->printXmlRow("<PRODUCTNAME>" . $_product_name . '</PRODUCTNAME>');
                $zbozi .= $this->printXmlRow('<DESCRIPTION>' . $_description . '</DESCRIPTION>');
                //$zbozi .= $this->printXmlRow('<DESCRIPTION>' . htmlspecialchars($p->popis_kratky) . '</DESCRIPTION>');
                $zbozi .= $this->printXmlRow('<URL>' . $_url . '</URL>');
                $zbozi .= $this->printXmlRow('<PRICE_VAT>' . ceil($p->cena_bez_dph * DPH) . '</PRICE_VAT>');
                $zbozi .= $this->printXmlRow('<DELIVERY_DATE>' . intval($_dostupnost) . '</DELIVERY_DATE>');
                $zbozi .= $this->printXmlRow('<ITEM_ID>' . $p->id . '</ITEM_ID>');

                if ($p->img != '') {
                    $zbozi .= $this->printXmlRow('<IMGURL>' . $_url_image . '</IMGURL>');
                }

                $zbozi .= $this->printXmlRow('<MANUFACTURER>' . htmlspecialchars($p->vyrobce->nazev) . '</MANUFACTURER>');
                //$zbozi .= $this->printXmlRow('<CATEGORYTEXT>' . $p->kategorie->nazev . '</CATEGORYTEXT>');
            }

            $zbozi .= $this->printXmlRow('</SHOPITEM>');

            $counter++;
        }

        $zbozi .= "</SHOP>";

        $f = fopen($zbozi_file_fs, 'w');
        fwrite($f, $zbozi);
        fclose($f);

        #-- message
        $msg = 'XML pro zbozi.cz bylo vygenerováno v pořádku. Zpracováno bylo ' . $counter . ' položek.<br/>';
        $msg.= 'Soubor lze nalézt <a href="' . $zbozi_file_www . '">zde</a> (pro poskytovatele je cesta mírně upravená - směrování zařizuje .htaccess).';

        #-- vzdy ulozime do db
        $this->saveCronActionToDb($msg, $manuallyCall);
        #-- vysledna akce -> dle toho, zda generujem manualne nebo cronem
        $this->returnAction($msg, FLASH_OK, $manuallyCall);
    }

    /**
     * obsluhuje generovani XML pro heureka.cz
     * 
     * @param bool $manuallyCall zda volam skript manualne (pak i vykresluju view)
     */
    public function actionGenerateHeurekaXml($manuallyCall) {
        // feed = zbozi.cz
        $zbozi_file_fs = ROOT_FS_WWW . '/heureka.xml';
        $zbozi_file_www = ROOT_WEB_WWW . '/heureka.xml';

        $zbozi = $this->printXmlRow("<?xml version=\"1.0\" encoding=\"utf-8\"?>");
        $zbozi.= $this->printXmlRow("<SHOP>");

        #-- counter, pro zjisteni poctu zpracovanych polozek
        $counter = 0;

        #-- polozky z db
        $url = $this->getHttpRequest()->getUrl();
        $pol = $this->repository->findAll('polozka')->order('nazev')->fetchAll();
        foreach ($pol as $p) {
            $_dostupnost = preg_replace('/[^0-9]+/', '', $p->dostupnost->nazev);
            $_product_name = htmlspecialchars($p->nazev . ' ' . $p->baleni_pocet . $p->baleni_mj . ' ' . $p->vyrobce->nazev);
            $_description = ($p->popis_kratky == '') ? htmlspecialchars($p->popis_dlouhy) : htmlspecialchars($p->popis_kratky);

            $zbozi .= $this->printXmlRow("<SHOPITEM>");
            $zbozi .= $this->printXmlRow("<ITEM_ID>" . $p->id . '</ITEM_ID>', 2);
            $zbozi .= $this->printXmlRow("<PRODUCTNAME>" . $_product_name . '</PRODUCTNAME>');
            $zbozi .= $this->printXmlRow("<PRODUCT>" . $_product_name . '</PRODUCT>');
            $zbozi .= $this->printXmlRow('<DESCRIPTION>' . $_description . '</DESCRIPTION>');
            $zbozi .= $this->printXmlRow('<URL>' . htmlspecialchars($this->link("//Default:itemDetail", array($p->kategorie->alias, $p->vyrobce->alias, $p->alias))) . '</URL>');
            $zbozi .= $this->printXmlRow('<PRICE_VAT>' . ceil($p->cena_bez_dph * DPH) . '</PRICE_VAT>');
            $zbozi .= $this->printXmlRow('<MANUFACTURER>' . $p->vyrobce->nazev . '</MANUFACTURER>');
            $zbozi .= $this->printXmlRow('<CATEGORYTEXT>Auto-moto | Náplně a kapaliny | Maziva</CATEGORYTEXT>');
            $zbozi .= $this->printXmlRow('<DELIVERY_DATE>' . intval($_dostupnost) . '</DELIVERY_DATE>');
            //$zbozi .= $this->printXmlRow('<ITEM_TYPE>new</ITEM_TYPE>');

            if ($p->img != '') {
                $zbozi .= $this->printXmlRow('<IMGURL>' . htmlspecialchars($url->hostUrl . $this->imageStorage->getWwwPath($p->img, '/items')) . '</IMGURL>');
            }

            $zbozi .= $this->printXmlRow('</SHOPITEM>');

            $counter++;
        }

        $zbozi .= $this->printXmlRow("</SHOP>");

        $f = fopen($zbozi_file_fs, 'w');
        fwrite($f, $zbozi);
        fclose($f);

        #-- message
        $msg = 'XML pro heureka.cz bylo vygenerováno v pořádku. Zpracováno bylo ' . $counter . ' položek.<br/>';
        $msg.= 'Soubor lze nalézt <a href="' . $zbozi_file_www . '">zde</a> (pro poskytovatele je cesta mírně upravená - směrování zařizuje .htaccess).';

        #-- vzdy ulozime do db
        $this->saveCronActionToDb($msg, $manuallyCall);
        #-- vysledna akce -> dle toho, zda generujem manualne nebo cronem
        $this->returnAction($msg, FLASH_OK, $manuallyCall);
    }

    //============================= PRIVATE ====================================
    /**
     * ulozi do databaze zaznam o cron akci
     * 
     * @param string $msg zprava - popis vysledku akce
     * @param bool $manuallyCall - zda je akce vyvolana manualne nebo cron planovacem
     */
    private function saveCronActionToDb($msg, $manuallyCall) {
        #-- vzdy ulozime do db
        $params = '';
        foreach ($this->getHttpRequest()->getUrl()->getQueryParameters() as $name => $value) {
            $params .= "$name=$value,";
        }

        $ins = array(
            'url' => $this->getHttpRequest()->getUrl()->absoluteUrl,
            'query_params' => rtrim($params, ','),
            'action_type' => ($manuallyCall) ? 'manually' : 'cron',
            'description' => str_replace('<br/>', "\n", $msg)
        );

        $this->repository->insert('cron_log', $ins);
    }

    /**
     * ukonci zpracovani presenteru. Pokud je akce volana manualne,
     * tak presmeruje na REFERERa, jinak terminate()
     * 
     * @param string $msg zprava - popis vysledku akce
     * $param string $msgType typ zobrazeni (info, danger, apod.)
     * @param bool $manuallyCall - zda je akce vyvolana manualne nebo cron planovacem
     */
    private function returnAction($msg, $msgType, $manuallyCall) {
        if ($manuallyCall) {
            $this->flashMessage($msg, $msgType);

            $url = $this->getHttpRequest()->getReferer();
            $url->appendQuery(array(self::FLASH_KEY => $this->getParam(self::FLASH_KEY)));

            $this->redirectUrl($url);
        } else {
            $this->terminate();
        }
    }

    /**
     * vrati radek, odsazeny o pocet tabu a na konci zalomeny pomoci "\n"
     * 
     * @param string $str obsah radku, vcetne xml elementu
     * @param string $spaces o kolik mezer odsadit
     * @return string
     */
    private function printXmlRow($str, $spaces = 0) {
        $r = "";
        $r.= str_repeat(" ", $spaces);
        $r.= $str;
        $r.= "\n";

        return $r;
    }

}
