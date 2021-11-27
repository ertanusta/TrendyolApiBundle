<?php

namespace Trendyol\ApiBundle\Model;

use TrendyolApiBundle\Exceptions\ValidationException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductModel
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class ProductModel implements TrendyolAPIModel
{
	/**
	 * @var string
	 * @Assert\Type (
	 *     "string",
	 *     message="Barkod bilgisi geçersiz."
	 * )
	 * @Assert\Regex(
	 *     "/^[a-zA-Z0-9ğüşöçİĞÜŞÖÇ-]+$/",
	 *     message="Barkod bilgisi ? / & % + ^ ' * _ gibi özel karakter ve boşluk içermemelidir."
	 * )
	 * @Assert\NotBlank (message="Barkod bilgisi boş olamaz")
	 * @Assert\NotNull (message="Barkod bilgisi boş olamaz")
	 * @Assert\Length (
	 *     max="40",
	 *     min="1",
	 *     maxMessage="Barkod maksimum 100 karakter olmalıdır.",
	 *     minMessage="Barkod minimum 1 karakter olmalıdır."
	 * )
	 */
	private $barcode;

	/**
	 * @var string
	 * @Assert\Type (
	 *     "string",
	 *      message="Ürün adı bilgisi geçersiz."
	 * )
	 * @Assert\Length (
	 *     max="100",
	 *     min="1",
	 *     maxMessage="Ürün adı maksimum 100 karakter olmalıdır.",
	 *     minMessage="Ürün adı minimum 1 karakter olmalıdır."
	 * )
	 * @Assert\NotBlank (message="Ürün adı bilgisi boş olamaz")
	 * @Assert\NotNull (message="Ürün adı bilgisi boş olamaz")
	 */
	private $title;

	/**
	 * @var string
	 * @Assert\Type (
	 *     "string",
	 *     message="Ana ürün ID bilgisi geçersiz."
	 * )
	 * @Assert\Length (
	 *     max="40",
	 *      min="1",
	 *     maxMessage="Ana ürün stok kodu maksimum 40 karakter olmalı.",
	 *     minMessage="Ana ürün stok kodu minimum 1 karakter olmalı."
	 * )
	 * @Assert\NotBlank (message="Ana ürün ID bilgisi boş olamaz")
	 * @Assert\NotNull (message="Ana ürün ID bilgisi boş olamaz")
	 */
	private $productMainId;

	/**
	 * @var int
	 * @Assert\Type (
	 *     "int",
	 *     message="Marka bilgisi geçersiz."
	 * )
	 * @Assert\NotNull (message="Marka bilgisi boş olamaz")
	 * @Assert\NotBlank  (message="Marka bilgisi boş olamaz")
	 */
	private $brandId;

	/**
	 * @var int
	 * @Assert\Type (
	 *     "int",
	 *      message="Trendyol kategori bilgisi geçersiz tipte"
	 * )
	 * @Assert\NotNull (message="Trendyol kategori bilgisi boş olamaz")
	 * @Assert\NotBlank  (message="Trendyol kategori bilgisi boş olamaz")
	 */
	private $categoryId;

	/**
	 * @var int
	 * @Assert\Type (
	 *     "int",
	 *     message="Stok miktarı bilgisi geçersiz tipte"
	 * )
	 * @Assert\NotNull (message="Stok miktarı bilgisi boş olamaz")
	 * @Assert\NotBlank  (message="Stok miktarı bilgisi boş olamaz")
	 */
	private $quantity;

	/**
	 * @var string
	 * @Assert\NotBlank (message="Stok kodu bilgisi boş olamaz")
	 * @Assert\NotNull (message="Stok kodu bilgisi boş olamaz")
	 * @Assert\Type (
	 *     "string",
	 *      message="Stok kodu geçersiz tipte"
	 * )
	 * @Assert\Length (
	 *     max="100",
	 *     min="1",
	 *     maxMessage="Stok kodu maksimum 100 karakter olmalıdır.",
	 *     minMessage="Stok kodu minimum 1 karakter olmalıdır."
	 * )
	 */
	private $stockCode;

	/**
	 * @var float
	 * @Assert\Type (
	 *     "float",
	 *     message="Desi miktarı geçersiz tiptedir."
	 * )
	 * @Assert\NotBlank (message="Desi miktarı boş bırakılamaz.")
	 * @Assert\NotNull (message="Desi miktarı boş bırakılamaz")
	 */
	private $dimensionalWeight;

	/**
	 * @var string
	 * @Assert\Type (
	 *     "string",
	 *      message="Ürün açıklaması geçersizdir"
	 * )
	 * @Assert\NotNull (message="Ürün açıklaması boş bırkaılamaz.")
	 * @Assert\NotBlank (message="Ürün açıklaması boş bırakılamaz.")
	 * @Assert\Length (
	 *     max="30000",
	 *     min="1",
	 *     maxMessage="Ürün açıklaması maksimum 30000 karakter olmalıdır.",
	 *     minMessage="Ürün açıklaması minimum 1 karakter olmalıdır."
	 * )
	 */
	private $description;

	/**
	 * @var string
	 * @Assert\NotBlank (message="Ürünün fiyat para birimi boş bırakılamaz.")
	 * @Assert\NotNull (message="Ürünün fiyat para birimi boş bırakılamaz.")
	 * @Assert\Type (
	 *     "string",
	 *     message="Ürünün fiyat para birimi geçersiz tipte."
	 * )
	 */
	private $currencyType;

	/**
	 * @var float
	 * @Assert\NotNull (message="Ürünün liste fiyatı boş bırakılamaz.")
	 * @Assert\NotBlank (message="Ürünün liste fiyatı boş bırakılamaz.")
	 * @Assert\Type (
	 *     "float",
	 *     message="Ürünün liste fiyatı yanlış titpte."
	 * )
	 * @Assert\Range (min="1", minMessage="Ürünün liste fiyatı 1'den küçük olamaz.")
	 */
	private $listPrice;

	/**
	 * @var float
	 * @Assert\NotNull (message="Ürünün satış fiyatı boş bırakılamaz.")
	 * @Assert\NotBlank (message="Ürünün satış fiyatı boş bırakılamaz.")
	 * @Assert\Type (
	 *     "float",
	 *      message="Ürünün satış fiyatı yanlış titpte."
	 * )
	 * @Assert\Range (
	 *     min="1",
	 *     minMessage="Ürünün satış fiyatı 1'den küçük olamaz."
	 * )
	 */
	private $salePrice;

	/**
	 * @var int
	 * @Assert\NotNull (message="Kargo firması bilgisi boş bırakılamaz.")
	 * @Assert\NotBlank  (message="Kargo firması bilgisi boş bırakılamaz.")
	 * @Assert\Type (
	 *     "int",
	 *      message="Kargo firması bilgisi yanlış tiptedir."
	 * )
	 */
	private $cargoCompanyId;

	/**
	 * @var int|null
	 */
	private $deliveryDuration = null;

	/**
	 * @var array
	 * @Assert\Count(
	 *     min="1",
	 *     max="8",
	 *     minMessage="Minimum 1 ürün resmi olmalıdır.",
	 *      maxMessage="Maksimum 8 adet ürün resmi ekleyebilirsiniz."
	 * )
	 * @Assert\NotBlank (message="Ürüne ait resim bilgisi boş bırakılamaz.")
	 */
	private $images = [];

	/**
	 * @var int
	 * @Assert\Type (
	 *     "int",
	 *     message="KDV oranı geçersiz tiptedir."
	 * )
	 * @Assert\NotBlank (message="KDV oranı boş bırakılamaz.")
	 * @Assert\NotNull (message="KDV oranı boş bırkaılamaz.")
	 * @Assert\Choice (
	 *     choices={0,1,8,18},
	 *     message="KDV oranı olarak sadece 0,1,8,18 değerlerini girebilirsiniz."
	 * )
	 */
	private $vatRate;

	/**
	 * @var int|null
	 */
	private $shipmentAddressId = null;
	/**
	 * @var int|null
	 */
	private $returningAddressId = null;
	/**
	 * @var array
	 * @Assert\NotBlank (message="Ürün özellikleri alanı boş bırakılamaz.")
	 */
	private $attributes = [];

	/**
	 * @return string
	 */
	public function getBarcode(): string
	{
		return $this->barcode;
	}

	/**
	 * @param string $barcode
	 */
	public function setBarcode(string $barcode): void
	{
		$this->barcode = $barcode;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle(string $title): void
	{
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getProductMainId(): string
	{
		return $this->productMainId;
	}

	/**
	 * @param string $productMainId
	 */
	public function setProductMainId(string $productMainId): void
	{
		$this->productMainId = $productMainId;
	}

	/**
	 * @return int
	 */
	public function getBrandId(): int
	{
		return $this->brandId;
	}

	/**
	 * @param int $brandId
	 */
	public function setBrandId(int $brandId): void
	{
		$this->brandId = $brandId;
	}

	/**
	 * @return int
	 */
	public function getCategoryId(): int
	{
		return $this->categoryId;
	}

	/**
	 * @param int $categoryId
	 */
	public function setCategoryId(int $categoryId): void
	{
		$this->categoryId = $categoryId;
	}

	/**
	 * @return int
	 */
	public function getQuantity(): int
	{
		return $this->quantity;
	}

	/**
	 * @param int $quantity
	 */
	public function setQuantity(int $quantity): void
	{
		$this->quantity = $quantity;
	}

	/**
	 * @return string
	 */
	public function getStockCode(): string
	{
		return $this->stockCode;
	}

	/**
	 * @param string $stockCode
	 */
	public function setStockCode(string $stockCode): void
	{
		$this->stockCode = $stockCode;
	}

	/**
	 * @return float
	 */
	public function getDimensionalWeight(): float
	{
		return $this->dimensionalWeight;
	}

	/**
	 * @param float $dimensionalWeight
	 */
	public function setDimensionalWeight(float $dimensionalWeight): void
	{
		$this->dimensionalWeight = $dimensionalWeight;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription(string $description): void
	{
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getCurrencyType(): string
	{
		return $this->currencyType;
	}

	/**
	 * @param string $currencyType
	 */
	public function setCurrencyType(string $currencyType): void
	{
		$this->currencyType = $currencyType;
	}

	/**
	 * @return float
	 */
	public function getListPrice(): float
	{
		return $this->listPrice;
	}

	/**
	 * @param float $listPrice
	 */
	public function setListPrice(float $listPrice): void
	{
		$this->listPrice = $listPrice;
	}

	/**
	 * @return float
	 */
	public function getSalePrice(): float
	{
		return $this->salePrice;
	}

	/**
	 * @param float $salePrice
	 */
	public function setSalePrice(float $salePrice): void
	{
		$this->salePrice = $salePrice;
	}

	/**
	 * @return int
	 */
	public function getCargoCompanyId(): int
	{
		return $this->cargoCompanyId;
	}

	/**
	 * @param int $cargoCompanyId
	 */
	public function setCargoCompanyId(int $cargoCompanyId): void
	{
		$this->cargoCompanyId = $cargoCompanyId;
	}

	/**
	 * @return int|null
	 */
	public function getDeliveryDuration(): ?int
	{
		return $this->deliveryDuration;
	}

	/**
	 * @param int|null $deliveryDuration
	 */
	public function setDeliveryDuration(?int $deliveryDuration): void
	{
		$this->deliveryDuration = $deliveryDuration;
	}

	/**
	 * @return array
	 */
	public function getImages(): array
	{
		return $this->images;
	}

	/**
	 * @param array $images
	 */
	public function setImages(array $images): void
	{
		$this->images = $images;
	}

	/**
	 * @return int
	 */
	public function getVatRate(): int
	{
		return $this->vatRate;
	}

	/**
	 * @param int $vatRate
	 */
	public function setVatRate(int $vatRate): void
	{
		$this->vatRate = $vatRate;
	}

	/**
	 * @return int|null
	 */
	public function getShipmentAddressId(): ?int
	{
		return $this->shipmentAddressId;
	}

	/**
	 * @param int|null $shipmentAddressId
	 */
	public function setShipmentAddressId(?int $shipmentAddressId): void
	{
		$this->shipmentAddressId = $shipmentAddressId;
	}

	/**
	 * @return int|null
	 */
	public function getReturningAddressId(): ?int
	{
		return $this->returningAddressId;
	}

	/**
	 * @param int|null $returningAddressId
	 */
	public function setReturningAddressId(?int $returningAddressId): void
	{
		$this->returningAddressId = $returningAddressId;
	}

	/**
	 * @return array
	 */
	public function getAttributes(): array
	{
		return $this->attributes;
	}

	/**
	 * @param array $attributes
	 */
	public function setAttributes(array $attributes): void
	{
		$this->attributes = $attributes;
	}

}