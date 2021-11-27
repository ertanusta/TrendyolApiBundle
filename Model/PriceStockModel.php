<?php

namespace Trendyol\ApiBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use TrendyolApiBundle\Exceptions\ValidationException;

/**
 * TrendyolAPIModel
 * @author Ertan USTA <ertanusta@outlook.com>
 */
class PriceStockModel implements TrendyolAPIModel
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
}