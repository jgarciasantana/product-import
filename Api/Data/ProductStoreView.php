<?php

namespace BigBridge\ProductImport\Api\Data;

use BigBridge\ProductImport\Model\Data\Image;
use BigBridge\ProductImport\Model\Data\ImageGalleryInformation;
use BigBridge\ProductImport\Model\Resource\Reference\GeneratedUrlKey;
use BigBridge\ProductImport\Model\Resource\Reference\Reference;
use BigBridge\ProductImport\Model\Resource\Reference\References;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Catalog\Model\Product\Visibility;

/**
 * @author Patrick van Bergen
 */
class ProductStoreView
{
    // a collection of some commonly used constants

    const STATUS_ENABLED = Status::STATUS_ENABLED;
    const STATUS_DISABLED = Status::STATUS_DISABLED;

    const MSRP_USE_CONFIG = 0;
    const MSRP_ON_GESTURE = 1;
    const MSRP_IN_CART = 2;
    const MSRP_BEFORE_ORDER_CONFIRMATION = 3;

    const VISIBILITY_NOT_VISIBLE = Visibility::VISIBILITY_NOT_VISIBLE;
    const VISIBILITY_IN_CATALOG = Visibility::VISIBILITY_IN_CATALOG;
    const VISIBILITY_IN_SEARCH = Visibility::VISIBILITY_IN_SEARCH;
    const VISIBILITY_BOTH = Visibility::VISIBILITY_BOTH;
    const ATTR_VISIBILITY = 'visibility';
    const ATTR_URL_KEY = 'url_key';
    const ATTR_TAX_CLASS_ID = 'tax_class_id';
    const ATTR_PRICE = 'price';
    const ATTR_COST = 'cost';
    const ATTR_STATUS = 'status';
    const ATTR_DESCRIPTION = 'description';
    const ATTR_SHORT_DESCRIPTION = 'short_description';
    const ATTR_NAME = 'name';
    const ATTR_WEIGHT = 'weight';
    const ATTR_SPECIAL_PRICE = 'special_price';
    const ATTR_SPECIAL_FROM_DATE = 'special_from_date';
    const ATTR_SPECIAL_TO_DATE = 'special_to_date';
    const ATTR_META_TITLE = 'meta_title';
    const ATTR_META_DESCRIPTION = 'meta_description';
    const ATTR_META_KEYWORDS = 'meta_keyword';
    const ATTR_NEWS_FROM_DATE = 'news_from_date';
    const ATTR_NEWS_TO_DATE = 'news_to_date';
    const ATTR_GIFT_MESSAGE_AVAILABLE = 'gift_message_available';
    const ATTR_COUNTRY_OF_MANUFACTURE = 'country_of_manufacture';
    const ATTR_MSRP = 'msrp';
    const ATTR_MSRP_DISPLAY_ACTUAL_PRICE_TYPE = 'msrp_display_actual_price_type';
    const ATTR_COLOR = 'color';
    const ATTR_MANUFACTURER = 'manufacturer';

    const SWATCH_IMAGE = 'swatch_image';
    const SMALL_IMAGE = 'small_image';
    const BASE_IMAGE = 'image';
    const THUMBNAIL_IMAGE = 'thumbnail';

    /**
     * For internal use only; not for application use
     * @var  Product
     */
    public $parent;

    /** @var  int */
    protected $store_view_id;

    /** @var ImageGalleryInformation[] */
    protected $imageGalleryInformation = [];

    /** @var array  */
    protected $imageRoles = [];

    /** @var array  */
    protected $attributes = [];

    /** @var Reference[]  */
    protected $unresolvedSelects = [];

    /** @var References[]  */
    protected $unresolvedMultipleSelects = [];

    public function setName(string $name)
    {
        $this->attributes[self::ATTR_NAME] = trim($name);
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return array_key_exists(self::ATTR_NAME, $this->attributes) ? $this->attributes[self::ATTR_NAME] : null;
    }

    public function setStoreViewId(int $storeViewId)
    {
        $this->store_view_id = $storeViewId;
    }

    public function getStoreViewId(): int
    {
        return $this->store_view_id;
    }

    public function removeStoreViewId()
    {
        $this->store_view_id = null;
    }

    public function setStatus(int $status)
    {
        $this->attributes[self::ATTR_STATUS] = $status;
    }

    public function setGiftMessageAvailable(bool $available)
    {
        $this->attributes[self::ATTR_GIFT_MESSAGE_AVAILABLE] = (int)$available;
    }

    public function setDescription(string $description)
    {
        $this->attributes[self::ATTR_DESCRIPTION] = trim($description);
    }

    public function setShortDescription(string $shortDescription)
    {
        $this->attributes[self::ATTR_SHORT_DESCRIPTION] = trim($shortDescription);
    }

    public function setMetaTitle(string $metaTitle)
    {
        $this->attributes[self::ATTR_META_TITLE] = trim($metaTitle);
    }

    public function setMetaDescription(string $metaDescription)
    {
        $this->attributes[self::ATTR_META_DESCRIPTION] = trim($metaDescription);
    }

    public function setMetaKeywords(string $metaKeywords)
    {
        $this->attributes[self::ATTR_META_KEYWORDS] = trim($metaKeywords);
    }

    /**
     * @param string $price A 12.4 decimal field
     */
    public function setPrice(string $price)
    {
        $this->attributes[self::ATTR_PRICE] = trim($price);
    }

    /**
     * @param string $cost A 12.4 decimal field
     */
    public function setCost(string $cost)
    {
        $this->attributes[self::ATTR_COST] = trim($cost);
    }

    /**
     * @param string $msrp Manufacturer Suggested Retail Price. A 12.4 decimal field
     */
    public function setMsrp(string $msrp)
    {
        $this->attributes[self::ATTR_MSRP] = trim($msrp);
    }

    /**
     * Check "MSRP" class constants for values.
     *
     * @param string $int
     */
    public function setMsrpDisplayActualPriceType(int $type)
    {
        $this->attributes[self::ATTR_MSRP_DISPLAY_ACTUAL_PRICE_TYPE] = $type;
    }

    public function setVisibility(int $visibility)
    {
        $this->attributes[self::ATTR_VISIBILITY] = $visibility;
    }

    public function setTaxClassId(int $taxClassId)
    {
        $this->attributes[self::ATTR_TAX_CLASS_ID] = $taxClassId;
    }

    public function setTaxClassName(string $taxClassName)
    {
        $this->attributes[self::ATTR_TAX_CLASS_ID] = new Reference(trim($taxClassName));
    }

    public function setUrlKey(string $urlKey)
    {
        $this->attributes[self::ATTR_URL_KEY] = trim($urlKey);
    }

    /**
     * @return string|GeneratedUrlKey|null
     */
    public function getUrlKey()
    {
        return array_key_exists(self::ATTR_URL_KEY, $this->attributes) ? $this->attributes[self::ATTR_URL_KEY] : null;
    }

    public function generateUrlKey()
    {
        $this->attributes[self::ATTR_URL_KEY] = new GeneratedUrlKey();
    }

    /**
     * @param string $weight A 12.4 decimal field
     */
    public function setWeight(string $weight)
    {
        $this->attributes[self::ATTR_WEIGHT] = trim($weight);
    }

    /**
     * @param string $specialPrice A 12.4 decimal field
     */
    public function setSpecialPrice(string $specialPrice)
    {
        $this->attributes[self::ATTR_SPECIAL_PRICE] = trim($specialPrice);
    }

    /**
     * @param string $specialPriceFromDate A y-m-d MySql date
     */
    public function setSpecialFromDate(string $specialPriceFromDate)
    {
        $this->attributes[self::ATTR_SPECIAL_FROM_DATE] = trim($specialPriceFromDate);
    }

    /**
     * @param string $specialPriceToDate A y-m-d MySql date
     */
    public function setSpecialToDate(string $specialPriceToDate)
    {
        $this->attributes[self::ATTR_SPECIAL_TO_DATE] = trim($specialPriceToDate);
    }

    /**
     * @param string $newsFromDate A y-m-d MySql date
     */
    public function setNewsFromDate(string $newsFromDate)
    {
        $this->attributes[self::ATTR_NEWS_FROM_DATE] = trim($newsFromDate);
    }

    /**
     * @param string $newsToDate A y-m-d MySql date
     */
    public function setNewsToDate(string $newsToDate)
    {
        $this->attributes[self::ATTR_NEWS_TO_DATE] = trim($newsToDate);
    }

    /**
     * @param string $option The admin name of the manufacturer attribute option
     */
    public function setManufacturer(string $option)
    {
        $this->unresolvedSelects[self::ATTR_MANUFACTURER] = trim($option);
    }

    /**
     * @param string $countryCode 2 characters, uppercase
     */
    public function setCountryOfManufacture(string $countryCode)
    {
        $this->attributes[self::ATTR_COUNTRY_OF_MANUFACTURE] = trim($countryCode);
    }

    /**
     * @param string $option The admin name of the color attribute option
     */
    public function setColor(string $option)
    {
        $this->unresolvedSelects[self::ATTR_COLOR] = trim($option);
    }

    /**
     * Set the value of a user defined attribute.
     *
     * @param string $name
     * @param string $value
     */
    public function setCustomAttribute(string $name, string $value)
    {
        $this->attributes[trim($name)] = trim($value);
    }

    /**
     * @param $attributeCode
     * @return mixed|null|
     */
    public function getAttribute($attributeCode)
    {
        return array_key_exists($attributeCode, $this->attributes) ? $this->attributes[$attributeCode] : null;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return array Attribute codes of selects whose option value names are given
     */
    public function getUnresolvedSelects()
    {
        return $this->unresolvedSelects;
    }

    /**
     * @return array Attribute codes of multiple selects whose option value names are given
     */
    public function getUnresolvedMultipleSelects()
    {
        return $this->unresolvedMultipleSelects;
    }

    /**
     * Removes an attribute
     * @param string $name
     */
    public function removeAttribute(string $name)
    {
        unset($this->attributes[$name]);
    }

    /**
     * @param Image $image Should be an image retrieved from $product->addImage() on the same product.
     * @param string $label Will be used as alt-tag on the product page
     * @param int $position Gallery position (1, 2, 3, ...)
     * @param bool $enabled Show on product page?
     */
    public function setImageGalleryInformation(Image $image, string $label, int $position, bool $enabled)
    {
        $this->imageGalleryInformation[] = new ImageGalleryInformation($image, $label, $position, $enabled);
    }

    public function getImageGalleryInformation()
    {
        return $this->imageGalleryInformation;
    }

    /**
     * Choose a "role" (image, small_image, thumbnail, swatch_image) for the image. Use one of this class' constants.
     *
     * @param Image $image Should be an image retrieved from $product->addImage() on the same product.
     * @param string $attributeCode A media_image attribute (use one of the class constants above, or a custom attribute code)
     */
    public function setImageRole(Image $image, string $attributeCode)
    {
        $this->imageRoles[$attributeCode] = $image;
    }

    /**
     * @return Image[]
     */
    public function getImageRoles()
    {
        return $this->imageRoles;
    }

    /**
     * @param string $attributeCode
     * @param string $option The admin name of the attribute option
     */
    public function setSelectAttribute(string $attributeCode, string $option)
    {
        $this->unresolvedSelects[trim($attributeCode)] = trim($option);
    }

    public function setSelectAttributeOptionId(string $attributeCode, int $optionId)
    {
        $this->attributes[$attributeCode] = $optionId;
    }

    /**
     * @param string $attributeCode
     * @param array $options The admin names of the attribute options
     */
    public function setMultipleSelectAttribute(string $attributeCode, array $options)
    {
        $this->unresolvedMultipleSelects[trim($attributeCode)] = array_map('trim', $options);
    }

    public function setMultiSelectAttributeOptionIds(string $attributeCode, array $optionIds)
    {
        $this->attributes[$attributeCode] = implode(',', array_map('trim', $optionIds));
    }
}