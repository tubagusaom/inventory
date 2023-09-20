<?php

    function app_name(){
        return "INVENTORY";
    }

    function company_name(){
        return "Company Name";
    }

    function base_url(){
        $base_ = (empty($_SERVER['HTTPS']) OR strtolower($_SERVER['HTTPS']) === 'off') ? 'http' : 'https';
        $base_ .= '://'. $_SERVER['HTTP_HOST'];
      
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      
        if ($_SERVER['HTTP_HOST'] == "localhost") {
          $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        }else{
          // $segmen = $this->segmen_url();
          // $segmen = $uriSegments;
          if ($uriSegments[1] == '') {
            $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $base_ . '/');
          }else {
            // $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $base_ . '/home' . '/');
            $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $base_ . '/');
          }
        }
      
        return $base_url;
      }

      function uri_segments(){
        $base_ = (empty($_SERVER['HTTPS']) OR strtolower($_SERVER['HTTPS']) === 'off') ? 'http' : 'https';
        $base_ .= '://'. $_SERVER['HTTP_HOST'];

        $base_server = $base_ . $_SERVER['REQUEST_URI']; 

        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        if ($_SERVER['HTTP_HOST'] == "localhost") {
            $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
          }else{
            $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $base_ . '/');
          }
      
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      }
      
      // var_dump(base_url()); die();

    