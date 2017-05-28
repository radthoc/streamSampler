#!/usr/bin/perl
use warnings;
use strict;

my $length;
my $piped_value;

$length = $ARGV[0];
$piped_value = <STDIN>;

exec("php app/console app:stream-sampler $length $piped_value");