ReadMe.txt
-----------

Features
1. Events.
   a. Event Admin/Creation pages.
      - Manage:
         . Event summary
            -> Owner
            -> Moderators
         . Event settings
            -> Name
            -> Password to join
            -> Game
            -> Type -> 1v1 or team ladder
            -> Enable/disable scoring, and draws
            -> Dates (start/end)
            -> Description
         . Event rules
            -> Rules
         . Event reset
            -> reset players/teams, reset scores, deleteevent
            -> Stats coeffs 
               -> nbr_games_to_rank, nbr_team_games_to_rank
               -> % for each stats categorie
               -> "Info only" mode, if you want to show the stat but not count it in results.
               -> TBD: ELO K, ELO M, ELO_default (can't be changed if one player has signed up)
               -> TBD: TS beta, epsilon (can't be changed if one player has signed up)
         . TBD: Ban/Kick Players/Teams

2. Events Info: Results/Ranking/Ratings
   a. List of categories:
      - Requirements to rank
        . Games required for player/team rating.
        . Nbr of players required for team rating
      - Scoring Catagories
        . Overall Rating
        . Games played
        . Wins, Losses, W/D/L, Victory ratio (W/L), Victory % (100*W/Games Played)
        . Avg score/points per game
        . Avg enemy score/points per game
        . Unique opponents (absolute, %)
        . Avg rating played
        . ELO
        . Rank delta, with up/down arrow next to rank
        . streak of victory & loss
        . score
        . score difference
        . points 
Suggestions:
- rank delta could be accumulated (like streaks) 
   - until delta is changing sign. if old_delta*delta > 0 -> ...
   - or since last match...
           
3. Match report
Suggestions:
   a. Need improved error checking when match report.
      - Need to check all possible cases.
   b. ELO calculation.
      Maybe need to multiply K/M by the number of players per team, since ELO of a team is sum of players ELOs.
   c. Sort names alphabetically, not by rank in the list boxes?
   d. Clanmates should not be able to play against each other.

4. Teams
   a. Team Admin/Creation pages
      - Kick
      - TBD: Ban
      - password to join
   b. Divisions Admin page ?

5. User Account
   a. TBD: Xfire?
   b. TBD: Team chooser, for each Game?

6. Awards
 - player took 1st place
 - player got into top 10
 - player streaks: 5/10/25 games won in a row

7. tinyMCE
- Images, Emoticons

8. Misc

9. Credits
  - DHTML calendar 1.0 - http://www.dynarch.com/projects/calendar
  - Tab Pane 1.02 - http://webfx.eae.net
  - TrueSkill™ Ranking system - http://research.microsoft.com/mlp/trueskill/
  - Pagination "Multiple Pages of Data from a Text File" - http://www.codewalkers.com/c/a/Database-Articles/Multiple-Pages-of-Data-from-a-Text-File/
  - Tigra Slider Control - http://www.softcomplex.com/products/tigra_slider_control/
  - Games icons - xfireplus.com
  - Photoshop/Design - http://www.empiredezign.com, http://www.tutorialstream.com
  - Ajax spinner - ajaxload.info

SQL database
- Queries:
 . eventinfo -> . 35 + 2 if signed up
 . updatestats: 3 + 2*players + 2* matches
 
BUGS:
Priority 1
Priority 2
- Problem when editing include/main.php in UltraEdit.
  UltraEdit adds "0xFEFF" signature (BOM) at the beginning of the file, creating "header already sent" issues.

Ideas:
- caption for ebattles menu.
- number of things to display in eb_recent_activity
- for forms validations, 
Before showing a button, I check if the user can use this button or not...
 . Should I re-check the user validity after the form is submitted?
 . Should check the button has been pressed: 
// form:
<input class="button" type="submit" name="matchreport" value="Match Report"/>
or
<input type="hidden" name="matchreport" value="1">
...
// submit:
if (!isset($_POST['matchreport']))
{
    $text .= "<p>You are not authorized to report a match.</p>";
    $text .= "<p>Back to [<a href=\"".e_PLUGIN."ebattles/eventinfo.php?eventid=$event_id\">Event</a>]</p>";
}
else
{
    ... 
}
 . Can $_POST be hacked somehow? Since it does not appear in the URL, can someone force a the value of $_POST ?
 . If $_POST contains enough info, we should not have to recheck everytinh after submit.
 . how do you handle cases like: join button appears if player has not joined yet.
   You have to check pre/post submit, because someone can open 2 pages showing the "join" button, then join twice.

- 2 players with the same userid and team can not be allowed.
Let's say a player plays for a clan, then quit the clan, and re-joins the clan, he'll be automatically signed up to the event again.
So there will be 2 players with the same userid, and team, unless quitting the clan also delete the players.

Now, we can delete members without deleting the corresponding players w/o leaving orphans.
But the example above shows there is an issue with this.
If the Players table references the members table, then deleting a member will force to delete the players.

- Kicking members of divisions has the same issue.
We can not delete members w/o deleting the corresponding players.
And we can delete players only if they have not scored yet.
Therefore, we can only delete members if they have not played in a match yet.

- Problem with having 2 players with the same userid in the same event.
  Since we do not know which player the current user is,
 . the user can not use quick loss report
 . if the user quits the event, it will delete both players
 - Add "Are you sure..." when deleting/quitting things.

- e107 admin can delete a user.
=> need to make sure each time we reference users, we check if exists.
.TBL_EVENTS.".Owner
.TBL_EVENTMODS.".User
.TBL_CLANS.".Owner
.TBL_DIVISIONS.".Captain
.TBL_MEMBERS.".User
.TBL_MATCHS.".ReportedBy
.TBL_PLAYERS.".User


EBATTLES.FREEHOSTIA.COM specific issues:
 - Forgot password won't work, because we can't send emails...
   e107 PHP mailer is not always workin properly
 - sometimes, the site can freeze, and the page source will stop at <!-- log meta -->
   This is because of corrupted site stats.
   Can be fixed by erasing logs in e107_plugins/log/logs

Regression:
- Need to make sure that the check to see if user can join/report/modify/delete is performed at the proper time.
- Should not be able to report a game as a guest
  To reproduce this, go to the match report page in a tab, and logout in another tab.
  When you Submit, the match, it will be as a Guest.

- to-do
. send PM on add player.