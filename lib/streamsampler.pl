#!/usr/bin/perl
use strict;

if (-t STDIN || not defined $ARGV[0]) {
    die "Usage: command | streamsampler.pl length\n";
}

my $length;
my $piped_value;

$length = $ARGV[0];
$piped_value = <STDIN>;

exec("php app/console app:stream-sampler $length $piped_value");