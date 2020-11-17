<?php


namespace Lichi\Vk;


interface MessagesKeyboard
{
    public static function hideKeyboard(): string;
    public function constructKeyboard(array $arrKeyboard, $typeKeyboard = "normal"): string;
}