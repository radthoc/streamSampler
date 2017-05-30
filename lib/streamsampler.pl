#!/usr/bin/perl
use strict;

if (-t STDIN || not defined $ARGV[0]) {
    die "Usage: command | streamsampler.pl length\n";
}

my $length;
my $line;

$length = $ARGV[0];

open(my $file_handler, '>', 'web/data/files/stream.txt') or die "Error: Unable to create stream file";

foreach $line ( <STDIN> ) {
    chomp( $line );
    print $file_handler $line;
}

close $file_handler;

exec("php app/console app:stream-sampler $length file");

#TODO: Refactor to validate size of stream in order to use a file only if its too large,
# and if not send the stream to the stream-sampler command
# exec("php app/console app:stream-sampler $length $stream");
