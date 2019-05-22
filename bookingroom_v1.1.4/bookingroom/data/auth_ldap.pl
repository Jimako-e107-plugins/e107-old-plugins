#!/usr/bin/perl -w

# $Id: auth_ldap.pl,v 1.2 2001/02/25 01:34:20 lbayuk Exp $

$server = shift;
$dn = shift;
$password = shift;

use Net::LDAP qw(LDAP_SUCCESS);

$ldap = Net::LDAP->new($server) or exit 1;

$msg = $ldap->bind(dn => $dn, password => $password);

exit $msg->code;
