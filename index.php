<?php



require "phpqrcode.php";

function createInvoiceQr($saler, $vatNumber, $dateTime, $totalWithVat, $vat)
{
    /// Get The Lens Of Values
    $salerLens = strlen($saler);
    $vatNumberLens = strlen($vatNumber);
    $dateTimeLens = strlen($dateTime);
    $totalWithVatLens = strlen($totalWithVat);
    $vatLens = strlen($vat);


    ////Covnert Lens To Hexdecimal
    $salerLens = dechex($salerLens);
    $vatNumberLens = dechex($vatNumberLens);
    $dateTimeLens = dechex($dateTimeLens);
    $totalWithVatLens = dechex($totalWithVatLens);
    $vatLens = dechex($vatLens);


    // /ADd 0 if Lens Is one digit
    if (strlen($salerLens) < 2)
        $salerLens = "0" . $salerLens;

    if (strlen($vatNumberLens) < 2)
        $vatNumberLens = "0" . $vatNumberLens;

    if (strlen($dateTimeLens) < 2)
        $dateTimeLens = "0" . $dateTimeLens;

    if (
        strlen($totalWithVatLens) < 2
    )
        $totalWithVatLens = "0" . $totalWithVatLens;

    if (strlen($vatLens) < 2)
        $vatLens = "0" . $vatLens;





    /// Conver Values To Hex
    // $saler = bin2hex($saler);
    // $vatNumber = bin2hex($vatNumber);
    // $dateTime = bin2hex($dateTime);
    // $totalWithVat = bin2hex($totalWithVat);
    // $vat = bin2hex($vat);

    $result = "01" . $salerLens . $saler . "02" . $vatNumberLens . $vatNumber . "03" . $dateTimeLens . $dateTime . "04" . $totalWithVatLens . $totalWithVat . "05" . $vatLens . $vat;

    return base64_encode(hex2bin($result));
}

$result = createInvoiceQr("tawreed tech", 310518806900003, "2023-06-10T18:30:00", 1150, 150);

echo $result;
echo QRcode::png($result, false, QR_ECLEVEL_L, 10);
