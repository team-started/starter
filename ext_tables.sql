#
# Extend table structure for table 'pages'
#
CREATE TABLE pages (
	tx_starter_nav_media int(11) unsigned DEFAULT '0' NOT NULL
);

#
# Extend table structure for table 'tt_content'
#
CREATE TABLE tt_content (
    tx_starter_celink_text varchar(255) DEFAULT '' NOT NULL,
    tx_starter_celink varchar(1024) DEFAULT '' NOT NULL,
    tx_starter_backgroundcolor varchar(60) DEFAULT '' NOT NULL,
		tx_starter_background_fluid tinyint(4) unsigned DEFAULT '0' NOT NULL,
    tx_starter_bordercolor varchar(60) DEFAULT '' NOT NULL,
    tx_starter_overline mediumtext,
    tx_starter_overlay_text mediumtext,
    tx_starter_headerclass varchar(60) DEFAULT '' NOT NULL,
    tx_starter_headerfontsize varchar(20) DEFAULT '' NOT NULL,
    tx_starter_headercolor varchar(60) DEFAULT '' NOT NULL,
    tx_starter_textclass varchar(60) DEFAULT '' NOT NULL,
    tx_starter_textcolor varchar(60) DEFAULT '' NOT NULL,
    tx_starter_width varchar(40) DEFAULT '' NOT NULL,
    tx_starter_height varchar(40) DEFAULT '' NOT NULL,
    tx_starter_carousel_element int(11) DEFAULT '0' NOT NULL,
    tx_starter_accordion_element int(11) DEFAULT '0' NOT NULL,
    tx_starter_tab_element int(11) DEFAULT '0' NOT NULL,
    tx_starter_assets_medium int(11) unsigned DEFAULT '0' NOT NULL,
    tx_starter_assets_large int(11) unsigned DEFAULT '0' NOT NULL,
    tx_starter_media_size_small varchar(20) DEFAULT '' NOT NULL,
    tx_starter_media_size_medium varchar(20) DEFAULT '' NOT NULL,
    tx_starter_media_size_large varchar(20) DEFAULT '' NOT NULL,
    tx_starter_imagecols_medium tinyint(4) unsigned DEFAULT '0' NOT NULL,
    tx_starter_imagecols_large tinyint(4) unsigned DEFAULT '0' NOT NULL,
    tx_starter_column_element int(11) unsigned DEFAULT '0' NOT NULL,
    tx_starter_ctalink varchar(1024) DEFAULT '' NOT NULL,
    tx_starter_ctalink_text varchar(255) DEFAULT '' NOT NULL
);

#
# Extend table structure for table 'sys_file_reference'
#
CREATE TABLE sys_file_reference (
	tx_starter_class varchar(60) DEFAULT '' NOT NULL,
	tx_starter_show_small smallint(5) unsigned DEFAULT '0' NOT NULL,
	tx_starter_show_medium smallint(5) unsigned DEFAULT '0' NOT NULL,
	tx_starter_show_large smallint(5) unsigned DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_starter_carousel_element'
#
CREATE TABLE tx_starter_carousel_element (
	type varchar(100) NOT NULL DEFAULT '0',
	layout varchar(255) DEFAULT '' NOT NULL,
	tt_content_carousel int(11) DEFAULT '0' NOT NULL,
	header varchar(255) DEFAULT '' NOT NULL,
	subheader varchar(255) DEFAULT '' NOT NULL,
	rowDescription text,
	bodytext mediumtext,
	assets int(11) unsigned DEFAULT '0' NOT NULL,
	assets_medium int(11) unsigned DEFAULT '0' NOT NULL,
	assets_large int(11) unsigned DEFAULT '0' NOT NULL,
	link varchar(1024) DEFAULT '' NOT NULL,
	link_text varchar(255) DEFAULT '' NOT NULL,

	KEY parent (pid,sorting),
	KEY language (l10n_parent,sys_language_uid)
);

#
# Table structure for table 'tx_starter_accordion_element'
#
CREATE TABLE tx_starter_accordion_element (
	type varchar(100) NOT NULL DEFAULT '0',
	layout varchar(255) DEFAULT '' NOT NULL,
	tt_content_accordion int(11) DEFAULT '0' NOT NULL,
	header varchar(255) DEFAULT '' NOT NULL,
	subheader varchar(255) DEFAULT '' NOT NULL,
	rowDescription text,
	bodytext mediumtext,
	assets int(11) unsigned DEFAULT '0' NOT NULL,
	assets_medium int(11) unsigned DEFAULT '0' NOT NULL,
	assets_large int(11) unsigned DEFAULT '0' NOT NULL,
	imageorient tinyint(4) unsigned DEFAULT '0' NOT NULL,
	imagecols tinyint(4) unsigned DEFAULT '0' NOT NULL,
	imagecols_medium tinyint(4) unsigned DEFAULT '0' NOT NULL,
	imagecols_large tinyint(4) unsigned DEFAULT '0' NOT NULL,
	image_zoom tinyint(3) unsigned DEFAULT '0' NOT NULL,
	media_size_small varchar(20) DEFAULT '' NOT NULL,
	media_size_medium varchar(20) DEFAULT '' NOT NULL,
	media_size_large varchar(20) DEFAULT '' NOT NULL,

	KEY parent (pid,sorting),
	KEY language (l10n_parent,sys_language_uid)
);

#
# Table structure for table 'tx_starter_tab_element'
#
CREATE TABLE tx_starter_tab_element (
	type varchar(100) NOT NULL DEFAULT '0',
	layout varchar(255) DEFAULT '' NOT NULL,
	tt_content_tab int(11) DEFAULT '0' NOT NULL,
	header varchar(255) DEFAULT '' NOT NULL,
	subheader varchar(255) DEFAULT '' NOT NULL,
	rowDescription text,
	bodytext mediumtext,
	assets int(11) unsigned DEFAULT '0' NOT NULL,
	assets_medium int(11) unsigned DEFAULT '0' NOT NULL,
	assets_large int(11) unsigned DEFAULT '0' NOT NULL,
	imageorient tinyint(4) unsigned DEFAULT '0' NOT NULL,
	imagecols tinyint(4) unsigned DEFAULT '0' NOT NULL,
	image_zoom tinyint(3) unsigned DEFAULT '0' NOT NULL,
	media_size_small varchar(20) DEFAULT '' NOT NULL,
	media_size_medium varchar(20) DEFAULT '' NOT NULL,
	media_size_large varchar(20) DEFAULT '' NOT NULL,

	KEY parent (pid,sorting),
	KEY language (l10n_parent,sys_language_uid)
);
