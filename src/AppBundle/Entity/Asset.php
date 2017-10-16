<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asset
 *
 * @ORM\Table(name="asset")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssetRepository")
 */
class Asset
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="assetName", type="string", length=255)
     */
    private $assetName;

    /**
     * @var string
     *
     * @ORM\Column(name="assetTitle", type="string", length=255, nullable=true)
     */
    private $assetTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="aclass", type="string", length=255)
     */
    private $aclass;

    /**
     * @var string
     *
     * @ORM\Column(name="altname", type="string", length=255)
     */
    private $altname;

    /**
     * @var int
     *
     * @ORM\Column(name="decimals", type="integer")
     */
    private $decimals;

    /**
     * @var int
     *
     * @ORM\Column(name="displayDecimals", type="integer")
     */
    private $displayDecimals;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set assetName
     *
     * @param string $assetName
     *
     * @return Asset
     */
    public function setAssetName($assetName)
    {
        $this->assetName = $assetName;

        return $this;
    }

    /**
     * Get assetName
     *
     * @return string
     */
    public function getAssetName()
    {
        return $this->assetName;
    }

    /**
     * Set assetTitle
     *
     * @param string $assetTitle
     *
     * @return Asset
     */
    public function setAssetTitle($assetTitle)
    {
        $this->assetTitle = $assetTitle;

        return $this;
    }

    /**
     * Get assetTitle
     *
     * @return string
     */
    public function getAssetTitle()
    {
        return $this->assetTitle;
    }

    /**
     * Set aclass
     *
     * @param string $aclass
     *
     * @return Asset
     */
    public function setAclass($aclass)
    {
        $this->aclass = $aclass;

        return $this;
    }

    /**
     * Get aclass
     *
     * @return string
     */
    public function getAclass()
    {
        return $this->aclass;
    }

    /**
     * Set altname
     *
     * @param string $altname
     *
     * @return Asset
     */
    public function setAltname($altname)
    {
        $this->altname = $altname;

        return $this;
    }

    /**
     * Get altname
     *
     * @return string
     */
    public function getAltname()
    {
        return $this->altname;
    }

    /**
     * Set decimals
     *
     * @param integer $decimals
     *
     * @return Asset
     */
    public function setDecimals($decimals)
    {
        $this->decimals = $decimals;

        return $this;
    }

    /**
     * Get decimals
     *
     * @return int
     */
    public function getDecimals()
    {
        return $this->decimals;
    }

    /**
     * Set displayDecimals
     *
     * @param integer $displayDecimals
     *
     * @return Asset
     */
    public function setDisplayDecimals($displayDecimals)
    {
        $this->displayDecimals = $displayDecimals;

        return $this;
    }

    /**
     * Get displayDecimals
     *
     * @return int
     */
    public function getDisplayDecimals()
    {
        return $this->displayDecimals;
    }
}

