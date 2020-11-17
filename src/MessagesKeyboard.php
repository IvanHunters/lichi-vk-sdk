<?php


namespace Lichi\Vk;


interface MessagesKeyboard
{
    /**
     * @return string
     */
    public static function hideKeyboard(): string;

    /**
     * @param array $arrKeyboard
     * @param string $typeKeyboard
     * @return string
     */
    public function constructKeyboard(array $arrKeyboard, $typeKeyboard = "normal"): string;
}