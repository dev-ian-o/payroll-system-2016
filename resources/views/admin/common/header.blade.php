<!DOCTYPE html>
<html lang="en" ng-app="eticketApp">
    <head>        
        <!-- META SECTION -->
        <title>Payroll System</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        

        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::to('admin-assets/css/theme-default.css') }}"/>
<!--         <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::to('css/style.css') }}"/> -->
        <!-- EOF CSS INCLUDE -->               
    </head>