#!/usr/bin/perl
use strict;

if (-t STDIN || not defined $ARGV[0]) {
    die "Usage: command | streamsampler.pl length\n";
}

my $length;
my $line;
my $stream;

$length = $ARGV[0];

foreach $line ( <STDIN> ) {
    chomp( $line );
    $stream = $stream . $line;
}

$stream =~ s/ //g;

exec("php app/console app:stream-sampler $length $stream");

#TODO: Refactor to validate size of stream in order to use a file only if its too large,
# and if not send the stream to the stream-sampler command
# exec("php app/console app:stream-sampler $length $stream");
