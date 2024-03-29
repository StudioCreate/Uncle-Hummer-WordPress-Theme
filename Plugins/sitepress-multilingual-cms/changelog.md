**3.1.9**

* **Fixes**
    * Fixed an issue not allowing the user to select options to be translated by String Translation.
    * Fixed an issue causing users of W3TC experiencing wrong language content to be displayed for widgets.
    * Fixed an issue resulting in taxonomy labels not being correctly translated.
    * Fixed an issue resulting in the slug of terms that got updated to be appended a language suffix.
    * Fixed an issue in which the use of domains per language together with domains that were sub-strings resulted in wrong-urls being presented to the user in the language switcher.
    * Fixed an issue with users not having String Translation installed, experiencing JavaScript errors on the Taxonomy Translation screen.
    * Fixed an issue with the original language version of a string not being displayed for a small number of plugins.
    * Fixed the language switcher so that menu-item-language-current class is only added to the menu item for the current language.
    * Fixed non-functional html as root page setting.
    * Fixed an issue with custom post type slug translations leading to 404 errors in some use cases.

* **Improvements**
    * Improved the caching strategy employed by String Translation for improved String Translation Performance for sites that contain many translated strings.

**3.1.8.4**

* **Fixes**
    * Fixed an issue causing sites using WooCommerce to become inaccessible
    * Fixed a notice occurring on duplicating WooCommerce products
    * Fixed an issue with Menu Synchronisation and custom links that were not recognised as translated
    * Fixed an issue with the taxonomy label translation. Label translation still necessitates the use of English as String Language as well as, as Admin Language.
    * Fixed the language switcher so that menu-item-language-current class is only added to the current menu

**3.1.8.3**

* **Fixes**
	* Replaced flag for Traditional Chinese with the correct one
	* Fixed an issue with using paginated front pages.
	* Fixed an issue with using a root page while using static front pages.
	* Fixed an issue with additional slashes in urls
	* Fixed an issue with same terms names in more than one language
	* Fixed support for post slug translation
	* Fixed an issue with term_ids being filtered despite the feature having been disabled.
	* Fixed issues with duplicate terms and erroneous language assignments to terms, resulting from setting a taxonomy from untranslated to translated.

**3.1.8.2**

* **Fixes**
	* Fixed compatibility issue of json_encode() function with PHP < 5.3.0 not accepting the options argument
	* Fixed an issue with some terms not being properly displayed on the Taxonomy Translations Screen.
	
**3.1.8.1**

* **Fixes**
	* Fixed a compatibility issue with WooCommerce, showing up when upgrading to 3.1.8

**3.1.8**

* **Improvements**
	* Added template tag to display HTML input with current language wpml_the_language_input_field()
	* Added support for translation of string packages
	* Minor speed improvements related to operations on arrays
	* Minor speed improvements related to string caching
	* Minor speed and compatibility improvement: JS files are now called from footer.
	* Installer: Added pagination for site keys list of Account -> My Sites
	* Installer: Allow registering new sites by clicking a link in the WordPress admin instead of copying and pasting the site url in the Account -> My Sites section
	* Installer: Display more detailed debug information related to connectivity issues with the WPML repository
	* Button "Post type assignments" added to Troubleshooting page allowing to synchronise post types and languages in translation table
	* Added functionality to allow the same term name across multiple languages without the use of @lang suffixes.
	* Added functionality to remove existing language suffixes to the troubleshooting menu.

* **Compatibility**
	* Fixed category setting for Woocommerce products

* **Fixes**
	* Fixed some PHP notices and warnings
	* Fixed search form on secondary language
	* Fixed issue with caching on page set as front page
	* Fixed: Taxonomy terms are not showing on the WPML->Taxonomy Translation page 
	* icl_object_id function now works well also with unregistered custom post types
	* Minor issues with language switcher on mobile devices
	* Fixed problem with language switcher options during installation
	* Textarea for additional CSS for language switcher was too wide, now it fits into screen. 
	* Fixed influence of admin language on settings for language switcher in menu
	* wp_nav_menu now always displays language switcher when configured
	* Fixed custom queries while using a root page
	* Fixed DB error when fetching completed translations from ICanLocalize
	* Installer: Fixed problem with WPML registration information (site key) not being saved when the option_value field in the wp_options table used a different charset than the default WordPress charset defined in wp-config.php
	* Installer: Reversed the order in which the site keys are displayed.
	* Fixed pagination on root page
	* Fixed root page permalink on post edit screen
	* Fixed root page preview
	* Fixed minor issues in wp-admin with RTL languages 
	* Fix for conflicting values of context when registering strings for translation
	* Fixed: Archive of untranslated custom post type should not display 'rel="alternate" hreflang="" href=""' in header
	* Fixed language filters for get_terms() function
	* Fixed problem with taxonomy (e.g. category) parents synchronization
	* Fixed problem with editing post slug
	* Removed unnecessary taxonomy selector from Taxonomy translation page
	* Fixed some PHP notices on WPML Languages page with "All Languages" selected on language switcher
	* Fixed problem with adding categories by simply pressing "Enter" key (post edit screen).
	* Removed option to delete default category translations
	* Fixed missing terms filtering by current language in admin panel
	* Fixed problem with comments quick edit

**3.1.7.2**

* **Improvements**
	* Installer support for WordPress Multisite
* **Fixes**
	* Fixed: Caching issue when duplicating posts

**3.1.7.1**

* **Fixes**
	* Fixed: Cannot send documents to translation
	* Fixed: WordPress database error: Duplicate entry during post delete
	* Fixed: Preview page does not work on Root page
	* Fixed: Fatal error: Call to a member function get_setting() on a non-object

**3.1.7**

* **Improvements**
	* Added template functions for reading/saving WPML settings, for future use
	* When wp-admin language is switched to non default and user will update any plugin or theme configuration, this value will be recognized as translation and updated correctly
	* Added "Remote WPML config files" functionality
	* New version of installer
	* Added various descriptions of WPML settings, displayed on configuration screens
	* Added shortcodes for language switchers
* **Compatibility** 
	* WP SEO plugin compatibility enhancements
	* Compatibility with WP 4.0: Removed like_escape() calls
* **Fixes**
	* get_custom_post_type_archive_link() now always returns correct link
	* Fixed url filters for different languages in different domains configured
	* In icl_object_id we were checking if post type is registered: WordPress doesn't require this, so we removed this to be compatible with filters from other plugins
	* Fixed hreflang atribute for tag/category archive pages
	* Fixed permissions checking for document translators
	* Fixed: media tags added to default language instead of translation
	* Fixed broken relationship consistency when translating posts 
	* Replaced strtolower() function calls with mb_strtolower() and gained better compatibility with non-ASCII languages

**3.1.6**

* **Improvements**
	* Languages can have now apostrophes in their names
	* Time of first activation of WPML plugin reduced to about 5% of previous results
	* Administrator can add user role to display hidden languages
	* New way to define WPML_TM_URL is now tolerant for different server settings
	* Added debug information box to WPML > Support page
* **Compatibility** 
	* WP SEO plugin compatibility enhancements
	* Added filters to be applied when custom fields are duplicated. 
	* Added filtering stylesheet URI back
	* Fixed compatibility with new version of NextGen Gallery plugin
* **Fixes**
	* Fixed possible SQL injections
	* Function 'get_post_type_archive_link' was not working with WPML, it is fixed now 
	* WPML is no longer removing backshlashes from post content, when post it duplicated
	* Enhanced filtering of home_url() function
	* Translated drafts are saved now with correct language information
	* Improved translation of hierarchical taxonomies
	* wp_query can have now more than one slug passed to category_name
	* Support for translate_object_id filter - this can be used in themes instead of the icl_object_id function
	* get_term_adjust_id cache fixed to work also if term is in multiple taxonomies
	* Fixed wrong post count for Language Links
	* Fixed widget previews
	* Fixed warning in sitepress::get_inactive_content()
	* Fixed string translation for multilevel arrays where content was indexed by numbers, it was not possible to translate elements on position zero. 
	* Function url_to_postid() is now filtered by WPML plugin to return correct post ID. 
	* WordPress Multisite: when you switch between blogs, $sitepress->get_default_language() returned sometimes wrong language. It is fixed.
	* Broken language switcher in custom post type archive pages was fixed. 
	* Removed references to global $wp_query in query filtering functions
	* icl_object_id works now for private posts
	* constants ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS + ICL_DONT_LOAD_LANGUAGES_JS are respected now when JS and CSS files are loaded
	* Fixed broken wp_query when qurying not translatable Custom Post Type by its name: WPML was removing this name, which resulted with wrong list of posts
	* When was set root page, secondary loops displayed wrong results

**3.1.5**

* **Improvements**
	* check_settings_integrity() won't run SQL queries on front-end and in the back-end it will run only once and only in specific circumstances
	* We added ability to add language information to duplicated content, when WPML_COMPATIBILITY_TEST_MODE is defined
	* Option to create database dump was removed as it was not working correctly. Please use additional plugins to do this (eg https://wordpress.org/plugins/adminer/ )
* **Usability**
	* We added links to String Translation if there are labels or urls that needs to be translated, when running menu synchronization
* **Compatibility** 
	* is_ajax() function is now deprecated and replaced by wpml_is_ajax() - **plugins and themes developers**: make sure you're updating your code!
	* Compatibility with WordPress 3.9 - WPML plugins were adjusted to use WPDB class in correct way, no direct usages of mysql_* functions
* **Fixes** 
	* Parent pages can be now changed or removed
	* Fixed issue when a showing paginated subqueries in home page (in non default language)
	* In some circumstance translated posts statuses doesn't get synchronized after publishing a post: fixed now
	* The "Connect translation" feature now works also when the WYSIWYG is not shown
	* We make use of debug_backtrace in some places: wherever it is possible (and depending on used PHP version), we've reduced the impact of this call by limiting the number of retrieved frames, or the complexity of the retrieved data
	* In some server configuration we were getting either a 404 error or a redirect loop
	* Static front page is not loosing now custom page template on translations when paged
	* Corrupted settings when no language in array - fixing this now doesn't end with pages missing
	* Custom Post Types when was set not to be translated was also not displayed, now it's fixed
	* Root page can work now with parameters
	* Fixed compatibility with CRED/Views (404, rewrite_rules_filter)
	* Fixed potential bug caused by redeclaration of icl_js_escape() function
	* Gallery was not displayed on root home page, this is fixed now
	* Filtered language doesn't remain as 'current value' on the wpml taxonomy page - this is also fixed
	* Information about hidden languages was displayed duplicated and doubled after every page refresh
	* Fixed filtering wp_query with tax_query element 
	* Ajax now "knows" language of page which made a ajax call
	* Removed PHP Notice on secondary language front page
	* Updated links to wpml.org
	* Many fixes in caching data what results in better site performance
	* Taxonomy @lang suffixes wasn't hidden always when it was necessary, now this is also fixed
	* Removed conflict between front page which ID was same as ID of actually displayed taxonomy archive page. 
	* Fixed saving setting for custom fields translation
	* Removed warning in inc/absolute-links/absolute-links.php
	* Removed duplicated entries in hidden languages list
	* Fixed Notice message when duplicating posts using Translation Management
	* Update posts using element_id instead of translation_id
	* Fixed PHP Fatal error: Cannot use object of type WP_Error as array
	* Option to translate custom posts slugs is now hidden when it is no set to translate them
	* Fixed monthly archive page, now it shows language switcher with correct urls
	* You can restore trashed translation when you tried to edit this
	* When you try to delete an item from untranslated menu, you saw PHP errors, now this is also fixed
	* Fixed compatibility issue with PHP versions < 5.3.6: constants DEBUG_BACKTRACE_PROVIDE_OBJECT and DEBUG_BACKTRACE_IGNORE_ARGS does not exist before this version, causing a PHP notice message.
	* Fixed wrong links to attachments in image galleries
	* Fixed not hidden spinner after re-install languages
	* Handled timeout error message when fixing languages table.
	* Made SitePress::slug_template only work for taxonomies
	* Fixed problems with missing taxonomies configuration from wpml-config.xml file
	* MENU (Automatically add new top-level pages to this menu) option was not synchronised
	* WP 3.9 compatibility issue: new version of WordPress doesn't automatically load dialog JS
	* Fixed WP 3.9 compatibility issues related to language switcher widget
	* Category hierarchy and pages hierarchy are now synchronised during translation
	* Fixed problem with redirecting to wrong page with the same slug in different language after upgrade to WP3.9
	* Fixed problem with Sticky Links and Custom Taxonomies
	* Home url not converted in current language when using different domains per language and WP in a folder
	* Fixed typos when calling in some places _() instead of __()
	* Fixed Korean locale in .mo file name

**3.1.4**

* **Fixes** 
	* The default menu in other language has gone
	* Menu stuck on default language
	* Infinite loop in auto-adjust-ids
	* Translations lose association
	* The "This is a translation of" drop down wasn't filled for non-original content
	* Removed language breakdown for Spam comments
	* Pages with custom queries won't show 404 errors
	* Languages in directories produces 404 for all pages when HTTP is using non standard 80 port
	* Fixed icl_migrate_2_0_0() logic
	* When a database upgrade is required, it won't fail with invalid nonce
	* Error in all posts page, where there are no posts
	* php notice when adding a custom taxonomy to a custom post
	* The default uncategorized category doesn't appear in the default language
	* Fixed locale for Vietnamese (from "vn" to "vi")
	* Fixed languages.csv file for Portuguese (Portugal) and Portuguese (Brazilian) mixed up --this requires a manual fix in languages editor for existing sites using one or both languages--
	* Pre-existing untranslatable custom post types disappears once set as translatable
	* Languages settings -> Language per domain: once selected and page is reloaded, is the option is not properly rendered
	* Languages settings -> Language per domain: custom languages generate a notice
	* Updated translations
	* Custom Fields set to be copied won't get lost anymore
	* Scheduled posts won't lose their translation relationship
	* Excluded/included posts in paginated custom queries won't cause any notice message
	* Replace hardcoded references of 'sitepress-multilingual-cms' with ICL_PLUGIN_FOLDER
	* Replace hardcoded references of 'wpml-string-translation' with WPML_ST_FOLDER
	* Replace hardcoded references of 'wpml-translation-management' with WPML_TM_FOLDER
* **Improvements** 
	* Generated keys of cached data should use the smallest possible amount of memory
	* The feature that allows to set orphan posts as source of other posts has been improved in order to also allow to set the orphan post as translation of an existing one
	* Added support to users with corrupted settings
	* Improved language detection from urls when using different domains
	* Added admin notices for custom post types set as translatable and with translatable slugs when translated slugs are missing

**3.1.3**

* **Fixes** 
	* In SitePress_Setup::languages_table_is_complete -> comparison between number of existing languages and number of built in languages changed from != to <
	* In SitePress_Setup::fill_languages -> added "$lang_locales = icl_get_languages_locales();" needed for repopulating language tables
	* Added cache clearing to icl_fix_languages logic on the troubleshooting page
	* Wording changes for the fix languages section on the troubleshooting page
	* Logic changes for the fix languages section on the troubleshooting page -> added checkbox and the button is enabled only when the checkbox is on
	* Added WPML capabilities to all roles with cap 'manage_options' when activate
	* Not remove WPML caps from super admin when deactivate

**3.1.2**

* **Fixes** 
	* Fixed a potential issue when element source language is set to an empty string rather than null: when reading element translations, either NULL or '' will be handled as NULL.

**3.1.1**

* **Fixes** 
	* Fixed an issue that occurs with some configurations, when reading WPML settings

**3.1**

* **Performances** 
	* Reduced number of queries to one per request when retrieving Admin language
	* Reduced the number of calls to *$sitepress->get_current_language()*, *$this->get_active_languages()* and *$this->get_default_language()*, to avoid running the same queries more times than needed
	* Dramatically reduced the amount of queries ran when checking if content is properly translated in several back-end pages
	* A lot of data is now cached, further reducing queries
* **Improvements** 
	* Improved javascript code style
	* Orphan content is now checked when (re)activating the plugin, rather than in each request on back-end side
	* If languages tables are incomplete, it will be possible to restore them
* **Feature** 
	* When setting a value for "This is a translation of", and the current content already has translations in other languages, each translation gets properly synchronized, as long as there are no conflicts. In case of conflicts, translation won't be synchronized, while the current content will be considered as not linked to an original (in line with the old behavior)
	* Categories, tags and taxonomies templates files don't need to be translated anymore (though you can still create a translated file). Taxonomy templates will follow this hierarchy: '{taxonomy}-{lang}-{term_slug}-{lang}.php', '{taxonomy}-{term_slug}-{lang}.php', '{taxonomy}-{lang}-{term_slug}-2.php', '{taxonomy}-{term_slug}-2.php', '{taxonomy}-{lang}.php', '{taxonomy}.php'
	* Administrators can now edit content that have been already sent to translators
	* Ability to set, in the post edit page, an orphan post as source of translated post
	* Added WPML capabilities (see online documentation)
	* Add support to users with corrupted settings
* **Security** 
	* Improved security by using *$wpdb->prepare()* wherever is possible
	* Database dump in troubleshooting page is now available to *admin* and *super admin* users only
* **Fixes** 
	* Admin Strings configured with wpml-config.xml files are properly shown and registered in String Translation
	* Removed max length issue in translation editor: is now possible to send content of any length
	* Taxonomy Translation doesn't hang anymore on custom hierarchical taxonomies
	* Is now possible to translate content when displaying "All languages", without facing PHP errors
	* Fixed issues on moderated and spam comments that exceed 999 items
	* Changed "Parsi" to "Farsi" (as it's more commonly used) and fixed some language translations in Portuguese
	* Deleting attachment from post that are duplicated now deleted the duplicated image as well (if "When deleting a post, delete translations as well" is flagged)
	* Translated static front-page with pagination won't loose the template anymore when clicking on pages
	* Reactivating WPML after having added content, will properly set the default language to the orphan content
	* SSL support is now properly handled in WPML->Languages and when setting a domain per language
	* Empty categories archives does not redirect to the home page anymore
	* Menu and Footer language switcher now follow all settings in WPML->Languages
	* Post metas are now properly synchronized among duplicated content
	* Fixed a compatibility issue with SlideDeck2 that wasn't retrieving images
	* Compatibility with WP-Types repeated fields not being properly copied among translations
	* Compatibility issue with bbPress
	* Removed warnings and unneeded HTML elements when String Translation is not installed/active
	* Duplicated content retains the proper status
	* Browser redirect for 2 letters language codes now works as expected
	* Menu synchronization now properly fetches translated items
	* Menu synchronization copy custom items if String Translation is not active, or WPML default languages is different than String Translation language
	* When deleting the original post, the source language of translated content is set to null or to the first available language
	* Updated localized strings
	* Posts losing they relationship with their translations
	* Checks if string is already registered before register string for translation. Fixed because it wasn't possible to translate plural and singular taxonomy names in Woocommerce Multilingual
	* Fixed error when with hierarchical taxonomies and taxonomies with same names of terms.
