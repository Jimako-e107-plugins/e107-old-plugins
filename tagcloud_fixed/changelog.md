
# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Versioning Guidelines
All versioning should attempt to follow the Semantic Versioning guidelines.

Given a version number MAJOR.MINOR.PATCH (e.g v0.0.0), increment the:

MAJOR version when you make incompatible API changes,
MINOR version when you add functionality in a backwards-compatible manner, and
PATCH version when you make backwards-compatible bug fixes.


## [1.01] - by Jezza101 start point

## [1.2.0] -  tested with e107 2.1.3, functionality without USE SEO links works.
### Fixed
- not able install plugin tables
- paths to main file for SEF-URLs pages 
- plugin folder name in .htaccess
### Removed
- removed flash functionality
- removed yahoo generating tags functionality
### Added
- generating default tags from metakeys if they are available.
### Updated
- db_fetch, db_select, db_Select_gen queries
 
Functionality without USE SEO links works.

## [2.0.0] -  working on updated version.

Note: in this repository because plugin name conflict needs to be solved at first 
Supported plugins (in progress) : news, page, download, forum, pcontent

### Removed
- hardcoded metatags

### Updated
- SEO URLs. Old way is saved with new e_url addons. Fully configurable like before. No htaccess is needed. 
- global shortcodes workaround. e_shortcode addon used.
- new template v2 way
- new shortcodes v2 way
- plugin.php updated to plugin.xml and plugin setup
- new prefs way (4/5) : installation, addons, admin, menu
- admin rewrite (2/7) : files organization,  admin menu

### Fixed
- part fix messed up constants in version 2 (3/5): news, page, download
- part fix for correct SEF-URL (1/5): news, 
- part fix for after front editing URL (2/5): news, page 

### New
- separated SEO settings as separate item in menu
- separated Addons settings as separate item in menu

TODO:
update: $con -> convert_date, $con = new convert;
Prefs:  frontend  
Admin rewrite: prefs, styling, maintenance, readme, tables overview (new) 
Remove old site mentions (not available): frontend, readme, prefs , tags_credit
Remove template overwritting, it's not possible anymore: tags_emetanews, tags_emetaforum, tags_emetadownload
- what is admin_table file for?

