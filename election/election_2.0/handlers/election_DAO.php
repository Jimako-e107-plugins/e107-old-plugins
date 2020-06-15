<?php
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/election/handlers/election_DAO.php,v $
| $Revision: 1.4 $
| $Date: 2008/02/10 15:22:02 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

/**
 * Class used to control all database access for election
 */
class electionDAO
{
    var $candidates;  // Cached candidates list
    var $voters;      // Cached voters list
    var $posters;     // Cached posters list
    var $owners;      // Cached owners list

    // Switch debug options on
    var $debug;

    /**
     * Constructor
     */
    function __construct()
    {
        global $pref;
        $this->debug = false; //"now";
    }

    /**
     * Get a specific election
     * @param $electionid  the election ID for the election to be retrieved
     */
    function getElection($electionid, $getcandidates = false)
    {
        global $sql;

        $election = false;
        if ($res = $sql->db_Select(ELECC_ELECTIONS_TABLE, "*", "election_id=$electionid", true, $this->debug))
        {
            $election = new electionElection($sql->db_Fetch(), $getcandidates);
        }
        else
        {
            if ($sql->getLastErrorNumber() != 0)
            {
                echo "<br>**" . $sql->getLastErrorNumber() . " : " . $sql->getLastErrorText();
            }
        }

        return $election;
    }

    /**
     * Get a list of elections
     */
    function getElectionList()
    {
        global $sql;

        $electionslist = array();
        if ($res = $sql->db_Select(ELECC_ELECTIONS_TABLE, "*", ELEC_ELECTION_ORDER, "no-where", $this->debug))
        {
            while ($row = $sql->db_Fetch())
            {
                $election = new electionElection($row);
                if (check_class($election->getViewClass()))
                {
                    $electionslist[$election->getId()] = $election;
                }
            }
        }
        else
        {

            if ($sql->getLastErrorNumber() != 0)
            {
                echo "<br>**" . $sql->getLastErrorNumber() . " : " . $sql->getLastErrorText();
            }
        }

        return $electionslist;
    }

    /**
     * Get a list of candidates for an election
     * @param  $electionid election ID to get candidates for, or false to get all candidates
     * @param  $force force a refresh of the cached list
     * @return        a list of candidates
     */
    function getCandidateList($electionid = false, $force = false)
    {
        global $sql;

        if (!isset($this->candidates) || $force)
        {
            $this->candidates = array();
            if ($res = $sql->db_Select(ELECC_CANDIDATES_TABLE, "*", ELECC_CANDIDATES_ORDER, "no-where", $this->debug))
            {
                while ($row = $sql->db_Fetch())
                {
                    $candidate = new electionCandidate($row);
                    $this->candidates[$candidate->getId()] = $candidate;
                }
            }
            else
            {
                if ($sql->getLastErrorNumber() != 0)
                {
                    echo "<br>**" . $sql->getLastErrorNumber() . " : " . $sql->getLastErrorText();
                }
            }
        }

        // Get a copy of the object as it may get modified
        $candidates = $this->_clone($this->candidates);
        if ($electionid !== false)
        {
            $candidates = $this->_discard($candidates, $electionid, "getElectionId");
        }

        return $candidates;
    }

    /**
     * Get a candidate
     * @param $candidateid ID of the candidate to get
     */
    function getCandidate($candidateid)
    {
        global $sql;

        // Make sure we have a potentially valid ID
        if (!is_numeric($candidateid))
        {
            return false;
        }

        if ($res = $sql->db_Select(ELECC_CANDIDATES_TABLE, "*", "where election_candidate_id=$candidateid ", "no-where", $this->debug))
        {
            $candidate = new electionCandidate($sql->db_Fetch());
        }
        else
        {
            $candidate = false;
            if ($sql->getLastErrorNumber() != 0)
            {
                echo "<br>**" . $sql->getLastErrorNumber() . " : " . $sql->getLastErrorText();
            }
        }

        return $candidate;
    }

    /**
     * Get the total number of candidates for an election/all elections
     * @param $electionid ID of election to get count for or false to get count of all candidates in all elections
     */
    function getCandidateCount($electionid = false)
    {
        global $sql;
        if ($electionid)
        {
            return $sql->db_Count(ELECC_CANDIDATES_TABLE, "(*)", "where election_candidate_election_ids=$electionid", $this->debug);
        }
        else
        {
            return $sql->db_Count(ELECC_CANDIDATES_TABLE, "(*)", "", $this->debug);
        }
    }

    /**
     * Get a list of voters for an election
     * $electionidthe ID of the election to get votes for
     * @return  a list of voters
     */
    function getVoterList($electionid)
    {
        global $sql;

        if (!isset($this->voters))
        {
            $this->voters = array();
            if ($res = $sql->db_Select(ELECC_VOTERS_TABLE, "*", "", "no-where", $this->debug))
            {
                while ($row = $sql->db_Fetch())
                {
                    $vote = new electionVoter($row);
                    $this->voters[$vote->getTimestamp()] = $vote;
                }
            }
            else
            {
                if ($sql->getLastErrorNumber() != 0)
                {
                    echo "<br>**" . $sql->getLastErrorNumber() . " : " . $sql->getLastErrorText();
                }
            }
        }

        // Get a copy of the object as it may get modified
        $votes = $this->_clone($this->voters);
        if ($electionid !== false)
        {
            $votes = $this->_discard($votes, $electionid, "getElectionId", "getTimestamp");
        }

        return $votes;
    }

    /**
     * Get a users votes
     * @param $userid user ID of the user to get votes for
     * @return users votes as an array, 1st vote in index 1, 2nd in 2, etc.
     */
    function getVotesForUser($userid)
    {
        global $sql;

        if ($res = $sql->db_Select(ELECC_VOTERS_TABLE, "*", "election_voter_user_id='$userid'", true, $this->debug))
        {
            $voter = new electionVoter($sql->db_Fetch());
        }
        else
        {
            if ($sql->getLastErrorNumber() != 0)
            {
                echo "<br>**" . $sql->getLastErrorNumber() . " : " . $sql->getLastErrorText();
            }
        }

        return $voter;
    }

    /**
     * Get the total number of votes for an election
     * @param $electionid ID of election to get count for
     */
    function getElectionVoterCount($electionid)
    {
        global $sql;
        return $sql->db_Count(ELECC_VOTERS_TABLE, "(*)", "where election_voter_election_id=$electionid", $this->debug);
    }

    /**
     * Get the total number of votes for a candidate
     * @param $candidateid ID of candidate to get count for
     */
    function getCandidateVoterCount($candidateid)
    {
        global $sql;
        return $sql->db_Count(ELECC_VOTERS_TABLE, "(*)", "where election_voter_votes REGEXP('(^|,)($candidateid)(,|$)')", $this->debug);
    }

    /**
     * Cast a vote
     * @param $electionid   the id of the election that the votes are for
     * @param $vote         a populated vote object
     */
    function castVote($electionid, $votes)
    {
        global $sql, $tp;
        $qry = array();
        $userid = USER ? USERID : 0;
        $qry[] = "'" . $userid . "'";                 // voter ID
        $qry[] = "'" . $_SERVER['REMOTE_ADDR'] . "'"; // voter ID
        $qry[] = "'$electionid'";                 // election ID
        $qry[] = "'" . implode(",", $votes) . "'";    // votes
        $qry[] = "'" . time() . "'";                  // timestamp
        $qry = implode(",", $qry);
        if (false !== $sql->db_Insert(ELECC_VOTERS_TABLE, $qry, $this->debug))
        {
            return true;
        }
        else
        {
            $statusInfo = new electionStatusInfo(STATUS_ERROR);
            $statusInfo->addMessage(ELEC_LAN_MSG_DB_ADD, $sql->getLastErrorNumber() . " : " . $sql->getLastErrorText() . ", query string is " . $qry);
            return $statusInfo;
        }
    }

    /**
     * Check if the current user has voted in the supplied election
     * @param $electionid  the election ID for the election to be checked
     */
    function hasVoted($electionid)
    {
        global $sql;

        $election = false;
        if ($res = $sql->db_Select(ELECC_VOTERS_TABLE, "*", "election_voter_election_id=$electionid and election_voter_user_id=" . USERID, true, $this->debug))
        {
            return true;
        }
        else if ($res = $sql->db_Select(ELECC_VOTERS_TABLE, "*", "election_voter_election_id=$electionid and election_voter_user_id=0 AND election_voter_user_ip='" . $_SERVER['REMOTE_ADDR'] . "'", true, $this->debug))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Helper function to remove items from a list of objects that are not present in a list of wanted items.
     * If the object's match function returns a value in the wanted list then the object is not discarded.
     * The objects must support two functions - getId() and the match function passed as a paremter.
     * @param $array     a list of objects that have a getId() function
     * @param $wanted    a comma separated list of IDs for which items are to be returned, defaults to false to get all items
     * @param $matchfun  function supported by the passed in objects used to determine if a match is made or not, defaults to getId
     * @param $keyfunc   function supported by the passed in objects used to determine the key for the current object, defaults to getId
     * @return           the passwed in array with appropriate objects discarded
     * @private
     */
    function _discard($array, $wanted, $matchfunc = "getId", $keyfunc = "getId")
    {
        $wanted = explode(",", $wanted);
        foreach ($array as $item)
        {
            if (array_search($item->$matchfunc(), $wanted) === false)
            {
                unset($array[$item->$keyfunc()]);
            }
        }
        return $array;
    }

    /**
     * Get a clone of an object
     * @param  $object the object to be cloned
     * @return         a clone of the supplied object
     * @private
     */
    function _clone($object)
    {
        return unserialize(serialize($object));
    }
}

