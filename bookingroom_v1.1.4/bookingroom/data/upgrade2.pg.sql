# $Id: upgrade2.pg.sql,v 1.3 2004/05/14 01:52:14 thierry_bo Exp $

# Add an extra column to the mrbs_repeat table for rep_type 6
ALTER TABLE mrbs_repeat
ADD COLUMN rep_num_weeks smallint DEFAULT 0 NULL;
