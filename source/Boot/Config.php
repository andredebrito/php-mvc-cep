<?php
/**
 * DEFAULT TIMEZONE
 */
date_default_timezone_set("America/Sao_Paulo");

define("CONF_DEBUG_MESSAGES", TRUE);
define("SANDBOX", TRUE);

/**
 * PROJECT ROOT
 */
define("ROOT", (SANDBOX ? "https://localhost/projetos/GIT/php-mvc-cep" : "https://php-mvc-cep.xhds.com.br"));

/**
 * SITE
 */
define("CONF_SITE_NAME", "PHP MVC CEP");
define("CONF_SITE_TITLE", "Aplicação PHP MVC");
define("CONF_SITE_DESC", "Aplicação MVC desenvolvida em PHP para consulta de CEP");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "xhds.com.br");

/**
 * VIEW
 */
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "main");

