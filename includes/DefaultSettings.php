<?php
if( defined( "MEDIAWIKI" ) ) {

# $Id$
# DO NOT EDIT THIS FILE!
# To customize your installation, edit "LocalSettings.php".
# Note that since all these string interpolations are expanded
# before LocalSettings is included, if you localize something
# like $wgScriptPath, you must also localize everything that
# depends on it.

$wgVersion			= '1.3.0+';

$wgSitename         = 'MediaWiki'; # Please customize!
$wgMetaNamespace    = FALSE; # will be same as you set $wgSitename


# check if server use https:
$wgProto = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';

if ( @$wgCommandLineMode ) {
	$wgServer = $wgProto.'://localhost';
} else {
	$wgServer           = $wgProto.'://' . $_SERVER['SERVER_NAME'];
	if( $_SERVER['SERVER_PORT'] != 80 ) $wgServer .= ":" . $_SERVER['SERVER_PORT'];
}
unset($wgProto);

$wgScriptPath	    = '/wiki';

# Whether to support URLs like index.php/Page_title
$wgUsePathInfo		= ( strpos( php_sapi_name(), 'cgi' ) === false );

# ATTN: Old installations used wiki.phtml and redirect.phtml -
# make sure that LocalSettings.php is correctly set!
$wgScript           = "{$wgScriptPath}/index.php";
$wgRedirectScript   = "{$wgScriptPath}/redirect.php";

$wgStylePath   = "{$wgScriptPath}/style";
$wgStyleDirectory = "{$IP}/style";
$wgStyleSheetPath = &$wgStylePath;
$wgStyleSheetDirectory = &$wgStyleDirectory;
$wgArticlePath      = "{$wgScript}?title=$1";
$wgUploadPath       = "{$wgScriptPath}/upload";
$wgUploadDirectory	= "{$IP}/upload";
$wgLogo				= "{$wgUploadPath}/wiki.png";
$wgMathPath         = "{$wgUploadPath}/math";
$wgMathDirectory    = "{$wgUploadDirectory}/math";
$wgTmpDirectory     = "{$wgUploadDirectory}/tmp";
$wgEmergencyContact = 'wikiadmin@' . getenv( 'SERVER_NAME' );
$wgPasswordSender	= 'Wikipedia Mail <apache@' . getenv( 'SERVER_NAME' ) . '>';

# For using a direct (authenticated) SMTP server connection.
# "host" => 'SMTP domain', "IDHost" => 'domain for MessageID', "port" => "25", "auth" => true/false, "username" => user, "password" => password
$wgSMTP				= false;

# Database settings
#
$wgDBserver         = 'localhost';
$wgDBname           = 'wikidb';
$wgDBconnection     = '';
$wgDBuser           = 'wikiuser';
$wgDBtype           = "mysql"; # "mysql" for working code and "pgsql" for development/broken code

# Database load balancer
$wgDBservers		= false; # e.g. array(0 => "larousse", 1 => "pliny")
$wgDBloads			= false; # e.g. array(0 => 0.6, 1 => 0.4);

# Sysop SQL queries
$wgAllowSysopQueries = false; # Dangerous if not configured properly.
$wgDBsqluser		= 'sqluser';
$wgDBsqlpassword	= 'sqlpass';
$wgDBpassword       = 'userpass';
$wgSqlLogFile           = "{$wgUploadDirectory}/sqllog_mFhyRe6";
$wgDBerrorLog		= false; # File to log MySQL errors to

$wgDBminWordLen     = 4;
$wgDBtransactions	= false; # Set to true if using InnoDB tables
$wgDBmysql4			= false; # Set to true to use enhanced fulltext search
$wgSqlTimeout		= 30;

$wgBufferSQLResults     = true; # use buffered queries by default

# Other wikis on this site, can be administered from a single developer account
# Array, interwiki prefix => database name
$wgLocalDatabases   = array();

# Database load balancer
$wgDBservers		= false; # e.g. array("larousse", "pliny")
$wgDBloads			= false; # e.g. array(0.6, 0.4);

# memcached settings
# See docs/memcached.doc
#
$wgMemCachedDebug   = false; # Will be set to false in Setup.php, if the server isn't working
$wgUseMemCached     = false;
$wgMemCachedServers = array( '127.0.0.1:11000' );
$wgMemCachedDebug   = false;
$wgSessionsInMemcached = false;
$wgLinkCacheMemcached = false; # Not fully tested

# Language settings
#
$wgLanguageCode     = 'en';
$wgLanguageFile     = false; # Filename of a language file generated by dumpMessages.php
$wgInterwikiMagic	= true; # Treat language links as magic connectors, not inline links
$wgInputEncoding	= 'ISO-8859-1'; # LanguageUtf8.php normally overrides this
$wgOutputEncoding	= 'ISO-8859-1'; # unless you set the next option to true:
$wgUseLatin1 		= false; # Enable ISO-8859-1 compatibility mode
$wgEditEncoding		= '';
$wgMimeType			= 'text/html';
$wgDocType			= '-//W3C//DTD XHTML 1.0 Transitional//EN';
$wgDTD				= 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd';
$wgUseDynamicDates  = false; # Enable to allow rewriting dates in page text
							 # DOES NOT FORMAT CORRECTLY FOR MOST LANGUAGES
$wgAmericanDates    = false; # Enable for English module to print dates
							 # as eg 'May 12' instead of '12 May'
$wgTranslateNumerals = true; # For Hindi and Arabic use local numerals instead
                             # of Western style (0-9) numerals in interface.

$wgLocalInterwiki   = 'w';
$wgShowIPinHeader	= true; # For non-logged in users
$wgMaxNameChars     = 32; # Maximum number of bytes in username
$wgInterwikiExpiry = 10800; # Expiry time for cache of interwiki table

# Translation using MediaWiki: namespace
# This will increase load times by 25-60% unless memcached is installed
$wgUseDatabaseMessages = true;
$wgMsgCacheExpiry	= 86400;
$wgSecondaryMessageDB = false; # DB to fall back on if the message isn't in the main DB

$wgExtraSubtitle	= '';
$wgSiteSupportPage	= '';

# Miscellaneous configuration settings
#
$wgReadOnlyFile         = "{$wgUploadDirectory}/lock_yBgMBwiR";

# The debug log file should be not be publicly accessible if it is
# used, as it may contain private data.
$wgDebugLogFile         = '';
$wgDebugRedirects		= false;

$wgDebugComments        = false;
$wgReadOnly             = false;
$wgLogQueries           = false;
$wgDebugDumpSql         = false;

# Whether to disable automatic generation of "we're sorry,
# but there has been a database error" pages.
$wgIgnoreSQLErrors      = false;

# Should [[Category:Dog]] on a page associate it with the
# category "Dog"? (a link to that category page will be
# added to the article, clicking it reveals a list of
# all articles in the category)
$wgUseCategoryMagic		= true;

# disable experimental dmoz-like category browsing. Output things like:
# Encyclopedia > Music > Style of Music > Jazz
# FIXME: need fixing
$wgUseCategoryBrowser   = false;

$wgEnablePersistentLC	= false;	# Persistent link cache in linkscc table; FAILS on MySQL 3.x
$wgCompressedPersistentLC = true; # use gzcompressed blobs

$wgEnableParserCache = false; # requires that php was compiled --with-zlib

# wgHitcounterUpdateFreq sets how often page counters should be
# updated, higher values are easier on the database. A value of 1
# causes the counters to be updated on every hit, any higher value n
# cause them to update *on average* every n hits. Should be set to
# either 1 or something largish, eg 1000, for maximum efficiency.

$wgHitcounterUpdateFreq = 1;

# User rights 
$wgWhitelistEdit = false;   # true = user must login to edit.
$wgWhitelistRead = false;	# Pages anonymous user may see, like: = array ( ":Main_Page", "Special:Userlogin", "Wikipedia:Help");
$wgWhitelistAccount = array ( 'user' => 1, 'sysop' => 1, 'developer' => 1 );
$wgSysopUserBans        = false; # Allow sysops to ban logged-in users
$wgSysopRangeBans		= false; # Allow sysops to ban IP ranges
$wgDefaultBlockExpiry	= '24 hours'; # default expiry time
                                # strtotime format, or "infinite" for an infinite block
$wgAutoblockExpiry		= 86400; # Number of seconds before autoblock entries expire
$wgBlockOpenProxies = false; # Automatic open proxy test on edit
$wgProxyPorts = array( 80, 81, 1080, 3128, 6588, 8000, 8080, 8888, 65506 );
$wgProxyScriptPath = "$IP/proxy_check.php";
$wgProxyMemcExpiry = 86400;
$wgProxyKey = 'W1svekXc5u6lZllTZOwnzEk1nbs';
$wgProxyList = array();  # big list of banned IP addresses, in the keys not the values
$wgAccountCreationThrottle = 0; # Number of accounts each IP address may create, 0 to disable. Requires memcached

# Client-side caching:
$wgCachePages       = true; # Allow client-side caching of pages

# Set this to current time to invalidate all prior cached pages.
# Affects both client- and server-side caching.
$wgCacheEpoch = '20030516000000';

# Server-side caching:
#  This will cache static pages for non-logged-in users
#  to reduce database traffic on public sites.
#  Must set $wgShowIPinHeader = false
$wgUseFileCache = false;
$wgFileCacheDirectory = "{$wgUploadDirectory}/cache";

# When using the file cache, we can store the cached HTML gzipped to save disk
# space. Pages will then also be served compressed to clients that support it.
# THIS IS NOT COMPATIBLE with ob_gzhandler which is now enabled if supported in
# the default LocalSettings.php! If you enable this, remove that setting first.
#
# Requires zlib support enabled in PHP.
$wgUseGzip = false;


$wgCookieExpiration = 2592000;

# Squid-related settings
#
# Enable/disable Squid
 $wgUseSquid = false;
# If you run Squid3 with ESI support, enable this (default:false):
 $wgUseESI = false;
# Internal server name as known to Squid, if different
# $wgInternalServer = 'http://yourinternal.tld:8000';
 $wgInternalServer = $wgServer;
# Cache timeout for the squid, will be sent as s-maxage (without ESI) or 
# Surrogate-Control (with ESI). Without ESI, you should strip out s-maxage in the Squid config.
# 18000 seconds = 5 hours, more cache hits with 2678400 = 31 days
 $wgSquidMaxage = 18000;
# A list of proxy servers (ips if possible) to purge on changes
# don't specify ports here (80 is default)
# $wgSquidServers = array('127.0.0.1');

# Maximum number of titles to purge in any one client operation
$wgMaxSquidPurgeTitles = 400;


# Set to set an explicit domain on the login cookies
# eg, "justthis.domain.org" or ".any.subdomain.net"
$wgCookieDomain = '';
$wgCookiePath = '/';
$wgDisableCookieCheck = false;

$wgAllowExternalImages = true;
$wgMiserMode = false; # Disable database-intensive features
$wgDisableQueryPages = false; # Disable all query pages if miser mode is on, not just some
$wgUseWatchlistCache = false; # Generate a watchlist once every hour or so
$wgWLCacheTimeout = 3600;	# The hour or so mentioned above

# To use inline TeX, you need to compile 'texvc' (in the 'math' subdirectory
# of the MediaWiki package and have latex, dvips, gs (ghostscript), and
# convert (ImageMagick) installed and available in the PATH.
# Please see math/README for more information.
$wgUseTeX = false;
$wgTexvc = './math/texvc'; # Location of the texvc binary

# Profiling / debugging
$wgProfiling = false; # Enable for more detailed by-function times in debug log
$wgProfileLimit = 0.0; # Only record profiling info for pages that took longer than this
$wgProfileOnly = false; # Don't put non-profiling info into log file
$wgProfileToDatabase = false; # Log sums from profiling into "profiling" table in db.
$wgProfileSampleRate = 1; # Only profile every n requests when profiling is turned on
$wgDebugProfiling = false; # Detects non-matching wfProfileIn/wfProfileOut calls
$wgDebugFunctionEntry = 0; # Output debug message on every wfProfileIn/wfProfileOut
$wgDebugSquid = false; # Lots of debugging output from SquidUpdate.php

$wgDisableCounters = false;
$wgDisableTextSearch = false;
$wgDisableFuzzySearch = false;
$wgDisableSearchUpdate = false; # If you've disabled search semi-permanently, this also disables updates to the table. If you ever re-enable, be sure to rebuild the search table.
$wgDisableUploads = true; # Uploads have to be specially set up to be secure
$wgRemoteUploads = false; # Set to true to enable the upload _link_ while local uploads are disabled. Assumes that the special page link will be bounced to another server where uploads do work.
$wgDisableAnonTalk = false;

# Path to the GNU diff3 utility. If the file doesn't exist,
# edit conflicts will fall back to the old behaviour (no merging).
$wgDiff3 = '/usr/bin/diff3';

# We can also compress text in the old revisions table. If this is set on,
# old revisions will be compressed on page save if zlib support is available.
# Any compressed revisions will be decompressed on load regardless of this
# setting *but will not be readable at all* if zlib support is not available.
$wgCompressRevisions = false;

# This is the list of preferred extensions for uploading files. Uploading
# files with extensions not in this list will trigger a warning.
$wgFileExtensions = array( 'png', 'gif', 'jpg', 'jpeg', 'ogg' );

# Files with these extensions will never be allowed as uploads.
$wgFileBlacklist = array(
	# HTML may contain cookie-stealing JavaScript and web bugs
	'html', 'htm',
	# PHP scripts may execute arbitrary code on the server
	'php', 'phtml', 'php3', 'php4', 'phps',
	# Other types that may be interpreted by some servers
	'shtml', 'jhtml', 'pl', 'py',
	# May contain harmful executables for Windows victims
	'exe', 'scr', 'dll', 'msi', 'vbs', 'bat', 'com', 'pif', 'cmd', 'vxd', 'cpl' );

# This is a flag to determine whether or not to check file extensions on
# upload.
$wgCheckFileExtensions = true;

# If this is turned off, users may override the warning for files not
# covered by $wgFileExtensions.
$wgStrictFileExtensions = true;

# Warn if uploaded files are larger than this
$wgUploadSizeWarning = 150000;

$wgPasswordSalt = true; # For compatibility with old installations set to false

# Which namespaces should support subpages?
# See Language.php for a list of namespaces.
#
$wgNamespacesWithSubpages = array( -1 => 0, 0 => 0, 1 => 1,
  2 => 1, 3 => 1, 4 => 0, 5 => 1, 6 => 0, 7 => 1, 8 => 0, 9 => 1, 10 => 0, 11 => 1);

$wgNamespacesToBeSearchedDefault = array( -1 => 0, 0 => 1, 1 => 0,
  2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 1, 10 => 0, 11 => 1 );

# If set, a bold ugly notice will show up at the top of every page.
$wgSiteNotice = "";

# Whether to allow anonymous users to set changes to 'minor'
$wgAllowAnonymousMinor = false;

## Set $wgUseImageResize to true if you want to enable dynamic
## server side image resizing ("Thumbnails")
# 
$wgUseImageResize		= false;

## Resizing can be done using PHP's internal image libraries
## or using ImageMagick. The later supports more file formats
## than PHP, which only supports PNG, GIF, JPG, XBM and WBMP.
##
## Set $wgUseImageMagick to true to use Image Magick instead
## of the builtin functions
#
$wgUseImageMagick		= false;
$wgImageMagickConvertCommand    = '/usr/bin/convert';

# PHPTal is a library for page templates. MediaWiki includes
# a recent PHPTal distribution. It is required to use the
# Monobook (default) skin.
#
# Currently it does not work on PHP5.
$wgUsePHPTal = version_compare( phpversion(), "5.0", "lt" );

if( !isset( $wgCommandLineMode ) ) {
	$wgCommandLineMode = false;
}

# Show seconds in Recent Changes
$wgRCSeconds = false;

# Log IP addresses in the recentchanges table
$wgPutIPinRC = false;

# RDF metadata toggles
$wgEnableDublinCoreRdf = false;
$wgEnableCreativeCommonsRdf = false;

# Override for copyright metadata.
# TODO: these options need documentation
$wgRightsPage = NULL;
$wgRightsUrl = NULL;
$wgRightsText = NULL;
$wgRightsIcon = NULL;

# Set this to true if you want detailed copyright information forms on Upload.
$wgUseCopyrightUpload = false;

# Set this to false if you want to disable checking that detailed 
# copyright information values are not empty.
$wgCheckCopyrightUpload = true;


# Set this to false to avoid forcing the first letter of links
# to capitals. WARNING: may break links! This makes links
# COMPLETELY case-sensitive. Links appearing with a capital at
# the beginning of a sentence will *not* go to the same place
# as links in the middle of a sentence using a lowercase initial.
$wgCapitalLinks = true;

# List of interwiki prefixes for wikis we'll accept as sources
# for Special:Import (for sysops). Since complete page history
# can be imported, these should be 'trusted'.
$wgImportSources = array();

# Set this to the number of authors that you want to be credited below an
# article text. Set it to zero to hide the attribution block, and a
# negative number (like -1) to show all authors. Note that this will
# require 2-3 extra database hits, which can have a not insignificant
# impact on performance for large wikis.
$wgMaxCredits = 0;

# If there are more than $wgMaxCredits authors, show $wgMaxCredits of them.
# Otherwise, link to a separate credits page.
$wgShowCreditsIfMax = true;

# Text matching this regular expression will be recognised as spam
# See http://en.wikipedia.org/wiki/Regular_expression
$wgSpamRegex = false; 
# Similarly if this function returns true
$wgFilterCallback = false;

# Go button goes straight to the edit screen if the article doesn't exist
$wgGoToEdit = false;

# Allow limited user-specified HTML in wiki pages?
# It will be run through a whitelist for security.
# Set this to false if you want wiki pages to consist only of wiki
# markup. Note that replacements do not yet exist for all HTML
# constructs.
$wgUserHtml = true;

# $wgUseTidy: use tidy to make sure HTML output is sane.
# This should only be enabled if $wgUserHtml is true.
# tidy is a free tool that fixes broken HTML. 
# See http://www.w3.org/People/Raggett/tidy/
# $wgTidyBin should be set to the path of the binary and 
# $wgTidyConf to the path of the configuration file.
# $wgTidyOpts can include any number of parameters.
$wgUseTidy = false;
$wgTidyBin = 'tidy';
$wgTidyConf = $IP.'/extensions/tidy/tidy.conf'; 
$wgTidyOpts = '';

# See list of skins and their symbolic names in language/Language.php
$wgDefaultSkin = 'monobook';

# Whether or not to allow real name fields. Defaults to true.
$wgAllowRealName = true;

# Extensions
$wgExtensionFunctions = array();

# Allow user Javascript page?
$wgAllowUserJs = true;

# Allow user Cascading Style Sheets (CSS)?
$wgAllowUserCss = true;

# Filter for Special:Randompage. Part of a WHERE clause
$wgExtraRandompageSQL = false;

# Allow the "info" action, very inefficient at the moment
$wgAllowPageInfo = false;

# Maximum indent level of toc.
# $wgMaxTocLevel = 999;

}
?>
