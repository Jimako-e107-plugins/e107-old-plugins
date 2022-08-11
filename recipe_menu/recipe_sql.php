 CREATE TABLE recipemenu_recipes (
  recipe_id int(10) unsigned NOT NULL auto_increment,
  recipe_name VARCHAR(50) default '',
  recipe_author VARCHAR(100) default '',
  recipe_servings VARCHAR(100) default '',
  recipe_preptime VARCHAR(100) default '',
  recipe_ingredients text,
  recipe_body text,
  recipe_source text,
  recipe_nutrition text,
  recipe_category int(10) unsigned NOT NULL default '0',
  recipe_approved int(10) unsigned NOT NULL default '0',
  recipe_posted int(10) unsigned NOT NULL default '0',
  recipe_picture varchar(200) default '',
  recipe_views int(10) unsigned NOT NULL default '0',
  recipe_viewers text,
  PRIMARY KEY  (recipe_id)
  ) TYPE=MyISAM;

CREATE TABLE recipemenu_category (
  recipe_category_id int(10) NOT NULL auto_increment,
  recipe_category_name VARCHAR(50) default NULL,
  recipe_category_description VARCHAR(250) default NULL,
  recipe_category_updated int(10) unsigned NOT NULL default '0',
  recipe_category_icon VARCHAR(50) default NULL,
  PRIMARY KEY  (recipe_category_id)
  ) TYPE=MyISAM;
