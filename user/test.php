<?php

$response = '
{
    "type": "delivery",
    "method": "request_pickup",
    "destinationOption": "single",
    "senderDetails": {
      "name": "Adebisi Covenant",
      "email": "adebisicovenant01@gmail.com",
      "phone": "+2349031704109",
      "address": "Maiduguri Bye-pass",
      "postal": "740242",
      "city": "Bauchi",
      "state": "Bauchi",
      "country": "Nigeria",
      "save": false
    },
    "receiverDetails": {
      "name": "Adebisi Covenant",
      "email": "adebisicovenant01@gmail.com",
      "phone": "+2349031704109",
      "address": "Maiduguri Bye-pass",
      "postal": "740242",
      "city": "Bauchi",
      "state": "Bauchi",
      "country": "Nigeria",
      "save": false
    },
    "item": {
      "category": "books",
      "value": "1000",
      "desc": "Kror",
      "quantity": "1",
      "weight": "1"
    },
    "delivery": {},
    "pickupDate": "2023-11-30",
    "shippingRate": {
      "type": "normal",
      "amount": 5000,
      "periodInDays": 5
    },
    "paymentType": "wallet"
  }
';

extract($_POST);

// return extract($_POST);

$res = json_decode($response);

$shippmentType = $res->type;
$shippmentMethod = $res->method;
$shippingDestinationOption = $res->destinationOption;
$shippingPickupDate = $res->pickupDate;
$shippingPaymentMethod = $res->paymentType;

// Sender's Information
$senderName = $res->senderDetails->name;
$senderEmail = $res->senderDetails->email;
$senderPhone = $res->senderDetails->phone;
$senderAddress = $res->senderDetails->address;
$senderPostal = $res->senderDetails->postal;
$senderCity = $res->senderDetails->city;
$senderState = $res->senderDetails->state;
$senderCountry = $res->senderDetails->country;
$senderSave = $res->senderDetails->save;

// Receiver's Information
$receiverName = $res->receiverDetails->name;
$receiverEmail = $res->receiverDetails->email;
$receiverPhone = $res->receiverDetails->phone;
$receiverAddress = $res->receiverDetails->address;
$receiverPostal = $res->receiverDetails->postal;
$receiverCity = $res->receiverDetails->city;
$receiverState = $res->receiverDetails->state;
$receiverCountry = $res->receiverDetails->country;
$receiverSave = $res->receiverDetails->save;

// Item
$itemCategory = $res->item->category;
$itemValue = $res->item->value;
$itemDesc = $res->item->desc;
$itemQuantity = $res->item->quantity;
$itemWeight = $res->item->weight;

// Shipping Rates
$shippingType = $res->shippingRate->type;
$shippingAmount = $res->shippingRate->amount;
$shippingPeriod = $res->shippingRate->periodInDays;

return $res->type;
?>