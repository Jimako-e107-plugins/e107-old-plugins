# $Id: upgrade2.my.sql,v 1.2.2.1 2004/11/29 23:12:33 jberanek Exp $

# Add an extra column to the mrbs_repeat table for rep_type 6
ALTER TABLE mrbs_repeat
ADD COLUMN rep_num_weeks smallint NULL;
